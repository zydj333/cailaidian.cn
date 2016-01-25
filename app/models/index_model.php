<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of index_model
 *
 * @createtime 2015-7-3 12:56:10
 * 
 * @author ZhangPing'an
 * 
 * @todo index_model
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class index_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 获取banner列表 
     * 
     * @param $count 要获取的条数
     * 
     * @return 返回一个结果集
     * 
     */
    public function getBannerList($count = 4) {
        $this->db->where(array('type' => "banner", 'is_del' => 0));
        $this->db->order_by('listorder', 'asc');
        $this->db->limit($count);
        $query = $this->db->get('db_banner');
        return $query->result();
    }

    /**
     * 
     * @todo 获取各种产品总条数 
     * 
     * @return 返回一个object类型的结果
     * 
     */
    public function getProductCountEachType() {
        $sql = 'select a.id,a.title,COUNT(b.id) as totlecount from db_protype as a join db_product as b on a.id=b.category where b.is_delete=0 and b.is_show=1 group by a.id order by a.salt asc limit 4';
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 获取首页产品列表 
     *  
     * @param $category 产品分类
     *  
     * @return 返回一个object类型的结果
     * 
     */
    public function productList($category) {
        $sql = 'select * from db_product where category=' . $category . ' and is_show=1 and is_delete=0 order by is_recommen desc,listorder asc limit 5';
        $query = $this->db->query($sql);
        $result = $query->result();
        if (!empty($result)) {
            foreach ($result as $key => $value) {
                $items = 'select * from db_product_items where product_id=' . $value->id . ' order by interest asc';
                $items_list = $this->db->query($items);
                $result[$key]->items = $items_list->result();
            }
        }
        return $result;
    }

    /**
     * 
     * @todo 获取信托快报
     * 
     * @param $type 文章分类
     * 
     * @param $count 要获取的总条数
     * 
     * @return 返回一个object 类型的结果 
     * 
     */
    public function getArticleList($type, $count = 5) {
        $sql = 'select id,ac_id,search_name,title,article_time,sts from db_article where sts=0 and ac_id=' . $type . ' order by listorder asc,article_time desc limit ' . $count;
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 获取合作伙伴
     * 
     * @param $count 要获取的条数
     * 
     * @return 返回一个结果集 
     * 
     */
    public function getPartnerList($count = 10) {
        $sql = 'select * from db_link order by listorder asc limit ' . $count;
        $query = $this->db->query($sql);
        return $query->result();
    }

}
