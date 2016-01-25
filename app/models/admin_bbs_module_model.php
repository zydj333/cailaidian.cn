<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_bbs_module_model
 *
 * @createtime 2015-7-24 15:04:15
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_bbs_module_model
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_bbs_module_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 获取话题模块分类列表 
     * 
     * @param $p_id 父级ID
     * 
     * @return 返回一个object结果集
     * 
     */
    public function getBbsModuleList($p_id = 0) {
        $this->db->where(array('cate_pid' => $p_id));
        $this->db->order_by('cate_salt', 'asc');
        $query = $this->db->get('db_bbs_category');
        return $query->result();
    }

    /**
     * 
     * @todo 检查模块是否已经在数据库中存在
     * 
     * @param $data 要检查的数据
     * 
     * @return 返回一个boolean类型的结果 
     * 
     */
    public function checkModuleIsSet($data) {
        $this->db->where(array('cate_name' => $data['cate_name'], 'cate_pid' => $data['cate_pid']));
        $query = $this->db->get('db_bbs_category');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @todo 保存模块数据
     * 
     * @param $data 要保持的数据
     * 
     * @return 返回一个int类型的整数 
     * 
     */
    public function saveBbsModuleData($data) {
        $this->db->insert('db_bbs_category', $data);
        return $this->db->insert_id();
    }

    /**
     * 
     * @todo 根据ID获取模块详情
     * 
     * @param $cate_id 分类ID
     * 
     * @return 返回一个object结果 
     * 
     */
    public function getModuleDetial($cate_id) {
        $this->db->where(array('cate_id' => $cate_id));
        $query = $this->db->get('db_bbs_category');
        return $query->row();
    }

    /**
     * 
     * @todo 修改社区模块
     * 
     * @param $cate_id 分类ID
     * 
     * @param $data 要修改的数据
     * 
     * @return  返回一个boolean类型的结果 
     * 
     */
    public function editModuleData($data, $cate_id) {
        return $this->db->update('db_bbs_category', $data, array('cate_id' => $cate_id));
    }

}
