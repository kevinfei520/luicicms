<?php
defined('BASEPATH') or exit('No direct script access allowed');

//用户模型
class User extends CI_Model {

    // get_count_users 获取用户总数
    public function get_count_users() {
        return $this->db->count_all('user');
    }

    //get_where_user_info 根据where条件筛选用户
    public function get_where_user_info($where = array()) {
        return $this->db->select("*")->from("user")->where($where)->get()->row_array();
    }

    //get_user_list 获取用户列表
    public function get_user_list($page, $limit, $search_params = '') {
        if (!empty($search_params)) {
            $query = $this->db->select("*")->from("user")->limit($limit, $page)->like($search_params)->get();
        } else {
            $query = $this->db->select("*")->from("user")->limit($limit, $page)->get();
        }
        return $query->result_array();
    }

    //insert_entry 增加数据入口
    public function insert_entry($data) {
        $data['create_time'] = time();
        $data['update_time'] = time();
        $data['password']    = md5($data['password']);
        $this->db->insert('user', $data);
        return $this->db->insert_id('user', $data);
    }

    //update_entry 修改数据入口
    public function update_entry($id, $data) {
        $data['update_time'] = time();
        return $this->db->update('user', $data, array('id' => $id));
    }

    //delete_entry 删除数据入口
    public function delete_entry($id) {
        return $this->db->delete('user', array('id' => $id));
    }

}
