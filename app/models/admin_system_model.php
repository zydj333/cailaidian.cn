<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_system_model
 *
 * @createtime 2015-6-16 15:27:50
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_system_model
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_system_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 获取系统控制列表
     * 
     * @param $param 父级ID
     * 
     * @return 返回一个对象结果集 
     * 
     */
    public function getSystemList($param = 0) {
        $this->db->where(array('pid' => $param));
        $this->db->order_by('salt', 'desc');
        $query = $this->db->get('db_system');
        return $query->result();
    }

    /**
     * 
     * @todo 检查信息是否已经存在 
     * 
     * @param $data 要检查的数据
     * 
     * @return  返回一个boolean类型的结果
     * 
     */
    public function checkSystemIsDefind($data) {
        $this->db->where(array('pid' => $data['pid'], 'controllers' => $data['controllers'], 'actions' => $data['actions']));
        $query = $this->db->get('db_system');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @todo 保存数据 
     * 
     * @param $data 要保持的数据
     *  
     * @return 返回一个int类型的结果
     * 
     */
    public function saveSystem($data) {
        $this->db->insert('db_system', $data);
        return $this->db->insert_id();
    }

    /**
     * 
     * @todo 获取模块初始化信息 
     * 
     * @param $id 模块ID
     * 
     * @return 返回一个结果集
     * 
     */
    public function getSystemById($id) {
        $this->db->where(array('id' => $id));
        $query = $this->db->get('db_system');
        return $query->row();
    }
    
    
    /**
     * 
     * @todo 修改数据
     * 
     * @param $data 要修改的数据
     * 
     * @param $id 被修改的数据ID
     * 
     * @return 返回一个boolean类型的结果 
     * 
     */
    public function saveSystemEdit($data,$id){
        return $this->db->update('db_system',$data,array('id'=>$id));
    }

}
