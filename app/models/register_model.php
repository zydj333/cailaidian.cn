<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class register_model extends CI_Model {
    /**
     * 
     *构造方法 
     * 
     */
    public function __construct() {
        parent::__construct();
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
     * 获取用户手机号码检查手机号码是否存在 
     * 
     * $phone 用户手机号码
     * 
     * 返回一个boolean类型的结果
     * 
     */
    public function checkPhone($phone) {
        $this->db->where(array('account' => $phone));
        $query = $this->db->get('db_member');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * 
     * @todo 执行用户的添加操作
     * 
     * @param $data 要添加的数据
     * 
     * @return  返回插入的ID 
     * 
     */
    public function saveMemberAccount($data) {
        $this->db->insert('db_member', $data);
        return $this->db->insert_id();
    }

    /**
     * 
     * @todo 添加用户操作
     * 
     * @param $data 要添加的数据
     * 
     * @return  返回插入的ID 
     * 
     */
    public function saveMemberInfo($data) {
        $this->db->insert('db_member_info', $data);
        return $this->db->insert_id();
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
     * @todo 修改用户密码,根据手机号码进行修改 
     * 
     * @param $data 要修改的数据 
     * 
     * @param $phone 手机号码
     * 
     * @return 返回一个boolean类型的结果
     * 
     */
    public function editMemberLoginPassword($data, $phone) {
        return $this->db->update('db_member', $data, array('account' => $phone));
    }
    
    /**
     * 
     * @todo 读取用户信息 
     * 
     * @param $phone 手机号码
     * 
     * @return 返回一个结果集
     * 
     */
    public function getMemberInfo($phone) {
        $this->db->where(array('account' => $phone));
        $query = $this->db->get('db_member');
        return $query->result();
    }
}