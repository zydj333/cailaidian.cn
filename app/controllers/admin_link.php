<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class admin_link extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin_link_model');
    }

    public function index() {
        $data['list'] = $this->admin_link_model->getList();
        $this->load->view('admin/link/list', $data);
    }

    /**
     * 
     * @todo 友链添加 
     * 
     */
    public function add() {
        $_data = $this->input->post();
        if (!empty($_data)) {
            $data = array(
                'title' => $_data['title'],
                'url' => $_data['url'],
                'imageurl' => $_data['imageurl'],
                'listorder' => $_data['listorder'],
                'addtime' => date('Y-m-d H:i:s', time())
            );
            $msg = array('flag' => 0, 'error' => "");
            if ($data['title'] == '') {
                $msg['error'] = "添加失败，标题不可以为空";
                echo json_encode($msg);
                exit();
            }
            $pid = $this->admin_link_model->saveListData($data);
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
        $this->load->view('admin/link/add');
    }

     /**
     * 
     * @todo 修改友链 
     * 
     */
    public function edit() {
        $_data = $this->input->post();
        if (!empty($_data)) {
            $data = array(
                'title' => $_data['title'],
                'url' => $_data['url'],
                'imageurl' => $_data['imageurl'],
                'listorder' => $_data['listorder'],
                'addtime' => date('Y-m-d H:i:s', time())
            );
            $msg = array('flag' => 0, 'error' => "");
            $id = $_data['id'] ? $_data['id'] : 0;
            if ($id == 0) {
                $msg['error'] = "保存失败，参数丢失";
                echo json_encode($msg);
                exit();
            }
            $msg = array('flag' => 0, 'error' => "");
            if ($data['title'] == '' || $data['url'] == '') {
                $msg['error'] = "保存失败，标题或链接不可以为空";
                echo json_encode($msg);
                exit();
            }
            if ($this->admin_link_model->editLinkData($data, $id)) {
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
            $link = $this->admin_link_model->getListById($id);
            if (empty($link)) {
                echo "初始化数据失败！";
                exit();
            }
            $data['link'] = $link;
            $this->load->view('admin/link/edit', $data);
        }
    }
    
    /**
     * 
     * @todo 删除友链
     * 
     */
    public function del() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id == 0) {
            echo "删除失败，参数丢失！";
            exit();
        }

        if ($this->admin_link_model->delLinkById($id)) {
            echo "删除该友链成功！";
            exit();
        } else {
            echo "删除失败，错误未知！";
            exit();
        }
    }

}
