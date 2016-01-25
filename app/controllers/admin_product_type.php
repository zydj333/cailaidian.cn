<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_product_type
 *
 * @createtime 2015-6-23 16:19:02
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_product_type
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_product_type extends Admin_Controller {

    //put your code here
    /**
     * 
     * @todo 构造方法 
     * 
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_product_type_model');
    }

    /**
     * 
     * @todo 载入列表 
     * 
     */
    public function index() {
        $list = $this->admin_product_type_model->getProductTypeList();
        $data['list'] = $list;
        $this->load->view('admin/product_type/list', $data);
    }

    /**
     * 
     * @todo 载入产品分类添加 
     * 
     */
    public function add() {
        $_data = $this->input->post();
        if (!empty($_data)) {
            $data = array(
                'title' => $_data['title'],
                'salt' => $_data['salt'] ? $_data['salt'] : 0
            );
            $msg = array('flag' => 0, 'error' => "");
            if ($data['title'] == '') {
                $msg['error'] = "分类标题不可以为空！";
                echo json_encode($msg);
                exit;
            }
            $t_id = $this->admin_product_type_model->saveProductType($data);
            if ($t_id > 0) {
                $msg['flag'] = 1;
                $msg['error'] = "保存成功！";
                echo json_encode($msg);
                exit;
            } else {
                $msg['error'] = "保存失败！";
                echo json_encode($msg);
                exit;
            }
        } else {
            $this->load->view('admin/product_type/add');
        }
    }

    /**
     * 
     * @todo 修改产品分类 
     * 
     */
    public function edit() {
        $_data = $this->input->post();
        if (!empty($_data)) {
            $data = array(
                'title' => $_data['title'],
                'salt' => $_data['salt'] ? $_data['salt'] : 0
            );
            $type_id = $_data['type_id'] ? $_data['type_id'] : 0;
            $msg = array('flag' => 0, 'error' => "");
            if ($type_id == 0) {
                $msg['error'] = "参数丢失，保存失败！";
                echo json_encode($msg);
                exit;
            }
            if ($data['title'] == '') {
                $msg['error'] = "分类标题不可以为空！";
                echo json_encode($msg);
                exit;
            }
            if ($this->admin_product_type_model->editProductType($data, $type_id)) {
                $msg['flag'] = 1;
                $msg['error'] = "保存成功！";
                echo json_encode($msg);
                exit;
            } else {
                $msg['error'] = "保存失败！";
                echo json_encode($msg);
                exit;
            }
        } else {
            $t_id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            $type = $this->admin_product_type_model->getProductTypeById($t_id);
            if (empty($type)) {
                echo "初始化数据失败！";
                exit;
            }
            $data['type'] = $type;
            $this->load->view('admin/product_type/edit', $data);
        }
    }

    /**
     * 
     * @todo 删除产品分类 
     * 
     */
    public function del() {
        $t_id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($t_id == 0) {
            echo "删除失败，参数错误！";
            exit;
        }
        if ($this->admin_product_type_model->delProductType($t_id)) {
            echo "删除成功！";
            exit;
        } else {
            echo '删除失败，未知错误！';
            exit;
        }
    }

}
