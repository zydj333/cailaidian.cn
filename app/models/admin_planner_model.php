<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_planner_model
 *
 * @createtime 2015-7-21 10:21:22
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_planner_model
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_planner_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 根据条件获取理财师总条数 
     * 
     * @param $search 查询数据条件
     * 
     * @return 返回一个int类型的整数
     * 
     */
    public function getPlannerCount($search) {
        $where = ' where 1=1';
        if (isset($search['cellphone'])) {
            $where.=' and a.phone="' . $search['cellphone'] . '"';
        }
        if (isset($search['username'])) {
            $where.=' and b.truename="' . $search['username'] . '"';
        }
        if (isset($search['province'])) {
            $where.=' and b.province_id=' . $search['province'];
        }
        $sql = 'select a.id from db_member as a left join db_member_info as b on a.id=b.user_id left join db_area as c on b.province_id=c.id' . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     * 
     * @todo 根据条件获取理财师列表
     * 
     * @param $search 查询条件
     * 
     * @return 返回一个object类型的整数 
     * 
     */
    public function getPlannerList($search) {
        $where = ' where 1=1';
        if (isset($search['cellphone'])) {
            $where.=' and a.phone="' . $search['cellphone'] . '"';
        }
        if (isset($search['username'])) {
            $where.=' and b.truename="' . $search['username'] . '"';
        }
        if (isset($search['province'])) {
            $where.=' and b.province_id=' . $search['province'];
        }
        $sql = 'select a.account,a.phone,b.*,c.name as province_name from db_member as a left join db_member_info as b on a.id=b.user_id left join db_area as c on b.province_id=c.id' . $where . ' order by points desc limit ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 获取用户基本信息
     * 
     * @param $uid 用户ID
     * 
     * @return 返回一个object类型的结果
     * 
     */
    public function getMemberLoginList($uid) {
        $this->db->where(array('id' => $uid));
        $query = $this->db->get('db_member');
        return $query->row();
    }

    /**
     *
     * @todo 获取用户详细信息
     * 
     * @param $uid 用户ID
     * 
     * @return 返回一个object类型的结果 
     * 
     */
    public function getMemberInfo($uid) {
        $this->db->where(array('user_id' => $uid));
        $query = $this->db->get('db_member_info');
        return $query->row();
    }

    /**
     *
     * @todo 获取用户的项目列表 
     * 
     * @param $uid 用户ID
     * 
     * @return 返回一个object类型的结果
     */
    public function getMemberProductList($uid) {
        $this->db->where(array('user_id' => $uid));
        $this->db->order_by('createtime', 'desc');
        $query = $this->db->get('db_member_product');
        return $query->result();
    }

}
