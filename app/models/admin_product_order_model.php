<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_product_order_model
 *
 * @createtime 2015-7-14 10:44:58
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_product_order_model
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_product_order_model extends CI_Model {

    //put your code here
    /**
     * 
     * @todo 构造方法 
     * 
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 获取条件下产品总条数
     * 
     * @param $search 查询条件
     * 
     * @return 返回一个int类型的整数 
     * 
     */
    public function getProductOrderCount($search) {
        $where = ' where 1=1';
        if (isset($search['order_sn'])) {
            $where.=' and order_sn="' . $search['order_sn'] . '"';
        }
        if (isset($search['celephone'])) {
            $where.=' and telephone="' . $search['celephone'] . '"';
        }
        if (isset($search['username'])) {
            $where.=' and username="' . $search['username'] . '"';
        }
        if (isset($search['is_success'])) {
            $where.=' and is_success=' . $search['is_success'];
        }
        $sql = 'select id from db_product_order' . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     * 
     * @todo 获取条件下产品列表
     * 
     * @param $search 查询条件
     * 
     * @return 返回一个object类型的结果集 
     * 
     */
    public function getProductOrderList($search) {
        $where = ' where 1=1';
        if (isset($search['order_sn'])) {
            $where.=' and a.order_sn="' . $search['order_sn'] . '"';
        }
        if (isset($search['celephone'])) {
            $where.=' and a.telephone="' . $search['celephone'] . '"';
        }
        if (isset($search['username'])) {
            $where.=' and a.username="' . $search['username'] . '"';
        }
        if (isset($search['is_success'])) {
            $where.=' and a.is_success=' . $search['is_success'];
        }
        $sql = 'select a.*,b.product_name from db_product_order as a left join db_product as b on a.pid=b.id' . $where . ' order by a.createtime desc limit ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    /**
     * 
     * @todo 修改预约订单状态 
     * 
     * @param $data  要修改的数据
     * 
     * @param $order_id 要修改的数据ID
     * 
     * @return 返回一个boolean类型的结果
     * 
     */
    public function editProductOrder($data,$order_id){
        return $this->db->update('db_product_order',$data,array('id'=>$order_id));
    }

}
