<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class admin_point_recycle extends Admin_Controller {
    
    private $now_time = 0;
    private $pagesize = 10;
    
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->library('pagenation');
        $this->load->model('admin_point_recycle_model');
        $this->load->model('admin_point_type_model');
        $this->now_time = time();
    }
    
    public function index() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize
        );
        $count = $this->admin_point_recycle_model->getPointCount($search);
        $data['url'] = $this->pagenation->getPage($count, $this->pagesize, 1);
        $data['list'] = $this->admin_point_recycle_model->getPointList($search);
        $data['type'] = $this->admin_point_type_model->getPointCategory();
        $this->load->view('admin/point_recycle/list', $data);
    }
    
    /**
     * 
     * 
     * @todo 载入异步分页 
     * 
     */
    public function ajaxList() {
        $msg = array(
            'flag' => 0,
            'error' => "",
        );
        $nowpage = $this->input->post('nowpage') ? $this->input->post('nowpage') : 1;
        $name = $this->input->post('name');
        $type_id = $this->input->post('type_id');
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize
        );
        if ($name != '') {
            $search['name'] = $name;
        }
        if ($type_id > -1) {
            $search['type_id'] = $type_id;
        }
        $count = $this->admin_point_recycle_model->getPointCount($search);
        $page_url = $this->pagenation->getPage($count, $this->pagesize, $nowpage);
        $list = $this->admin_point_recycle_model->getPointList($search);
        if (!empty($list)) {
            $msg['flag'] = 1;
            $msg['error'] = $list;
            $msg['pageurl'] = $page_url;
        } else {
            $msg['flag'] = 0;
            $msg['error'] = '没有相应数据';
            $msg['pageurl'] = '';
        }
        echo json_encode($msg);
    }
    
    /**
     * 
     * @todo 取消删除 
     * 
     */
    public function recycle() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id == 0) {
            echo "无法恢复，参数丢失";
            exit;
        }
        $data = array(
            'status' => 0
        );
        if ($this->admin_point_recycle_model->editPointRec($data, $id)) {
            echo "恢复信息成功！";
            exit();
        } else {
            echo "无法恢复，错误未知";
            exit;
        }
    }
}