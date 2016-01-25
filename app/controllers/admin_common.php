<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_common
 *
 * @createtime 2015-7-6 12:50:36
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_common
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_common extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 获取城市列表 
     * 
     */
    public function getCity() {
        $pid = $this->input->post('pid') ? $this->input->post('pid') : 0;
        $list = $this->common_model->getProvinceCityArea($pid);
        $msg = array('fiag' => 0, 'error' => "");
        if (!empty($list)) {
            $msg['flag'] = 1;
            $msg['error'] = $list;
        } else {
            $msg['error'] = "父级参数丢失";
        }
        echo json_encode($msg);
        exit;
    }

}
