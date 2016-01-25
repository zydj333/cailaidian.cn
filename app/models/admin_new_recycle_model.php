<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class admin_new_recycle_model extends CI_Model {
    
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    /**
     *
     * 获取已删除文章列表
     *
     * 返回一个结果集
     *
     */
     public function getNewCount($search) {
        $where = '';
        if (isset($search['title'])) {
            $where.=" and title like '%" . $search['title'] . "%'";
        }
        if (isset($search['search_name'])) {
            $where.=" and search_name= '" . $search['search_name'] . "'";
        }
        if (isset($search['ac_id'])) {
            $where.=" and ac_id= " . $search['ac_id'];
        }
        $sql = "select ac_id from db_article where sts = 1" . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    /**
     *
     * todo 获取数据列表
     *
     * param $search 查询条件
     *
     * return 返回一个结果集
     *
     */
    public function getNewList($search) {
        $where = '';
        if (isset($search['title'])) {
            $where.=" and a.title like '%" . $search['title'] . "%'";
        }
        if (isset($search['search_name'])) {
            $where.=" and a.search_name= '" . $search['search_name'] . "'";
        }
        if (isset($search['ac_id'])) {
            $where.=" and a.ac_id= " . $search['ac_id'];
        }
        $sql = "select a.*,b.name as typename from db_article as a left join db_article_category as b on a.ac_id=b.ac_id where a.sts = 1 " . $where . " order by a.id desc limit " . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    /**
     *
     * 还原文章信息
     *
     * $data 要还原的数据
     *
     * $id 要还原的文章ID
     *
     * 返回真假类型的结果
     *
     */
    public function editNewRec($data, $id) {
        return $row = $this->db->update('db_article', $data, array('id' => $id));
    }
}