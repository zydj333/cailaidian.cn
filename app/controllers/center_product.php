<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class center_product extends Home_Controller {

    //put your code here
    protected $pagesize = 10;

    public function __construct() {
        parent::__construct();
        $this->load->model('center_product_model');
        $this->common->checkMemberLogin();
    }

    /**
     * 
     * @todo 上传产品首页 
     * 
     */
    public function index() {
        $header = array(
            'chosen' => "product",
            'title' => parent::HEADER_TITLE,
            'keywords' => parent::HEADER_KEYWORDS,
            'description' => parent::HEADER_DESCRIPTION
        );
        $this->loadCenter($header);
        $nowpage = $this->input->get('page') ? $this->input->get('page') : 1;
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize,
            'user_id' => $this->member->user_id
        );
        //获取产品总条数
        $count = $this->center_product_model->getProductCount($search);
        //获取产品列表
        $list = $this->center_product_model->getProductList($search);
        if (!empty($list)) {
            foreach ($list as $key => $value) {
                $list[$key]->earning = $this->common_model->getProductEarning($value->earning);
            }
        }
        $data['count'] = $count;
        $data['list'] = $list;
        $this->load->view('home/center_product/product', $data);
        $this->loadFooter();
    }

    /**
     * 
     * @todo 删除我的产品 
     * 
     */
    public function delMyProduct() {
        $pid = $this->input->post('pid') ? $this->input->post('pid') : 0;
        $msg = array('flag' => 0, 'error' => "");
        if ($pid == 0) {
            $msg['error'] = "删除失败，产品参数丢失！";
            echo json_encode($msg);
            exit();
        }
        $data['is_del'] = 1;
        if ($this->center_product_model->editProductData($data, $pid)) {
            $msg['flag'] = 1;
            $msg['error'] = "删除成功，跳转到列表页面！";
            echo json_encode($msg);
            exit();
        } else {
            $msg['error'] = "删除失败，发送未知错误！";
            echo json_encode($msg);
            exit();
        }
    }

}
