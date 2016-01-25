<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_database
 *
 * @createtime 2015-6-23 14:30:37
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_database
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_database extends Admin_Controller {

    //put your code here
    /**
     * 
     * @todo 构造方法 
     * 
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_database_model');
    }

    /**
     * 
     * @todo 获取数据库表
     * 
     */
    public function index() {
        $tables = $this->admin_database_model->getTableList();
        $data['list'] = $tables;
        $this->load->view('admin/database/list', $data);
    }

    /**
     * 
     * @todo 查看标字段列表 
     * 
     */
    public function detial() {
        $table = $this->uri->segment(3);
        $column = $this->admin_database_model->getTableColumns($table);
        if (empty($column)) {
            echo "表名称错误，初始化数据失败！";
            exit;
        }
        $data['list'] = $column;
        $this->load->view('admin/database/detial', $data);
    }

}
