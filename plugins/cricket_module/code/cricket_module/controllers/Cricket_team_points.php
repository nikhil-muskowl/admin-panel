<?php

class Cricket_team_points extends MX_Controller {

    private $data = array();
    private $error = array();
    private $meta_title;

    public function __construct() {
        parent::__construct();
        if (!$this->users_lib->isLogged()):
            redirect('admin');
        endif;
        $this->meta_title = humanize(__CLASS__);
        $this->load->model('cricket_module/cricket_teams_model');
        $this->load->model('cricket_module/cricket_players_model');
        $this->load->model('cricket_module/cricket_team_points_model');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('cricket_module/api/cricket_team_points_api/list');
        $this->data['ajax_delete'] = base_url('cricket_module/api/cricket_team_points_api/delete');
        $this->data['ajax_approved_poitns'] = base_url('cricket_module/api/cricket_team_points_api/approved_poitns/');
        $this->data['ajax_cancel_poitns'] = base_url('cricket_module/api/cricket_team_points_api/cancel_poitns/');
        $this->data['ajax_return_poitns'] = base_url('cricket_module/api/cricket_team_points_api/return_poitns/');
        $this->data['ajax_form'] = base_url('cricket_module/cricket_team_points/form');
        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('cricket_module/cricket_team_points/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->cricket_team_points_model->getById($id);

        if (isset($result['id']) && $result['id']) :
            $this->data['id'] = $result['id'];
        else:
            $this->data['id'] = 0;
        endif;

        if (isset($result['team_id']) && $result['team_id']) :
            $this->data['team_id'] = $result['team_id'];
        else:
            $this->data['team_id'] = 0;
        endif;
        if (isset($result['player_id']) && $result['player_id']) :
            $this->data['player_id'] = $result['player_id'];
        else:
            $this->data['player_id'] = 0;
        endif;

        if (isset($result['description']) && $result['description']) :
            $this->data['description'] = $result['description'];
        else:
            $this->data['description'] = '';
        endif;

        if (isset($result['points']) && $result['points']) :
            $this->data['points'] = $this->settings_lib->number_format($result['points']);
        else:
            $this->data['points'] = '';
        endif;

        $this->data['cricket_teams'] = $this->cricket_teams_model->getTables();
        $this->data['cricket_players'] = $this->cricket_players_model->getTables();

        $this->data['ajax_list'] = base_url('cricket_module/cricket_team_points');
        $this->data['ajax_save'] = base_url('cricket_module/api/cricket_team_points_api/save');

        $this->data['meta_title'] = $this->meta_title . ' ' . humanize(__FUNCTION__);
        $this->data['sidebar'] = $this->sidebar->load();
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('cricket_module/cricket_team_points/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}
