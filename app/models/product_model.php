<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of product_model
 *
 * @createtime 2015-7-7 15:57:22
 * 
 * @author ZhangPing'an
 * 
 * @todo product_model
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class product_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 获取分类列表
     * 
     * @return 返回一个object类型的结果 
     * 
     */
    public function getCategoryList() {
        $this->db->order_by('salt', 'asc');
        $query = $this->db->get('db_protype');
        return $query->result();
    }

    /**
     * 
     * @todo 获取分类详情
     * 
     * @param $cate_id
     * 
     * @return 返回一个结果集 
     * 
     */
    public function getCateInfoById($cate_id) {
        $this->db->where(array('id' => $cate_id));
        $query = $this->db->get('db_protype');
        return $query->row();
    }

    /**
     * 
     * @todo 根据条件获取产品总条数 
     * 
     * @param $search 查询条件
     * 
     * @return 返回一个int类型的整数
     * 
     */
    public function getProductCount($search) {
        $where = ' where is_delete=0 and is_show=1';
        //分类条件
        if ($search['cate'] > 0) {
            $where.=' and category=' . $search['cate'];
        }
        //状态条件
        if ($search['status'] > 0) {
            $where.=' and status=' . $search['status'];
        }
        //产品期限区间
        if ($search['date_area'] > 0) {
            $where.=' and month_area=' . $search['date_area'];
        }
        //佣金区间
        if ($search['fee'] > 0) {
            $where.=' and fee_area=' . $search['fee'];
        }
        //收益区间
        if ($search['interest'] > 0) {
            $where.=' and interest_area=' . $search['interest'];
        }
        //产品所在地
        if ($search['province'] > 0) {
            $where.=' and province=' . $search['province'];
        }
        //投资领域
        if ($search['tender_area'] > 0) {
            $where.=' and tender_area=' . $search['tender_area'];
        }
        //付息方式
        if ($search['pay_way'] > 0) {
            $where.=' and pay_way=' . $search['pay_way'];
        }
        //大小配比
        if ($search['comparison'] > 0) {
            $where.=' and comparison=' . $search['comparison'];
        }
        //产品评级
        if ($search['level'] > 0) {
            $where.=' and level=' . $search['level'];
        }
        $sql = 'select id from db_product' . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     * 
     * @todo 根据条件获取产品列表 
     * 
     * @param $search 查询条件
     * 
     * @return 返回一个object类型的结果集
     * 
     */
    public function getProductList($search) {
        $where = ' where is_delete=0 and is_show=1';
        //分类条件
        if ($search['cate'] > 0) {
            $where.=' and category=' . $search['cate'];
        }
        //状态条件
        if ($search['status'] > 0) {
            $where.=' and status=' . $search['status'];
        }
        //产品期限区间
        if ($search['date_area'] > 0) {
            $where.=' and month_area=' . $search['date_area'];
        }
        //佣金区间
        if ($search['fee'] > 0) {
            $where.=' and fee_area=' . $search['fee'];
        }
        //收益区间
        if ($search['interest'] > 0) {
            $where.=' and interest_area=' . $search['interest'];
        }
        //产品所在地
        if ($search['province'] > 0) {
            $where.=' and province=' . $search['province'];
        }
        //投资领域
        if ($search['tender_area'] > 0) {
            $where.=' and tender_area=' . $search['tender_area'];
        }
        //付息方式
        if ($search['pay_way'] > 0) {
            $where.=' and pay_way=' . $search['pay_way'];
        }
        //大小配比
        if ($search['comparison'] > 0) {
            $where.=' and comparison=' . $search['comparison'];
        }
        //产品评级
        if ($search['level'] > 0) {
            $where.=' and level=' . $search['level'];
        }
        $order = ' is_recommen desc,create_time desc';
        switch ($search['order']) {
            case 'all':
                $order = ' is_recommen desc,create_time desc';
                break;
            case 'interest':
                $order = ' interest_area desc';
                break;
            case 'fee':
                $order = ' fee_area desc';
                break;
            case 'dateline':
                $order = ' month_area asc';
                break;
            case 'level':
                $order = ' level asc';
                break;
            case 'views':
                $order = ' view_times desc';
                break;
            case 'buys':
                $order = ' support_times desc';
                break;
            case 'downloads':
                $order = ' download_times desc';
                break;
            case 'mails':
                $order = ' mail_times desc';
                break;
            default:
                $order = ' is_recommen desc,create_time desc';
                break;
        }
        $sql = 'select id,product_name,category,category_name,month,tender_area,pay_way,interest_area,progress,support_log from db_product' . $where . ' order by ' . $order . ' limit ' . $search['start'] . ',' . $search['pagesize'];
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 获取产品的收益子项 
     * 
     * @param $pid 产品ID
     * 
     * @return 返回一个object类型的结果集
     * 
     */
    public function getProductItemsByPid($pid) {
        $this->db->where(array('product_id' => $pid));
        $this->db->order_by('interest', 'asc');
        $query = $this->db->get('db_product_items');
        return $query->result();
    }

    /**
     * 
     * @todo 根据产品ID获取产品详情
     * 
     * @param $product_id 产品ID
     * 
     * @return 返回一个object类型的结果 
     * 
     */
    public function getProductDetial($product_id) {
        $this->db->where(array('id' => $product_id, 'is_delete' => 0, 'is_show' => 1));
        $query = $this->db->get('db_product');
        return $query->row();
    }

    /**
     * 
     * @todo 保存产品预约 订单
     * 
     * @param $data 数组  要保存的数据
     * 
     * @return 返回一个int类型的整数 
     * 
     */
    public function saveProductOrder($data) {
        $this->db->insert('db_product_order', $data);
        return $this->db->insert_id();
    }

    /**
     * 
     * @todo 根据关键词搜索产品列表
     * 
     * @param $keyword 关键字
     * 
     * @return  返回一个object类型的结果集 
     * 
     */
    public function getProductBySearch($keyword) {
        $sql = 'select * from `db_product` where product_name like "%' . $keyword . '%" and is_delete=0 and is_show=1 order by id desc';
        $query = $this->db->query($sql);
        return $query->result();
    }

}
