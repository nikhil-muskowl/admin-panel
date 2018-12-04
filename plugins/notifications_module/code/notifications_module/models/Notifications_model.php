<?php

class Notifications_model extends CI_Model {

    private $table = 'notifications';
    private $detailTable = 'notification_details';
    private $table_view = 'notifications_view';
    private $column_order = array(null, 'title', 'status', 'created_date', 'modified_date', null);
    private $column_search = array('title', 'status', 'created_date', 'modified_date');
    private $order = array('modified_date' => 'desc');
    private $status;
    private $language_id;
    private $fcm_key;
    private $pushy_key;

    public function __construct() {
        parent::__construct();
        $this->status = 1;
        $this->language_id = 1;

        $this->fcm_key = $this->settings_lib->config('notifications_module', 'fcm_key');
        $this->pushy_key = $this->settings_lib->config('notifications_module', 'pushy_key');
    }

    private function _getTablesQuery($array = array()) {
        $this->db->from($this->table_view);

        if ($this->input->post('status') && $this->input->post('status') == 'false'):
            $this->status = 0;
        endif;
        $this->db->where('status', $this->status);


        if ($this->input->post('language_id')):
            $this->language_id = $this->input->post('language_id');
        elseif ($this->languages_lib->getLanguageId()):
            $this->language_id = $this->languages_lib->getLanguageId();
        endif;
        $this->db->where('language_id', $this->language_id);



        $i = 0;
        foreach ($this->column_search as $item) :
            if (isset($_POST['length'])) :
                if (isset($_POST['search']['value'])) :
                    if ($i === 0) :
                        $this->db->group_start();
                        $this->db->like($item, $_POST['search']['value']);
                    else :
                        $this->db->or_like($item, $_POST['search']['value']);
                    endif;
                    if (count($this->column_search) - 1 == $i):
                        $this->db->group_end();
                    endif;
                endif;
            endif;
            $i++;
        endforeach;

        if (isset($_POST['order'])) :
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        elseif (isset($this->order)) :
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        endif;
    }

    public function getTables($array = array()) {
        $this->_getTablesQuery($array);
        if (isset($_POST['length'])) :
            if ($_POST['length'] != -1):
                $this->db->limit($_POST['length'], $_POST['start']);
            endif;
        endif;
        $query = $this->db->get();

//        print_r($this->db->last_query());
//        exit;
        return $query->result_array();
    }

    public function countFiltered($array = array()) {
        $this->_getTablesQuery($array);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function countAll() {
        $this->db->from($this->table_view);
        if ($this->input->post('status') && $this->input->post('status') == 'false'):
            $this->status = 0;
        endif;
        $this->db->where('status', $this->status);


        if ($this->input->post('language_id')):
            $this->language_id = $this->input->post('language_id');
        endif;
        $this->db->where('language_id', $this->language_id);
        return $this->db->count_all_results();
    }

    public function getById($id) {
        $this->db->from($this->table_view);
        $this->db->where('id', $id);
        if ($this->input->post('language_id')):
            $this->language_id = $this->input->post('language_id');
        elseif ($this->languages_lib->getLanguageId()):
            $this->language_id = $this->languages_lib->getLanguageId();
        endif;
        $this->db->where('language_id', $this->language_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function deleteById($id) {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function postData() {
        $this->db->trans_start();

        $this->db->set('image', $this->custom_image->get_path($this->input->post('image')));

        if ($this->input->post('id')):
            $id = $this->input->post('id');
            $this->db->where('id', $id);
            $this->db->update($this->table);
        else:
            $this->db->insert($this->table);
            $id = $this->db->insert_id();
        endif;
        $this->postDetails($id);
        $this->setUsers($id);
        $this->sendPushNotification($id);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return $this->getById($id);
        }
    }

    public function postDetails($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->detailTable);

        if ($this->input->post('details')):
            foreach ($this->input->post('details') as $key => $value) :
                $this->db->set('id', $id);
                $this->db->set('language_id', $key);
                $this->db->set('title', $value['title']);
                $this->db->set('description', $value['description']);
                $this->db->insert($this->detailTable);
            endforeach;
        endif;
    }

    public function details($id) {
        $result = array();
        $this->db->from($this->detailTable);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $description = $query->result_array();

        if ($description):
            foreach ($description as $value) :
                $result[$value['language_id']] = array(
                    'id' => $value['id'],
                    'language_id' => $value['language_id'],
                    'title' => $value['title'],
                    'description' => $value['description'],
                );
            endforeach;
        endif;

        return $result;
    }

    public function setUsers($id) {
        $this->db->where('notification_id', $id);
        $this->db->delete('notification_to_users');

        if ($this->input->post('users')):
            foreach ($this->input->post('users') as $value) :
                $this->db->set('notification_id', $id);
                $this->db->set('user_id', $value);
                $this->db->insert('notification_to_users');
            endforeach;
        endif;
    }

    public function getUsers($id) {
        $result = array();
        $this->db->from('notification_to_users');
        $this->db->where('notification_id', $id);
        $query = $this->db->get();
        $description = $query->result_array();

        if ($description):
            foreach ($description as $value) :
                $result[] = $value['user_id'];
            endforeach;
        endif;

        return $result;
    }

    public function getNotificationUsers($id) {
        $this->db->from('notification_user_devices_view');
        $this->db->where('notification_id', $id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function sendPushNotification($id) {
        $status = TRUE;
        $fireBaseDevices = array();
        $PushyDevices = array();
        $image = '';
        $title = '';
        $message = '';

        $notifications = $this->getById($id);
        if ($notifications):
//            print_r($notifications);
//            exit;
            $title = $notifications['title'];
            $message = $notifications['description'];
            $image = base_url($notifications['image']);

            $user_devices = $this->getNotificationUsers($notifications['id']);
//            print_r($user_devices);
//            exit;
            if ($user_devices):
                foreach ($user_devices as $user_device) :
                    if ($user_device['provider'] == 'firebase' && $user_device['code']):
                        $fireBaseDevices[] = $user_device['code'];
                    elseif ($user_device['provider'] == 'pushy' && $user_device['code']):
                        $PushyDevices[] = $user_device['code'];
                    endif;
                endforeach;
            endif;

//            print_r($PushyDevices);
//            exit;

            $data = array(
                'title' => $title,
                'image' => $image,
                'message' => $message
            );

            if ($fireBaseDevices):
                $this->sendGCM($data, $fireBaseDevices);
            endif;

            if ($PushyDevices):
                $this->sendPushy($data, $PushyDevices);
            endif;
        endif;

        return $status;
    }

    public function sendGCM($data, $devices) {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $fields = array(
            'registration_ids' => $devices,
            'data' => $data
        );
        $fields = json_encode($fields);

        $headers = array(
            'Authorization: key=' . $this->fcm_key,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        $result = curl_exec($ch);
//        echo $result;
        curl_close($ch);
        
        return TRUE;
    }

    public function sendPushy($data, $devices) {
        $options = array(
            'notification' => array(
                'badge' => 1,
                'sound' => 'ping.aiff',
                'body' => "Hello World \xE2\x9C\x8C"
            )
        );

        // Insert your Secret API Key here
        $apiKey = $this->pushy_key;

        // Default post data to provided options or empty array
        $post = $options ?: array();

        // Set notification payload and recipients
        $post['to'] = $devices;
        $post['data'] = $data;

        // Set Content-Type header since we're sending JSON
        $headers = array(
            'Content-Type: application/json'
        );

        // Initialize curl handle
        $ch = curl_init();

        // Set URL to Pushy endpoint
        curl_setopt($ch, CURLOPT_URL, 'https://api.pushy.me/push?api_key=' . $apiKey);

        // Set request method to POST
        curl_setopt($ch, CURLOPT_POST, true);

        // Set our custom headers
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Get the response back as string instead of printing it
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Set post data as JSON
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post, JSON_UNESCAPED_UNICODE));

        // Actually send the push
        $result = curl_exec($ch);

        // Display errors
        if (curl_errno($ch)) {
            echo curl_error($ch);
        }

        // Close curl handle
        curl_close($ch);

        // Debug API response
        //echo $result;
        
        return TRUE;
    }

}
