<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * AuthGroupAccess 权限授权
 *
 * @property  CI_DB_driver  $db
 */
class AuthGroupAccess extends CI_Model {

    //获取用户权限的权限列表
    public function get_uid_auth_group_access_list($uid) {
        $query = $this->db->select("*")->from("auth_group_access")
            ->where(['auth_group_access.uid' => $uid])
            ->join('auth_group', 'auth_group_access.group_id = auth_group.id', 'left')
            ->get();
        return $query->row_array();
    }

    /**
     * insert_entry 增加数据入口
     */
    public function insert_entry($data) {
        $this->db->insert('auth_group_access', $data);
        return $this->db->insert_id('auth_group_access', $data);
    }

    /**
     * update_entry update_entry 修改数据入口
     */
    public function update_entry($id, $data) {
        return $this->db->update('auth_group_access', $data, array('uid' => $id));
    }

    /**
     * delete_entry 删除数据入口
     */
    public function delete_entry($id) {
        return $this->db->delete('auth_group_access', array('id' => $id));
    }
}
