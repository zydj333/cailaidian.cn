<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class center_order_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     *
     * 获取订单数量
     *
     * $search 查询条件
     *
     * 返回一个返回一个int类型的整数
     *
     */
    public function getOrderCountById($search) {
        $this->db->where(array('user_id'=>$search['id']));
        $query=$this->db->get('db_order');
        return $query->num_rows();
    }
    
    /**
     *
     * 获取订单数量
     *
     * $search 查询条件
     *
     * 返回一个返回一个int类型的整数
     *
     */
    public function getOrderCount($search) {
        $this->db->where(array('user_id'=>$search['id'],'order_status'=>$search['status']));
        $query=$this->db->get('db_order');
        return $query->num_rows();
    }
    
    /**
     *
     * 根据ID获取订单详情
     *
     * $search 查询条件
     *
     * 返回一个结果集
     *
     */
    public function getOrderList($search) {
        $sql = 'SELECT a.product_id,mem_id,name,money,order_status,remark,b.id,product_name,amount
        FROM db_reserve AS a
        LEFT JOIN db_product AS b ON b.id = a.product_id
        WHERE a.mem_id = ' . $search['id']  . ' limit ' . $search['start'] . ' , ' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }

}
