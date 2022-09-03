<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * AuthGroup 权限组
 *
 * @property  CI_DB_driver db
 */
class AuthGroup extends CI_Model
{   
    // 获取全部的权限组数量
    public function get_auth_group_count()
    {
        return $this->db->count_all('auth_group');
    }

    // 获取权限组列表
    public function get_group_list()
    {   
        $query = $this->db->select("id,name")->from("auth_group")->get();
        return $query->result_array();
    }

    // 获取权限组列表
    public function get_auth_group_list($page, $limit, $search_params = []) {
        if (!empty($search_params)) {
            $query = $this->db->select("*")->from("auth_group")->limit($limit, $page)->like($search_params)->get();
        } else {
            $query = $this->db->select("*")->from("auth_group")->limit($limit, $page)->get();
        }
        return $query->result_array();
    }

    // 获取权限组的权限内容
    public function get_auth_group_info($where = [])
    {   
        $query = $this->db->select("*")->from("auth_group")->where($where)->get();
        return empty($where) ? $query->result_array() : $query->row_array();
    }

    // insert_entry 增加数据入口
    public function insert_entry($data)
    {   
        $data['create_time'] = time();
        $data['update_time'] = time();
        $this->db->insert('auth_group', $data);
        return $this->db->insert_id('auth_group', $data);
    }

    // update_entry 修改数据入口
    public function update_entry($id, $data)
    {   
        $data['update_time'] = time();
        return $this->db->update('auth_group', $data, array('id' => $id));
    }
    
    // delete_entry 删除数据入口
    public function delete_entry($id)
    {
        return $this->db->delete('auth_group', array('id' => $id));
    }

}
