<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class admin_member_group extends Admin_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_member_group_model');
    }
    
    /*
     * 获取分组列表
     * 
     */
    public function index(){
        $data['list'] = $this->admin_member_group_model->getGroupList();
        $this->load->view('admin/member_group/list', $data);
    }
    
    /**
     * 
     * 分组添加 
     * 
     */
    public function add() {
        $_data = $this->input->post();
        if (!empty($_data)) {
            $data = array(
                'groupname' => $_data['groupname'],
                'minexp' => $_data['minexp'],
                'maxexp' => $_data['maxexp'],
                'listorder' => $_data['listorder'],
                'discount' => $_data['discount']
            );
            $msg = array('flag' => 0, 'error' => "");
            if ($data['groupname'] == '') {
                $msg['error'] = "添加失败，分组名不可以为空";
                echo json_encode($msg);
                exit();
            }
            $pid = $this->admin_member_group_model->saveGroupData($data);
            if ($pid > 0) {
                $msg['flag'] = 1;
                $msg['error'] = "添加成功！";
                echo json_encode($msg);
                exit();
            } else {
                $msg['error'] = "添加失败，错误未知";
                echo json_encode($msg);
                exit();
            }
        }
        $this->load->view('admin/member_group/add');
    }

     /**
     * 
     * 分组修改 
     * 
     */
    public function edit() {
        $_data = $this->input->post();
        if (!empty($_data)) {
            $data = array(
                'groupname' => $_data['groupname'],
                'minexp' => $_data['minexp'],
                'maxexp' => $_data['maxexp'],
                'listorder' => $_data['listorder'],
                'discount' => $_data['discount']
            );
            $msg = array('flag' => 0, 'error' => "");
            $id = $_data['id'] ? $_data['id'] : 0;
            if ($id == 0) {
                $msg['error'] = "保存失败，参数丢失";
                echo json_encode($msg);
                exit();
            }
            $msg = array('flag' => 0, 'error' => "");
            if ($data['groupname'] == '') {
                $msg['error'] = "保存失败，分组名不可以为空";
                echo json_encode($msg);
                exit();
            }
            if ($this->admin_member_group_model->editGroupData($data, $id)) {
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
                echo "参数丢失！";
                exit();
            }
            $group = $this->admin_member_group_model->getGroupById($id);
            if (empty($group)) {
                echo "初始化数据失败！";
                exit();
            }
            $data['group'] = $group;
            $this->load->view('admin/member_group/edit', $data);
        }
    }
    
    /**
     * 
     * 删除分组
     * 
     */
    public function del() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id == 0) {
            echo "删除失败，参数丢失！";
            exit();
        }

        if ($this->admin_member_group_model->delGroupById($id)) {
            echo "删除成功！";
            exit();
        } else {
            echo "删除失败，错误未知！";
            exit();
        }
    }
}