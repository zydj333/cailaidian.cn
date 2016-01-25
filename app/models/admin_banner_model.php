<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Admin_banner_model extends CI_Model {
//put your code here
    public function  __construct() {
        parent::__construct();
    }

    /**
     *
     * 广告分类列表
     *
     */
    public function getBannerType() {
        return array(
            'banner' => "首页BANNER",
            'news_banner' => "咨询广告",
            'activity' => "活动广告",
            'projects' => "项目广告",
            'bbs' => "社区广告",
        );
    }
    
   /**
     *
     * 根据条件获取广告总条数
     *
     * $search 查询条件
     *
     * 返回一个int类型的整数
     *
     */
    public function getAdCountBySearch($search) {
        $where = '';
        if (isset($search['type'])) {
            $where.=' AND type="' . $search['type'] . '"';
        }
        if (isset($search['title'])) {
            $where.=' AND title like "%' . $search['title'] . '%"';
        }
        $sql = 'SELECT id FROM db_banner where is_del = 0' . $where . ' ORDER BY listorder ASC';
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     *
     * 根据条件获取广告列表
     *
     * search 查询条件
     *
     * array() 返回一个二维数组
     *
     */
    public function getAdListBySearch($search) {
        $where = '';
        if (isset($search['type'])) {
            $where.=' AND type="' . $search['type'] . '"';
        }
        if (isset($search['title'])) {
            $where.=' AND title like "%' . $search['title'] . '%"';
        }
        $sql = 'SELECT * FROM db_banner where is_del = 0' . $where . ' ORDER BY listorder ASC LIMIT ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     *
     * @todo 保存广告信息
     *
     * @param $data 要保存的数据
     *
     * @return 返回一个int类型的整数
     *
     */
    public function saveAdData($data) {
        $this->db->insert('db_banner', $data);
        return $this->db->insert_id();
    }

    /**
     *
     * @todo 根据ID获取广告信息
     *
     * @param $id 要获取的广告信息ID
     *
     * @return 返回一个一维数组
     *
     */
    public function getAdInfoById($id) {
        $sql = 'select * from db_banner where id=?';
        $query = $this->db->query($sql, array($id));
        return $query->row();
    }

    /**
     *
     * @todo 保存对广告信息的修改
     *
     * @param $data 要保存的数据
     *
     * @param $id 要修改的数据ID
     *
     * @return 返回一个真假类型的结果
     *
     */
    public function saveAdDataEdit($data, $id) {
        return $row = $this->db->update('db_banner', $data, array('id' => $id));
    }

    /**
     *
     * @todo 根据广告ID删除广告信息
     *
     * @param $id 要删除的广告ID
     *
     * @return 返回一个真假类型的结果
     *
     */
    public function delBanById($data,$id) {
        return $row = $this->db->update('db_banner', $data, array('id' => $id));
    }
}
?>