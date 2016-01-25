<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class mysetting_model extends CI_Model {

//put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 保存用户的头像信息
     * 
     * @param $data 要保存的数据
     * 
     * @param $uid 用户ID
     * 
     * @return 返回boolean类型的结果
     * 
     */
    public function saveMemberEdit($data, $uid) {
        return $this->db->update('db_member_info', $data, array('user_id' => $uid));
    }
}