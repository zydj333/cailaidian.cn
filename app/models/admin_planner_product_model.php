<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_planner_product_model
 *
 * @createtime 2015-7-22 10:08:55
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_planner_product_model
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_planner_product_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 获取理财师产品总条数
     * 
     * @param $search 查询条件
     * 
     * @return 返回一个int类型的整数 
     * 
     */
    public function getPlannerProductCount($search) {
        $where = ' where 1=1';
        if (isset($search['product_name'])) {
            $where.=' and product_name like "%' . $search['product_name'] . '%"';
        }
        if (isset($search['username'])) {
            $where.=' and username="' . $search['username'] . '"';
        }
        if (isset($search['category'])) {
            $where.=' and category=' . $search['category'];
        }
        if (isset($search['province'])) {
            $where.=' and province=' . $search['province'];
        }
        $sql = 'select id from `db_member_product` ' . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     * 
     * @todo 获取理财师产品列表
     * 
     * @param $search  查询条件
     * 
     * @return 返回一个object类型的结果集 
     * 
     */
    public function getPlannerProductList($search) {
        $where = ' where 1=1';
        if (isset($search['product_name'])) {
            $where.=' and product_name like "%' . $search['product_name'] . '%"';
        }
        if (isset($search['username'])) {
            $where.=' and username="' . $search['username'] . '"';
        }
        if (isset($search['category'])) {
            $where.=' and category=' . $search['category'];
        }
        if (isset($search['province'])) {
            $where.=' and province=' . $search['province'];
        }
        $sql = 'select * from db_member_product ' . $where . ' order by createtime desc limit ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 获取项目详情
     * 
     * @param $product_id 产品ID
     * 
     * @return 返回一个object类型的结果
     * 
     */
    public function getPlannerProductDetial($product_id) {
        $this->db->where(array('id' => $product_id));
        $query = $this->db->get('db_member_product');
        return $query->row();
    }

}
