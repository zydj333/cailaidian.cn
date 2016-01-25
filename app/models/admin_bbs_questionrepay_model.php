<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class admin_bbs_questionrepay_model extends CI_Model {
    
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * 
     * todo  获取总条数
     * 
     * param $search 查询条件
     * 
     * return 返回一个int类型的整数
     * 
     */
    public function getQuestionCount($search) {
        $where = '';
        if (isset($search['qtitle'])) {
            $where.=" and qtitle like '%" . $search['qtitle'] . "%'";
        }
        if (isset($search['content'])) {
            $where.=" and content like '%" . $search['content'] . "%'";
        }
        if (isset($search['username'])) {
            $where.=" and username like '%" . $search['username'] . "%'";
        }
        $sql = "select id from db_bbs_question_repay where is_del = 0" . $where;
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
    public function getQuestionList($search) {
        $where = '';
        if (isset($search['qtitle'])) {
            $where.=" and qtitle like '%" . $search['qtitle'] . "%'";
        }
        if (isset($search['content'])) {
            $where.=" and content like '%" . $search['content'] . "%'";
        }
        if (isset($search['username'])) {
            $where.=" and username like '%" . $search['username'] . "%'";
        }
        $sql = "SELECT * from db_bbs_question_repay where is_del = 0 " . $where . " order by id desc limit " . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    /**
     * 
     * 删除
     * 
     * $id 文章ID
     * 
     * 返回一个boolean类型的结果
     * 
     */
    public function delQuestionById($id) {
        return $this->db->delete('db_bbs_question_repay', array('id' => $id));
    }
}
?>