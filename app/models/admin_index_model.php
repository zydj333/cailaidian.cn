<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class admin_index_model extends CI_Model {
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * 
     * @todo 获取昨日注册 
     * 
     */
    
    public function yesterday() {
        $sql = "SELECT id FROM (`db_member`) WHERE `createtime` > ".strtotime('-1 day');
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    /**
     * 
     * @todo 获取本周注册 
     * 
     */
    
    public function week() {
        $sql = "SELECT id FROM (`db_member`) WHERE `createtime` > ".strtotime('-1 week');
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    /**
     * 
     * @todo 获取昨日订单
     * 
     */
    
    public function yesterdayOrder() {
        $sql = "SELECT id FROM (`db_order`) WHERE `post_time` > ".strtotime('-1 day');
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    /**
     * 
     * @todo 获取本周订单 
     * 
     */
    
    public function weekOrder() {
        $sql = "SELECT id FROM (`db_order`) WHERE `post_time` > ".strtotime('-1 week');
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    /**
     *
     *  @todo 获取会员总数 
     * 
     * @return 返回一个int类型的结果
     * 
     */
    public function getCount() {
        $query = $this->db->get('db_member');
        return $query->num_rows();
    }
    
    /**
     *
     *  @todo 获取产品总数 
     * 
     * @return 返回一个int类型的结果
     * 
     */
    public function getProduct() {
        $query = $this->db->get('db_product');
        return $query->num_rows();
    }
    
    /**
     *
     *  @todo 获取订单总数 
     * 
     * @return 返回一个int类型的结果
     * 
     */
    public function getOrder() {
        $query = $this->db->get('db_order');
        return $query->num_rows();
    }
    
    /**
     *
     *  @todo 获取留言总数 
     * 
     * @return 返回一个int类型的结果
     * 
     */
    public function getMessage() {
        $query = $this->db->get('db_message');
        return $query->num_rows();
    }
    
    /**
     *
     * @todo 获取订单详情 
     * 
     * @return 返回一个int类型的结果
     * 
     */
    public function getMoney() {
        $sql = "SELECT sum(money) as totalmoney FROM db_order where order_status = 1";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result->totalmoney;
    }
    
    /**
     *
     * @todo 获取数据库详情 
     * 
     * @return 返回一个int类型的结果
     * 
     */
    public function getMysql() {
        $sql = "select VERSION() as version";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result->version;
    }
}
