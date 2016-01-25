<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_bbs_module
 *
 * @createtime 2015-7-24 15:04:01
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_bbs_module
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_bbs_module extends Admin_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_bbs_module_model');
    }

    /**
     * 
     * @todo 载入社区模块列表 
     * 
     */
    public function index() {
        //获取一级分类
        $list = $this->admin_bbs_module_model->getBbsModuleList(0);
        if (!empty($list)) {
            //获取二级分类
            foreach ($list as $key => $value) {
                $list[$key]->second = $this->admin_bbs_module_model->getBbsModuleList($value->cate_id);
            }
        }
        $data['list'] = $list;
        $this->load->view('admin/bbs_module/list', $data);
    }

    /**
     * 
     * @todo 添加社区模块添加 
     * 
     */
    public function add() {
        if ($this->input->post()) {
            $_data = $this->input->post();
            $data = array(
                'cate_pid' => $_data['cate_pid'],
                'cate_name' => $_data['cate_name'],
                'cate_description' => $_data['cate_description'],
                'cate_image_url' => $_data['cate_image_url'],
                'cate_topic_num' => 0,
                'cate_salt' => $_data['cate_salt'],
                'cate_create_time' => time()
            );
            $msg = array('flag' => 0, 'error' => "");
            if ($data['cate_name'] == '') {
                $msg['error'] = "模块名称不可以为空！";
                echo json_encode($msg);
                exit;
            }
            if ($this->admin_bbs_module_model->checkModuleIsSet($data)) {
                $msg['error'] = "保存失败，该数据已存在,不可重复！";
                echo json_encode($msg);
                exit;
            }
            $id = $this->admin_bbs_module_model->saveBbsModuleData($data);
            if ($id > 0) {
                $msg['flag'] = 1;
                $msg['error'] = "保存成功，回到列表！";
                echo json_encode($msg);
                exit;
            } else {
                $msg['error'] = "保存失败，错误未知！";
                echo json_encode($msg);
                exit;
            }
        } else {
            //获取一级分类列表
            $data['list'] = $this->admin_bbs_module_model->getBbsModuleList(0);
            $this->load->view('admin/bbs_module/add', $data);
        }
    }

    /**
     * 
     * @todo 载入社区模块修改 
     * 
     */
    public function edit() {
        if ($this->input->post()) {
            $msg = array('flag' => 0, 'error' => "");
            $_data = $this->input->post();
            $cate_id = $_data['cate_id'] ? $_data['cate_id'] : 0;
            $data = array(
                'cate_pid' => $_data['cate_pid'],
                'cate_name' => $_data['cate_name'],
                'cate_description' => $_data['cate_description'],
                'cate_image_url' => $_data['cate_image_url'],
                'cate_salt' => $_data['cate_salt']
            );
            if ($cate_id == 0) {
                $msg['error'] = "参数丢失,无法进行修改";
                echo json_encode($msg);
                exit;
            }
            if ($data['cate_name'] == '') {
                $msg['error'] = "模块名称不可以为空!";
                echo json_encode($msg);
                exit;
            }
            if ($this->admin_bbs_module_model->editModuleData($data, $cate_id)) {
                $msg['flag'] = 1;
                $msg['error'] = "修改成功，返回到列表页面";
                echo json_encode($msg);
                exit;
            } else {
                $msg['error'] = "保存修改失败，发生未知错误!";
                echo json_encode($msg);
                exit;
            }
        } else {
            $cate_id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            if ($cate_id == 0) {
                echo '参数丢失无法载入修改!';
                exit;
            }
            $detial = $this->admin_bbs_module_model->getModuleDetial($cate_id);
            if (empty($detial)) {
                echo '初始化数据失败，无法载入修改！';
                exit;
            }
            //获取一级分类列表
            $data['cate'] = $detial;
            $data['list'] = $this->admin_bbs_module_model->getBbsModuleList(0);
            $this->load->view('admin/bbs_module/edit', $data);
        }
    }

}
