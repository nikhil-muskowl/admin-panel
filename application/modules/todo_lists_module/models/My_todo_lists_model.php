<?php

class My_todo_lists_model extends CI_Model {

    private $table = 'todo_lists';
    private $table_view = 'todo_lists_view';
    private $column_order = array(null, 'subject', 'text', 'status', 'created_date', 'modified_date', null);
    private $column_search = array('subject', 'text', 'status', 'created_date', 'modified_date');
    private $order = array('modified_date' => 'desc');
    private $status;
    private $user_id;
    private $language_id;
    private $date_format;
    private $datetime_format;

    public function __construct() {
        parent::__construct();
        $this->status = 1;
        $this->language_id = 1;
        $this->date_format = $this->settings_lib->config('config', 'date_format');
        $this->datetime_format = $this->settings_lib->config('config', 'datetime_format');
    }

    private function _getTablesQuery($array = array()) {
        $this->db->from($this->table_view);

        if ($this->input->post('status') && $this->input->post('status') == 'false'):
            $this->status = 0;
        endif;
        $this->db->where('status', $this->status);

        $this->db->where('user_id', $this->users_lib->isLogged());

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
        $this->db->set('user_id', $this->users_lib->isLogged());
        if ($this->input->post('language_id')):
            $this->language_id = $this->input->post('language_id');
        elseif ($this->languages_lib->getLanguageId()):
            $this->language_id = $this->languages_lib->getLanguageId();
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

        $this->db->set('user_id', $this->users_lib->isLogged());

        if ($this->input->post('language_id')):
            $this->language_id = $this->input->post('language_id');
        elseif ($this->languages_lib->getLanguageId()):
            $this->language_id = $this->languages_lib->getLanguageId();
        endif;
        $this->db->set('language_id', $this->language_id);

        $this->db->set('subject', $this->input->post('subject'));
        $this->db->set('text', $this->input->post('text'));

        $this->db->set('status', 1);
        if ($this->input->post('id')):
            $id = $this->input->post('id');
            $this->db->where('id', $id);
            $this->db->update($this->table);
        else:
            $this->db->insert($this->table);
            $id = $this->db->insert_id();
        endif;

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return $this->getById($id);
        }
    }

    public function change_status() {
        $this->db->trans_start();

        $id = $this->input->post('id');
        $status = $this->input->post('status');

        if ($status == 'true'):
            $this->db->set('status', 1);
        else:
            $this->db->set('status', 0);
        endif;

        $this->db->where('id', $id);
        $this->db->update($this->table);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function getTodoList() {
        $this->data = array();
        $this->db->from($this->table_view);

        if ($this->input->post('user_id')):
            $this->user_id = $this->input->post('user_id');
        elseif ($this->users_lib->isLogged()):
            $this->user_id = $this->users_lib->isLogged();
        endif;
        $this->db->where('user_id', $this->user_id);

        if ($this->input->post('language_id')):
            $this->language_id = $this->input->post('language_id');
        elseif ($this->languages_lib->getLanguageId()):
            $this->language_id = $this->languages_lib->getLanguageId();
        endif;
        $this->db->where('language_id', $this->language_id);

        if ($this->input->post('status') && $this->input->post('status') == 'false'):
            $this->status = 0;
        endif;
        $this->db->where('status', $this->status);

        if ($this->input->post('date')):
            $this->db->where('DATE(modified_date)', date('Y-m-d', strtotime($this->input->post('date'))));
        endif;

        $result = $this->db->get()->result_array();

        return $result;
    }

    public function getUser($id) {
        $this->db->from('users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function sendToDoEmail() {
        $status = FALSE;
        if ($this->input->post('to_user_id')):
            $user = $this->getUser($this->input->post('to_user_id'));
            if ($user):
                $result = $this->getTodoList();
                if ($result):
                    $this->data['subject'] = date($this->date_format) . ' task list';
                    $this->data['todo_lists'] = array();
                    foreach ($result as $object) :
                        $this->data['todo_lists'][] = array(
                            'user_name' => $object['user_name'],
                            'subject' => $object['subject'],
                            'text' => $object['text'],
                            'status' => $object['status'] ? $this->lang->line('text_open') : $this->lang->line('text_close'),
                            'created_date' => date($this->datetime_format, strtotime($object['created_date'])),
                            'modified_date' => date($this->datetime_format, strtotime($object['modified_date'])),
                        );
                    endforeach;

                    $html = $this->load->view('todo_lists_module/my_todo_lists/send_todo_list', $this->data, TRUE);

                    $cc_users = array();
                    if ($this->input->post('cc_users')):
                        foreach ($this->input->post('cc_users') as $cc):
                            $ccuser = $this->getUser($cc);
                            $cc_users[] = $ccuser['email'];
                        endforeach;
                    endif;

                    $this->email_lib->toEmail = $user['email'];
                    $this->email_lib->cc = $cc_users;
                    $this->email_lib->subject = $this->data['subject'];
                    $this->email_lib->message = $html;
                    if ($this->email_lib->send()):
                        $status = TRUE;
                    else:
                        $status = FALSE;
                    endif;
                else:
                    $status = FALSE;
                endif;
            else:
                $status = FALSE;
            endif;
        else:
            $status = FALSE;
        endif;

        return $status;
    }

    
}
