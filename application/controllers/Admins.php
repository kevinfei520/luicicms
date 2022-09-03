<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Admin 管理员控制器
 *
 * @property  CI_DB_driver  db
 * @property  AuthGroup     AuthGroup
 * @property  Hulk_template hulk_template
 */
class Admins extends Base_Controller {

    protected $_count = 0;  //数据列表总数

    /**
     * 架构方法 设置参数
     *
     * @access public
     */
    public function __construct() {
        parent::__construct();
        $this->_count = $this->admin->get_admin_list_count();
    }

    /**
     * 管理员首页
     */
    public function index() {
        $this->hulk_template->parse('/admin/index');
    }

    /**
     * 获取管理员详情
     *
     * @return array $result
     */
    public function getinfo() {
        $id     = $this->input->post('id');
        $result = $this->admin->get_admin_info($id);
        sendSuccess('管理员详情', $result, $this->_count);
    }

    /**
     * 获取管理员列表
     *
     * @return array $result
     */
    public function getlist() {
        $result = $this->admin->get_admin_list($this->_page, $this->_limit, $this->search_params);
        sendSuccess('获取列表', $result, $this->_count);
    }

    /**
     * 获取权限组
     */
    public function getauthgroup() {
        $this->load->model('AuthGroup', '', true);
        $result = $this->AuthGroup->get_group_list();
        sendSuccess('数据获取成功', $result, $this->_count);
    }

    /**
     * 添加数据
     */
    public function add() {
        $param = $this->input->post('data');
        if ($param) {
            $permission_group = $param['permission_group'];
            unset($param['permission_group']);
            $this->db->trans_begin();
            $data['uid']      = $this->admin->insert_entry($param);
            $data['group_id'] = $permission_group;
            $this->load->model('AuthGroupAccess', '', true);
            $this->AuthGroupAccess->insert_entry($data);
            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
                sendSuccess('数据添加成功', '', $this->_count);
            }
        } else {
            $this->hulk_template->parse('/admin/add');
        }
    }

    /**
     * 编辑管理信息
     */
    public function edit() {
        $param            = $this->input->post("data");
        $id               = isset($param["id"]) && empty($param["id"]) ? $param["id"] : 0;
        $permission_group = isset($param["permission_group"]) && empty($param["permission_group"]) ? $param["permission_group"] : 0;

        unset($param['id']);
        unset($param['permission_group']);

        if ($param && $id && $permission_group) {
            if ($param['password']) {
                $param['password'] = md5($param['password']);
            } else {
                unset($param['password']);
            }
            $this->db->trans_begin();
            $this->admin->update_entry($id, $param);
            $data['group_id'] = $permission_group;
            $this->load->model('AuthGroupAccess', '', true);
            $this->AuthGroupAccess->update_entry($id, $data);
            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
                sendSuccess('数据修改成功', '', $this->_count);
            }
        } else {
            $this->hulk_template->parse('/admin/edit');
        }
    }

    /**
     * 删除操作
     */
    public function delete() {
        $id     = $this->input->post('id');
        $result = $this->admin->delete_entry($id);
        sendSuccess('数据删除成功', $result, $this->_count);
    }

    /**
     * 删除全部操作
     */
    public function delete_all() {
        $ids    = $this->input->post('data');
        $result = array();
        foreach ($ids as $key => $value) {
            $result[$key] = $this->admin->delete_entry($value['id']);
        }
        sendSuccess('数据删除成功', $result, $this->_count);
    }

}
