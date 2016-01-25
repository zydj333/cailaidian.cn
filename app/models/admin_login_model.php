<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_login_model
 *
 * @createtime 2015-6-17 13:49:28
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_login_model
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_login_model extends CI_Model {
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * 
     * @todo 获取用户信息 
     * 
     * @param $account 用户帐户
     * 
     * @param $password 用户密码
     * 
     * @return 返回一个结果集
     * 
     */
    public function getUser($account,$password){
        $sql='select a.*,b.power as power_value from db_adminuser as a left join db_power as b on a.power=b.id where a.account=? and a.password=? and a.is_del=0';
        $query=  $this->db->query($sql,array($account,$password));
        return $query->row();
    }
}
