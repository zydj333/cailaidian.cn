<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_system
 *
 * @createtime 2015-6-16 15:26:55
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_system
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_system extends Admin_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_system_model');
    }

    /**
     * 
     * @todo 载入模块列表 
     * 
     */
    public function index() {
        //一级模块
        $list = $this->admin_system_model->getSystemList(0);
        if (!empty($list)) {
            //获取二级模块
            foreach ($list as $key => $value) {
                $list[$key]->second = $this->admin_system_model->getSystemList($value->id);
            }
        }
        $data['list'] = $list;
        $this->load->view('admin/system/list', $data);
    }

    /**
     * 
     * @todo 添加模块 
     * 
     */
    public function add() {
        $_data = $this->input->post();
        if (!empty($_data)) {
            $data = array(
                'title' => $_data['title'],
                'controllers' => $_data['controllers'],
                'actions' => $_data['actions'],
                'pid' => $_data['pid'] ? $_data['pid'] : 0,
                'salt' => $_data['salt'] ? $_data['salt'] : 0,
                'addtime' => time()
            );
            $msg = array('flag' => 0, 'error' => "");
            if ($data['title'] == '' || $data['title'] == '') {
                $msg['error'] = "信息没有填写完整";
                echo json_encode($msg);
                exit();
            }
            if ($this->admin_system_model->checkSystemIsDefind($data)) {
                $msg['error'] = "该信息已经存在";
                echo json_encode($msg);
                exit();
            }
            $s_id = $this->admin_system_model->saveSystem($data);
            if ($s_id > 0) {
                $msg['flag'] = 1;
                $msg['error'] = "保存成功!";
                echo json_encode($msg);
                exit();
            } else {
                $msg['error'] = "保存失败，错误未知";
                echo json_encode($msg);
                exit();
            }
        } else {
            $list = $this->admin_system_model->getSystemList(0);
            $data['list'] = $list;
            $this->load->view('admin/system/add', $data);
        }
    }

    /**
     * 
     * @todo 载入系统模块修改 
     * 
     */
    public function edit() {
        $_data = $this->input->post();
        if (!empty($_data)) {
            $msg = array('flag' => 0, 'error' => "");
            $sys_id = $_data['system_id'] ? $_data['system_id'] : 0;
            $data = array(
                'title' => $_data['title'],
                'controllers' => $_data['controllers'],
                'actions' => $_data['actions'],
                'pid' => $_data['pid'] ? $_data['pid'] : 0,
                'salt' => $_data['salt'] ? $_data['salt'] : 0,
                'addtime' => time()
            );
            $msg = array('flag' => 0, 'error' => "");
            if ($data['title'] == '' || $data['title'] == '') {
                $msg['error'] = "信息没有填写完整";
                echo json_encode($msg);
                exit();
            }
            if ($sys_id == 0) {
                $msg['error'] = "参数丢失";
                echo json_encode($msg);
                exit();
            }
            if ($this->admin_system_model->saveSystemEdit($data, $sys_id)) {
                $msg['flag'] = 1;
                $msg['error'] = "保存成功！";
                echo json_encode($msg);
                exit();
            } else {
                $msg['error'] = "保存失败，错误未知";
                echo json_encode($msg);
                exit();
            }
        } else {
            $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            if ($id == 0) {
                echo '参数错误！';
                exit();
            }
            $data['system'] = $this->admin_system_model->getSystemById($id);
            $data['list'] = $this->admin_system_model->getSystemList(0);
            if (empty($data['system'])) {
                echo '初始化数据失败！';
                exit();
            }
            $this->load->view('admin/system/edit', $data);
        }
    }
    
    
    /**
     * 
     * @todo 删除模块 
     * 
     */
    public function del(){
        echo '暂时不开放删除功能!';
        exit;
    }

}
