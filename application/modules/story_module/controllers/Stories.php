<?php

class Stories extends MX_Controller {

    private $data;
    private $meta_title;
    private $imageWidth;
    private $imageHeight;
    private $bannerWidth;
    private $bannerHeight;
    private $pet_module;
    private $event_module;

    public function __construct() {
        parent::__construct();
        if (!$this->users_lib->isLogged()):
            redirect('admin');
        else:
            if (!$this->users_lib->has_permission(__CLASS__, 'is_view')):
                redirect('permission');
            endif;
        endif;
        $this->lang->load('stories', $this->languages_lib->getLanguage());
        $this->meta_title = humanize(__CLASS__);
        $this->load->model('story_module/stories_model');

        if ($this->plugin_lib->check('pet_module')):
            $this->pet_module = TRUE;
        else :
            $this->pet_module = FALSE;
        endif;

        if ($this->plugin_lib->check('event_module')):
            $this->event_module = TRUE;
        else :
            $this->event_module = FALSE;
        endif;

        $this->imageWidth = $this->settings_lib->config('config', 'list_image_width');
        $this->imageHeight = $this->settings_lib->config('config', 'list_image_height');
        $this->bannerWidth = $this->settings_lib->config('config', 'list_banner_width');
        $this->bannerHeight = $this->settings_lib->config('config', 'list_banner_height');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('story_module/api/stories_api/list');
        $this->data['ajax_delete'] = base_url('story_module/api/stories_api/delete');
        $this->data['ajax_form'] = base_url('story_module/stories/form');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->lang->line('text_heading_list');
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('story_module/stories/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->stories_model->getById($id);

        if (isset($result['id']) && $result['id']) :
            $this->data['id'] = $result['id'];
        else:
            $this->data['id'] = 0;
        endif;

        if (isset($result['user_id']) && $result['user_id']) :
            $this->data['user_id'] = $result['user_id'];
        else:
            $this->data['user_id'] = 0;
        endif;
        
        if (isset($result['event_id']) && $result['event_id']) :
            $this->data['event_id'] = $result['event_id'];
        else:
            $this->data['event_id'] = 0;
        endif;

        $this->data['types'] = $this->stories_model->getTypes($id);

        $this->data['tags'] = $this->stories_model->getTags($id);


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

        $this->load->model('settings/languages_model');
        $languages = $this->languages_model->getTables();

        $details = $this->stories_model->details($id);

        $this->data['details'] = array();
        if ($languages):
            foreach ($languages as $value) :
                if (isset($details[$value['id']]['title'])):
                    $title = $details[$value['id']]['title'];
                else:
                    $title = '';
                endif;

                if (isset($details[$value['id']]['description'])):
                    $description = $details[$value['id']]['description'];
                else:
                    $description = '';
                endif;

                if (isset($details[$value['id']]['html'])):
                    $html = $details[$value['id']]['html'];
                else:
                    $html = '';
                endif;

                $this->data['details'][] = array(
                    'id' => $value['id'],
                    'language' => $value['name'],
                    'title' => $title,
                    'description' => $description,
                    'html' => $html,
                );
            endforeach;
        endif;

        $images = $this->stories_model->images($id);
        $imagesData = array();

        if ($images):
            foreach ($images as $value) :
                $this->custom_image->width = $this->imageWidth;
                $this->custom_image->height = $this->imageHeight;
                if (isset($value['image']) && $value['image'] != '') {
                    $image = $value['image'];
                } else {
                    $image = '';
                }

                $image_thumb = $this->custom_image->image_resize($image);

                $imageDetails = $this->stories_model->imageDetails($value['id']);
                $image_details = array();
                if ($languages):
                    foreach ($languages as $language) :

                        if (isset($imageDetails[$language['id']]['title'])):
                            $title = $imageDetails[$language['id']]['title'];
                        else:
                            $title = '';
                        endif;

                        if (isset($imageDetails[$language['id']]['description'])):
                            $description = $imageDetails[$language['id']]['description'];
                        else:
                            $description = '';
                        endif;

                        if (isset($imageDetails[$language['id']]['html'])):
                            $html = $imageDetails[$language['id']]['html'];
                        else:
                            $html = '';
                        endif;

                        $image_details[] = array(
                            'language_id' => $language['id'],
                            'language' => $language['name'],
                            'title' => $title,
                            'description' => $description,
                            'html' => $html,
                        );
                    endforeach;
                endif;

                $imagesData[] = array(
                    'image' => $image,
                    'image_thumb' => $image_thumb,
                    'link' => $value['link'],
                    'sort_order' => $value['sort_order'],
                    'status' => $value['status'],
                    'image_details' => $image_details,
                );
            endforeach;
        endif;

        $this->data['images'] = $imagesData;

        $this->load->model('story_module/story_types_model');
        $this->data['story_types'] = $this->story_types_model->getTables();

        $this->load->model('user_module/users_model');
        $this->data['users'] = $this->users_model->getTables();

        $this->data['ajax_list'] = base_url('story_module/stories');
        $this->data['ajax_save'] = base_url('story_module/api/stories_api/save');
        $this->data['ajax_image_form'] = base_url('story_module/stories/image_form/');


        if ($this->event_module):
            $this->load->model('event_module/events_model');
            $this->data['events'] = $this->events_model->getTables();
        endif;

        $this->data['event_module'] = $this->event_module;

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->lang->line('text_heading_form');
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('story_module/stories/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/tinymce_config', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function image_form($id = NULL) {
        $this->data = array();
        if (isset($id)) {
            $this->data['images_row'] = $id;
        } else {
            $this->data['images_row'] = 1;
        }
        $this->load->model('settings/languages_model');
        $languages = $this->languages_model->getTables();

        $image_details = array();
        if ($languages):
            foreach ($languages as $language) :

                $title = '';
                $description = '';
                $html = '';

                $image_details[] = array(
                    'language_id' => $language['id'],
                    'language' => $language['name'],
                    'title' => $title,
                    'description' => $description,
                    'html' => $html,
                );
            endforeach;
        endif;


        $this->data['image_details'] = $image_details;
        $this->custom_image->width = $this->imageWidth;
        $this->custom_image->height = $this->imageHeight;
        $this->data['thumb'] = $this->custom_image->image_resize('upload/images/placeholder.png');
        $this->load->view('story_module/stories/add_image_form', $this->data);
    }

}
