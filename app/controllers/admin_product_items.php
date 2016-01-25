<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_product_items
 *
 * @createtime 2015-7-6 15:05:25
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_product_items
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_product_items extends Admin_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_product_items_model');
    }

    public function index() {
        $pid = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($pid == 0) {
            show_error('产品参数丢失！');
        } else {
            $data['product_id'] = $pid;
            $data['list'] = $this->admin_product_items_model->getProductItemsList($pid);
            $this->load->view('admin/product_items/list', $data);
        }
    }

    /**
     * 
     * @todo 载入添加页面 
     * 
     */
    public function add() {
        $_data = $this->input->post();
        if (!empty($_data)) {
            $data = array(
                'product_id' => $_data['product_id'] ? $_data['product_id'] : 0,
                'buy_total' => $_data['buy_total'],
                'interest' => $_data['interest'],
                'fee' => $_data['fee'],
                'creattime' => time()
            );
            $msg = array('flag' => 0, 'error' => "");
            if ($data['product_id'] == 0) {
                $msg['error'] = "产品参数丢失，无法保存";
                echo json_encode($msg);
                exit;
            }
            if ($data['buy_total'] == '' || $data['interest'] == '' || $data['fee'] == '') {
                $msg['error'] = "信息没有填写完整，无法保存";
                echo json_encode($msg);
                exit;
            }
            //入库
            $items_id = $this->admin_product_items_model->saveProductItems($data);
            if ($items_id > 0) {
                $msg['flag'] = 1;
                $msg['error'] = "保存成功!";
                echo json_encode($msg);
                exit;
            } else {
                $msg['error'] = "保存失败，错误未知！";
                echo json_encode($msg);
                exit;
            }
        } else {
            $product_id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            if ($product_id == 0) {
                echo '产品数据丢失，无法进行添加';
            }
            $data['product_id'] = $product_id;
            $this->load->view('admin/product_items/add', $data);
        }
    }

    /**
     * 
     * @todo 修改产品收益子项 
     * 
     */
    public function edit() {
        $_data = $this->input->post();
        if (!empty($_data)) {
            $product_id = $_data['product_id'] ? $_data['product_id'] : 0;
            $data = array(
                'buy_total' => $_data['buy_total'],
                'interest' => $_data['interest'],
                'fee' => $_data['fee']
            );
            $msg = array('flag' => 0, 'error' => "");
            if ($product_id == 0) {
                $msg['error'] = "产品参数丢失，无法保存";
                echo json_encode($msg);
                exit;
            }
            if ($data['buy_total'] == '' || $data['interest'] == '' || $data['fee'] == '') {
                $msg['error'] = "信息没有填写完整，无法保存";
                echo json_encode($msg);
                exit;
            }
            $items_id = $this->input->post('items_id') ? $this->input->post('items_id') : 0;
            if ($items_id == 0) {
                $msg['error'] = "收益子项参数丢失，无法保存";
                echo json_encode($msg);
                exit;
            }
            if ($this->admin_product_items_model->editProductItems($data, $items_id)) {
                $msg['flag'] = 1;
                $msg['error'] = "保存成功！";
                echo json_encode($msg);
                exit;
            } else {
                $msg['error'] = "保存失败，未知错误";
                echo json_encode($msg);
                exit;
            }
        } else {
            $product_id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            $items_id = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
            if ($product_id == 0) {
                echo "产品参数丢失，无法载入修改!";
                exit;
            }
            if ($items_id == 0) {
                echo "产品收益子项参数丢失，无法载入修改!";
                exit;
            }
            $items = $this->admin_product_items_model->getItemsInfo($items_id);
            if (empty($items)) {
                echo "初始化数据失败，无法载入修改!";
                exit;
            }
            $data['items'] = $items;
            $this->load->view('admin/product_items/edit', $data);
        }
    }

    public function del() {
        $product_id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        $items_id = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
        if ($product_id == 0) {
            echo "产品参数丢失，无法删除!";
            exit;
        }
        if ($items_id == 0) {
            echo "产品收益子项参数丢失，无法删除!";
            exit;
        }
        if($this->admin_product_items_model->delProductItems($items_id)){
            echo "删除成功，点击确定回到列表!";
            exit;
        }else{
            echo "发生未知错误，无法删除!";
            exit;
        }
    }

}
