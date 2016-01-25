<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class admin_member_recommend_model extends CI_Model {
    /**
     *
     * 获取用户详情
     *
     * $search 查询条件
     * 
     * 返回一个结果集
     *
     */
    public function getCardInfo($search) {
        $where = '';
        if (isset($search['account'])) {
            $where.=" where account like '%" . $search['account'] . "%'";
        }
        if (isset($search['cardno'])) {
            $where.=" where cardno =" . $search['cardno'];
        }
        $sql = "SELECT a .id,a.account,a.cardno,a.is_del,b.truename FROM `db_member` AS a LEFT JOIN `db_member_info` AS b ON b.user_id = (SELECT id FROM db_member WHERE account = a.cardno )".$where. " order by a.id desc limit " . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
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
            $where.=" where account like '%" . $search['account'] . "%'";
        }
        if (isset($search['cardno'])) {
            $where.=" where cardno like '%" . $search['cardno'] . "%'";
        }
        $sql = "select id from db_member " . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
}