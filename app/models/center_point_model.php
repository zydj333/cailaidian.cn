<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class center_point_model extends CI_Model {
    
    /**
     * 
     *构造方法 
     * 
     */
    public function __construct() {
        parent::__construct();
    }
    
    /*
     * 根据ID获取积分升级信息
     * 
     * $id
     */
    public function getPointsInfo($id){
        $sql = "SELECT a.user_id,a.iscate,a.points,a.pointsnow,a.pointsuse,b.id,b.groupname,b.maxexp from db_member_info as a left join db_member_group as b on b.id = a.iscate where a.user_id = '$id'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    /*
     * 积分自动升级
     */
    public function autoLevelUp($data,$id){
        return $row = $this->db->update('db_member_info', $data, array('user_id' => $id));
    }
    
    /**
     * 
     * @todo 获取积分商品列表
     * 
     * @return 返回一个结果集 
     * 
     */
    public function getList($search) {
        $sql = "select * from db_points where status = 0 limit " . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    /**
     *
     * 获取积分商品 
     *
     * $id 要获取的数据ID
     *
     * 返回一个结果集
     *
     */
    public function getListCount() {
        $this->db->where(array('status' => 0));
        $query = $this->db->get('db_points');
        return $query->num_rows();
    }
}
?>