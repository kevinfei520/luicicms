<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Upload 文件上传
 *
 * @property  CI_Upload $upload
 * @property  CI_Output $output
 */
class Upload extends Base_Controller {

    public function do_upload() {
        $config['upload_path']   = APPPATH . '../public/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = 20480;
        $config['max_width']     = 10240;
        $config['max_height']    = 7680;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            $error = array('error' => $this->upload->display_errors());
            $this->output->set_header('Content-Type: application/json; charset=utf-8');
            echo json_encode($error);
        } else {
            $path = upload_file_qiniuyun($this->upload->data());
            sendSuccess('完成文件上传', $path);
        }
    }

}
