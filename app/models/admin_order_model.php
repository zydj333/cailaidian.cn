<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_order_model
 *
 * @createtime 2015-7-15 13:36:52
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_order_model
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_order_model extends CI_Model {

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
     * @return  返回一个int类型的整数 
     * 
     */
    public function getOrderCount($search) {
        $where = ' where 1=1';
        if (isset($search['order_sn'])) {
            $where.=' and order_sn="' . $search['order_sn'] . '"';
        }
        if (isset($search['username'])) {
            $where.=' and name="' . $search['username'] . '"';
        }
        if (isset($search['order_status'])) {
            $where.=' and order_status=' . $search['order_status'];
        }
        $sql = 'select id from db_order' . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     * 
     * @todo 获取产品列表
     *  
     * @param $search 查询条件
     * 
     * @return f返回一个object类型的结果
     * 
     */
    public function getOrderList($search) {
        $where = ' where 1=1';
        if (isset($search['order_sn'])) {
            $where.=' and a.order_sn="' . $search['order_sn'] . '"';
        }
        if (isset($search['username'])) {
            $where.=' and a.name="' . $search['username'] . '"';
        }
        if (isset($search['order_status'])) {
            $where.=' and a.order_status=' . $search['order_status'];
        }
        $sql = 'select a.*,b.product_name from db_order as a left join db_product as b on a.product_id=b.id ' . $where . ' order by a.post_time desc limit ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 根据订单ID获取订单详情
     * 
     * @param $order_id 订单ID
     * 
     * @return 返回一个object的结果 
     * 
     */
    public function getOrderDetial($order_id) {
        $this->db->where(array('id' => $order_id));
        $query = $this->db->get('db_order');
        return $query->row();
    }

    /**
     * 
     * @todo 修改订单信息 
     * 
     * @param $data 要修改数据
     * 
     * @param $order_id 要修改的订单ID
     * 
     * @return 返回一个boolean类型的结果
     * 
     */
    public function editOrderStatus($data, $order_id) {
        return $this->db->update('db_order', $data, array('id' => $order_id));
    }
    
    /**
     * 
     * @todo 获取用户信息 
     * 
     * @param $uid 用户ID
     * 
     * @return 返回一个用户详情
     * 
     */
    public function getUserInfo($uid){
        $this->db->where(array('user_id'=>$uid));
        $query=  $this->db->get('db_member_info');
        return $query->row();
    }
    
    /**
     * 
     * @todo 修改用户资金信息
     * 
     * @param $data 要修改的数据
     * 
     * @param $uid 修改的用户id
     * 
     * @return 返回一个boolean类型的整数 
     * 
     */
    public function saveUserInfo($data,$uid){
        return $this->db->update('db_member_info',$data,array('user_id'=>$uid));
    }
    
    /**
     * 
     * @todo 添加用户自己变动记录
     * 
     * @param $data 要保存的数据
     * 
     * @return 返回一个int类型的整数 
     * 
     */
    public function saveUserAccountLog($data){
        $this->db->insert('db_member_account_log', $data);
        return $this->db->insert_id();
    }

}
