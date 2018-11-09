<?php

class Cricket_players extends MX_Controller {

    private $data = array();
    private $error = array();
    private $meta_title;
    private $imageWidth;
    private $imageHeight;
    private $bannerWidth;
    private $bannerHeight;

    public function __construct() {
        parent::__construct();
        if (!$this->users_lib->isLogged()):
            redirect('admin');
        endif;
        $this->meta_title = humanize(__CLASS__);
        $this->load->model('cricket_module/cricket_players_model');
        $this->load->model('cricket_module/cricket_roles_model');
        $this->load->model('cricket_module/cricket_teams_model');
        $this->load->model('cricket_module/cricket_batting_types_model');
        $this->load->model('cricket_module/cricket_bowlling_types_model');
        $this->load->model('cricket_module/cricket_tournament_levels_model');
        $this->load->model('cricket_module/cricket_tournament_types_model');

        $this->imageWidth = $this->settings_lib->config('config', 'list_image_width');
        $this->imageHeight = $this->settings_lib->config('config', 'list_image_height');
        $this->bannerWidth = $this->settings_lib->config('config', 'list_banner_width');
        $this->bannerHeight = $this->settings_lib->config('config', 'list_banner_height');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('cricket_module/api/cricket_players_api/list');
        $this->data['ajax_export'] = base_url('cricket_module/api/cricket_players_api/export');
        $this->data['ajax_delete'] = base_url('cricket_module/api/cricket_players_api/delete');
        $this->data['ajax_form'] = base_url('cricket_module/cricket_players/form');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->meta_title;
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('cricket_module/cricket_players/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->cricket_players_model->getById($id);

        $roles = $this->cricket_players_model->getRoles($id);
        $levels = $this->cricket_players_model->getLevels($id);

        if ($roles):
            $this->data['roles'] = $roles;
        else:
            $this->data['roles'] = array();
        endif;

        if ($levels):
            $this->data['levels'] = $levels;
        else:
            $this->data['levels'] = array();
        endif;

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

        if (isset($result['type_id']) && $result['type_id']) :
            $this->data['type_id'] = $result['type_id'];
        else:
            $this->data['type_id'] = 0;
        endif;
        if (isset($result['bowlling_type_id']) && $result['bowlling_type_id']) :
            $this->data['bowlling_type_id'] = $result['bowlling_type_id'];
        else:
            $this->data['bowlling_type_id'] = 0;
        endif;
        if (isset($result['batting_type_id']) && $result['batting_type_id']) :
            $this->data['batting_type_id'] = $result['batting_type_id'];
        else:
            $this->data['batting_type_id'] = 0;
        endif;

        if (isset($result['name']) && $result['name']) :
            $this->data['name'] = $result['name'];
        else:
            $this->data['name'] = '';
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


        if (isset($result['image']) && $result['image']) :
            $this->data['image'] = $result['image'];
        else:
            $this->data['image'] = '';
        endif;


        $this->custom_image->width = $this->imageWidth;
        $this->custom_image->height = $this->imageHeight;
        $this->data['image_thumb'] = $this->custom_image->image_resize($this->data['image']);

        if (isset($result['banner']) && $result['banner']) :
            $this->data['banner'] = $result['banner'];
        else:
            $this->data['banner'] = '';
        endif;
        $this->custom_image->width = $this->bannerWidth;
        $this->custom_image->height = $this->bannerHeight;
        $this->data['banner_thumb'] = $this->custom_image->image_resize($this->data['banner']);

        $this->custom_image->width = $this->imageWidth;
        $this->custom_image->height = $this->imageHeight;
        $this->data['thumb'] = $this->custom_image->image_resize('upload/images/placeholder.png');

        $this->data['cricket_teams'] = $this->cricket_teams_model->getTables();
        $this->data['cricket_roles'] = $this->cricket_roles_model->getTables();
        $this->data['cricket_tournament_levels'] = $this->cricket_tournament_levels_model->getTables();
        $this->data['cricket_tournament_types'] = $this->cricket_tournament_types_model->getTables();
        $this->data['cricket_batting_types'] = $this->cricket_batting_types_model->getTables();
        $this->data['cricket_bowlling_types'] = $this->cricket_bowlling_types_model->getTables();

        $this->data['ajax_list'] = base_url('cricket_module/cricket_players');
        $this->data['ajax_save'] = base_url('cricket_module/api/cricket_players_api/save');

        $this->data['meta_title'] = $this->meta_title . ' ' . humanize(__FUNCTION__);
        $this->data['sidebar'] = $this->sidebar->load();
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('cricket_module/cricket_players/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}
