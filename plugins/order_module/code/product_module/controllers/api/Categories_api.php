<?php

require APPPATH . '/libraries/REST_Controller.php';

class Categories_api extends Restserver\Libraries\REST_Controller {

    private $data = array();
    private $filterData = array();
    private $error = array();
    private $imageWidth;
    private $imageHeight;
    private $bannerWidth;
    private $bannerHeight;

    public function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('product_module/categories_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '');

        $this->imageWidth = $this->settings_lib->config('config', 'list_image_width');
        $this->imageHeight = $this->settings_lib->config('config', 'list_image_height');
        $this->bannerWidth = $this->settings_lib->config('config', 'list_banner_width');
        $this->bannerHeight = $this->settings_lib->config('config', 'list_banner_height');
    }

    public function index_post() {
        $this->data = array();

        $list = $this->categories_model->getTables();

        $result = array();
        foreach ($list as $object) :

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

            $result[] = array(
                'id' => $object['id'],
                'title' => $object['title'],
                'description' => $object['description'],
                'image' => base_url($image),
                'image_thumb' => $image_thumb,
                'banner' => base_url($banner),
                'banner_thumb' => $banner_thumb,
                'status' => $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                'created_date' => date('Y-m-d s:i A', strtotime($object['created_date'])),
                'modified_date' => date('Y-m-d s:i A', strtotime($object['modified_date'])),
            );
        endforeach;

        $this->data['recordsTotal'] = $this->categories_model->countAll();
        $this->data['recordsFiltered'] = $this->categories_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function list_post() {
        $this->data = array();

        $list = $this->categories_model->getTables();

        if ($this->input->post('draw')):
            $draw = $this->input->post('draw');
        else:
            $draw = 10;
        endif;

        $result = array();
        foreach ($list as $object) :
            $action = '';
            $action .= '<a class="btn btn-sm btn-primary" href="' . base_url('product_module/categories/form/' . $object['id']) . '" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>';
            $action .= ' <a class="btn btn-sm btn-danger" href="javascript:void(0)" data-toggle="tooltip" title="Delete" onclick="delete_record(' . "'" . $object['id'] . "'" . ')"><i class="fa fa-trash"></i></a>';

            $checkbox = '<input type="checkbox" class="data-check" value="' . $object['id'] . '">';

            $result[] = array(
                $checkbox,
                $object['title'],
                $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                date('Y-m-d s:i A', strtotime($object['modified_date'])),
                $action
            );
        endforeach;

        $this->data['draw'] = $draw;
        $this->data['recordsTotal'] = $this->categories_model->countAll();
        $this->data['recordsFiltered'] = $this->categories_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function detail_post($id) {
        $this->data = array();
        $this->imageWidth = $this->settings_lib->config('config', 'detail_image_width');
        $this->imageHeight = $this->settings_lib->config('config', 'detail_image_height');
        $this->bannerWidth = $this->settings_lib->config('config', 'detail_banner_width');
        $this->bannerHeight = $this->settings_lib->config('config', 'detail_banner_height');

        $object = $this->categories_model->getById($id);

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


            $result = array(
                'id' => $object['id'],
                'title' => $object['title'],
                'description' => $object['description'],
                'html' => $object['html'],
                'keyword' => $object['keyword'],
                'meta_title' => $object['meta_title'],
                'meta_keyword' => $object['meta_keyword'],
                'meta_description' => $object['meta_description'],
                'image' => base_url($image),
                'image_thumb' => $image_thumb,
                'banner' => base_url($banner),
                'banner_thumb' => $banner_thumb,
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
        $result = $this->categories_model->postData();
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


            $this->data['status'] = FALSE;
            $this->data['message'] = 'validation error!';
            $this->data['result'] = $this->error;
            echo json_encode($this->data);
            exit;
        endif;
    }

    public function delete_get($id) {
        $this->data = array();
        $result = $this->categories_model->deleteById($id);
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
            $result = $this->categories_model->deleteById($id);
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

    public function categories_post() {
        $this->data = array();

        $this->filterData['parent_id'] = 0;
        $this->filterData['in_menu'] = 1;
        $list = $this->categories_model->getCategories($this->filterData);

        $result = array();

        if ($list):
            foreach ($list as $object) :

                $this->filterData['parent_id'] = $object['id'];
                $this->filterData['in_menu'] = 1;
                $children = $this->categories_model->getCategories($this->filterData);
                $childrenData = array();
                if ($children):
                    foreach ($children as $childrenValue) :

                        $this->filterData['parent_id'] = $childrenValue['id'];
                        $this->filterData['in_menu'] = 1;
                        $children2 = $this->categories_model->getCategories($this->filterData);
                        $children2Data = array();
                        if ($children2):
                            foreach ($children2 as $children2Value) :
                                if (isset($children2Value['image']) && $children2Value['image']) {
                                    $image = $children2Value['image'];
                                } else {
                                    $image = 'upload/images/placeholder.png';
                                }
                                $this->custom_image->width = $this->imageWidth;
                                $this->custom_image->height = $this->imageHeight;
                                $image_thumb = $this->custom_image->image_resize($image);

                                if (isset($children2Value['banner']) && $children2Value['banner']) {
                                    $banner = $children2Value['banner'];
                                } else {
                                    $banner = 'upload/images/placeholder.png';
                                }
                                $this->custom_image->width = $this->bannerWidth;
                                $this->custom_image->height = $this->bannerHeight;
                                $banner_thumb = $this->custom_image->image_resize($banner);

                                $children2Data[] = array(
                                    'id' => $children2Value['id'],
                                    'title' => $children2Value['title'],
                                    'description' => $children2Value['description'],
                                    'image' => base_url($image),
                                    'image_thumb' => $image_thumb,
                                    'banner' => base_url($banner),
                                    'banner_thumb' => $banner_thumb,
                                    'status' => $children2Value['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                                    'created_date' => date('Y-m-d s:i A', strtotime($children2Value['created_date'])),
                                    'modified_date' => date('Y-m-d s:i A', strtotime($children2Value['modified_date'])),
                                );
                            endforeach;
                        endif;

                        if (isset($childrenValue['image']) && $childrenValue['image']) {
                            $image = $childrenValue['image'];
                        } else {
                            $image = 'upload/images/placeholder.png';
                        }
                        $this->custom_image->width = $this->imageWidth;
                        $this->custom_image->height = $this->imageHeight;
                        $image_thumb = $this->custom_image->image_resize($image);

                        if (isset($childrenValue['banner']) && $childrenValue['banner']) {
                            $banner = $childrenValue['banner'];
                        } else {
                            $banner = 'upload/images/placeholder.png';
                        }
                        $this->custom_image->width = $this->bannerWidth;
                        $this->custom_image->height = $this->bannerHeight;
                        $banner_thumb = $this->custom_image->image_resize($banner);

                        $childrenData[] = array(
                            'id' => $childrenValue['id'],
                            'title' => $childrenValue['title'],
                            'description' => $childrenValue['description'],
                            'image' => base_url($image),
                            'image_thumb' => $image_thumb,
                            'banner' => base_url($banner),
                            'banner_thumb' => $banner_thumb,
                            'childrens' => $children2Data,
                            'status' => $childrenValue['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                            'created_date' => date('Y-m-d s:i A', strtotime($childrenValue['created_date'])),
                            'modified_date' => date('Y-m-d s:i A', strtotime($childrenValue['modified_date'])),
                        );
                    endforeach;
                endif;

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

                $result = array(
                    'id' => $object['id'],
                    'title' => $object['title'],
                    'description' => $object['description'],
                    'image' => base_url($image),
                    'image_thumb' => $image_thumb,
                    'banner' => base_url($banner),
                    'banner_thumb' => $banner_thumb,
                    'childrens' => $childrenData,
                    'status' => $object['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                    'created_date' => date('Y-m-d s:i A', strtotime($object['created_date'])),
                    'modified_date' => date('Y-m-d s:i A', strtotime($object['modified_date'])),
                );
            endforeach;

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

}
