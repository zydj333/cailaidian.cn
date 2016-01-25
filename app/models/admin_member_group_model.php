<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class admin_member_group_model extends CI_Model {
    
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * 
     * 获取用户分组列表 
     * 
     * 返回一个object的结果集
     * 
     */
    public function getGroupList() {
        $this->db->order_by('listorder', 'desc');
        $query = $this->db->get('db_member_group');
        return $query->result();
    }
    
    /**
     *
     * 根据ID获取分组列表 
     * 
     * $id ID
     * 
     * 返回一个object类型的结果
     * 
     */
    public function getGroupById($id) {
        $this->db->where(array('id' => $id));
        $query = $this->db->get('db_member_group');
        return $query->row();
    }
    
    
    /**
     * 
     * 保存分组信息
     *  
     *  $data 数据
     * 
     * 返回一个int类型的整数
     * 
     */
    public function saveGroupData($data) {
        $this->db->insert('db_member_group', $data);
        return $this->db->insert_id();
    }
    
    /**
     * 
     * 分组修改
     * 
     * $data 要修改的数据
     * 
     * $id ID
     * 
     *n 返回一个boolean类型的结果 
     * 
     */
    public function editGroupData($data, $id) {
        return $this->db->update('db_member_group', $data, array('id' => $id));
    }
    
    /**
     * 
     * 删除分组
     * 
     * $id 要删除数据的ID
     * 
     * 返回一个boolean类型的结果
     * 
     */
    public function delGroupById($id) {
        return $this->db->delete('db_member_group', array('id' => $id));
    }
}