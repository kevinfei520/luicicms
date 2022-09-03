<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * AdminLog 后台管理员的操作日志Model
 *
 * @property CI_DB_driver $db
 */
class AdminLog extends CI_Model {

    public function get_admin_log_info($id = 0) {
        $query = $this->db->select("*")->from("admin_log")->where('id', $id)->get();
        return $query->row_array();
    }

    /**
     * 记录管理员操作日志
     */
    public function auto_admin_log($remark) {
        $data = [
            'admin_id'    => $this->session->admin_auth ?? 0,
            'username'    => $this->session->admin_name ?? "",
            'useragent'   => $_SERVER["HTTP_USER_AGENT"],
            'ip'          => $_SERVER["SERVER_ADDR"] ?? getClientIp(),
            'url'         => $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"],
            'method'      => $_SERVER["REQUEST_METHOD"] ?? __METHOD__,
            'type'        => $_SERVER['CONTENT_TYPE'],
            'param'       => $_SERVER['QUERY_STRING'],
            'remark'      => $remark ?? "",
            'create_time' => time(),
            'update_time' => time()
        ];
        return $this->insert_entry($data);
    }

    // insert_entry 增加数据入口
    public function insert_entry($data) {
        $this->db->insert('admin_log', $data);
        return $this->db->insert_id('admin_log', $data);
    }

    // update_entry 修改数据入口
    public function update_entry($id, $data) {
        $data['update_time'] = time();
        return $this->db->update('admin_log', $data, array('id' => $id));
    }

    // delete_entry 删除数据入口
    public function delete_entry($id) {
        return $this->db->delete('admin_log', array('id' => $id));
    }

}
