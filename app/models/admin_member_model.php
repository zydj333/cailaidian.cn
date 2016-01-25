<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class admin_member_model extends CI_Model {

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
        $sql = "select id from db_member where is_del = 0 and ischeck = 1" . $where;
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
        $sql = "select a.*,b.truename,b.head_ico from db_member as a left join db_member_info as b on a.id=b.user_id where a.is_del = 0 and ischeck = 1" . $where . " order by a.id desc limit " . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     *
     * 根据ID获取用户详情
     *
     * $id 要获取的数据ID
     *
     * 返回一个结果集
     *
     */
    public function getMemberInfo($id) {
        $sql = "select * from db_member left join db_member_info on db_member.id = db_member_info.user_id where db_member.id = '$id'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     *
     * 根据ID获取用户详情
     *
     * $id 要获取的数据ID
     *
     * 返回一个结果集
     *
     */
    public function getCardInfo($id) {
        $sql = "SELECT a . * , b.truename FROM `db_member` AS a LEFT JOIN `db_member_info` AS b ON b.user_id = (SELECT id FROM db_member WHERE account = a.cardno ) where a.id = '$id';";
        $query = $this->db->query($sql);
        return $query->result();
    }

}
