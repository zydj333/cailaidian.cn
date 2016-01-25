<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login_model
 *
 * @createtime 2015-7-3 17:09:59
 * 
 * @author ZhangPing'an
 * 
 * @todo login_model
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class login_model extends CI_Model {
    //put your code here
     public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo  获取用户信息
     * 
     * @param $account 用户手机号
     * 
     * @return 返回一条用户信息
     * 
     */
    public function getUserinfo($account) {
        $this->db->where(array('account' => $account));
        $query = $this->db->get('db_member');
        return $query->row();
    }
}
