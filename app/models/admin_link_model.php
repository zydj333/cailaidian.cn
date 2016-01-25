<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class admin_link_model extends CI_Model {
    
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * 
     * @todo 获取友链列表
     * 
     * @return 返回一个结果集 
     * 
     */
    public function getList() {
        $query = $this->db->get('db_link');
        return $query->result();
    }
    
    /**
     *
     *  @todo 获取友链列表 
     * 
     * @param $id ID
     * 
     * @return 返回一个object类型的结果
     * 
     */
    public function getListById($id) {
        $this->db->where(array('id' => $id));
        $query = $this->db->get('db_link');
        return $query->row();
    }
    
    
    /**
     * 
     * @todo 保存友链信息
     *  
     * @param $data 数据
     * 
     * @return 返回一个int类型的整数
     * 
     */
    public function saveListData($data) {
        $this->db->insert('db_link', $data);
        return $this->db->insert_id();
    }
    
    /**
     * 
     * @todo 友链修改
     * 
     * @param $data 要修改的数据
     * 
     * @param $id ID
     * 
     * @return 返回一个boolean类型的结果 
     * 
     */
    public function editLinkData($data, $id) {
        return $this->db->update('db_link', $data, array('id' => $id));
    }
    
    /**
     * 
     * @todo 删除友链 
     * 
     * @param $id ID
     * 
     * @return 返回一个boolean类型的结果
     * 
     */
    public function delLinkById($id) {
        return $this->db->delete('db_link', array('id' => $id));
    }
}
/*
 * 
 *
 * 
 */