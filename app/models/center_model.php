<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class center_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 获取产品分类及分类下的产品列表 
     * 
     * @return 返回一个结果集
     * 
     */
    public function getProductCategory() {
        $this->db->order_by('salt', 'asc');
        $query = $this->db->get('db_protype');
        return $query->result();
    }

    /**
     * 
     * @todo 获取产品列表
     * 
     * @param $cate_id 分类ID
     * 
     * @return 返回一个结果集 
     * 
     */
    public function getProductListByCate($cate_id) {
        $this->db->where(array('is_delete' => 0, 'is_show' => 1, 'category' => $cate_id));
        $this->db->order_by('create_time', 'desc');
        $query = $this->db->get('db_product');
        return $query->result();
    }

    /**
     * 
     * @todo 保存报单信息 
     *
     * @param $data 要保存的数据
     * 
     * @param $return 返回一个int类型的整数
     *  
     */
    public function saveMyOrder($data) {
        $this->db->insert('db_order', $data);
        return $this->db->insert_id();
    }

    /**
     * 
     * @todo 获取我的所有状态报单
     * 
     * @param $user_id
     * 
     * @return 返回一个object类型的结果 
     * 
     */
    public function getMyOrderStatusCount($user_id, $status = 3) {
        $where = ' where user_id=' . $user_id;
        if ($status != 3) {
            $where.=' and order_status =' . $status;
        }
        $sql = 'SELECT COUNT(id) AS total_count FROM db_order' . $where;
        $query = $this->db->query($sql);
        return $query->row();
    }

    /**
     * 
     * @todo 获取我的订单总条数
     * 
     * @param $search 查询条件 
     * 
     * @return 返回一个int类型的整数
     * 
     */
    public function getMyOrderCount($search) {
        $where = ' where user_id=' . $search['user_id'];
        if (isset($search['status'])) {
            $where.=' and order_status=' . $search['status'];
        }
        $sql = 'select id from db_order' . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     * 
     * @todo 获取我的订单列表
     * 
     * @param $search 查询条件 
     * 
     * @return 返回一个object类型的整数
     * 
     */
    public function getMyOrderList($search) {
        $where = ' where a.user_id=' . $search['user_id'];
        if (isset($search['status'])) {
            $where.=' and a.order_status=' . $search['status'];
        }
        $sql = 'select a.*,b.product_name from db_order as a left join db_product as b on a.product_id=b.id' . $where . ' order by a.post_time desc limit ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 获取我的预约订单总条数
     * 
     * @param $search 查询条件
     * 
     * @return 返回一个int类型的整数 
     * 
     */
    public function getMyBookOrderCount($search) {
        $sql = 'select id from db_product_order where uid=?';
        $query = $this->db->query($sql, array($search['user_id']));
        return $query->num_rows();
    }

    /**
     * 
     * @todo 获取我的预约订单列表 
     * 
     * @param $search 查询条件
     * 
     * @return  返回一个object类型的结果
     * 
     */
    public function getMyBookOrderList($search) {
        $sql = 'select a.*,b.product_name,b.month,b.interest_area,b.tender_area,b.pay_way from db_product_order as a left join db_product as b on a.pid=b.id order by a.id desc limit ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 获取我的个人资料
     * 
     * @param $user_id 查询条件
     * 
     * @return 返回一个object结果 
     * 
     */
    public function getMyInfo($user_id) {
        $this->db->where(array('user_id' => $user_id));
        $query = $this->db->get('db_member_info');
        return $query->row();
    }

    /**
     * 
     * @todo 获取用户佣金发放记录总条数，和总和
     * 
     * @param $user_id 用户ID
     * 
     * @return 返回一个object类型的结果 
     * 
     */
    public function getMyTenderLogTotal($user_id) {
        $sql = 'select COUNT(id) as total_count,SUM(money) as total_money from db_member_account_log where type="order" and uid=' . $user_id;
        $query = $this->db->query($sql);
        return $query->row();
    }

    /**
     *
     * 
     * @todo 保存合同申请
     * 
     * @param $data 要保存的数据 
     * 
     * return 返回一个int类型的整数
     * 
     */
    public function saveContractData($data) {
        $this->db->insert('db_product_contract', $data);
        return $this->db->insert_id();
    }

    /**
     * 
     * @todo 获取我的申请列表 
     * 
     * @param $search
     * 
     * @return 返回一个object类型的结果集
     * 
     */
    public function getMyContractList($id) {
        $sql = "SELECT a.*,b.id,b.product_name FROM db_product_contract as a left join db_product as b on b.id = a.pid where a.user_id = '$id'";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    /**
     *
     * 获取合同数量 
     *
     * $search
     *
     * 返回一个结果集
     *
     */
    public function getListCount($search) {
        $this->db->where(array('user_id' => $search['id']));
        $query = $this->db->get('db_product_contract');
        return $query->num_rows();
    }
    
    /**
     *
     * 获取订单
     *
     * $id
     *
     * 返回一个结果集
     *
     */
    public function getOrdeCount($id) {
        $this->db->where(array('user_id' =>$id));
        $query = $this->db->get('db_order');
        return $query->num_rows();
    }
    
    /**
     *
     * 获取预约订单
     *
     * $id
     *
     * 返回一个结果集
     *
     */
    public function getOrderCount($id) {
        $this->db->where(array('uid' =>$id));
        $query = $this->db->get('db_product_order');
        return $query->num_rows();
    }

}
