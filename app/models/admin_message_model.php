<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class admin_message_model extends CI_Model {

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
    public function getMessageCount($search) {
        $where = '';
        if (isset($search['phonenumber'])) {
            $where.=" and phonenumber = '" . $search['phonenumber'] . "'";
        }
        if (isset($search['status'])) {
            $where.=" and status = '" . $search['status'] . "'";
        }
        $sql = 'select id from db_phonecode where 1=1' . $where;
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
    public function getMessageList($search) {
        $where = '';
        if (isset($search['phonenumber'])) {
            $where.=' and phonenumber="' . $search['phonenumber'] . '"';
        }
        if (isset($search['status'])) {
            $where.=' and status=' . $search['status'];
        }
        $sql = 'select * from db_phonecode where 1=1' . $where . ' order by createtime desc limit ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    /**
     * 
     * 修改验证码信息
     * 
     * $id 验证码ID
     * 
     * $data 要修改的信息
     * 
     * 返回一个真假类型的结果 
     * 
     */
    public function editMessageById($data,$id){
        return $this->db->update('db_phonecode', $data, array('id' => $id));
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
        return $this->db->delete('db_phonecode', array('id' => $id));
    }

}

?>
