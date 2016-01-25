<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class admin_new_recycle extends  Admin_Controller {
    private $pagesize = 10;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_new_recycle_model');
        $this->load->library('pagenation');
    }
    
    /**
     * 
     * 回收站首页 
     * 
     */
    public function index() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize
        );
        $count = $this->admin_new_recycle_model->getNewCount($search);
        $data['url'] = $this->pagenation->getPage($count, $this->pagesize, 1);
        $data['list'] = $this->admin_new_recycle_model->getNewList($search);
        $this->load->view('admin/new_recycle/list', $data);
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
        $title = $this->input->post('title');
        $search_name = $this->input->post('search_name');
        $ac_id = $this->input->post('ac_id');
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize
        );
        if ($title != '') {
            $search['title'] = $title;
        }
        if ($ac_id > -1) {
            $search['ac_id'] = $ac_id;
        }
        if ($search_name != '') {
            $search['search_name'] = $search_name;
        }
        $count = $this->admin_new_recycle_model->getNewCount($search);
        $page_url = $this->pagenation->getPage($count, $this->pagesize, $nowpage);
        $list = $this->admin_new_recycle_model->getNewList($search);
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
     * 还原资讯 
     * 
     */
    public function recycle() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id == 0) {
            echo "还原失败，参数丢失！";
            exit();
        }
        $data = array(
                'sts' => 0,
            );
        if ($this->admin_new_recycle_model->editNewRec($data,$id)) {
            exit();
        } else {
            echo "还原失败，错误未知！";
            exit();
        }
    }
}