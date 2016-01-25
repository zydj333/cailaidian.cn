<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class admin_point_recycle_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * 
     * todo  获取商品总条数
     * 
     * param $search 查询条件
     * 
     * return 返回一个int类型的整数
     * 
     */
    public function getPointCount($search) {
        $where = '';
        if (isset($search['name'])) {
            $where.=" and name like '%" . $search['name'] . "%'";
        }
        if (isset($search['type_id'])) {
            $where.=" and type_id= " . $search['type_id'];
        }
        $sql = "select id from db_points where status = 1" . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    /**
     *
     * todo 获取商品列表
     *
     * param $search 查询条件
     *
     * return 返回一个结果集
     *
     */
    public function getPointList($search) {
        $where = '';
        if (isset($search['name'])) {
            $where.=" and a.name like '%" . $search['name'] . "%'";
        }
        if (isset($search['type_id'])) {
            $where.=" and a.type_id= " . $search['type_id'];
        }
        $sql = "select a.*,b.name as typename from db_points as a left join db_point_type as b on a.type_id=b.id where a.status = 1 " . $where . " order by a.id desc limit " . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    /**
     *
     * 还原商品
     *
     * $data 要还原的数据
     *
     * $id 要还原的ID
     *
     * 返回真假类型的结果
     *
     */
    public function editPointRec($data, $id) {
        return $row = $this->db->update('db_points', $data, array('id' => $id));
    }
}