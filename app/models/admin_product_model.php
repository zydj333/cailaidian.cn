<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_product_model
 *
 * @createtime 2015-6-18 13:21:51
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_product_model
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_product_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 获取产品总条数
     * 
     * @param $search 查询条件
     * 
     * @return 返回一个int类型的结果 
     * 
     */
    public function getProductCount($search) {
        $where = ' where is_delete=' . $search['isdel'];
        if (isset($search['name'])) {
            $where.=' and product_name like "%' . $search['name'] . '%"';
        }
        if (isset($search['category'])) {
            $where.=' and category=' . $search['category'];
        }
        if (isset($search['status'])) {
            $where.=' and status=' . $search['status'];
        }
        $sql = "select id from db_product" . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     * 
     * @todo 根据条件获取产品列表
     * 
     * @param $search 查询条件
     * 
     * @return 返回一个object类型的结果集
     *  
     */
    public function getProductList($search) {
        $where = ' where is_delete=' . $search['isdel'];
        if (isset($search['name'])) {
            $where.=' and product_name like "%' . $search['name'] . '%"';
        }
        if (isset($search['category'])) {
            $where.=' and category=' . $search['category'];
        }
        if (isset($search['status'])) {
            $where.=' and status=' . $search['status'];
        }
        $sql = 'select * from db_product ' . $where . ' order by listorder asc,create_time desc limit ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 检查产品是否已经存在
     * 
     * @param $cate 分类ID
     * 
     * @param $name 产品名称
     *  
     * @return 返回一个boolean类型的结果
     * 
     */
    public function checkProductIsSet($cate, $name) {
        $this->db->where(array('category' => $cate, 'product_name' => $name));
        $query = $this->db->get('db_product');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @todo 保存产品信息
     * 
     * @param $data 要保持的数据
     * 
     * @return  返回一个int类型的整数 
     * 
     */
    public function saveProductData($data) {
        $this->db->insert('db_product', $data);
        return $this->db->insert_id();
    }

    /**
     * 
     * @todo 根据ID获取产品详情
     * 
     * @param $product_id 产品ID
     * 
     * @return object 返回一个对象 
     * 
     */
    public function getProductById($product_id) {
        $sql = 'select * from db_product where id=' . $product_id;
        $query = $this->db->query($sql);
        return $query->row();
    }

    /**
     * 
     * @todo 保存产品信息
     * 
     * @param $data 要修改的数据
     * 
     * @param $product_id 产品ID
     * 
     * @return 返回一个Boolean类型的结果
     * 
     */
    public function editProductData($data, $product_id) {
        return $this->db->update('db_product', $data, array('id' => $product_id));
    }

}
