<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class admin_member extends Admin_Controller {
    
    private $pagesize = 17;
    
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->library('pagenation');
        $this->load->model('admin_member_model');
    }

    /**
     * 
     * 载入前台用户列表 
     * 
     */
    public function index() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize
        );
        $count = $this->admin_member_model->getUserCount($search);
        $data['url'] = $this->pagenation->getPage($count, $this->pagesize, 1);
        $data['list'] = $this->admin_member_model->getUserList($search);
        $this->load->view('admin/member/list', $data);
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
        $account = $this->input->post('account');
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize
        );
        if ($account != '') {
            $search['account'] = $account;
        }
        $count = $this->admin_member_model->getUserCount($search);
        $page_url = $this->pagenation->getPage($count, $this->pagesize, $nowpage);
        $list = $this->admin_member_model->getUserList($search);
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
     * @todo 载入用户详情页面 
     * 
     */
    public function detial(){
        $id=$this->uri->segment(3)?$this->uri->segment(3):0;
        if($id>0){
            $member=$this->admin_member_model->getMemberInfo($id);
            $card=$this->admin_member_model->getCardInfo($id);
            if(!empty($member)){
                $data['member']=$member;
                $data['card']=$card;
                //var_dump($data);die;
                 $this->load->view('admin/member/detial', $data);
            }else{
                error('获取资讯失败');
            }
        }else{
            error('获取ID失败');
        }
    }
}