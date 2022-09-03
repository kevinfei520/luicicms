<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Articles 文章控制器
 *
 * @property  article       article
 * @property  AdminLog      AdminLog
 * @property  Hulk_template hulk_template
 */
class Articles extends Base_Controller {

    private $_count = 0; // 数据总数

    /**
     * 架构方法 设置参数
     *
     * @access public
     * @param array $config 配置参数
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('article', '', true);
        $this->_count = $this->article->getArticleCount();
    }

    public function index() {
        $this->hulk_template->parse('/article/index');
    }

    public function list() {
        $result = $this->article->get_carousel_list($this->_page, $this->_limit, $this->search_params);
        sendSuccess('获取列表', $result, $this->_count);
    }

    public function add() {
        $param = $this->input->post('data');
        if ($param) {
            unset($param['id']);
            unset($param['file']);
            $result = $this->article->insert_entry($param);
            sendSuccess('数据添加成功', $result, $this->_count);
        } else {
            $this->hulk_template->parse('/article/add');
        }
    }

    public function edit() {
        $id    = $this->input->get('id');
        $param = $this->input->post('data');
        if ($param) {
            $id = $param['id'];
            unset($param['id']);
            unset($param['file']);
            $result = $this->article->update_entry($id, $param);
            sendSuccess('数据修改成功', $result, $this->_count);
        } else {
            $result = $this->article->getArticleInfo($id);
            $this->hulk_template->parse('/article/edit', $result);
        }
    }

    public function delete() {
        $id = $this->input->post('id');

        $result = $this->article->delete_entry($id);
        sendSuccess('数据删除成功', $result, $this->_count);
    }

    public function delete_all() {
        $ids    = $this->input->post('data');
        $result = array();
        foreach ($ids as $key => $value) {
            $result[$key] = $this->article->delete_entry($value['id']);
        }
        sendSuccess('数据删除成功', $result, $this->_count);
    }

}
