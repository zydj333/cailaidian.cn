<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_user_model
 *
 * @createtime 2015-6-17 8:41:02
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_user_model
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_user_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 获取后台用户列表 
     * 
     * @return 返回一个object的结果集
     * 
     */
    public function getUserList() {
        $this->db->where(array('is_del' => 0));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('db_adminuser');
        return $query->result();
    }

    /**
     * 
     * @todo 检查添加的用户是否已经存在
     * 
     * @param $dta 要添加的数据
     * 
     * @return 返回一个boolean类型的结果 
     * 
     */
    public function checkUserIsDefind($data) {
        $this->db->where(array('account' => $data['account'], 'is_del' => $data['is_del']));
        $query = $this->db->get('db_adminuser');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @todo 添加用户信息
     * 
     * @param $data 要添加的数据
     * 
     * @return 返回一个int类型的整数 
     * 
     */
    public function saveUserData($data) {
        $this->db->insert('db_adminuser', $data);
        return $this->db->insert_id();
    }

    /**
     * 
     * @todo 获取单一用户信息
     *  
     * @param $uid 要获取的用户ID
     * 
     * @return 返回一个结果集
     * 
     */
    public function getUserInfoByUid($uid) {
        $this->db->where(array('id' => $uid, 'is_del' => 0));
        $query = $this->db->get('db_adminuser');
        return $query->row();
    }

    /**
     * 
     * @todo 修改用户信息
     * 
     * @param $data 要修改的数据
     * 
     * @param $uid 要修改的用户ID
     * 
     * @return 返回一个boolean类型的结果 
     * 
     */
    public function editUserData($data, $uid) {
        return $this->db->update('db_adminuser', $data, array('id' => $uid));
    }

    /**
     * 
     * @todo 根据用户ID和原始密码检查原始密码是否正确
     * 
     * @param $uid 用户ID 
     * 
     * @param $password 登录密码
     * 
     * @return 返回真假类型的结果 boolean
     * 
     */
    public function checkPasswordIsDefind($uid, $password) {
        $this->db->where(array('id' => $uid, 'password' => $password));
        $query = $this->db->get('db_adminuser');
        $row = $query->num_rows();
        if($row>0){
            return true;
        }else{
            return false;
        }
    }

}
