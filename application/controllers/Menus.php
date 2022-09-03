<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Menus 菜单控制器
 *
 * @property  menu $menu
 */
class Menus extends Base_Controller {

    protected $_count = 0;  //数据列表总数

    /**
     * 架构方法 设置参数
     *
     * @access public
     * @param array $config 配置参数
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('menu');
        $this->_count = $this->menu->get_menu_list_count();
    }

    public function index() {
        $this->hulk_template->parse('/menu/index');
    }

    public function list() {
        $result = $this->menu->get_menu_list($this->_page, $this->_limit, $this->search_params);
        sendSuccess('登出成功', $result, $this->_count);
    }

    public function add() {
        $this->hulk_template->parse('/menu/add');
    }

    public function addData() {
        $param  = $this->input->post('data');
        $result = $this->menu->insert_entry($param);
        sendSuccess('数据添加成功', $result);
    }

    public function edit() {
        $id     = $this->input->get('id');
        $result = $this->menu->get_where_menu_info(array('id' => $id));
        $this->hulk_template->parse('/menu/edit', $result);
    }

    public function editData() {
        $id     = $this->input->get('id');
        $param  = $this->input->post('data');
        $result = $this->menu->update_entry($id, $param);
        sendSuccess('数据修改成功', $result);
    }

    public function detele() {
        $id = $this->input->post('id');
        if (!isset($id) || $id == null) {
            sendError('对不起，无ID，数据出错');
        }
        $result = $this->menu->delete_entry($id);
        sendSuccess('数据删除成功', $result);
    }

    public function detele_all() {
        $ids    = $this->input->post('data');
        $result = [];
        foreach ($ids as $key => $value) {
            $result[$key] = $this->menu->delete_entry($value['id']);
        }
        sendSuccess('数据删除成功', $result);
    }

}
