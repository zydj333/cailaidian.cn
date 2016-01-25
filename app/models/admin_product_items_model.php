<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_product_items_model
 *
 * @createtime 2015-7-6 15:06:01
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_product_items_model
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_product_items_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 获取某一产品的所有收益列表项
     * 
     * @param $pid 产品ID
     * 
     * @return 返回一个object类型的结果  
     * 
     */
    public function getProductItemsList($pid) {
        $this->db->where(array('product_id' => $pid));
        $this->db->order_by('interest', 'asc');
        $query = $this->db->get('db_product_items');
        return $query->result();
    }

    /**
     * 
     * @todo 根据ID获取产的收益子项详情
     * 
     * @param $items_id 收益项ID
     * 
     * @return 返回一个结果集
     * 
     */
    public function getItemsInfo($items_id) {
        $this->db->where(array('id' => $items_id));
        $query = $this->db->get('db_product_items');
        return $query->row();
    }

    /**
     * 
     * @todo 保存收益子项
     * 
     * @pasram $data 要保存的数据
     * 
     * @return 返回一个int类型的整数
     * 
     */
    public function saveProductItems($data) {
        $this->db->insert('db_product_items', $data);
        return $this->db->insert_id();
    }

    /**
     * 
     * @todo 修改收益子项
     * 
     * @param $data 要修改的数据 
     * 
     * @param $items_id 要修改的子项ID
     * 
     * @return 返回一个boolean类型的结果 
     * 
     */
    public function editProductItems($data, $items_id) {
        return $this->db->update('db_product_items', $data, array('id' => $items_id));
    }

    /**
     * 
     * @todo 删除产品收益子项
     * 
     * @param $items_id 要删除的子项ID
     * 
     * @return 返回一个boolean类型的结果 
     * 
     */
    public function delProductItems($items_id) {
        return $this->db->delete('db_product_items', array('id' => $items_id));
    }

}
