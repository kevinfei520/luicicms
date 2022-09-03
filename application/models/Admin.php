<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Admin 后台管理员Model
 *
 * @property CI_DB_driver $db
 */
class Admin extends CI_Model {

    //获取管理员列表总数
    public function get_admin_list_count() {
        return $this->db->count_all("admin");
    }

    //获取管理员信息
    public function get_admin_info($id = 0) {
        $query = $this->db->select("*")->from("admin")->where('id', $id)->get();
        return $query->row_array();
    }

    //根据where条件获取管理员信息
    public function get_where_admin_info($where = array()) {
        $query = $this->db->select("*")->from("admin")->where($where)->get();
        return $query->row_array();
    }

    //获取管理员列表
    public function get_admin_list($page, $limit, $search_params = []) {
        if (!empty($search_params)) {
            $query = $this->db->select("*, admin.id as id, auth_group.name as name, admin.status as status")->from("admin")
                ->join('auth_group_access', 'auth_group_access.uid = admin.id', 'left')
                ->join('auth_group', 'auth_group_access.group_id = auth_group.id', 'left')
                ->limit($limit, $page)->like($search_params)->get();
        } else {
            $query = $this->db->select("*, admin.id as id, auth_group.name as name, admin.status as status")->from("admin")
                ->join('auth_group_access', 'auth_group_access.uid = admin.id', 'left')
                ->join('auth_group', 'auth_group_access.group_id = auth_group.id', 'left')
                ->order_by("admin.id", "desc")->limit($limit, $page)->get();
        }
        return $query->result_array();
    }

    // insert_entry 增加数据入口
    public function insert_entry($data) {
        $data['password']    = md5($data['password']);
        $data['create_time'] = time();
        $data['update_time'] = time();
        $this->db->insert('admin', $data);
        return $this->db->insert_id('admin', $data);
    }

    // update_entry 修改数据入口
    public function update_entry($id, $data) {
        $data['update_time'] = time();
        return $this->db->update('admin', $data, array('id' => $id));
    }

    // delete_entry 删除数据入口
    public function delete_entry($id) {
        return $this->db->delete('admin', array('id' => $id));
    }

}
