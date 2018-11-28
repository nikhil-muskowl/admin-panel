<?php

class Sidebar {

    private $ci;

    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->database();
        $this->ci->load->library('users_lib');
    }

    public function getModules() {
        $sidebar = array();

        $file = APPPATH . 'modules';
        $path = directory_map($file);

        $ignore = array(
            'admin',
            'public',
        );

        $files = array();
        if ($path):
            foreach ($path as $key => $value) :
                $key = str_replace('\\', '', $key);
                $key = str_replace('/', '', $key);

                if (!in_array($key, $ignore)) :
                    $module = array();
                    if (is_array($value)):
                        foreach ($value as $key1 => $subvalue):
                            $key1 = str_replace('\\', '', $key1);
                            $key1 = str_replace('/', '', $key1);
                            $module[$key1] = $subvalue;
                        endforeach;

                        $files[$key] = $module;
                    endif;
                endif;
            endforeach;
        endif;

        $menuData = array();


//        print_r($files);
//        exit;

        if ($files):
            foreach ($files as $key => $file) :
                $menuData = array();
                if (is_array($file['controllers'])):
                    $controllers = array();
                    foreach ($file['controllers'] as $controllersKey => $controllersvalue):
                        $controllersKey = str_replace('\\', '', $controllersKey);
                        $controllersKey = str_replace('/', '', $controllersKey);
                        $controllers[$controllersKey] = $controllersvalue;
                    endforeach;
                    unset($controllers['api']);

                    foreach ($controllers as $key1 => $value1):
                        $href = str_replace('.php', '', $value1);
                        $menuData[] = array(
                            'name' => humanize($href),
                            'code' => $href,
                            'children' => array()
                        );
                    endforeach;
                endif;

                $sidebar[] = array(
                    'name' => humanize(str_replace('_module', '', $key)),
                    'children' => $menuData
                );
            endforeach;
        endif;

        return $sidebar;
    }

    public function load() {
        $sidebar = array();

        $file = APPPATH . 'modules';
        $path = directory_map($file);

        $ignore = array(
            'admin',
            'public',
        );

        $files = array();
        if ($path):
            foreach ($path as $key => $value) :
                $key = str_replace('\\', '', $key);
                $key = str_replace('/', '', $key);

                if (!in_array($key, $ignore)) :
                    $module = array();
                    if (is_array($value)):
                        foreach ($value as $key1 => $subvalue):
                            $key1 = str_replace('\\', '', $key1);
                            $key1 = str_replace('/', '', $key1);
                            $module[$key1] = $subvalue;
                        endforeach;

                        $files[$key] = $module;
                    endif;
                endif;
            endforeach;
        endif;

        $menuData = array();


//        print_r($files);
//        exit;

        if ($files):
            foreach ($files as $key => $file) :
                $menuData = array();
                if (is_array($file['controllers'])):
                    $controllers = array();
                    foreach ($file['controllers'] as $controllersKey => $controllersvalue):
                        $controllersKey = str_replace('\\', '', $controllersKey);
                        $controllersKey = str_replace('/', '', $controllersKey);
                        $controllers[$controllersKey] = $controllersvalue;
                    endforeach;
                    unset($controllers['api']);

                    foreach ($controllers as $key1 => $value1):
                        $href = str_replace('.php', '', $value1);
                        if ($this->ci->users_lib->has_permission($href, 'is_view')):
                            $menuData[] = array(
                                'name' => humanize($href),
                                'href' => base_url($key . '/' . $href),
                                'children' => array()
                            );
                        endif;

                    endforeach;
                endif;

                if ($menuData):
                    $sidebar[] = array(
                        'id' => 'menu-' . $key,
                        'icon' => 'fa-user-circle',
                        'name' => humanize(str_replace('_module', '', $key)),
                        'href' => '#',
                        'children' => $menuData
                    );
                endif;

            endforeach;
        endif;

        return $sidebar;
    }

}
