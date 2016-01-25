<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of phone_code_model
 *
 * @createtime 2015-7-3 12:12:40
 * 
 * @author ZhangPing'an
 * 
 * @todo phone_code_model
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class phone_code_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
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
     * @todo 保存手机验证码
     * 
     * @data 要保存的数据
     * 
     * @return 返回一个int类型的整数 
     * 
     */
    public function saveCode($data) {
        $this->db->insert('db_phonecode', $data);
        return $this->db->insert_id();
    }

}
