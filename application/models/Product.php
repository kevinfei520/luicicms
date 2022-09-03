<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Product 商品模型
 *
 * @property CI_DB_driver $db
 */
class Product extends CI_Model {

    //获取商品总数
    public function get_product_list_count() {
        return $this->db->count_all("product");
    }

    //获取搜索的商品总数
    public function get_product_list_like_count($search_params = []) {
        return $this->db->count_all("product");
    }

    /**
     * 获取商品详情
     * @ param  id
     *
     * @return  array  $reply
     */
    public function get_product_info($id = 0) {
        $query = $this->db->select("*")->from("product")->where('id', $id)->get();
        return $query->row_array();
    }

    //获取商品列表
    public function get_product_list($page, $limit, $search_params = []) {
        if (empty($search_params)) {
            $query = $this->db->select("*, product.id as id, category.category_name as cname")->from("product")
                ->join('category', 'category.id = product.pid', 'left')
                ->limit($limit, $page)->get();
            return $query->result_array();
        }

        $query = $this->db->select("*, product.id as id, category.category_name as cname")->from("product")
            ->join('category', 'category.id = product.pid', 'left')
            ->like(array_filter($search_params))->limit($limit, $page)->get();
        return $query->result_array();
    }

    /**
     * insert_entry 增加数据入口
     */
    public function insert_entry($data) {
        $data['create_time'] = time();
        $data['update_time'] = time();
        $this->db->insert('product', $data);
        return $this->db->insert_id('product', $data);
    }

    /**
     * update_entry 修改数据入口
     */
    public function update_entry($id, $data) {
        $data['update_time'] = time();
        return $this->db->update('product', $data, array('id' => $id));
    }

    /**
     * delete_entry 删除数据入口
     */
    public function delete_entry($id) {
        return $this->db->delete('product', array('id' => $id));
    }

}
