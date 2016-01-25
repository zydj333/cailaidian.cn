<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_planner_product
 *
 * @createtime 2015-7-22 10:08:36
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_planner_product
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_planner_product extends Admin_Controller {

    //put your code here
    protected $pagesize = 10;

    public function __construct() {
        parent::__construct();
        $this->load->model('admin_planner_product_model');
        $this->load->library('pagenation');
    }

    public function index() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize
        );
        $count = $this->admin_planner_product_model->getPlannerProductCount($search);
        $list = $this->admin_planner_product_model->getPlannerProductList($search);
        $page_url = $this->pagenation->getPage($count, $this->pagesize, 1);
        $data['list'] = $list;
        $data['page_url'] = $page_url;
        $data['province'] = $this->common_model->getProvinceCityArea(0);
        $data['cate'] = $this->common_model->getProductCategory();
        $this->load->view('admin/planner_product/list', $data);
    }

    /**
     * 
     * @todo 异步获取理财师产品列表 
     * 
     */
    public function ajaxList() {
        $nowpage = $this->input->post('nowpage') ? $this->input->post('nowpage') : 1;
        $product_name = $this->input->post('product_name');
        $username = $this->input->post('username');
        $category = $this->input->post('category') ? $this->input->post('category') : 0;
        $province = $this->input->post('province') ? $this->input->post('province') : 0;
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize,
        );
        if ($product_name != '') {
            $search['product_name'] = $product_name;
        }
        if ($username != '') {
            $search['username'] = $username;
        }
        if ($category > 0) {
            $search['category'] = $category;
        }
        if ($province > 0) {
            $search['province'] = $province;
        }
        $data = array(
            'flag' => 0,
            'error' => ""
        );
        $count = $this->admin_planner_product_model->getPlannerProductCount($search);
        $list = $this->admin_planner_product_model->getPlannerProductList($search);
        $page_url = $this->pagenation->getPage($count, $this->pagesize, 1);
        if ($count > 0) {
            $data['flag'] = 1;
            $data['error'] = $list;
            $data['pageurl'] = $page_url;
        } else {
            $data['error'] = '没有获取到对应条件下的数据!';
            $data['pageurl'] = '获取到0条数据';
        }
        echo json_encode($data);
    }

    /**
     * 
     * @todo 获取项目详情
     * 
     * @param $product_id 产品ID
     * 
     * @return 返回一个object类型的整数 
     * 
     */
    public function detial() {
        $product_id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($product_id == 0) {
            echo '产品参数丢失，无法获取详情!';
            exit;
        }
        $product = $this->admin_planner_product_model->getPlannerProductDetial($product_id);
        if (empty($product)) {
            echo '获取产品失败，该产品不存在!';
            exit;
        }
        $product->earning = $this->common_model->getProductEarning($product->earning);
        $product->pay_way = $this->common_model->getProductPayWay($product->pay_way);
        $product->tender_area = $this->common_model->getProductTenderArea($product->tender_area);
        $data['product']=$product;
        $this->load->view('admin/planner_product/detial',$data);
    }

}
