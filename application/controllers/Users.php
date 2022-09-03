<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *  Users 用户设置
 *
 * @property  user  $user
 */
class Users extends Base_Controller {

    protected $_count = 0; // 数据总数

    /**
     * 架构方法 设置参数
     *
     * @access public
     * @param array $config 配置参数
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('user', '', true);
        $this->_count = $this->user->get_count_users();
    }

    public function index() {
        $this->hulk_template->parse('/user/index');
    }

    public function list() {
        $result = $this->user->get_user_list($this->_page, $this->_limit, $this->search_params);
        sendSuccess('获取列表', $result, $this->_count);
    }

    public function add() {
        $param = $this->input->post('data');
        if ($param) {
            $result = $this->user->insert_entry($param);
            sendSuccess('数据添加成功', $result);
        } else {
            $this->hulk_template->parse('/user/add');
        }
    }

    public function edit() {
        $id    = $this->input->get('id');
        $param = $this->input->post('data');
        if ($param) {
            $result = $this->user->update_entry($id, $param);
            sendSuccess('数据修改成功', $result);
        } else {
            $result = $this->user->get_where_user_info(array('id' => $id));
            $this->hulk_template->parse('/user/edit', $result);
        }
    }

    public function delete() {
        $id = $this->input->post('id');
        if (!isset($id) || $id == null) {
            sendError('对不起，无ID，数据出错');
        }
        $result = $this->user->delete_entry($id);
        sendSuccess('数据删除成功', $result);
    }

    public function delete_all() {
        $ids    = $this->input->post('data');
        $result = [];
        foreach ($ids as $key => $value) {
            $result[$key] = $this->user->delete_entry($value['id']);
        }
        sendSuccess('数据删除成功', $result);
    }

}
