<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_setpower_model
 *
 * @createtime 2015-6-17 12:32:25
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_setpower_model
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_setpower_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 获取用户权限及列表
     * 
     * @return 返回一个object类型的结果集 
     * 
     */
    public function getUserPowerList() {
        $sql = 'select a.*,b.powername from db_adminuser as a left join db_power as b on a.power=b.id where a.is_del=0 order by a.id desc';
        $query = $this->db->query($sql);
        return $query->result();
    }

}
