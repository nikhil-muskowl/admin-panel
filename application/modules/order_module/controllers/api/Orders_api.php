<?php

require APPPATH . '/libraries/REST_Controller.php';

class Orders_api extends Restserver\Libraries\REST_Controller {

    private $data = array();
    private $error = array();
    private $imageWidth;
    private $imageHeight;
    private $bannerWidth;
    private $bannerHeight;

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('order_module/orders_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');
        $this->lang->load('orders', $this->languages_lib->getLanguage());
        $this->imageWidth = $this->settings_lib->config('config', 'list_image_width');
        $this->imageHeight = $this->settings_lib->config('config', 'list_image_height');
        $this->bannerWidth = $this->settings_lib->config('config', 'list_banner_width');
        $this->bannerHeight = $this->settings_lib->config('config', 'list_banner_height');
    }

    public function index_post() {
        $this->data = array();

        $list = $this->orders_model->getTables();

        $result = array();
        foreach ($list as $object) :

            $result[] = array(
                'id' => $object['id'],
                'invoice_no' => $object['invoice_no'],
                'user_id' => $object['user_id'],
                'name' => $object['name'],
                'email' => $object['email'],
                'contact' => $object['contact'],
                'payment_name' => $object['payment_name'],
                'payment_country' => $object['payment_country'],
                'payment_country_id' => $object['payment_country_id'],
                'payment_zone' => $object['payment_zone'],
                'payment_zone_id' => $object['payment_zone_id'],
                'payment_city' => $object['payment_city'],
                'payment_postcode' => $object['payment_postcode'],
                'payment_address' => $object['payment_address'],
                'payment_method' => $object['payment_method'],
                'payment_code' => $object['payment_code'],
                'shipping_name' => $object['shipping_name'],
                'shipping_country' => $object['shipping_country'],
                'shipping_country_id' => $object['shipping_country_id'],
                'shipping_zone' => $object['shipping_zone'],
                'shipping_zone_id' => $object['shipping_zone_id'],
                'shipping_city' => $object['shipping_city'],
                'shipping_postcode' => $object['shipping_postcode'],
                'shipping_address' => $object['shipping_address'],
                'shipping_method' => $object['shipping_method'],
                'shipping_code' => $object['shipping_code'],
                'status' => $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                'created_date' => date('Y-m-d s:i A', strtotime($object['created_date'])),
                'modified_date' => date('Y-m-d s:i A', strtotime($object['modified_date'])),
            );
        endforeach;

        $this->data['recordsTotal'] = $this->orders_model->countAll();
        $this->data['recordsFiltered'] = $this->orders_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function list_post() {
        $this->data = array();

        $list = $this->orders_model->getTables();

        if ($this->input->post('draw')):
            $draw = $this->input->post('draw');
        else:
            $draw = 10;
        endif;

        $result = array();
        foreach ($list as $object) :
            $action = '';
            $action .= '<a class="btn btn-sm btn-primary" href="' . base_url('order_module/orders/form/' . $object['id']) . '" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>';
            $action .= ' <a class="btn btn-sm btn-danger" href="javascript:void(0)" data-toggle="tooltip" title="Delete" onclick="delete_record(' . "'" . $object['id'] . "'" . ')"><i class="fa fa-trash"></i></a>';

            $checkbox = '<input type="checkbox" class="data-check" value="' . $object['id'] . '">';

            $result[] = array(
                $checkbox,
                $object['name'],
                $object['email'],
                $object['contact'],
                $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                date('Y-m-d s:i A', strtotime($object['modified_date'])),
                $action
            );
        endforeach;

        $this->data['draw'] = $draw;
        $this->data['recordsTotal'] = $this->orders_model->countAll();
        $this->data['recordsFiltered'] = $this->orders_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function detail_get($id) {
        $this->data = array();
        $object = $this->orders_model->getById($id);
        if ($object):
            $result = array(
                'id' => $object['id'],
                'invoice_no' => $object['invoice_no'],
                'user_id' => $object['user_id'],
                'name' => $object['name'],
                'email' => $object['email'],
                'contact' => $object['contact'],
                'payment_name' => $object['payment_name'],
                'payment_country' => $object['payment_country'],
                'payment_country_id' => $object['payment_country_id'],
                'payment_zone' => $object['payment_zone'],
                'payment_zone_id' => $object['payment_zone_id'],
                'payment_city' => $object['payment_city'],
                'payment_postcode' => $object['payment_postcode'],
                'payment_address' => $object['payment_address'],
                'payment_method' => $object['payment_method'],
                'payment_code' => $object['payment_code'],
                'shipping_name' => $object['shipping_name'],
                'shipping_country' => $object['shipping_country'],
                'shipping_country_id' => $object['shipping_country_id'],
                'shipping_zone' => $object['shipping_zone'],
                'shipping_zone_id' => $object['shipping_zone_id'],
                'shipping_city' => $object['shipping_city'],
                'shipping_postcode' => $object['shipping_postcode'],
                'shipping_address' => $object['shipping_address'],
                'shipping_method' => $object['shipping_method'],
                'shipping_code' => $object['shipping_code'],
                'status' => $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                'created_date' => date('Y-m-d s:i A', strtotime($object['created_date'])),
                'modified_date' => date('Y-m-d s:i A', strtotime($object['modified_date'])),
            );
            $this->data['status'] = TRUE;
            $this->data['message'] = 'loading..';
            $this->data['result'] = $result;
        else:
            $this->data['status'] = FALSE;
            $this->data['message'] = 'no result found!';
            $this->data['result'] = array();
        endif;

        $this->response($this->data);
    }

    public function save_post() {
        $this->data = array();
        $this->_validation();
        $result = $this->orders_model->postData();
        if ($result):
            $this->data['status'] = TRUE;
            $this->data['message'] = 'update success!';
            $this->data['result'] = $result;
        else:
            $this->data['status'] = FALSE;
            $this->data['message'] = 'update failed!';
            $this->data['result'] = array();
        endif;
        $this->response($this->data);
    }

    public function _validation() {
        $this->data = array();

        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('contact', 'contact', 'required');

        $this->form_validation->set_rules('payment_name', 'payment name', 'required');
        $this->form_validation->set_rules('payment_country_id', 'payment country', 'required');
        $this->form_validation->set_rules('payment_zone_id', 'payment zone', 'required');
        $this->form_validation->set_rules('payment_city', 'payment city', 'required');
        $this->form_validation->set_rules('payment_postcode', 'payment postcode', 'required');
        $this->form_validation->set_rules('payment_address', 'payment address', 'required');

        $this->form_validation->set_rules('shipping_name', 'shipping name', 'required');
        $this->form_validation->set_rules('shipping_country_id', 'shipping country', 'required');
        $this->form_validation->set_rules('shipping_zone_id', 'shipping zone', 'required');
        $this->form_validation->set_rules('shipping_city', 'shipping city', 'required');
        $this->form_validation->set_rules('shipping_postcode', 'shipping postcode', 'required');
        $this->form_validation->set_rules('shipping_address', 'shipping address', 'required');

        if ($this->form_validation->run() == FALSE):
            
            if (form_error('name', '', '')):
                $this->error[] = array(
                    'id' => 'name',
                    'text' => form_error('name', '', '')
                );
            endif;
            
            if (form_error('email', '', '')):
                $this->error[] = array(
                    'id' => 'email',
                    'text' => form_error('email', '', '')
                );
            endif;
            
            if (form_error('contact', '', '')):
                $this->error[] = array(
                    'id' => 'contact',
                    'text' => form_error('contact', '', '')
                );
            endif;

            if (form_error('payment_name', '', '')):
                $this->error[] = array(
                    'id' => 'payment_name',
                    'text' => form_error('payment_name', '', '')
                );
            endif;
            
            if (form_error('payment_country_id', '', '')):
                $this->error[] = array(
                    'id' => 'payment_country_id',
                    'text' => form_error('payment_country_id', '', '')
                );
            endif;
            
            if (form_error('payment_zone_id', '', '')):
                $this->error[] = array(
                    'id' => 'payment_zone_id',
                    'text' => form_error('payment_zone_id', '', '')
                );
            endif;
            
            if (form_error('payment_city', '', '')):
                $this->error[] = array(
                    'id' => 'payment_city',
                    'text' => form_error('payment_city', '', '')
                );
            endif;
            
            if (form_error('payment_postcode', '', '')):
                $this->error[] = array(
                    'id' => 'payment_postcode',
                    'text' => form_error('payment_postcode', '', '')
                );
            endif;
            
            if (form_error('payment_address', '', '')):
                $this->error[] = array(
                    'id' => 'payment_address',
                    'text' => form_error('payment_address', '', '')
                );
            endif;

            if (form_error('shipping_name', '', '')):
                $this->error[] = array(
                    'id' => 'shipping_name',
                    'text' => form_error('shipping_name', '', '')
                );
            endif;
            
            if (form_error('shipping_country_id', '', '')):
                $this->error[] = array(
                    'id' => 'shipping_country_id',
                    'text' => form_error('shipping_country_id', '', '')
                );
            endif;
            
            if (form_error('shipping_zone_id', '', '')):
                $this->error[] = array(
                    'id' => 'shipping_zone_id',
                    'text' => form_error('shipping_zone_id', '', '')
                );
            endif;
            
            if (form_error('shipping_city', '', '')):
                $this->error[] = array(
                    'id' => 'shipping_city',
                    'text' => form_error('shipping_city', '', '')
                );
            endif;
            
            if (form_error('shipping_postcode', '', '')):
                $this->error[] = array(
                    'id' => 'shipping_postcode',
                    'text' => form_error('shipping_postcode', '', '')
                );
            endif;
            
            if (form_error('shipping_address', '', '')):
                $this->error[] = array(
                    'id' => 'shipping_address',
                    'text' => form_error('shipping_address', '', '')
                );
            endif;

            $this->data['status'] = FALSE;
            $this->data['message'] = 'validation error!';
            $this->data['result'] = $this->error;
            echo json_encode($this->data);
            exit;
        endif;
    }

    public function delete_get($id) {
        $this->data = array();
        $result = $this->orders_model->deleteById($id);
        if ($result) {
            $this->data['status'] = TRUE;
            $this->data['message'] = 'delete successfully';
        } else {
            $this->data['status'] = FALSE;
            $this->data['message'] = 'delete failed!';
        }

        $this->response($this->data);
    }

    public function delete_post() {
        $this->data = array();
        $list_id = $this->input->post('list_id');
        foreach ($list_id as $id) {
            $result = $this->orders_model->deleteById($id);
        }
        if ($result) {
            $this->data['status'] = TRUE;
            $this->data['message'] = 'delete successfully';
        } else {
            $this->data['status'] = FALSE;
            $this->data['message'] = 'delete failed!';
        }
        $this->response($this->data);
    }

}
