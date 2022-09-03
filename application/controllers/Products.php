<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Products 管理员控制器
 *
 * @property  CI_DB_driver $db
 * @property  product      $product
 */
class Products extends Base_Controller {

    protected $_count = 0;  //数据列表总数

    /**
     * 架构方法 设置参数
     *
     * @access public
     * @param array $config 配置参数
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('product');
        if (empty($this->search_params)) {
            $this->_count = $this->product->get_product_list_count();
        } else {
            $this->_count = $this->product->get_product_list_like_count($this->search_params);
        }
    }

    public function index() {
        $this->hulk_template->parse('/product/index');
    }

    /**
     * 获取详情
     *
     * @return array $result
     */
    public function getInfo() {
        $id     = $this->input->post('id');
        $result = $this->product->get_product_info($id);
        sendSuccess('数据获取成功', $result, $this->_count);
    }

    public function getlist() {
        $result = $this->product->get_product_list($this->_page, $this->_limit, $this->search_params);
        sendSuccess('获取列表', $result, $this->_count);
    }

    public function add() {
        $param = $this->input->post('data');
        if ($param) {
            $this->db->trans_begin();
            $this->product->insert_entry($param);
            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
                sendSuccess('数据添加成功', '', $this->_count);
            }
        } else {
            $this->hulk_template->parse('/product/add');
        }
    }

    public function edit() {
        $id    = $this->input->post('id');
        $param = $this->input->post('data');
        if ($param && $id) {
            $this->db->trans_begin();
            $this->product->update_entry($id, $param);
            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
                sendSuccess('数据修改成功', '', $this->_count);
            }
        } else {
            $id     = $this->input->get('id');
            $result = $this->product->get_product_info($id);
            $this->hulk_template->parse('/product/edit', $result);
        }
    }

    public function delete() {
        $id     = $this->input->post('id');
        $result = $this->product->delete_entry($id);
        sendSuccess('数据删除成功', $result, $this->_count);
    }

    public function delete_all() {
        $ids    = $this->input->post('data');
        $result = array();
        foreach ($ids as $key => $value) {
            $result[$key] = $this->product->delete_entry($value['id']);
        }
        sendSuccess('数据删除成功', $result, $this->_count);
    }

}
