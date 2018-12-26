<?php

class Custom_image {

    private $ci;
    private $image;
    private $image_library = 'gd2';
    public $source_image;
    public $new_image;
    private $new_image_path;
    public $width = 100;
    public $height = 100;
    public $quality = 50;
    private $file_permissions = 0755;
    private $maintain_ratio = FALSE;
    private $path;
    private $cache_path;
    private $filename;
    private $status;

    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->library('image_lib');
        $this->ci->load->library('settings_lib');
        $this->clear();
        $this->cache_path = FCPATH . 'upload' . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR;
    }

    public function clear() {
        $this->ci->image_lib->clear();
    }

    public function createPath() {
        if (!is_dir($this->new_image_path)) {
            mkdir($this->new_image_path, 0755, TRUE);
        }
    }

    private function resize() {
        $this->image = '';
        if (!file_exists($this->new_image)) {
            $config['image_library'] = $this->image_library;
            $config['source_image'] = $this->source_image;
            $config['new_image'] = $this->new_image;
            $config['maintain_ratio'] = $this->maintain_ratio;
            $config['quality'] = $this->quality;
            $config['file_permissions'] = $this->file_permissions;
            $config['width'] = $this->width;
            $config['height'] = $this->height;
            $this->ci->image_lib->initialize($config);

            if (!$this->ci->image_lib->resize()) {
//                print_r($this->ci->image_lib);
//                exit;
                $this->image = base_url($this->source_image);
            } else {
//                print_r($this->ci->image_lib);
//                exit;               
                $this->image = base_url() . $this->new_image;
            }
        } else {
            $this->image = base_url() . $this->new_image;
        }

        $this->clear();
        return $this->image;
    }

    public function image_resize($image = '', $width = 0, $height = 0) {
        $this->clear();
        if (!$image) {
            $image = 'upload/images/placeholder.png';
        }
//        $this->width = $width;
//        $this->height = $height;
        $this->source_image = $this->get_path($image);

        $x = explode('/', $this->source_image);
        $source_image = end($x);

        $source_folder = str_replace($source_image, '', $this->source_image);

        $ext = strrchr($source_image, '.');
        $name = ($ext === FALSE) ? $source_image : substr($source_image, 0, -strlen($ext));

        $this->filename = $name . $this->width . 'X' . $this->height . $ext;

        $source_folder_url = 'upload/cache/' . $source_folder;
        $this->new_image_path = $this->cache_path . $source_folder;

        $this->createPath();

        $this->new_image = $source_folder_url . $this->filename;

        $this->image = $this->resize();
        return $this->image;
    }

    public function get_path($image) {
        return str_replace(base_url(), '', $image);
    }

    public function setBase64Image($filename, $param) {
        $this->image = '';
        if ($param):
            $data = explode(',', $param);
            if (isset($data[1])):
                $img = $data[1];

                $this->path = FCPATH;
                $this->filename = $filename;

                $image = base64_decode($img);
                $this->status = file_put_contents($this->path . $this->filename, $image);
                if ($this->status):
                    $this->image = $this->filename;
                endif;
            endif;
        endif;

        return $this->image;
    }

    public function base64Image($param) {
        $this->image = '';
        if ($param):
            $data = explode(',', $param);
            if (isset($data[1])):
                $img = $data[1];

                $this->path = FCPATH;
                $this->filename = 'upload/users/' . rand(10000, 10000000) . '.jpg';

                $image = base64_decode($img);
                $this->status = file_put_contents($this->path . $this->filename, $image);
                if ($this->status):
                    $this->image = $this->filename;
                endif;
            endif;
        endif;

        return $this->image;
    }

    public function circle($filename = '') {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '2048M');

        if (!$filename) {
            $filename = 'upload/images/placeholder.png';
        }

        $this->width = 450;
        $this->height = 450;
        
        $this->source_image = $this->get_path($filename);

        $x = explode('/', $this->source_image);
        $source_image = end($x);

        $source_folder = str_replace($source_image, '', $this->source_image);

        $ext = strrchr($source_image, '.');
        $name = ($ext === FALSE) ? $source_image : substr($source_image, 0, -strlen($ext));

        $this->filename = $name . 'circle' . $this->width . 'X' . $this->height . $ext;

        $source_folder_url = 'upload/cache/' . $source_folder;
        $this->new_image_path = $this->cache_path . $source_folder;

        // convert the picture
        $w = $this->width;
        $h = $this->height; // original size
        $original_path = $this->source_image;
        $dest_path = $this->new_image_path . $this->filename;

        
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if ($ext == "jpg" || $ext == "jpeg") {
            $image_s = imagecreatefromjpeg($filename);
        } else if ($ext == "png") {
            $image_s = imagecreatefrompng($filename);
        }

        $width = imagesx($image_s);
        $height = imagesy($image_s);


        $newwidth = 450;
        $newheight = 450;

        $image = imagecreatetruecolor($newwidth, $newheight);
        imagealphablending($image, true);
        imagecopyresampled($image, $image_s, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

// create masking
        $mask = imagecreatetruecolor($width, $height);
        $mask = imagecreatetruecolor($newwidth, $newheight);


        $transparent = imagecolorallocate($mask, 255, 0, 0);
        imagecolortransparent($mask, $transparent);


        imagefilledellipse($mask, $newwidth / 2, $newheight / 2, $newwidth, $newheight, $transparent);



        $red = imagecolorallocate($mask, 0, 0, 0);
        imagecopymerge($image, $mask, 0, 0, 0, 0, $newwidth, $newheight, 100);
        imagecolortransparent($image, $red);
        imagefill($image, 0, 0, $red);

// output and free memory
//        header('Content-type: image/png');
        imagepng($image, $dest_path);
        imagedestroy($image);
        imagedestroy($mask);


        return base_url($this->new_image = $source_folder_url . $this->filename);
    }

}
