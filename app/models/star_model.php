<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description 理财师模型
 *
 * @createtime 2015-7-17 13:52:53
 * 
 * @author ZhangPing'an
 * 
 * @todo star_model
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class star_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 根据条件获取理财师总条数
     * 
     * @param $search 查询条件
     * 
     * @return 返回一个int类型的整数
     * 
     */
    public function getStarCount($search) {
        $where = ' where c.is_del=0';
        if ($search['province'] > 0) {
            $where .= ' and a.province_id=' . $search['province'];
        }
        $sql = 'select a.id from db_member_info as a left join db_member as c on a.user_id=c.id' . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     * 
     * @todo 根据条件获取理财师列表
     *  
     * @param $search 查询条件
     * 
     * @return 返回一个object类型的结果
     * 
     */
    public function getStarList($search) {
        $where = ' where c.is_del=0';
        if ($search['province'] > 0) {
            $where .= ' and a.province_id=' . $search['province'];
        }
        if ($search['order'] == 0) {
            $order = ' order by a.head_ico desc';
        } else {
            $order = ' order by a.points desc';
        }
        $sql = 'select a.*,b.name as province_name,c.account from db_member_info as a left join db_area as b on a.province_id=b.id left join db_member as c on a.user_id=c.id' . $where . $order . ' limit ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 根据用户ID获取名称
     * 
     * @param $uid 用户ID
     * 
     * @return 返回用户名称
     * 
     */
    public function getMemberAccount($uid) {
        $sql = 'select account from db_member where id=?';
        $query = $this->db->query($sql, array($uid));
        return $query->row();
    }

    /**
     * 
     * @todo 根据用户ID获取用户详细信息
     * 
     * @param $uid 用户ID
     * 
     * @return 返回一个object 
     * 
     */
    public function getMemberInfo($uid) {
        $sql = 'select a.account,a.phone,a.email_status,b.* from db_member as a left join db_member_info as b on a.id=b.user_id where a.id=?';
        $query = $this->db->query($sql, array($uid));
        return $query->row();
    }

    /**
     * 
     * @todo 保存站内信 
     * 
     * @param $data 要保存的数据
     * 
     * @return 返回一个int类型的整数
     * 
     */
    public function saveMyLettler($data) {
        $this->db->insert('db_message', $data);
        return $this->db->insert_id();
    }

    /**
     * 
     * @todo 获取产品详情
     * 
     * @param $pid产品ID
     * 
     * @return 返回一个object类型的结果 
     * 
     */
    public function getStarProductDetial($pid) {
        $this->db->where(array('id' => $pid, 'is_del' => 0));
        $query = $this->db->get('db_member_product');
        return $query->row();
    }

}
