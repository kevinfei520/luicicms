<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Carousel 轮播图模型
 *
 * @property  CI_DB_driver db
 */
class Carousel extends CI_Model {
    //获取轮播图总数
    public function get_carousel_count() {
        return $this->db->count_all("carousel");
    }

    //获取轮播图列表
    public function get_carousel_list($page, $limit, $search_params = []) {
        if (!empty($search_params)) {
            $query = $this->db->select("*")->from("carousel")->limit($limit, $page)->like($search_params)->get();
            return $query->result_array();
        } else {
            $query = $this->db->select("*")->from("carousel")->order_by("id", "desc")->limit($limit, $page)->get();
            return $query->result_array();
        }
    }

    // insert_entry 增加数据入口
    public function insert_entry($data) {
        $data['create_time'] = time();
        $data['update_time'] = time();
        $this->db->insert('carousel', $data);
        return $this->db->insert_id('carousel', $data);
    }

    // update_entry 修改数据入口
    public function update_entry($id, $data) {
        $data['update_time'] = time();
        return $this->db->update('carousel', $data, array('id' => $id));
    }

    /**
     * delete_entry 删除数据入口
     */
    public function delete_entry($id) {
        return $this->db->delete('carousel', array('id' => $id));
    }

}
