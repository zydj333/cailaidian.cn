<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_product
 *
 * @createtime 2015-6-18 13:18:20
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_product
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_product extends Admin_Controller {

    protected $pagesize = 10;

    //put your code here
    /**
     * 
     * @todo 构造方法 
     * 
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_product_model');
        $this->load->model('admin_product_type_model');
        $this->load->model('admin_product_items_model');
        $this->load->library('pagenation');
    }

    /**
     * 
     * @todo 产品首页 
     * 
     */
    public function index() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize,
            'isdel' => 0,
        );
        $count = $this->admin_product_model->getProductCount($search);
        $list = $this->admin_product_model->getProductList($search);
        $pageurl = $this->pagenation->getPage($count, $this->pagesize, 1);
        $category = $this->admin_product_type_model->getProductTypeList();
        $data = array(
            'list' => $list,
            'page_url' => $pageurl,
            'category' => $category
        );
        $this->load->view('admin/product/list', $data);
    }

    /**
     * 
     * @todo 异步获取产品列表  
     * 
     */
    public function ajaxList() {
        $nowpage = $this->input->post('nowpage') ? $this->input->post('nowpage') : 1;
        $name = $this->input->post('name');
        $category = $this->input->post('category') ? $this->input->post('category') : 0;
        $status = $this->input->post('status') ? $this->input->post('status') : 0;
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize,
            'isdel' => 0,
        );
        if ($name != '') {
            $search['name'] = $name;
        }
        if ($category > 0) {
            $search['category'] = $category;
        }
        if ($status > 0) {
            $search['status'] = $status;
        }
        $count = $this->admin_product_model->getProductCount($search);
        $list = $this->admin_product_model->getProductList($search);
        $pageurl = $this->pagenation->getPage($count, $this->pagesize, $nowpage);
        $data = array(
            'flag' => 0,
            'error' => ""
        );
        if ($count > 0) {
            foreach ($list as $k => $v) {
                $list[$k]->create_time = date('Y-m-d H:i:s', $v->create_time);
            }
            $data['flag'] = 1;
            $data['error'] = $list;
            $data['pageurl'] = $pageurl;
        } else {
            $data['error'] = '没有获取到对于条件下的数据!';
            $data['pageurl'] = '获取到0条数据';
        }
        echo json_encode($data);
        exit;
    }

    /**
     * 
     * @todo 添加产品信息 
     * 
     */
    public function add() {
        $_data = $this->input->post();
        if (empty($_data)) {
            //获取产品系列 
            $data['category'] = $this->admin_product_type_model->getProductTypeList();
            //产品期限区间
            $data['deadline'] = $this->common_model->getProductDeadline(0);
            //发行费用区间
            $data['issucost'] = $this->common_model->getProductIssuCost(0);
            //收益率  
            $data['interest'] = $this->common_model->getProductInterest(0);
            //收益类型
            $data['earning'] = $this->common_model->getProductEarning(0);
            //付息方式
            $data['payway'] = $this->common_model->getProductPayWay(0);
            //投资领域
            $data['area'] = $this->common_model->getProductTenderArea(0);
            //大小配比
            $data['comparison'] = $this->common_model->getProductComparison(0);
            //获取评级
            $data['level'] = $this->common_model->getProductLevel(0);
            //获取省份
            $data['province'] = $this->common_model->getProvinceCityArea(0);
            $this->load->view('admin/product/add', $data);
        } else {
            $data = array(
                'product_name' => $_data['product_name'],
                'image' => $_data['image'],
                'category' => $_data['category'],
                'category_name' => "",
                'month_area' => $_data['month_area'],
                'month' => $_data['month'],
                'fee_area' => $_data['fee_area'],
                'fee' => $_data['fee'],
                'interest_area' => $_data['interest_area'],
                'earning' => $_data['earning'],
                'province' => $_data['province'],
                'province_name' => "",
                'city' => $_data['city'],
                'city_name' => "",
                'tender_area' => $_data['tender_area'],
                'pay_way' => $_data['pay_way'],
                'comparison' => $_data['comparison'],
                'level' => $_data['level'],
                'progress' => $_data['progress'],
                'support_log' => $_data['support_log'],
                'start' => strtotime($_data['start']),
                'company' => $_data['company'],
                'amount' => $_data['amount'],
                'support_limit' => $_data['support_limit'],
                'support_amount' => 0.00,
                'mainpart' => $_data['mainpart'],
                'mortgage' => $_data['mortgage'],
                'account' => $_data['account'],
                'use_for' => $_data['use_for'],
                'repayment_from' => $_data['repayment_from'],
                'risk_control' => $_data['risk_control'],
                'highlights' => $_data['highlights'],
                'download_file' => $_data['download_file'],
                'discription' => $_data['discription'],
                'content' => $_data['content'],
                'seo_title' => $_data['seo_title'],
                'seo_keyword' => $_data['seo_keyword'],
                'seo_description' => $_data['seo_description'],
                'is_recommen' => $_data['is_recommen'],
                'is_show' => $_data['is_show'],
                'status' => $_data['status'],
                'is_delete' => 0,
                'view_times' => 0,
                'support_times' => 0,
                'download_times' => 0,
                'mail_times' => 0,
                'listorder' => $_data['listorder'],
                'create_time' => time()
            );
            $category = $this->admin_product_type_model->getProductTypeById($data['category']);
            if (!empty($category)) {
                $data['category_name'] = $category->title;
            }
            if ($data['province'] > 0) {
                $province = $this->common_model->getAreaInfoById($data['province']);
                $data['province_name'] = $province->name;
            }
            if ($data['city'] > 0) {
                $city = $this->common_model->getAreaInfoById($data['city']);
                $data['city_name'] = $city->name;
            }
            $product_id = $this->admin_product_model->saveProductData($data);
            if ($product_id > 0) {
                redirect('/admin_product/index');
            } else {
                show_error('数据添加失败，错误未知！');
            }
        }
    }

    /**
     * 
     * @todo 添加前，检查信息的完整性 
     * 
     */
    public function checkInfo() {
        $_data = $this->input->post();
        $data = array(
            'product_name' => $_data['product_name'],
            'image' => $_data['image'],
            'category' => $_data['category'],
            'category_name' => "",
            'month_area' => $_data['month_area'],
            'month' => $_data['month'],
            'fee_area' => $_data['fee_area'],
            'fee' => $_data['fee'],
            'interest_area' => $_data['interest_area'],
            'earning' => $_data['earning'],
            'province' => $_data['province'],
            'province_name' => "",
            'city' => $_data['city'],
            'city_name' => "",
            'tender_area' => $_data['tender_area'],
            'pay_way' => $_data['pay_way'],
            'comparison' => $_data['comparison'],
            'level' => $_data['level'],
            'progress' => $_data['progress'],
            'support_log' => $_data['support_log'],
            'start' => strtotime($_data['start']),
            'company' => $_data['company'],
            'amount' => $_data['amount'],
            'support_limit' => $_data['support_limit'],
            'support_amount' => 0.00,
            'mainpart' => $_data['mainpart'],
            'mortgage' => $_data['mortgage'],
            'account' => $_data['account'],
            'use_for' => $_data['use_for'],
            'repayment_from' => $_data['repayment_from'],
            'risk_control' => $_data['risk_control'],
            'highlights' => $_data['highlights'],
            'download_file' => $_data['download_file'],
            'discription' => $_data['discription'],
            'content' => $_data['content'],
            'seo_title' => $_data['seo_title'],
            'seo_keyword' => $_data['seo_keyword'],
            'seo_description' => $_data['seo_description'],
            'is_recommen' => $_data['is_recommen'],
            'is_show' => $_data['is_show'],
            'status' => $_data['status'],
            'is_delete' => 0,
            'view_times' => 0,
            'support_times' => 0,
            'download_times' => 0,
            'mail_times' => 0,
            'listorder' => $_data['listorder'],
            'create_time' => time()
        );
        $msg = array('flag' => 0, 'error' => "");
        if ($data['product_name'] == '' || $data['month'] == '' || $data['account'] == '') {
            $msg['error'] = "无法保存，信息没有填写完整";
        } else {
                $msg['flag'] = 1;
                $msg['error'] = "信息提交中！";
            /*检查是否已经存在
            if ($this->admin_product_model->checkProductIsSet($data['category'], $data['product_name'])) {
                $msg['error'] = "无法保存，该名称的产品数据库中已经存在!";
            } else {
               
            }*/
        }
        echo json_encode($msg);
        exit;
    }

    /**
     * 
     * @todo 载入产品详情 
     * 
     */
    public function detial() {
        $p_id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        $product = $this->admin_product_model->getProductById($p_id);
        if (empty($product)) {
            echo "没有获取到对应的数据!";
            exit();
        }
        //投资领域
        $product->tender_area = $this->common_model->getProductTenderArea($product->tender_area);
        //发行费用区间
        $product->fee_area = $this->common_model->getProductIssuCost($product->fee_area);
        //收益率
        $product->interest_area = $this->common_model->getProductInterest($product->interest_area);
        //付息方式
        $product->pay_way = $this->common_model->getProductPayWay($product->pay_way);
        //大小匹配
        $product->comparison = $this->common_model->getProductComparison($product->comparison);
        //收益类型
        $product->earning = $this->common_model->getProductEarning($product->earning);
        //时间区间
        $product->month_area = $this->common_model->getProductDeadline($product->month_area);
        //项目评级
        $product->level = $this->common_model->getProductLevel($product->level);
        $data['product'] = $product;
        //获取产品收益列表
        $data['items'] = $this->admin_product_items_model->getProductItemsList($product->id);
        $this->load->view('admin/product/detial', $data);
    }

    /**
     * 
     * @todo 修改产品信息 
     * 
     */
    public function edit() {
        $_data = $this->input->post();
        if (empty($_data)) {
            $product_id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            //获取产品信息
            $product = $this->admin_product_model->getProductById($product_id);
            if (empty($product)) {
                show_error('初始数据未找到！');
            } else {
                //获取产品系列 
                $data['category'] = $this->admin_product_type_model->getProductTypeList();
                //产品期限区间
                $data['deadline'] = $this->common_model->getProductDeadline(0);
                //发行费用区间
                $data['issucost'] = $this->common_model->getProductIssuCost(0);
                //收益率  
                $data['interest'] = $this->common_model->getProductInterest(0);
                //收益类型
                $data['earning'] = $this->common_model->getProductEarning(0);
                //付息方式
                $data['payway'] = $this->common_model->getProductPayWay(0);
                //投资领域
                $data['area'] = $this->common_model->getProductTenderArea(0);
                //大小配比
                $data['comparison'] = $this->common_model->getProductComparison(0);
                //获取评级
                $data['level'] = $this->common_model->getProductLevel(0);
                //获取省份
                $data['province'] = $this->common_model->getProvinceCityArea(0);
                $data['city'] = array();
                if ($product->province > 0) {
                    $data['city'] = $this->common_model->getProvinceCityArea($product->province);
                }
                $data['product'] = $product;
                //print_r($data);exit;
                $this->load->view('admin/product/edit', $data);
            }
        } else {
            $data = array(
                'product_name' => $_data['product_name'],
                'image' => $_data['image'],
                'category' => $_data['category'],
                'category_name' => "",
                'month_area' => $_data['month_area'],
                'month' => $_data['month'],
                'fee_area' => $_data['fee_area'],
                'fee' => $_data['fee'],
                'interest_area' => $_data['interest_area'],
                'earning' => $_data['earning'],
                'province' => $_data['province'],
                'province_name' => "",
                'city' => $_data['city'],
                'city_name' => "",
                'tender_area' => $_data['tender_area'],
                'pay_way' => $_data['pay_way'],
                'comparison' => $_data['comparison'],
                'level' => $_data['level'],
                'progress' => $_data['progress'],
                'support_log' => $_data['support_log'],
                'start' => strtotime($_data['start']),
                'company' => $_data['company'],
                'amount' => $_data['amount'],
                'support_limit' => $_data['support_limit'],
                'mainpart' => $_data['mainpart'],
                'mortgage' => $_data['mortgage'],
                'account' => $_data['account'],
                'use_for' => $_data['use_for'],
                'repayment_from' => $_data['repayment_from'],
                'risk_control' => $_data['risk_control'],
                'highlights' => $_data['highlights'],
                'download_file' => $_data['download_file'],
                'discription' => $_data['discription'],
                'content' => $_data['content'],
                'seo_title' => $_data['seo_title'],
                'seo_keyword' => $_data['seo_keyword'],
                'seo_description' => $_data['seo_description'],
                'is_recommen' => $_data['is_recommen'],
                'is_show' => $_data['is_show'],
                'status' => $_data['status'],
                'listorder' => $_data['listorder']
            );
            $category = $this->admin_product_type_model->getProductTypeById($data['category']);
            if (!empty($category)) {
                $data['category_name'] = $category->title;
            }
            if ($data['province'] > 0) {
                $province = $this->common_model->getAreaInfoById($data['province']);
                $data['province_name'] = $province->name;
            }
            if ($data['city'] > 0) {
                $city = $this->common_model->getAreaInfoById($data['city']);
                $data['city_name'] = $city->name;
            }
            $product_id = $_data['product_id'] ? $_data['product_id'] : 0;
            if ($product_id > 0) {
                if ($this->admin_product_model->editProductData($data, $product_id)) {
                    redirect('/admin_product/index');
                } else {
                    show_error('数据保存失败，错误未知！');
                }
            } else {
                show_error('保存失败，参数丢失！');
            }
        }
    }

    /**
     * 
     * @todo 删除项目 
     * 
     */
    public function del() {
        $product_id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($product_id == 0) {
            echo "无法删除，参数丢失";
            exit;
        }
        $data = array(
            'is_delete' => 1
        );
        if ($this->admin_product_model->editProductData($data, $product_id)) {
            echo "删除信息成功！";
            exit();
        } else {
            echo "无法删除，错误未知";
            exit;
        }
    }

}
