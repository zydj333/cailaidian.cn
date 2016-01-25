<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class center_account_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * 
     * 修改用户密码,根据ID进行修改 
     * 
     * $data 要修改的数据 
     * 
     * $id
     * 
     * 返回一个boolean类型的结果
     * 
     */
    public function editMemberLoginPassword($data, $id) {
        return $this->db->update('db_member', $data, array('id' => $id));
    }
    
    /*
     * 
     * 实名认证
     * 
     * $id 要认证的用户ID
     * 
     * $data 要修改的数据
     */
    public function truename($data,$id){
        return $this->db->update('db_member_info', $data, array('user_id' => $id));
    }
    
    /**
     * 
     * @todo 保存邮箱验证信息
     * 
     * @data 要保存的数据
     * 
     * @return 返回一个int类型的整数 
     * 
     */
    public function saveEmail($data) {
        $this->db->insert('db_email', $data);
        return $this->db->insert_id();
    }
    
    /**
     * 
     * @todo 保存邮箱信息
     * 
     * @id 要保存的用户ID
     * 
     * @data 要保存的数据
     * 
     * @return 返回一个布尔类型
     * 
     */
    public function updateEmail($data,$id) {
        return $this->db->update('db_member', $data, array('id' => $id));
    }
    
    /**
     * 
     * @todo 获取邮箱信息
     * 
     * @email 要获取邮箱的email
     * 
     * @return 返回一个结果集
     * 
     */
    public function getEmail($email) {
        $this->db->where(array('email' => $email,'status' => 1));
        $this->db->order_by('creattime', 'desc');
        $query = $this->db->get('db_email');
        return $query->row();
    }
    
    /**
     * 
     * @todo  获取用户详情信息
     * 
     * @param $id 
     * 
     * @return 返回一条用户信息
     * 
     */
    public function getUserinfo($id) {
        $this->db->where(array('user_id' => $id));
        $query = $this->db->get('db_member_info');
        return $query->row();
    }
    
    /**
     * 
     * @todo 添加本次登录记录
     * 
     * @param $data 要保存的数据
     * 
     * @return  返回一个自增ID
     *  
     * 
     */
    public function addThisLogin($data) {
        $this->db->insert('db_member_log', $data);
        return $this->db->insert_id();
    }
    
    /**
     * 
     * @todo 验证成功，邮箱入库
     * 
     * @data 要保存的数据
     * 
     * @id 要保存的用户ID
     * 
     * @return 返回一个布尔类型 
     * 
     */
    public function email($data,$id) {
        return $this->db->update('db_member', $data, array('id' => $id));
    }
    
    /**
     * 
     * @todo 验证成功，更改邮件状态
     * 
     * @data 要保存的数据
     * 
     * @id 要保存的用户ID
     * 
     * @return 返回一个布尔类型 
     * 
     */
    public function changeEmail($data,$id) {
        return $this->db->update('db_email', $data, array('user_id' => $id));
    }
    
    /**
     * 
     * @todo 获取用户的手机验证码
     * 
     * @param $phone 手机号
     * 
     * @param $phonecode 手机验证码
     * 
     * @return 返回一个boolean类型的结果
     * 
     */
    public function checkPhoneCode($phone, $phonecode) {
        $time = time();
        $sql = 'select id from db_phonecode where phonenumber=' . $phone . ' and phonecode=' . $phonecode . ' and (status=1 or status=0) and passtime>' . $time;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 
     * @todo 读取用户信息 
     * 
     * @param $id 用户ID
     * 
     * @return 返回一个结果集
     * 
     */
    public function getMemberInfo($id) {
        $this->db->where(array('id' => $id));
        $query = $this->db->get('db_member');
        return $query->result();
    }
    
    /**
     * 
     * @todo 修改手机验证码的状态
     * 
     * @param $data 要修改的数据
     * 
     * @param $phone 条件
     * 
     * @param $phonecode 条件
     * 
     * @return  返回真假类型的结果 
     * 
     */
    public function editPhoneCodeStatus($data, $phone, $phonecode) {
        return $this->db->update('db_phonecode', $data, array('phonenumber' => $phone, 'phonecode' => $phonecode));
    }
    
    /**
     * 
     * @todo 修改用户手机号码 
     * 
     * @param $data 要修改的数据 
     * 
     * @param $phone 手机号码
     * 
     * @return 返回一个boolean类型的结果
     * 
     */
    public function editMemberAccount($data, $phone) {
        return $this->db->update('db_member', $data, array('account' => $phone));
    }
    
    /**
     * 
     * @todo 修改用户资料
     * 
     * @param $data 要修改的数据 
     * 
     * @param $id 用户id
     * 
     * @return 返回一个boolean类型的结果
     * 
     */
    public function editMemberInfo($data, $id) {
        return $this->db->update('db_member_info', $data, array('user_id' => $id));
    }
    
    /**
     * 
     * @todo 获取省市县信息
     * 
     * @param $id 地区ID
     * 
     * @return 返回一个结果集
     * 
     */
    public function getArea($id) {
        $this->db->where(array('id' => $id));
        $query = $this->db->get('db_area');
        return $query->row();
    }
    
    /**
     * 
     * @todo 获取用户站内信数量
     * 
     * @id 站内信ID
     * 
     * @param $id 用户ID
     * 
     * @return 返回一个int
     * 
     */
    public function getMessageCount($search) {
        $sql = "select id from db_message where to_uid = " . $search['id'] . " and (status = 0 or status = 1) order by id desc";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    /**
     * 
     * @todo 获取用户站内信
     * 
     * @id 站内信ID
     * 
     * @param $id 用户ID
     * 
     * @return 返回一个int
     * 
     */
    public function getMessageList($search) {
        $sql = "select * from db_message where to_uid = " . $search['id'] . " and (status = 0 or status = 1) order by id desc limit " . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    /**
     * 
     * @todo 修改站内信状态
     * 
     * @param $to_id 用户ID
     * 
     * @param $id 站内信ID
     * 
     * @return 返回一个结果集
     * 
     */
    public function getMessageInfo($id,$to_id) {
        $this->db->where(array('id' => $id,'to_uid' => $to_id));
        $query = $this->db->get('db_message');
        return $query->row();
    }
    
    /**
     * 
     * @todo 获取站内信详情
     * 
     * @param $to_id 用户ID
     * 
     * @param $id 站内信ID
     * 
     * @return 返回一个boolean类型的结果
     * 
     */
    public function editMessage($id,$to_id) {
        return $this->db->update('db_message', array('status' => 1), array('id' => $id,'to_uid' => $to_id));
    }
    
    /**
     * 
     * @todo 删除站内信
     * 
     * @param $to_id 用户ID
     * 
     * @param $id 站内信ID
     * 
     * @return 返回一个boolean类型的结果
     * 
     */
    public function delMessage($id,$to_id) {
        return $this->db->update('db_message', array('status' => 2), array('id' => $id,'to_uid' => $to_id));
    }
}