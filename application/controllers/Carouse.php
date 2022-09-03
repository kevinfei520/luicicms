<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Carouse 轮播图控制器
 *
 * @property  carousel  carousel
 */
class Carouse extends Base_Controller {
    private $_count = 0; // 数据总数

    /**
     * 架构方法 设置参数
     *
     * @access public
     * @param array $config 配置参数
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('carousel', '', true);
        $this->_count = $this->carousel->get_carousel_count();
    }

    public function index() // 载入类库
    {
        $this->hulk_template->parse('/carousel/index');
    }

    public function getlist() {
        $result = $this->carousel->get_carousel_list($this->_page, $this->_limit, $this->search_params);
        sendSuccess('数据获取成功', $result, $this->_count);
    }

    public function add() {
        $param = $this->input->post('data');
        if ($param) {
            unset($param['file']);
            unset($param['ci_csrf_token']);
            $result = $this->carousel->insert_entry($param);
            sendSuccess('数据添加成功', $result, $this->_count);
        } else {
            $this->hulk_template->parse('/carousel/add');
        }
    }

    // 编辑
    public function edit() {
        $param = $this->input->post('data');
        if ($param) {
            $id = $param['id'];
            unset($param['id']);
            unset($param['file']);
            unset($param['ci_csrf_token']);
            $result = $this->carousel->update_entry($id, $param);
            sendSuccess('数据修改成功', $result);
        } else {
            $this->hulk_template->parse('/carousel/edit');
        }
    }

    // 图片删除
    public function delete() {
        $id     = $this->input->post('id');
        $result = $this->carousel->delete_entry($id);
        sendSuccess('数据删除成功', $result);
    }

    //多选删除
    public function delete_all() {
        $ids    = $this->input->post('data');
        $result = array();
        foreach ($ids as $key => $value) {
            $result[$key] = $this->carousel->delete_entry($value['id']);
        }
        sendSuccess('数据删除成功', $result);
    }
}
