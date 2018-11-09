<?php

class Cricket_team_matches extends MX_Controller {

    private $data = array();
    private $error = array();
    private $meta_title;

    public function __construct() {
        parent::__construct();
        if (!$this->users_lib->isLogged()):
            redirect('admin');
        endif;
        $this->meta_title = humanize(__CLASS__);
        $this->load->model('cricket_module/cricket_team_matches_model');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('cricket_module/api/cricket_team_matches_api/list');
        $this->data['ajax_delete'] = base_url('cricket_module/api/cricket_team_matches_api/delete');
        $this->data['ajax_form'] = base_url('cricket_module/cricket_team_matches/form');
        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('cricket_module/cricket_team_matches/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->cricket_team_matches_model->getById($id);

        if (isset($result['id']) && $result['id']) :
            $this->data['id'] = $result['id'];
        else:
            $this->data['id'] = 0;
        endif;

        if (isset($result['match_id']) && $result['match_id']) :
            $this->data['match_id'] = $result['match_id'];
        else:
            $this->data['match_id'] = '';
        endif;

        if (isset($result['team_id']) && $result['team_id']) :
            $this->data['team_id'] = $result['team_id'];
        else:
            $this->data['team_id'] = '';
        endif;

        if (isset($result['description']) && $result['description']) :
            $this->data['description'] = $result['description'];
        else:
            $this->data['description'] = '';
        endif;

        $this->data['ajax_list'] = base_url('cricket_module/cricket_team_matches');
        $this->data['ajax_save'] = base_url('cricket_module/api/cricket_team_matches_api/save');
        $this->data['meta_title'] = $this->meta_title . ' ' . humanize(__FUNCTION__);
        $this->data['sidebar'] = $this->sidebar->load();
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('cricket_module/cricket_team_matches/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}
