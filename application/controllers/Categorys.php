<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Categorys 分类管理控制器
 *
 * @property  category category
 */
class Categorys extends Base_Controller {
    private $_count = 0;  //数据列表总数

    /**
     * 架构方法 设置参数
     *
     * @access public
     * @param array $config 配置参数
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('category', '', true);
        $this->_count = $this->category->getCountCategory();
    }

    public function index() {
        $this->hulk_template->parse('/category/index');
    }

    public function list() {
        $result = $this->category->get_carousel_list($this->_page, $this->_limit, $this->search_params);
        sendSuccess('获取列表', $result, $this->_count);
    }

    public function add() {
        $param = $this->input->post('data');
        if ($param) {
            unset($param['file']);
            unset($param['ci_csrf_token']);
            $result = $this->category->insert_entry($param);
            sendSuccess('数据添加成功', $result, $this->_count);
        } else {
            $this->hulk_template->parse('/category/add');
        }
    }

    public function edit() {
        $param = $this->input->post('data');
        if ($param) {
            $param  = $this->input->post('data');
            $id     = $param['id'];
            $result = $this->category->update_entry($id, $param);
            sendSuccess('数据修改成功', $result, $this->_count);
        } else {
            $this->hulk_template->parse('/category/edit');
        }
    }

    public function editData() {

    }

    // 删除操作
    public function delete() {
        $id     = $this->input->post('id');
        $result = $this->category->delete_entry($id);
        sendSuccess('数据删除成功', $result, $this->_count);
    }

    // 多选删除操作
    public function delete_all() {
        $ids    = $this->input->post('data');
        $result = [];
        foreach ($ids as $key => $value) {
            $result[$key] = $this->category->delete_entry($value['id']);
        }
        sendSuccess('数据删除成功', $result, $this->_count);
    }
}
