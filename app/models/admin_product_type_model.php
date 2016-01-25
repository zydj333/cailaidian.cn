<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_product_type_model
 *
 * @createtime 2015-6-23 16:18:41
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_product_type_model
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_product_type_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 获取产品分类列表 
     * 
     */
    public function getProductTypeList() {
        $this->db->order_by('salt', 'asc');
        $query = $this->db->get('db_protype');
        return $query->result();
    }

    /**
     * 
     * @todo 保存产品分类
     * 
     * @param $data 要保持的数据
     * 
     * @return 返回一个int类型的整数 
     * 
     */
    public function saveProductType($data) {
        $this->db->insert('db_protype', $data);
        return $this->db->insert_id();
    }

    /**
     * 
     * @todo 根据ID获取产品分类信息
     * 
     * @param $t_id 产品分类ID
     * 
     * @return 返回一个结果集 
     * 
     */
    public function getProductTypeById($t_id) {
        $this->db->where(array('id' => $t_id));
        $query = $this->db->get('db_protype');
        return $query->row();
    }

    /**
     * 
     * @todo 保存产品分类修改
     * 
     * @param $data 要修改的数据 
     * 
     * @param $type_id 要修改的数据ID
     * 
     * @return  返回一个Boolean类型的结果
     * 
     */
    public function editProductType($data, $type_id) {
        return $this->db->update('db_protype', $data, array('id' => $type_id));
    }

    /**
     * 
     * @todo 删除产品分类
     * 
     * @param $type_id 要删除的数据ID
     * 
     * @return 返回一个boolean看类型的结果 
     * 
     */
    public function delProductType($type_id) {
        return $this->db->delete('db_protype', array('id' => $type_id));
    }

}
