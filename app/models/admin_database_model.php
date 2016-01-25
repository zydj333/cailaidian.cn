<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_database_model
 *
 * @createtime 2015-6-23 14:35:06
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_database_model
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_database_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 获取数据库表结构 
     * 
     */
    public function getTableList() {
        $sql = "select TABLE_NAME,TABLE_TYPE,ENGINE,DATA_LENGTH,DATA_FREE,CREATE_TIME,TABLE_COLLATION,TABLE_COMMENT from information_schema.tables where table_schema='cailaidian'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 根据表明获取字段列表
     * 
     * @param $table_name 表名
     * 
     * @return 返回一个结果集 
     * 
     */
    public function getTableColumns($table_name) {
        $sql = "select COLUMN_NAME,DATA_TYPE,COLUMN_TYPE,COLUMN_COMMENT from information_schema.columns where table_schema='cailaidian' and table_name='" . $table_name . "'";
        $query = $this->db->query($sql);
        return $query->result();
    }

}
