<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_product_order
 *
 * @createtime 2015-7-14 10:43:01
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_product_order
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_product_order extends Admin_Controller {

    protected $pagesize = 10;

    /**
     * 
     * @todo  构造方法 
     * 
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_product_order_model');
        $this->load->library('pagenation');
    }

    /**
     * 
     * @todo 载入产品订单列表 
     * 
     */
    public function index() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize,
        );
        $count = $this->admin_product_order_model->getProductOrderCount($search);
        $list = $this->admin_product_order_model->getProductOrderList($search);
        $pageurl = $this->pagenation->getPage($count, $this->pagesize, 1);
        $data['list'] = $list;
        $data['page_url'] = $pageurl;
        $this->load->view('admin/product_order/list', $data);
    }

    /**
     * 
     * @todo 异步列表 
     * 
     */
    public function ajaxList() {
        $nowpage = $this->input->post('nowpage');
        $order_sn = $this->input->post('order_sn');
        $celephone = $this->input->post('celephone');
        $username = $this->input->post('username');
        $is_success = $this->input->post('is_success');
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize,
        );
        if ($order_sn != '') {
            $search['order_sn'] = $order_sn;
        }
        if ($celephone != '') {
            $search['celephone'] = $celephone;
        }
        if ($username != '') {
            $search['username'] = $username;
        }
        if ($is_success > -1) {
            $search['is_success'] = $is_success;
        }
        $data = array(
            'flag' => 0,
            'error' => ""
        );
        $count = $this->admin_product_order_model->getProductOrderCount($search);
        $list = $this->admin_product_order_model->getProductOrderList($search);
        $pageurl = $this->pagenation->getPage($count, $this->pagesize, $nowpage);
        if (!empty($list)) {
            foreach ($list as $key => $val) {
                $list[$key]->createtime = date('Y-m-d H:i:s', $val->createtime);
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
     * 
     * @todo 取消掉预约订单 
     * 
     */
    public function cancelOrder() {
        $order_id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($order_id == 0) {
            echo '参数错误，无法处理!';
        }
        $data = array('is_success' => 1);
        if ($this->admin_product_order_model->editProductOrder($data, $order_id)) {
            echo '处理成功!';
        } else {
            echo '处理失败，未知错误!';
        }
    }

}
