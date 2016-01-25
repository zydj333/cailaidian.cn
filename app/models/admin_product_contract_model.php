<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_product_contract_model
 *
 * @createtime 2015-7-17 11:41:41
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_product_contract_model
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_product_contract_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 获取合同申请总条数
     * 
     * @param $search 查询条件
     * 
     * @return 返回一个int类型的整数 
     * 
     */
    public function getProductContractCount($search) {
        $where = ' where 1=1';
        if (isset($search['celphone'])) {
            $where.=' and celphone="' . $search['celphone'] . '"';
        }
        if (isset($search['username'])) {
            $where.=' and username="' . $search['username'] . '"';
        }
        if (isset($search['status'])) {
            $where.=' and status=' . $search['status'];
        }
        $sql = 'select id from db_product_contract' . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     * 
     * @todo 获取合同列表
     * 
     * @param $search 查询条件
     * 
     * @return 返回一个object类型的结果集 
     * 
     */
    public function getProductContractList($search) {
        $where = ' where 1=1';
        if (isset($search['celphone'])) {
            $where.=' and a.celphone="' . $search['celphone'] . '"';
        }
        if (isset($search['username'])) {
            $where.=' and a.username="' . $search['username'] . '"';
        }
        if (isset($search['status'])) {
            $where.=' and a.status=' . $search['status'];
        }
        $sql = 'select a.*,b.product_name from db_product_contract as a left join db_product as b on a.pid=b.id order by a.id desc limit ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 修改合同申请状态
     * 
     * @param $data 要修改的数据
     * 
     * @param $id 要修改的数据ID
     * 
     * @return 返回一个boolean类型的结果 
     * 
     */
    public function editContractData($data, $id) {
        return $this->db->update('db_product_contract', $data, array('id' => $id));
    }

}
