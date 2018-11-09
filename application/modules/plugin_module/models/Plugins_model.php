<?php

class Plugins_model extends CI_Model {

    private $table = 'plugins';
    private $plugin_path;

    public function __construct() {
        parent::__construct();
        $this->plugin_path = FCPATH . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR;
    }

    public function get_all($array = array()) {

        $result = $this->db->get($this->table)->result_array();

        if ($result):
            return $result;
        else:
            return FALSE;
        endif;
    }

    public function get_plugins() {
        $path = directory_map($this->plugin_path, FALSE, TRUE);

        $files = array();
        if ($path):
            foreach ($path as $key => $value) :
                $key = str_replace('\\', '', $key);
                $key = str_replace('/', '', $key);
                $files[] = $key;
            endforeach;
        endif;

        return $files;
    }

    public function getByCode($code) {
        $this->db->from($this->table);
        $this->db->where('code', $code);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function install($code) {
        $this->db->trans_start();

        $this->db->set('name', humanize($code));
        $this->db->set('code', $code);
        $this->db->insert($this->table);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            $this->install_table($code);
            $this->install_view($code);
            $this->install_code($code);
            return TRUE;
        }
    }

    public function uninstall($code) {
        $this->db->trans_start();

        $this->db->where('code', $code);
        $this->db->delete($this->table);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            $this->uninstall_table($code);
            $this->uninstall_view($code);
            $this->uninstall_code($code);
            return TRUE;
        }
    }

    public function backup($code) {
        $file = $this->plugin_path . $code . '/tables.json';
        if (file_exists($file)):
            $lines = read_file($file);

            $tables = json2arr($lines);

            $this->load->dbutil();

            $prefs = array(
                'tables' => $tables,
                'ignore' => array(),
                'format' => 'txt',
                'filename' => 'query.sql',
                'add_drop' => TRUE,
                'add_insert' => TRUE,
                'newline' => "\n",
                'foreign_key_checks' => FALSE
            );

            $backup = $this->dbutil->backup($prefs);

            $backupFileName = 'query.sql';
            write_file($this->plugin_path . $code . '/install/' . $backupFileName, $backup);

            $this->backup_code($code, 'controllers');
            $this->backup_code($code, 'models');
            $this->backup_code($code, 'views');

            return TRUE;
        else:
            return FALSE;
        endif;
    }

    public function install_table($code) {
        $file = $this->plugin_path . $code . '/install/query.sql';
        if (file_exists($file)):
            $lines = file($file);
            try {
                if ($lines) {
                    $this->db->trans_start();
                    $sql = '';
                    foreach ($lines as $line) {
                        if ($line && (substr($line, 0, 2) != '--') && (substr($line, 0, 1) != '#')) {
                            $sql .= $line;
                            if (preg_match('/;\s*$/', $line)) {
                                $this->db->query($sql);
                                $sql = '';
                            }
                        }
                    }
                    $this->db->trans_complete();
                    if ($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                        return FALSE;
                    } else {
                        $this->db->trans_commit();
                        return TRUE;
                    }
                }
            } catch (Exception $exc) {
                return FALSE;
            }
        else:
            return FALSE;
        endif;
    }

    public function install_view($code) {
        $file = $this->plugin_path . $code . '/install/view.sql';
        if (file_exists($file)):
            $lines = file($file);
            try {
                if ($lines) {
                    $this->db->trans_start();
                    $sql = '';
                    foreach ($lines as $line) {
                        if ($line && (substr($line, 0, 2) != '--') && (substr($line, 0, 1) != '#')) {
                            $sql .= $line;
                            if (preg_match('/;\s*$/', $line)) {
                                $this->db->query($sql);
                                $sql = '';
                            }
                        }
                    }
                    $this->db->trans_complete();
                    if ($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                        return FALSE;
                    } else {
                        $this->db->trans_commit();
                        return TRUE;
                    }
                }
            } catch (Exception $exc) {
                return FALSE;
            }
        else:
            return FALSE;
        endif;
    }

    public function uninstall_table($code) {
        $file = $this->plugin_path . $code . '/uninstall/query.sql';
        if (file_exists($file)):
            $lines = file($file);
            try {
                if ($lines) {
                    $this->db->trans_start();
                    $sql = '';
                    foreach ($lines as $line) {
                        if ($line && (substr($line, 0, 2) != '--') && (substr($line, 0, 1) != '#')) {
                            $sql .= $line;
                            if (preg_match('/;\s*$/', $line)) {
                                $this->db->query($sql);
                                $sql = '';
                            }
                        }
                    }
                    $this->db->trans_complete();
                    if ($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                        return FALSE;
                    } else {
                        $this->db->trans_commit();
                        return TRUE;
                    }
                }
            } catch (Exception $exc) {
                return FALSE;
            }
        else:
            return FALSE;
        endif;
    }

    public function uninstall_view($code) {
        $file = $this->plugin_path . $code . '/uninstall/view.sql';
        if (file_exists($file)):
            $lines = file($file);
            try {
                if ($lines) {
                    $this->db->trans_start();
                    $sql = '';
                    foreach ($lines as $line) {
                        if ($line && (substr($line, 0, 2) != '--') && (substr($line, 0, 1) != '#')) {
                            $sql .= $line;
                            if (preg_match('/;\s*$/', $line)) {
                                $this->db->query($sql);
                                $sql = '';
                            }
                        }
                    }
                    $this->db->trans_complete();
                    if ($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                        return FALSE;
                    } else {
                        $this->db->trans_commit();
                        return TRUE;
                    }
                }
            } catch (Exception $exc) {
                return FALSE;
            }
        else:
            return FALSE;
        endif;
    }

    public function backup_code($code, $type) {
        $status = TRUE;
        $target_path = $this->plugin_path . $code . DIRECTORY_SEPARATOR . 'code';
        $get_path = APPPATH . 'modules' . DIRECTORY_SEPARATOR . $code;

        $get_path_zip = $get_path . '.zip';

        if (is_dir($get_path)):
            $this->load->library('zip');
            $this->zip->clear_data();
            $this->zip->read_dir($get_path, FALSE);
            $zipResult = $this->zip->archive($get_path_zip);

            if ($zipResult):
                $zip = new ZipArchive;
                if ($zip->open($get_path_zip) === TRUE) :
                    $zip->extractTo($target_path);
                    $zip->close();
                    $status = unlink($get_path_zip);
                else :
                    $status = FALSE;
                endif;
            else:
                $status = FALSE;
            endif;
        endif;

        return $status;
    }

    public function install_code($code) {
        $status = TRUE;
        $target_path = APPPATH . 'modules' . DIRECTORY_SEPARATOR;

        $get_path = $this->plugin_path . $code . DIRECTORY_SEPARATOR . 'code' . DIRECTORY_SEPARATOR . $code;

        $get_path_zip = $get_path . '.zip';

        if (is_dir($get_path)):
            $this->load->library('zip');
            $this->zip->clear_data();
            $this->zip->read_dir($get_path, FALSE);
            $zipResult = $this->zip->archive($get_path_zip);

            if ($zipResult):
                $zip = new ZipArchive;
                if ($zip->open($get_path_zip) === TRUE) :
                    $zip->extractTo($target_path);
                    $zip->close();
                    $status = unlink($get_path_zip);
                else :
                    $status = FALSE;
                endif;
            else:
                $status = FALSE;
            endif;
        endif;

        return $status;
    }

    public function uninstall_code($code) {
        $status = TRUE;
        $get_path = APPPATH . 'modules' . DIRECTORY_SEPARATOR . $code . DIRECTORY_SEPARATOR;

        if (is_dir($get_path)):
            $status = delete_files($get_path, TRUE, FALSE, 1);
        else:
            $status = FALSE;
        endif;

        return $status;
    }

}
