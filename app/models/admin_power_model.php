<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_power_model
 *
 * @createtime 2015-6-17 9:56:29
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_power_model
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_power_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 获取权限列表
     * 
     * @return 返回一个结果集 
     * 
     */
    public function getPowerList() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('db_power');
        return $query->result();
    }

    /**
     * 
     * @todo 保存权限信息
     *  
     * @param $data 数据
     * 
     * @return 返回一个int类型的整数
     * 
     */
    public function savePowerData($data) {
        $this->db->insert('db_power', $data);
        return $this->db->insert_id();
    }

    /**
     *
     *  @todo 获取权限信息 
     * 
     * @param $id 权限ID
     * 
     * @return 返回一个object类型的结果
     * 
     */
    public function getPowerById($id) {
        $this->db->where(array('id' => $id));
        $query = $this->db->get('db_power');
        return $query->row();
    }

    /**
     * 
     * @todo 保存权限修改
     * 
     * @param $data 要修改的数据
     * 
     * @param $id 权限ID
     * 
     * @return 返回一个boolean类型的结果 
     * 
     */
    public function editPowerData($data, $id) {
        return $this->db->update('db_power', $data, array('id' => $id));
    }

    /**
     * 
     * @todo 删除权限 
     * 
     * @param $id 权限ID
     * 
     * @return 返回一个boolean类型的结果
     * 
     */
    public function delPowerById($id) {
        return $this->db->delete('db_power', array('id' => $id));
    }

}
