<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Category 分类模型
 *
 * @property CI_DB_driver $db
 */
class Category extends CI_Model {

    public function getCountCategory() {
        return $this->db->count_all('category');
    }

    public function get_carousel_list($page, $limit, $search_params = []) {
        if (!empty($search_params)) {
            $field = array_filter($search_params);
            $query = $this->db->select("*")->from("category")->limit($limit, $page)->like($field)->get();
        } else {
            $query = $this->db->select("*")->from("category")->order_by("id", "desc")->limit($limit, $page)->get();
        }
        return $query->result_array();
    }

    public function get_count_carousel_list() {
        return $this->db->count_all("category");
    }

    // insert_entry 增加数据入口
    public function insert_entry($data) {
        $data['create_time'] = time();
        $data['update_time'] = time();
        $this->db->insert('category', $data);
        return $this->db->insert_id('category', $data);
    }

    // update_entry 修改数据入口
    public function update_entry($id, $data) {
        $data['update_time'] = time();
        return $this->db->update('category', $data, array('id' => $id));
    }

    /**
     * [delete_entry 删除数据入口]
     */
    public function delete_entry($id) {
        return $this->db->delete('category', array('id' => $id));
    }
}
