<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 菜单模型
 */
class Menu extends CI_Model
{   
    /**
     * [get_menu_list_count 获取菜单列表总数]
     * @author   Ding Jingfei  <794783766@qq.com>
     * @datetime 2020-02-28T13:40:27+0800
     * @return   [type]                   [description]
     */
    public function get_menu_list_count()
    {
        return $this->db->count_all('menu');
    }

    /**
     * [get_menu_list 获取菜单列表]
     *
     * @author   Ding Jingfei  <794783766@qq.com>
     * @datetime 2020-02-28T13:42:02+0800
     */
    public function get_menu_list($page, $limit, $search_params = []) {
        if (!empty($search_params)) {
            $query = $this->db->select("*")->from("menu")->limit($limit, $page)->like($search_params)->get();
        } else {
            $query = $this->db->select("*")->from("menu")->limit($limit, $page)->get();
        }
        return $query->result_array();
    }

    /** 
     * 根据条件查询出对应的数据  get_where_menu_info
     */
    public function get_where_menu_info($where = array())
    {
        return $this->db->select("*")->from("menu")->where($where)->get()->row_array();
    }

    /** 
     *  insert_entry 增加数据入口
     * 
     */
    public function insert_entry($data)
    {
        $data['create_time'] = time();
        $data['update_time'] = time();
        $this->db->insert('menu', $data);
        return $this->db->insert_id('menu', $data);
    }

    /** 
     * update_entry 修改数据入口
     */
    public function update_entry($id, $data)
    {
        $data['update_time'] = time();
        return $this->db->update('menu', $data, array('id' => $id));
    }

    /** 
     * delete_entry 删除数据入口
     */
    public function delete_entry($id)
    {
        return $this->db->delete('menu', array('id' => $id));
    }
    
}
