<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class admin_point_type_model extends CI_Model {

//put your code here
    public function __construct() {
        parent::__construct();
    }
    /*
     *获取商品类别
     */
    public function getPointCategory(){
        $this->db->where(array('status'=>0));
        $this->db->order_by('listorder');
        $result = $this->db->get('db_point_type');
        return $result->result();
    }
    
    /**
     *
     * 保存商品分类
     *
     * $data 要保存的数据
     *
     * 返回一个int类型的结果
     *
     */
    public function savePointType($data){
        $this->db->insert('db_point_type', $data);
        return $this->db->insert_id();
    }
    
    /**
     *
     * 根据ID获取商品分类信息
     *
     * $id 资讯分类ID
     *
     * 返回一个结果集
     *
     */
    public function getPointTypeInfoById($id){
        $this->db->where(array('id'=>$id));
        $query=$this->db->get('db_point_type');
        return $query->row();
    }
    
    /**
     *
     * 根据ID修改分类信息
     *
     * $id 要修改的数据
     *
     * $data 修改成的数据
     *
     *  返回一个真假类型的结果
     *
     */
    public function saveTypeEdit($data,$id){
         return $row = $this->db->update('db_point_type', $data, array('id' => $id));
    }
    
    /**
     *
     * 根据ID删除分类信息
     *
     * $id 要删除的数据ID
     * 
     * $data 修改成的数据
     *
     * 返回真假类型的结果
     *
     */
    public function delPointTypeById($data,$id){
        return $this->db->update('db_point_type', $data, array('id' => $id));
    }
    
    /**
     * 
     * @todo 获取系统控制列表
     * 
     * @param $param 父级ID
     * 
     * @return 返回一个对象结果集 
     * 
     */
    public function getTypeList($param = 0) {
        $this->db->where(array('parent_id' => $param,'status' => 0));
        $this->db->order_by('listorder', 'desc');
        $query = $this->db->get('db_point_type');
        return $query->result();
    }
    
    /**
     * 
     * @todo 检查信息是否已经存在 
     * 
     * @param $data 要检查的数据
     * 
     * @return  返回一个boolean类型的结果
     * 
     */
    public function checkTypeIsDefind($data) {
        $this->db->where(array('parent_id' => $data['parent_id'], 'name' => $data['name']));
        $query = $this->db->get('db_point_type');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 
     * @todo 保存数据 
     * 
     * @param $data 要保持的数据
     *  
     * @return 返回一个int类型的结果
     * 
     */
    public function saveType($data) {
        $this->db->insert('db_point_type', $data);
        return $this->db->insert_id();
    }
    
    /**
     * 
     * @todo 获取分类信息
     * 
     * @param $id 模块ID
     * 
     * @return 返回一个结果集
     * 
     */
    public function getTypeById($id) {
        $this->db->where(array('id' => $id));
        $query = $this->db->get('db_point_type');
        return $query->row();
    }
}