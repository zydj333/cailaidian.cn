<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of bbs_model
 *
 * @createtime 2015-7-28 10:50:05
 * 
 * @author ZhangPing'an
 * 
 * @todo bbs_model
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class bbs_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 获取资讯列表
     * 
     * @param $type 文章分类
     * 
     * @param $count 要获取的总条数
     * 
     * @return 返回一个object 类型的结果 
     * 
     */
    public function getArticleList($type, $count = 5) {
        $sql = 'select id,ac_id,search_name,title,article_time,sts,imageurl from db_article where sts=0 and ac_id=' . $type . ' order by listorder asc,article_time desc limit ' . $count;
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 获取问题列表
     * 
     * @param $count 要获取的条数
     * 
     * @return 返回一个object类型的结果集
     * 
     */
    public function getQuestionList($count = 5) {
        $sql = 'select * from db_bbs_question where is_del=0 order by create_time desc limit ' . $count;
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 获取资讯总条数
     * 
     * @param $search 查询参数
     * 
     * @return 返回一个int类型的整数
     *  
     */
    public function getArticleTotalCount() {
        $sql = ' select id from db_article where (ac_id=1 or ac_id=11) and sts=0';
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     * 
     * 
     * @todo 获取资讯列表
     * 
     * @param $search 查询参数
     * 
     * @return  返回一个object类型的结果集 
     * 
     */
    public function getArticleTotalList($search) {
        $sql = ' select * from db_article where (ac_id=1 or ac_id=11) and sts=0 order by article_time desc limit ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 根据ID获取资讯详情 
     * 
     * @param $id 资讯ID
     * 
     * @return 返回一个object类型的结果
     * 
     */
    public function getArticleDetialById($id) {
        $this->db->where(array('id' => $id, 'sts' => 0));
        $query = $this->db->get('db_article');
        return $query->row();
    }

    /**
     * 
     * @todo 根据ID修改资讯浏览次数
     * 
     * @param $id 资讯ID
     * 
     * @return 返回收到影响的行数 
     * 
     */
    public function editArticleViewTimes($id) {
        $sql = 'UPDATE db_article SET views=views+1 where id=?';
        $this->db->query($sql, array($id));
        return $this->db->affected_rows();
    }

    /**
     * 
     * @todo 获取问题总条数
     * 
     * @param $search 查询条件
     * 
     * @return 返回一个int类型的整数 
     * 
     */
    public function getQuestionTotalCount($search) {
        $sql = 'select id from db_bbs_question where is_del=0';
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     * 
     * @todo 获取问题总列表
     * 
     * @param  $search 查询条件
     * 
     * @return 返回一个object类型的结果集
     * 
     */
    public function getQuestionTotalList($search) {
        $order = 'order by id desc';
        if (isset($search['type'])) {
            $order = 'order by views desc';
        }
        $sql = 'select * from db_bbs_question where is_del=0 ' . $order . ' limit ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 获取问题详情
     * 
     * @param $qid 问题ID
     * 
     * @return 返回一个object类型的结果 
     * 
     */
    public function getQuestionDetial($qid) {
        $this->db->where(array('id' => $qid, 'is_del' => 0));
        $query = $this->db->get('db_bbs_question');
        return $query->row();
    }

    /**
     * 
     * @todo 保存回答信息 
     * 
     * @param $data 要保存的数据
     * 
     * @return 返回一个int类型的结果
     * 
     */
    public function saveQuestionAnswerData($data) {
        $this->db->insert('db_bbs_question_repay', $data);
        return $this->db->insert_id();
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
     * @todo 获取用户问题的答案列表
     * 
     * @param $qid 问题ID
     * 
     * @retirn 返回一个object列表 
     * 
     */
    public function getQuestionRepayList($qid) {
        $sql = 'select a.*,b.head_ico,c.phone from db_bbs_question_repay as a left join db_member_info as b on a.user_id=b.user_id left join db_member as c on a.user_id=c.id where a.qid=? and a.is_del=0 order by a.create_time desc';
        $query = $this->db->query($sql, array($qid));
        return $query->result();
    }

    /**
     * 
     * @todo 修改问题的查看次数
     * 
     * @param $qid 问题ID
     * 
     * @return 返回一个boolean类型的结果 
     * 
     */
    public function editQuestionViewTimes($qid) {
        $sql = 'UPDATE db_bbs_question SET views=views+1 WHERE id=?';
        $query = $this->db->query($sql, array($qid));
        return $this->db->affected_rows();
    }

    /**
     * 
     * @todo 修改问题答案的支持次数
     * 
     * @param $rid 问题ID
     * 
     * @return 返回一个boolean类型的结果 
     * 
     */
    public function editQuestionAssistTimes($rid) {
        $sql = 'UPDATE db_bbs_question_repay SET assist=assist+1 WHERE id=?';
        $query = $this->db->query($sql, array($rid));
        return $this->db->affected_rows();
    }

    /**
     * 
     *  检查支持项是否重复
     * 
     * @param $data 要坚持的数据
     * 
     * @return 返回一个真假类型的结果
     * 
     */
    public function checkQuestionRepayAssisted($data) {
        $this->db->where(array('rid' => $data['rid'], 'user_id' => $data['user_id']));
        $query = $this->db->get('db_bbs_question_assist');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @todo  保存支持记录 
     * 
     * @param $data 要保存的数据
     * 
     * @return  返回一个int类型的整数
     * 
     */
    public function saveQuestionRepayAssisted($data) {
        $this->db->insert('db_bbs_question_assist', $data);
        return $this->db->insert_id();
    }

    /**
     * 
     * @todo 检查用户已经发布了该问题
     * 
     * @param $data 要判断的数据信息
     * 
     * @return 返回一个boolean类型的结果 
     * 
     */
    public function checkQuestionIsSet($data) {
        $this->db->where(array('user_id' => $data['user_id'], 'title' => $data['title']));
        $query = $this->db->get('db_bbs_question');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @todo 保存问题
     * 
     * @param $data 要保存的数据
     * 
     * @return 返回一个int类型的整数 
     * 
     */
    public function saveQuestionDataAdd($data) {
        $this->db->insert('db_bbs_question', $data);
        return $this->db->insert_id();
    }

    /**
     * 
     * @todo 获取我的回答问题总条数
     * 
     * @param $search 查询条件
     * 
     * @return 返回一个int类型的整数
     * 
     */
    public function getMyAnswerCount($search) {
        $sql = 'select id from db_bbs_question_repay where user_id =?';
        $query = $this->db->query($sql, array($search['user_id']));
        return $query->num_rows();
    }

    /**
     * 
     * @todo 获取我的回答问题列表
     * 
     * @param $search 查询条件
     * 
     * @return 返回一个object类型的结果集 
     * 
     */
    public function getMyAnswerList($search) {
        $sql = 'select * from db_bbs_question_repay where user_id =? order by create_time desc limit ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql, array($search['user_id']));
        return $query->result();
    }

    /**
     * 
     * @todo 获取我的问题总条数
     * 
     * @param $search 查询条件
     * 
     * @return 返回一个int类型的整数 
     * 
     */
    public function getMyQuestionCount($search) {
        $sql = 'select id from db_bbs_question where user_id=?';
        $query = $this->db->query($sql, array($search['user_id']));
        return $query->num_rows();
    }

    /**
     * 
     * @todo 获取我的问题列表
     * 
     * @param $search 查询条件
     * 
     * @return 返回一个object类型的结果集 
     * 
     */
    public function getMyQuestionList($search) {
        $sql = 'select * from db_bbs_question where user_id=? order by create_time desc limit ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql, array($search['user_id']));
        return $query->result();
    }

    /**
     * 
     * @todo 根据关键字获取资讯信息
     * 
     * @param $keyword  关键字
     * 
     * @return 返回一个object类型的结果 
     * 
     */
    public function getArticleListByKeyword($keyword) {
        $sql = 'select * from db_article where (title like "%' . $keyword . '%" or seo_keyword like "%' . $keyword . '%" or seo_title like "%' . $keyword . '%") and sts =0 order by id desc';
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 根据关键字获取问题信息
     * 
     * @param $keyword 关键字 
     * 
     * @return 返回一个object类型的结果
     * 
     */
    public function getQuestionListByKeyword($keyword) {
        $sql = 'select * from db_bbs_question where (title like "%' . $keyword . '%" or questions like "%' . $keyword . '%") and is_del=0 order by views desc';
        $query = $this->db->query($sql);
        return $query->result();
    }

}
