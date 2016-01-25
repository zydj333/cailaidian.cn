<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class admin_financial_points_model extends CI_Model {
//put your code here
    public function  __construct() {
        parent::__construct();
    }
    
   /**
     *
     * 根据条件获取总条数
     *
     * $search 查询条件
     *
     * 返回一个int类型的整数
     *
     */
    public function getCountBySearch($search) {
        $where = '';
        if (isset($search['type'])) {
            $where.='where type="' . $search['type'] . '"';
        }
        if (isset($search['account'])) {
            $where.='where account="' . $search['account'] . '"';
        }
        $sql = 'SELECT a.*,b.account from db_point_record as a left join db_member as b on a.user_id = b.id ' . $where . ' ORDER BY id desc';
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    /**
     *
     * 根据条件获取积分列表
     *
     * search 查询条件
     *
     * array() 返回一个二维数组
     *
     */
    public function getListBySearch($search) {
        $where = '';
        if (isset($search['type'])) {
            $where.='where type="' . $search['type'] . '"';
        }
        if (isset($search['account'])) {
            $where.='where account="' . $search['account'] . '"';
        }
        $sql = 'SELECT a.*,b.account from db_point_record as a left join db_member as b on a.user_id = b.id ' . $where . ' ORDER BY id desc LIMIT ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    /**
     *
     * @todo 根据ID获取信息
     *
     * @param $id 要获取的信息ID
     *
     * @return 返回一个一维数组
     *
     */
    public function getInfoById($id) {
        $sql = 'SELECT a.*,b.account from db_point_record as a left join db_member as b on a.user_id = b.id where a.id=?';
        $query = $this->db->query($sql, array($id));
        return $query->row();
    }
}