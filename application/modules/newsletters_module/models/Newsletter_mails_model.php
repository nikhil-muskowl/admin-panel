<?php

class Newsletter_mails_model extends CI_Model {

    private $table = 'newsletter_mails';
    private $table_view = 'newsletter_mails';
    private $column_order = array(null, 'title', 'name', 'email', 'contact', 'status', 'created_date', 'modified_date', null);
    private $column_search = array('title', 'name', 'email', 'contact', 'status', 'created_date', 'modified_date');
    private $order = array('modified_date' => 'desc');
    private $status;

    public function __construct() {
        parent::__construct();
        $this->status = 1;
    }

    private function _getTablesQuery($array = array()) {
        $this->db->from($this->table_view);

        if ($this->input->post('status') && $this->input->post('status') == 'false'):
            $this->status = 0;
        endif;
        $this->db->where('status', $this->status);


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

        return $this->db->count_all_results();
    }

    public function getById($id) {
        $this->db->from($this->table_view);
        $this->db->where('id', $id);
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

        $this->db->set('title', $this->input->post('title'));
        $this->db->set('name', $this->input->post('name'));
        $this->db->set('email', $this->input->post('email'));
        $this->db->set('contact', $this->input->post('contact'));
        $this->db->set('subject', $this->input->post('subject'));
        $this->db->set('text', $this->input->post('text'));
        $this->db->set('html', $this->input->post('html'));

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

    public function getNewsletters() {
        $this->db->from('newsletters');
        $this->db->where('subscribe', 1);
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function setNewsletterMails($data = array()) {
        $this->db->trans_start();

        $this->db->set('title', $data['title']);
        $this->db->set('name', $data['name']);
        $this->db->set('email', $data['email']);
        $this->db->set('contact', $data['contact']);
        $this->db->set('to_email', $data['to_email']);
        $this->db->set('subject', $data['subject']);
        $this->db->set('text', $data['text']);
        $this->db->set('html', $data['html']);
        $this->db->set('email_status', $data['email_status']);

        $this->db->insert('newsletter_mail_trackers');

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    public function postEmails($id) {
        $status = TRUE;
        $newsletter_mails = $this->getById($id);

        if ($newsletter_mails):

            $this->email_lib->fromEmail = $newsletter_mails['email'];
            $this->email_lib->fromName = $newsletter_mails['name'];

            $newsletters = $this->getNewsletters();

            if ($newsletters):
                foreach ($newsletters as $newsletter) :
                    $this->email_lib->toEmail = $newsletter['email'];
                    $this->email_lib->subject = $newsletter_mails['subject'];
                    $this->email_lib->message = $newsletter_mails['html'];
                    if ($this->email_lib->send()):
                        $status = TRUE;
                        $email_status = 'sent';
                    else:
                        $status = FALSE;
                        $email_status = 'failed';
                    endif;

                    $dataArray = array(
                        'title' => $newsletter_mails['title'],
                        'name' => $newsletter['name'],
                        'email' => $newsletter_mails['email'],
                        'contact' => $newsletter_mails['contact'],
                        'to_email' => $newsletter['email'],
                        'subject' => $newsletter_mails['subject'],
                        'text' => $newsletter_mails['text'],
                        'html' => $newsletter_mails['html'],
                        'email_status' => $email_status,
                    );

                    $this->setNewsletterMails($dataArray);

                endforeach;
            endif;
        else:
            $status = FALSE;
        endif;

        return $status;
    }

}
