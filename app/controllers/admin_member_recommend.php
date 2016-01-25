<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class admin_member_recommend extends Admin_Controller{
    
    protected $pagesize = 10;
    
    public function __construct() {
        parent::__construct();
        $this->load->library('pagenation');
        $this->load->model('admin_member_recommend_model');
    }
   
    public function index(){
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize
        );
        $count = $this->admin_member_recommend_model->getUserCount($search);
        $data['pageurl'] = $this->pagenation->getPage($count, $this->pagesize, 1);
        $data['list'] = $this->admin_member_recommend_model->getCardInfo($search);
        $this->load->view('admin/member_recommend/list', $data);
    }
    
    /**
     * 
     * @todo 获取推荐人列表  
     * 
     */
    public function ajaxList() {
        $nowpage = $this->input->post('nowpage') ? $this->input->post('nowpage') : 1;
        $cardno = $this->input->post('cardno');
        $account = $this->input->post('account');
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize,
        );
        if ($cardno != '') {
            $search['cardno'] = $cardno;
        }
        if ($account != '') {
            $search['account'] = $account;
        }
        $count = $this->admin_member_recommend_model->getUserCount($search);
        $list = $this->admin_member_recommend_model->getCardInfo($search);
        $pageurl = $this->pagenation->getPage($count, $this->pagesize, $nowpage);
        $data = array(
            'flag' => 0,
            'error' => ""
        );
        if ($count > 0) {
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
}