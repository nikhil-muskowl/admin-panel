<?php

class Newsletters extends MX_Controller {

    private $data;
    private $meta_title;

    public function __construct() {
        parent::__construct();
        if (!$this->users_lib->isLogged()):
            redirect('admin');
        endif;
        $this->meta_title = humanize(__CLASS__);

        $this->load->model('newsletters_module/newsletters_model');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('newsletters_module/api/newsletters_api/list');
        $this->data['ajax_delete'] = base_url('newsletters_module/api/newsletters_api/delete');
        $this->data['ajax_form'] = base_url('newsletters_module/newsletters/form');
        $this->data['ajax_csv_export'] = base_url('newsletters_module/newsletters/csv_export/');
        $this->data['ajax_csv_import'] = base_url('newsletters_module/newsletters/csv_import/');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('newsletters_module/newsletters/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->newsletters_model->getById($id);

        if (isset($result['id']) && $result['id']) :
            $this->data['id'] = $result['id'];
        else:
            $this->data['id'] = 0;
        endif;

        if (isset($result['name']) && $result['name']) :
            $this->data['name'] = $result['name'];
        else:
            $this->data['name'] = '';
        endif;
        if (isset($result['email']) && $result['email']) :
            $this->data['email'] = $result['email'];
        else:
            $this->data['email'] = '';
        endif;
        if (isset($result['contact']) && $result['contact']) :
            $this->data['contact'] = $result['contact'];
        else:
            $this->data['contact'] = '';
        endif;
        if (isset($result['subscribe']) && $result['subscribe']) :
            $this->data['subscribe'] = $result['subscribe'];
        else:
            $this->data['subscribe'] = 0;
        endif;


        $this->data['subscribes'] = array(
            1 => 'yes',
            0 => 'no',
        );

        $this->data['ajax_list'] = base_url('newsletters_module/newsletters');
        $this->data['ajax_save'] = base_url('newsletters_module/api/newsletters_api/save');
        $this->data['ajax_image_form'] = base_url('newsletters_module/newsletters/image_form/');
        

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('newsletters_module/newsletters/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/tinymce_config', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function csv_export() {
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = "\t";
        $newline = "\r\n";
        $filename = $this->meta_title . date('Y-m-d-H-i-s') . ".csv";
        $result = $this->newsletters_model->get_data_csv();
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        $data = chr(255) . chr(254) . mb_convert_encoding($data, 'UTF-16LE', 'UTF-8');
        force_download($filename, $data);
    }

    public function csv_import() {
        $this->benchmark->mark('code_start');
        $this->data = array();
        $this->load->library('csvimport');
        $config['upload_path'] = 'upload/files';
        $config['allowed_types'] = 'csv';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file')) {
            $this->data['status'] = FALSE;
            $this->data['message'] = $this->upload->display_errors('', '');
        } else {
            $data = array('upload_data' => $this->upload->data());
            $file = $data['upload_data']['full_path'];
            $array = $this->csvimport->get_array($file);

            $this->newsletters_model->insert_batch($array);
            $count = count($array);
            $this->benchmark->mark('code_end');
            $elapsed_time = $this->benchmark->elapsed_time('code_start', 'code_end');
            $memory_usage = $this->benchmark->memory_usage();
            $this->data['status'] = TRUE;
            $this->data['message'] = 'Total ' . $count . ' records upload in ' . round($elapsed_time / 60, 2) . ' min memory used ' . $memory_usage;
        }


        echo json_encode($this->data);
    }
    
    public function excel_export() {
        $this->load->library('excel');
        $filename = $this->meta_title . date('Y-m-d-H-i-s') . ".xls";
        $result = $this->newsletters_model->get_data();
        $this->excel->stream($filename, $result);
    }

    public function excel_import() {
        $this->benchmark->mark('code_start');
        $this->data = array();
        $this->load->library('excel');
        $config['upload_path'] = 'storage/upload';
        $config['allowed_types'] = 'xls';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file')) {
            $this->data['status'] = FALSE;
            $this->data['message'] = $this->upload->display_errors('', '');
        } else {
            $data = array('upload_data' => $this->upload->data());
            $file = $data['upload_data']['full_path'];
            $array = $this->excel->excelToArray($file);
            $this->newsletters_model->insert_batch($array);
            $count = count($array);
            $this->benchmark->mark('code_end');
            $elapsed_time = $this->benchmark->elapsed_time('code_start', 'code_end');
            $memory_usage = $this->benchmark->memory_usage();
            $this->data['status'] = TRUE;
            $this->data['message'] = 'Total ' . $count . ' records upload in ' . round($elapsed_time / 60, 2) . ' min memory used ' . $memory_usage;
        }

        echo json_encode($this->data);
    }

    
}
