<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Groups 权限组管理
 *
 * @property  AuthGroup AuthGroup
 */
class Groups extends Base_Controller {

    private $_count = 0;  //数据列表总数

    /**
     * 架构方法 设置参数
     *
     * @access public
     * @param array $config 配置参数
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('AuthGroup', '', true);
        $this->_count = $this->AuthGroup->get_auth_group_count();
    }

    // 权限组主页
    public function index() {
        $this->hulk_template->parse('/group/index');
    }

    // 权限组列表
    public function getList() {
        $result = $this->AuthGroup->get_auth_group_list($this->_page, $this->_limit, $this->search_params);
        sendSuccess('获取列表数据', $result, $this->_count);
    }

    /**
     * 参数处理
     */
    public function handleParams($param) {
        if ($param === null || empty($param)) {
            return [];
        }

        return [
            'name'        => $param['name'],
            'status'      => $param['status'],
            'description' => $param['description'],
            'rules'       => implode(',', $param),
        ];
    }

    //权限组添加
    public function add() {
        $param = $this->input->post('data');
        $data  = $this->handleParams($param);
        if (empty($data)) {
            return $this->hulk_template->parse('/group/add');
        }
        $result = $this->AuthGroup->insert_entry($data);
        sendSuccess('规则添加成功', $result, $this->_count);
    }

    // 权限组编辑
    public function edit() {
        $id    = $this->input->get('id');
        $param = $this->input->post('data');
        $data  = $this->handleParams($param);
        if (empty($data)) {
            $result = $this->AuthGroup->get_auth_group_info(array('id' => $id));
            return $this->hulk_template->parse('/group/edit', $result);
        }
        $result = $this->AuthGroup->update_entry($id, $data);
        sendSuccess('修改成功', $result, $this->_count);
    }

    // 修改权限状态
    public function editGroupStatus() {
        $id             = $this->input->get('id');
        $data['status'] = $this->input->post('data');
        $result         = $this->AuthGroup->update_entry($id, $data);
        sendSuccess('修改成功', $result, $this->_count);
    }

    // 删除权限组
    public function delete() {
        $id     = $this->input->post('id');
        $result = $this->AuthGroup->delete_entry($id);
        sendSuccess('删除成功', $result, $this->_count);
    }

}
