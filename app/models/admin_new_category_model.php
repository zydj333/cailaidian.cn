<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class admin_new_category_model extends CI_Model {

//put your code here
    public function __construct() {
        parent::__construct();
    }
    /*
     *获取文章类别
     */
    public function getNewCategory(){
        $this->db->order_by('listorder');
        $result = $this->db->get('db_article_category');
        return $result->result();
    }
    
    /**
     *
     * 保存资讯分类
     *
     * $data 要保存的数据
     *
     * 返回一个int类型的结果
     *
     */
    public function saveNewType($data){
        $this->db->insert('db_article_category', $data);
        return $this->db->insert_id();
    }
    
    /**
     *
     * 根据ID获取资讯分类信息
     *
     * $id 资讯分类ID
     *
     * 返回一个结果集
     *
     */
    public function getNewTypeInfoById($id){
         $this->db->where(array('ac_id'=>$id));
        $query=$this->db->get('db_article_category');
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
    public function saveNewTypeEdit($data,$id){
         return $row = $this->db->update('db_article_category', $data, array('ac_id' => $id));
    }
    
    /**
     *
     * 根据ID删除分类信息
     *
     * $id 要删除的数据ID
     *
     * 返回真假类型的结果
     *
     */
    public function delNewTypeById($id){
        return $this->db->delete('db_article_category', array('ac_id' => $id));
    }
}