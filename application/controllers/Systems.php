<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *  System 系统设置
 *
 * @property  system $system
 */
class Systems extends Base_Controller {

    /**
     * 架构方法 设置参数
     *
     * @access public
     * @param array $config 配置参数
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('system');
    }

    public function index() {
        $result = $this->system->get_system_list();
        $data   = [];
        foreach ($result as $key => $value) {
            $data[$value['title']] = $value['content'];
        }
        $this->load->view('/system/setting', $data);
    }

    public function upsetData() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = $this->input->post("data");
            $this->load->model('system', '', true);
            $system_result = $this->system->update_entry($data);
            echo json_encode(array('message' => "系统设置成功", 'code' => 200));
        }
    }

}
