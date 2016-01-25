<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of launch_model  上传产品模型
 *
 * @createtime 2015-7-17 15:33:20
 * 
 * @author ZhangPing'an
 * 
 * @todo launch_model
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class launch_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 保存上传项目
     * 
     * @param $data 要保存的数据
     * 
     * @return 返回一个int类型的整数 
     * 
     */
    public function saveProductData($data) {
        $this->db->insert('db_member_product', $data);
        return $this->db->insert_id();
    }

}
