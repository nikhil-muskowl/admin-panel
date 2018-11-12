<?php

require APPPATH . '/libraries/REST_Controller.php';

class Stories_api extends Restserver\Libraries\REST_Controller {

    private $data = array();
    private $error = array();
    private $imageWidth;
    private $imageHeight;
    private $bannerWidth;
    private $bannerHeight;
    private $datetime_format;

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('story_module/stories_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');

        $this->imageWidth = $this->settings_lib->config('config', 'list_image_width');
        $this->imageHeight = $this->settings_lib->config('config', 'list_image_height');
        $this->bannerWidth = $this->settings_lib->config('config', 'list_banner_width');
        $this->bannerHeight = $this->settings_lib->config('config', 'list_banner_height');
        $this->datetime_format = $this->settings_lib->config('config', 'datetime_format');
    }

    public function index_post() {
        $this->data = array();

        $list = $this->stories_model->getTables();

        $result = array();
        foreach ($list as $key => $object) :

            if (isset($object['user_image']) && $object['user_image']) {
                $user_image = $object['user_image'];
            } else {
                $user_image = 'upload/images/placeholder.png';
            }
            $this->custom_image->width = $this->imageWidth;
            $this->custom_image->height = $this->imageHeight;
            $user_image_thumb = $this->custom_image->image_resize($user_image);

            if (isset($object['image']) && $object['image']) {
                $image = $object['image'];
            } else {
                $image = 'upload/images/placeholder.png';
            }
            $this->custom_image->width = $this->imageWidth;
            $this->custom_image->height = $this->imageHeight;
            $image_thumb = $this->custom_image->image_resize($image);

            if (isset($object['banner']) && $object['banner']) {
                $banner = $object['banner'];
            } else {
                $banner = 'upload/images/placeholder.png';
            }
            $this->custom_image->width = $this->bannerWidth;
            $this->custom_image->height = $this->bannerHeight;
            $banner_thumb = $this->custom_image->image_resize($banner);

            $tags = $this->stories_model->getTags($object['id']);
            $categories = $this->stories_model->getTypesNames($object['id']);

            $rank = $object['rank'];

            if ($rank <= 5) :
                $rankImage = base_url('assets/images/ranking-star/' . $rank . '.png');
            else:
                $rankImage = '';
            endif;

            $result[] = array(
                'id' => $object['id'],
                'title' => $object['title'],
                'description' => $object['description'],
                'rank' => $rank,
                'rank_image' => $rankImage,
                'user_id' => $object['user_id'],
                'user_name' => $object['user_name'],
                'user_level' => $object['user_level'],
                'user_image' => base_url($user_image),
                'user_image_thumb' => $user_image_thumb,
                'image' => base_url($image),
                'image_thumb' => $image_thumb,
                'banner' => base_url($banner),
                'banner_thumb' => $banner_thumb,
                'tags' => $tags,
                'categories' => $categories,
                'latitude' => $object['latitude'],
                'longitude' => $object['longitude'],
                'location' => $object['location'],
                'distance' => $this->settings_lib->number_format($object['distance']),
                'totalLikes' => $this->settings_lib->nice_number($object['likes']),
                'totalDislikes' => $this->settings_lib->nice_number($object['dislikes']),
                'totalFlames' => $this->settings_lib->nice_number($object['totalLikes']),
                'status' => $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                'created_date' => date($this->datetime_format, strtotime($object['created_date'])),
                'modified_date' => date($this->datetime_format, strtotime($object['modified_date'])),
                'date' => $this->settings_lib->time_elapsed_string($object['modified_date']),
            );
        endforeach;

        $this->data['recordsTotal'] = $this->stories_model->countAll();
        $this->data['recordsFiltered'] = $this->stories_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function list_post() {
        $this->data = array();

        $list = $this->stories_model->getTables();

        if ($this->input->post('draw')):
            $draw = $this->input->post('draw');
        else:
            $draw = 10;
        endif;

        $result = array();
        foreach ($list as $object) :
            $action = '';
            $action .= '<a class="btn btn-sm btn-primary" href="' . base_url('story_module/stories/form/' . $object['id']) . '" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>';
            $action .= ' <a class="btn btn-sm btn-danger" href="javascript:void(0)" data-toggle="tooltip" title="Delete" onclick="delete_record(' . "'" . $object['id'] . "'" . ')"><i class="fa fa-trash"></i></a>';

            $checkbox = '<input type="checkbox" class="data-check" value="' . $object['id'] . '">';

            $result[] = array(
                $checkbox,
                $object['title'],
                $object['totalLikes'],
                $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                date($this->datetime_format, strtotime($object['modified_date'])),
                $action
            );
        endforeach;

        $this->data['draw'] = $draw;
        $this->data['recordsTotal'] = $this->stories_model->countAll();
        $this->data['recordsFiltered'] = $this->stories_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function detail_post($id) {
        $this->data = array();
        $this->imageWidth = $this->settings_lib->config('config', 'detail_image_width');
        $this->imageHeight = $this->settings_lib->config('config', 'detail_image_height');
        $this->bannerWidth = $this->settings_lib->config('config', 'detail_banner_width');
        $this->bannerHeight = $this->settings_lib->config('config', 'detail_banner_height');

        $object = $this->stories_model->getById($id);

        if ($object):
            if (isset($object['image']) && $object['image']) {
                $image = $object['image'];
            } else {
                $image = 'upload/images/placeholder.png';
            }
            $this->custom_image->width = $this->imageWidth;
            $this->custom_image->height = $this->imageHeight;
            $image_thumb = $this->custom_image->image_resize($image);

            if (isset($object['banner']) && $object['banner']) {
                $banner = $object['banner'];
            } else {
                $banner = 'upload/images/placeholder.png';
            }

            $this->custom_image->width = $this->bannerWidth;
            $this->custom_image->height = $this->bannerHeight;
            $banner_thumb = $this->custom_image->image_resize($banner);




            $images = $this->stories_model->images($object['id']);

            $imagesData = array();
            if ($images):
                foreach ($images as $imageValue) :
                    $this->custom_image->width = $this->imageWidth;
                    $this->custom_image->height = $this->imageHeight;
                    $imagesData[] = array(
                        'image' => $this->custom_image->image_resize($imageValue['image']),
                        'link' => $imageValue['link'],
                    );
                endforeach;
            endif;

            $tags = $this->stories_model->getTags($object['id']);

            $categories = $this->stories_model->getTypesNames($object['id']);


            if (isset($object['user_image']) && $object['user_image']) {
                $user_image = $object['user_image'];
            } else {
                $user_image = 'upload/images/placeholder.png';
            }
            $this->custom_image->width = $this->imageWidth;
            $this->custom_image->height = $this->imageHeight;
            $user_image_thumb = $this->custom_image->image_resize($user_image);


            if ($object['receipt_private']):
                $receipt_private = $object['receipt_private'];
            else:
                $receipt_private = 0;
            endif;

            if (isset($object['receipt']) && $object['receipt']) {
                $receipt = $object['receipt'];
            } else {
                $receipt = 'upload/images/placeholder.png';
                $receipt_private = 1;
            }
            $this->custom_image->width = $this->imageWidth;
            $this->custom_image->height = $this->imageHeight;
            $receipt_thumb = $this->custom_image->image_resize($receipt);

            $result[] = array(
                'id' => $object['id'],
                'title' => $object['title'],
                'description' => $object['description'],
                'html' => $object['html'],
                'user_id' => $object['user_id'],
                'user_name' => $object['user_name'],
                'user_image' => base_url($user_image),
                'user_image_thumb' => $user_image_thumb,
                'image' => base_url($image),
                'image_thumb' => $image_thumb,
                'receipt_private' => $receipt_private,
                'receipt' => base_url($receipt),
                'receipt_thumb' => $receipt_thumb,
                'image' => base_url($image),
                'image_thumb' => $image_thumb,
                'banner' => base_url($banner),
                'banner_thumb' => $banner_thumb,
                'images' => $imagesData,
                'tags' => $tags,
                'categories' => $categories,
                'location' => $object['location'],
                'totalLikes' => $this->settings_lib->nice_number($object['likes']),
                'totalDislikes' => $this->settings_lib->nice_number($object['dislikes']),
                'totalFlames' => $this->settings_lib->nice_number($object['totalLikes']),
                'status' => $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                'date' => $this->settings_lib->time_elapsed_string($object['modified_date']),
                'created_date' => date($this->datetime_format, strtotime($object['created_date'])),
                'modified_date' => date($this->datetime_format, strtotime($object['modified_date'])),
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
        $result = $this->stories_model->postData();
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

        $this->form_validation->set_rules('user_id', 'user', 'required');
        $this->form_validation->set_rules('details[]', 'details', 'required|xss_clean');

        if ($this->input->post('details')):
            if (is_array($this->input->post('details'))) :
                foreach ($this->input->post('details') as $key => $value) :
                    $this->form_validation->set_rules('details[' . $key . '][title]', 'title', 'required');
                endforeach;
            endif;
        endif;

        if ($this->form_validation->run() == FALSE):
            if ($this->input->post('details')):
                if (is_array($this->input->post('details'))) :
                    foreach ($this->input->post('details') as $key => $value) :
                        if (form_error('details[' . $key . '][title]', '', '')):
                            $this->error[] = array(
                                'id' => 'details[' . $key . '][title]',
                                'text' => form_error('details[' . $key . '][title]', '', '')
                            );
                        endif;
                    endforeach;
                endif;
            endif;

            if (form_error('user_id', '', '')):
                $this->error[] = array(
                    'id' => 'user_id',
                    'text' => form_error('user_id', '', '')
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
        $result = $this->stories_model->deleteById($id);
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
            $result = $this->stories_model->deleteById($id);
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

    public function api_save_post() {
        $this->data = array();
        $this->_api_validation();
        $result = $this->stories_model->apiPostData();
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

    public function _api_validation() {
        $this->data = array();

        $this->form_validation->set_rules('user_id', 'user', 'required');
        $this->form_validation->set_rules('language_id', 'language', 'required');
//        $this->form_validation->set_rules('title', 'title', 'required');

        if ($this->form_validation->run() == FALSE):

            if (form_error('user_id', '', '')):
                $this->error[] = array(
                    'id' => 'user_id',
                    'text' => form_error('user_id', '', '')
                );
            endif;

            if (form_error('language_id', '', '')):
                $this->error[] = array(
                    'id' => 'language_id',
                    'text' => form_error('language_id', '', '')
                );
            endif;

            if (form_error('title', '', '')):
                $this->error[] = array(
                    'id' => 'title',
                    'text' => form_error('title', '', '')
                );
            endif;

            $this->data['status'] = FALSE;
            $this->data['message'] = 'validation error!';
            $this->data['result'] = $this->error;
            echo json_encode($this->data);
            exit;
        endif;
    }

    public function set_ranking_post() {
        $this->data = array();
        $this->_ranking_validation();
        $result = $this->stories_model->setRanking();
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

    public function _ranking_validation() {
        $this->data = array();

        $this->form_validation->set_rules('user_id', 'user', 'required');
        $this->form_validation->set_rules('story_id', 'story', 'required|callback_validate_ranking');

        if ($this->form_validation->run() == FALSE):
            if (form_error('user_id', '', '')):
                $this->error[] = array(
                    'id' => 'user_id',
                    'text' => form_error('user_id', '', '')
                );
            endif;
            if (form_error('story_id', '', '')):
                $this->error[] = array(
                    'id' => 'story_id',
                    'text' => form_error('story_id', '', '')
                );
            endif;
            $this->data['status'] = FALSE;
            $this->data['message'] = 'validation error!';
            $this->data['result'] = $this->error;
            echo json_encode($this->data);
            exit;
        endif;
    }

    public function validate_ranking($field_value) {
        if ($this->stories_model->checkRanking($field_value)) {
            $this->form_validation->set_message('validate_ranking', '{field} already ranked!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function top_stories_marker_post() {
        $this->data = array();

        $user_id = $this->input->post('user_id');

        if ($this->input->post('distance')):
            $distance = $this->input->post('distance');
        else:
            $distance = '10';
        endif;

        if ($this->input->post('latitude')):
            $latitude = $this->input->post('latitude');
        else:
            $latitude = '';
        endif;

        if ($this->input->post('longitude')):
            $longitude = $this->input->post('longitude');
        else:
            $longitude = '';
        endif;

        $filterData = array();
        $filterData['user_id'] = $user_id;
        $filterData['distance'] = $distance;
        $filterData['latitude'] = $latitude;
        $filterData['longitude'] = $longitude;
        $filterData['group_by'] = array('latitude', 'longitude');
        $filterData['order_by'] = 'totalLikes';
        $filterData['order_type'] = 'desc';

        $list = $this->stories_model->getTopFollowersStories($filterData);

        $result = array();
        foreach ($list as $object) :

            $filterData = array();
            $filterData['user_id'] = $user_id;
            $filterData['latitude'] = $object['latitude'];
            $filterData['longitude'] = $object['longitude'];
            $filterData['order_by'] = 'totalLikes';
            $filterData['order_type'] = 'desc';
            $totalStories = 0;
            $stories = $this->stories_model->getFollowersStories($filterData);
            $totalStories = count($stories);

            $marker = 'upload/storyMapIcon/1.png';

            if (isset($object['user_image']) && $object['user_image']) :
                $user_image = $object['user_image'];
            else :
                $user_image = 'upload/images/placeholder.png';
            endif;


            $user_image_thumb = $this->custom_image->circle($user_image);

            $result[] = array(
                'id' => $object['id'],
                'marker' => base_url($marker),
                'marker_thumb' => $user_image_thumb,
                'latitude' => $object['latitude'],
                'longitude' => $object['longitude'],
                'total_stories' => $totalStories,
            );
        endforeach;

        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function top_stories_post() {
        $this->data = array();

        $user_id = $this->input->post('user_id');

        if ($this->input->post('distance')):
            $distance = $this->input->post('distance');
        else:
            $distance = '0';
        endif;

        if ($this->input->post('latitude')):
            $latitude = $this->input->post('latitude');
        else:
            $latitude = '';
        endif;

        if ($this->input->post('longitude')):
            $longitude = $this->input->post('longitude');
        else:
            $longitude = '';
        endif;

        if ($this->input->post('length')):
            $length = $this->input->post('length');
        else:
            $length = 10;
        endif;
        if ($this->input->post('start')):
            $start = $this->input->post('start');
        else:
            $start = 0;
        endif;

        $filterData = array();
        $filterData['user_id'] = $user_id;
        $filterData['latitude'] = $latitude;
        $filterData['longitude'] = $longitude;
        $filterData['distance'] = $distance;
        $filterData['order_by'] = 'totalLikes';
        $filterData['order_type'] = 'desc';
        $filterData['length'] = $length;
        $filterData['start'] = $start;

        $list = $this->stories_model->getFollowersStories($filterData);

        $result = array();
        foreach ($list as $key => $object) :
            if (isset($object['image']) && $object['image']) {
                $image = $object['image'];
            } else {
                $image = 'upload/images/placeholder.png';
            }
            $this->custom_image->width = $this->imageWidth;
            $this->custom_image->height = $this->imageHeight;
            $image_thumb = $this->custom_image->image_resize($image);

            if (isset($object['banner']) && $object['banner']) {
                $banner = $object['banner'];
            } else {
                $banner = 'upload/images/placeholder.png';
            }
            $this->custom_image->width = $this->bannerWidth;
            $this->custom_image->height = $this->bannerHeight;
            $banner_thumb = $this->custom_image->image_resize($banner);

            if (isset($object['user_image']) && $object['user_image']) {
                $user_image = $object['user_image'];
                $marker = $object['user_image'];
            } else {
                $marker = 'upload/storyMapIcon/marker.png';
                $user_image = 'upload/images/placeholder.png';
            }

            $this->custom_image->width = $this->imageWidth;
            $this->custom_image->height = $this->imageHeight;
            $user_image_thumb = $this->custom_image->image_resize($user_image);

            $tags = $this->stories_model->getTags($object['id']);
            $categories = $this->stories_model->getTypesNames($object['id']);

            $rank = $object['rank'];

            if ($rank <= 5) :
                $rankImage = base_url('assets/images/ranking-star/' . $rank . '.png');
            else:
                $rankImage = '';
            endif;

            $result[] = array(
                'id' => $object['id'],
                'title' => $object['title'],
                'description' => $object['description'],
                'rank' => $rank,
                'rank_image' => $rankImage,
                'user_name' => $object['user_name'],
                'user_level' => $object['user_level'],
                'user_image' => base_url($user_image),
                'user_image_thumb' => $user_image_thumb,
                'image' => base_url($image),
                'image_thumb' => $image_thumb,
                'banner' => base_url($banner),
                'banner_thumb' => $banner_thumb,
                'tags' => $tags,
                'categories' => $categories,
                'latitude' => $object['latitude'],
                'longitude' => $object['longitude'],
                'totalLikes' => $this->settings_lib->nice_number($object['likes']),
                'totalDislikes' => $this->settings_lib->nice_number($object['dislikes']),
                'totalFlames' => $this->settings_lib->nice_number($object['totalLikes']),
                'status' => $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                'created_date' => date($this->datetime_format, strtotime($object['created_date'])),
                'modified_date' => date($this->datetime_format, strtotime($object['modified_date'])),
            );
        endforeach;

        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function remove_save_stories_post() {
        $this->data = array();
        $this->_removeSaveStoriesValidation();
        $result = $this->stories_model->removeSaveStory();
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

    public function _removeSaveStoriesValidation() {
        $this->data = array();

        $this->form_validation->set_rules('user_id', 'user', 'required');
        $this->form_validation->set_rules('story_id', 'story', 'required');

        if ($this->form_validation->run() == FALSE):

            if (form_error('user_id', '', '')):
                $this->error[] = array(
                    'id' => 'user_id',
                    'text' => form_error('user_id', '', '')
                );
            endif;
            if (form_error('story_id', '', '')):
                $this->error[] = array(
                    'id' => 'story_id',
                    'text' => form_error('story_id', '', '')
                );
            endif;

            $this->data['status'] = FALSE;
            $this->data['message'] = 'validation error!';
            $this->data['result'] = $this->error;
            echo json_encode($this->data);
            exit;
        endif;
    }

    public function set_save_stories_post() {
        $this->data = array();
        $this->_save_stories_validation();
        $result = $this->stories_model->setSaveStory();
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

    public function _save_stories_validation() {
        $this->data = array();

        $this->form_validation->set_rules('user_id', 'user', 'required');
        $this->form_validation->set_rules('story_id', 'story', 'required|callback_validate_save_stories');

        if ($this->form_validation->run() == FALSE):

            if (form_error('user_id', '', '')):
                $this->error[] = array(
                    'id' => 'user_id',
                    'text' => form_error('user_id', '', '')
                );
            endif;
            if (form_error('story_id', '', '')):
                $this->error[] = array(
                    'id' => 'story_id',
                    'text' => form_error('story_id', '', '')
                );
            endif;

            $this->data['status'] = FALSE;
            $this->data['message'] = 'validation error!';
            $this->data['result'] = $this->error;
            echo json_encode($this->data);
            exit;
        endif;
    }

    public function validate_save_stories($field_value) {
        if ($this->stories_model->checkSaveStories($field_value)) {
            $this->form_validation->set_message('validate_save_stories', '{field} already saved!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function allLocations_get() {
        $this->data = array();

        $list = $this->stories_model->getAllLocations();
        if ($list):
            $this->data['status'] = TRUE;
            $this->data['data'] = $list;
        else:
            $this->data['status'] = FALSE;
            $this->data['data'] = array();
        endif;


        $this->response($this->data);
    }

}
