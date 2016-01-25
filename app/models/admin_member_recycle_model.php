<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class admin_member_recycle_model extends CI_Model {
    
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * 
     *  获取用户总条数
     * 
     * $search 查询条件
     * 
     * 返回一个int类型的整数
     * 
     */
    public function getUserCount($search) {
        $where = '';
        if (isset($search['account'])) {
            $where.=" and account like '%" . $search['account'] . "%'";
        }
        $sql = "select id from db_member where is_del = 1 " . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    /**
     *
     * 获取用户列表
     *
     * $search 查询条件
     *
     * 返回一个结果集
     *
     */
    public function getUserList($search) {
        $where = '';
        if (isset($search['account'])) {
            $where.=" and account like '%" . $search['account'] . "%'";
        }
        $sql = "select a.*,b.truename from db_member as a left join db_member_info as b on a.id=b.user_id where a.is_del = 1 " . $where . " order by a.id desc limit " . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    /**
     * 
     * 还原删除
     * 
     * $id 用户ID
     * 
     * 返回一个boolean类型的结果
     * 
     */
    public function recycleMemberById($data,$id) {
        return $row = $this->db->update('db_member', $data, array('id' => $id));
    }
}