<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */ 

class admin_financial_points extends Admin_Controller{
    private $pagesize = 10;

    /**
     *
     * 构造方法
     *
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_financial_points_model');
        $this->load->library('pagenation');
    }

    /**
     *
     * 积分变动列表
     *
     */
    public function index() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize
        );
        $count = $this->admin_financial_points_model->getCountBySearch($search);
        $data['url'] = $this->pagenation->getPage($count, $this->pagesize, 1);
        $data['list'] = $this->admin_financial_points_model->getListBySearch($search);
        $this->load->view('admin/member_points/list', $data);
    }
    
    /**
     * 
     * @todo 载入详情页面 
     * 
     */
    public function detial(){
        $id=$this->uri->segment(3)?$this->uri->segment(3):0;
        if($id>0){
            $new=$this->admin_financial_points_model->getInfoById($id);
            if(!empty($new)){
                $data['new']=$new;
                $this->load->view('admin/member_points/detial', $data);
            }else{
                $this->common->redirect('3','/admin_point/index','获取详情失败！');
            }
        }else{
            $this->common->redirect('3','/admin_point/index','获取ID失败！');
        }
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
        $type = $this->input->post('type');
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize
        );
        if ($account != '') {
            $search['account'] = $account;
        }
        if ($type != '') {
            $search['type'] = $type;
        }
        $count = $this->admin_financial_points_model->getCountBySearch($search);
        $page_url = $this->pagenation->getPage($count, $this->pagesize, $nowpage);
        $list = $this->admin_financial_points_model->getListBySearch($search);
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
}