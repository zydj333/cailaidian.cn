<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_product_recycle
 *
 * @createtime 2015-7-1 15:49:12
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_product_recycle
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_product_recycle extends Admin_Controller {

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
            'isdel' => 1,
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
        $this->load->view('admin/product_recycle/list', $data);
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
            'isdel' => 1,
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
     * @todo 取消删除 
     * 
     */
    public function cancle() {
        $product_id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($product_id == 0) {
            echo "无法恢复，参数丢失";
            exit;
        }
        $data = array(
            'is_delete' => 0
        );
        if ($this->admin_product_model->editProductData($data, $product_id)) {
            echo "恢复信息成功！";
            exit();
        } else {
            echo "无法恢复，错误未知";
            exit;
        }
    }

}
