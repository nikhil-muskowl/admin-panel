<?php

class Events extends MX_Controller {

    private $data;
    private $meta_title;
    private $imageWidth;
    private $imageHeight;
    private $bannerWidth;
    private $bannerHeight;

    public function __construct() {
        parent::__construct();
        if (!$this->users_lib->isLogged()):
            redirect('admin');
        else:
            if (!$this->users_lib->has_permission(__CLASS__, 'is_view')):
                redirect('permission');
            endif;
        endif;
        $this->lang->load('events', $this->languages_lib->getLanguage());
        $this->meta_title = humanize(__CLASS__);
        $this->load->model('event_module/events_model');

        $this->imageWidth = $this->settings_lib->config('config', 'list_image_width');
        $this->imageHeight = $this->settings_lib->config('config', 'list_image_height');
        $this->bannerWidth = $this->settings_lib->config('config', 'list_banner_width');
        $this->bannerHeight = $this->settings_lib->config('config', 'list_banner_height');
    }

    public function index() {
        $this->data = array();
        $this->data['ajax_list'] = base_url('event_module/api/events_api/list');
        $this->data['ajax_delete'] = base_url('event_module/api/events_api/delete');
        $this->data['ajax_form'] = base_url('event_module/events/form');

        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->lang->line('text_heading_list');
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('event_module/events/list', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

    public function form($id = NULL) {
        $this->data = array();
        $result = $this->events_model->getById($id);

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

        if (isset($result['from_date']) && $result['from_date']) :
            $this->data['from_date'] = date('d-m-Y H:i', strtotime($result['from_date']));
        else:
            $this->data['from_date'] = '';
        endif;

        if (isset($result['to_date']) && $result['to_date']) :
            $this->data['to_date'] = date('d-m-Y H:i', strtotime($result['to_date']));
        else:
            $this->data['to_date'] = '';
        endif;

        if (isset($result['location']) && $result['location']) :
            $this->data['location'] = $result['location'];
        else:
            $this->data['location'] = '';
        endif;

        if (isset($result['latitude']) && $result['latitude']) :
            $this->data['latitude'] = $result['latitude'];
        else:
            $this->data['latitude'] = '';
        endif;

        if (isset($result['longitude']) && $result['longitude']) :
            $this->data['longitude'] = $result['longitude'];
        else:
            $this->data['longitude'] = '';
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

        $this->load->model('settings/languages_model');
        $languages = $this->languages_model->getTables();

        $details = $this->events_model->details($id);

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

        $this->load->model('user_module/users_model');
        $this->data['users'] = $this->users_model->getTables();

        $this->data['ajax_list'] = base_url('event_module/events');
        $this->data['ajax_save'] = base_url('event_module/api/events_api/save');
        $this->data['ajax_image_form'] = base_url('event_module/events/image_form/');


        $this->data['location_api_types'] = array(
            'google' => 'Google',
            'baidu' => 'Baidu'
        );


        $this->load->library('googlemaps');
        $config = array();
        if ($this->data['latitude'] != 0 && $this->data['longitude'] != 0) {
            $config['center'] = '' . $this->data['latitude'] . ', ' . $this->data['longitude'] . '';
        } else {
            $config['center'] = 'auto';
        }
        $config['zoom'] = '14';
        $config['onboundschanged'] = 'if (!centreGot) {
	var mapCentre = map.getCenter();
	marker_0.setOptions({
		position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng()) 
	});
}
centreGot = true;';

        $config['places'] = TRUE;
        $config['placesAutocompleteInputID'] = 'google_location';
        $config['placesAutocompleteBoundsMap'] = TRUE;
        $config['placesAutocompleteOnChange'] = '           
            var place = placesAutocomplete.getPlace();
            var location = place.geometry.location;           
            marker_0.setOptions({
                position: new google.maps.LatLng(location.lat(), location.lng())
            });               
            map.setCenter(location);           
            document.getElementById(\'latitude\').value=location.lat(); 
            document.getElementById(\'longitude\').value=location.lng();                       
        ';

        $this->googlemaps->initialize($config);

        $marker = array();
        if ($this->data['latitude'] != 0 && $this->data['longitude'] != 0) {
            $marker['position'] = '' . $this->data['latitude'] . ', ' . $this->data['longitude'] . '';
        }
        $marker['icon_font'] = "path: fontawesome.markers.MAP_MARKER,
                                        scale: 1,
                                        strokeWeight: 0.5,
                                        strokeColor: 'black',
                                        strokeOpacity: 5,
                                        fillColor: '#1e91cf',
                                        fillOpacity: 1";
        $marker['draggable'] = true;
        $marker['ondragend'] = 'document.getElementById(\'latitude\').value=event.latLng.lat();document.getElementById(\'longitude\').value=event.latLng.lng()';
        $this->googlemaps->add_marker($marker);

        $this->data['map'] = $this->googlemaps->create_map();



        $baidu_cities = file_get_contents(base_url('assets/json/baidu_city.json'));

        if ($baidu_cities):
            $this->data['baidu_cities'] = json2arr($baidu_cities);           
        else:
            $this->data['baidu_cities'] = array();
        endif;



        $this->data['sidebar'] = $this->sidebar->load();
        $this->data['meta_title'] = $this->lang->line('text_heading_form');
        $this->load->view('admin/common/header', $this->data);
        $this->load->view('admin/common/navbar', $this->data);
        $this->load->view('admin/common/sidebar', $this->data);
        $this->load->view('event_module/events/form', $this->data);
        $this->load->view('admin/common/jquery_form', $this->data);
        $this->load->view('admin/common/filemanager', $this->data);
        $this->load->view('admin/common/tinymce_config', $this->data);
        $this->load->view('admin/common/footer', $this->data);
    }

}
