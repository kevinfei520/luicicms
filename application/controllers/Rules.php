<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Rules 权限规则管理
 */
class Rules extends Base_Controller
{   

    /**
     * 架构方法 设置参数
     * @access public
     * @param  array $config 配置参数
     */
    public function __construct()
    {
        parent::__construct();
    }

    //获取规则
    public function getrule()
    {
        $id     = $this->input->post('id');
        $result = $this->AuthRule->get_auth_rule_info(array('authorityId' => $id));
        sendSuccess('获取成功', $result);
    }

    //获取父级规则
    public function getparentrule()
    {
        $result = $this->AuthRule->get_parent_rule_list();
        sendSuccess('获取父级规则', $result);
    }

    // 规则管理主页
    public function index()
    {
        $this->load->view('/rule/menu');
    }

    // 获取权限规则列表
    public function list() 
    {
        $result = $this->AuthRule->get_auth_rule_list();
        sendSuccess('获取列表数据', $result);
    }

    // 添加权限规则
    public function add()
    {
        $this->hulk_template->parse('/rule/add');
    }

    public function addruledata()
    {
        $param = $this->input->post('data');
        $result = $this->AuthRule->insert_entry($param);
        sendSuccess('数据添加成功', $result);
    }

    // 编辑权限规则
    public function edit()
    {   
        $id = $this->input->get('id');
        $result = $this->AuthRule->get_auth_rule_info(['authorityId'=>$id]);
        $reply = $this->AuthRule->get_auth_rule_info(['authorityId' => $result['parentId']], 'authorityName,isMenu,parentId');
        $result['parentInfo'] = $reply;
        $this->hulk_template->parse('/rule/edit', $result);
    }

    public function editruledata()
    {
        $param = $this->input->post('data');
        $result = $this->AuthRule->update_entry($param['authorityId'],$param);
        sendSuccess('修改成功', $result);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $result = $this->AuthRule->delete_entry($id);
        sendSuccess('数据删除成功', $result);
    }

}
