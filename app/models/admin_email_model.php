<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class admin_email_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * 获取短信总条数
     * 
     * $search 查询条件 
     * 
     * 返回一个INT类型的整数
     * 
     */
    public function getEmailCount($search) {
        $where = '';
        if (isset($search['email'])) {
            $where.=" and email = '" . $search['email'] . "'";
        }
        if (isset($search['status'])) {
            $where.=" and status = '" . $search['status'] . "'";
        }
        $sql = 'select id from db_email where 1=1' . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     * 
     * 获取短信列表
     * 
     * $search 查询条件
     * 
     * 返回一个结果集
     *  
     * 
     */
    public function getEmailList($search) {
        $where = '';
        if (isset($search['email'])) {
            $where.=' and email="' . $search['email'] . '"';
        }
        if (isset($search['status'])) {
            $where.=' and status=' . $search['status'];
        }
        $sql = 'select * from db_email where 1=1' . $where . ' order by id desc limit ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    /**
     *
     * 根据ID获取详情
     *
     * $id 要获取的数据ID
     *
     * 返回一个结果集
     *
     */
    public function getEmailInfo($id) {
        $this->db->where(array('id' => $id));
        $query = $this->db->get('db_email');
        return $query->row();
    } 
    
    /**
     * 
     * 删除验证码信息
     * 
     * $id 要删除的数据ID
     * 
     * 返回一个int类型的结果 
     * 
     */
    public function delMessageById($id){
        return $this->db->delete('db_email', array('id' => $id));
    }

}

?>
