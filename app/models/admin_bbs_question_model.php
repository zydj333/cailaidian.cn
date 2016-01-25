<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class admin_bbs_question_model extends CI_Model {
    
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
        if (isset($search['title'])) {
            $where.=" and title like '%" . $search['title'] . "%'";
        }
        if (isset($search['questions'])) {
            $where.=" and questions like '%" . $search['questions'] . "%'";
        }
        if (isset($search['user_name'])) {
            $where.=" and user_name like '%" . $search['user_name'] . "%'";
        }
        $sql = "select id from db_bbs_question where is_del = 0" . $where;
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
        if (isset($search['title'])) {
            $where.=" and title like '%" . $search['title'] . "%'";
        }
        if (isset($search['questions'])) {
            $where.=" and questions like '%" . $search['questions'] . "%'";
        }
        if (isset($search['user_name'])) {
            $where.=" and user_name like '%" . $search['user_name'] . "%'";
        }
        $sql = "SELECT * from db_bbs_question where is_del = 0 " . $where . " order by id desc limit " . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    /**
     *
     * 根据ID获取详情
     *
     * $id 要获取的数据ID
     *
     * 返回一个结果集
     *
     */
    public function getQuestionInfo($id) {
        $sql = "SELECT * from db_bbs_question_repay where is_del = 0 and qid = '$id'";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    /**
     * 
     * @todo 获取问题详情
     * 
     * @param $id 问题ID
     * 
     * @return 返回一个object类型的结果 
     * 
     */
    public function getQuestionDetial($id) {
        $this->db->where(array('id' => $id, 'is_del' => 0));
        $query = $this->db->get('db_bbs_question');
        return $query->row();
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
    
    /**
     *
     * 后台回复信息
     *
     * $data 要保存的数据信息
     *
     * 返回一个int类型的结果
     *
     */
    public function saveQuestion($data) {
        $this->db->insert('db_bbs_question_repay', $data);
        return $this->db->insert_id();
    }
    
    /**
     * 
     * @todo 检查回复是否已经存在
     * 
     * @param $data 要坚持的数据
     * 
     * @return 返回boolean类型的结果 
     * 
     */
    public function checkQuestionAnswerIsSet($data) {
        $this->db->where(array('qid' => $data['qid'], 'content' => $data['content'], 'user_id' => $data['user_id']));
        $query = $this->db->get('db_bbs_question_repay');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 
     * @todo 保存问题信息的修改
     * 
     * @param $data 要修改的数据
     * 
     * @param $qid 问题ID
     * 
     * @return 返回一个真假类型的结果 
     * 
     */
    public function saveQuestionEdit($data, $qid) {
        return $this->db->update('db_bbs_question', $data, array('id' => $qid));
    }
}
?>