<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of center_product_model
 *
 * @createtime 2015-7-20 10:47:55
 * 
 * @author ZhangPing'an
 * 
 * @todo center_product_model
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class center_product_model extends CI_Model {
    //put your code here
    
    public function __construct() {
        parent::__construct();
    }
    
    
    /**
     * 
     * @todo 获取我的产品列表
     * 
     * @param $search 查询条件 
     * 
     * @return 返回一个int类型的整数
     * 
     */
    public function getProductCount($search){
        $sql='select id from db_member_product where user_id='.$search['user_id'].' and is_del=0';
        $query=  $this->db->query($sql);
        return $query->num_rows();
    }
    
    /**
     * 
     * @todo 获取我的产品列表
     * 
     * @param $search 查询条件
     * 
     * @return 返回一个object类型的结果集 
     * 
     */
    public function getProductList($search){
        $sql='select * from db_member_product where user_id='.$search['user_id'].' and is_del=0 order by createtime desc limit '.$search['start'].','.$search['pagesize'];
        $query=  $this->db->query($sql);
        return $query->result();
    }
    
    
    /**
     * 
     * @todo 修改我的产品信息
     * 
     * @param $data 要修改的数据
     * 
     * @return $pid 产品ID
     * 
     * @return 返回一个boolean类型的结果 
     * 
     */
    public function editProductData($data,$pid){
        return $this->db->update('db_member_product',$data,array('id'=>$pid));
    }
}
