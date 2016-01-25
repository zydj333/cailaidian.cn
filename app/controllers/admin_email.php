<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class admin_email extends Admin_Controller {

    private $id = 0;
    private $account = "admin";
    private $now_time = 0;
    private $pagesize = 10;

    /**
     *
     * @todo 构造方法
     *
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_email_model');
        $this->load->library('pagenation');
        $this->id = $this->common->get_session('id');
        $this->account = $this->common->get_session('account');
        $this->now_time = time();
    }

    /**
     * 
     * @todo 邮件列表 
     * 
     */
    public function index() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize,
        );
        $count = $this->admin_email_model->getEmailCount($search);
        $data['pageurl'] = $this->pagenation->getPage($count, $this->pagesize, 1);
        $list = $this->admin_email_model->getEmailList($search);
        if (!empty($list)) {
            foreach ($list as $k => $v) {
                $list[$k]->creattime = date('Y-m-d H:i:s', $v->creattime);
            }
            $data['list'] = $list;
        }
        $this->load->view('admin/email/list', $data);
    }

    /**
     * 
     * @todo 异步列表 
     * 
     */
    public function ajaxList() {
        $msg = array(
            'flag' => 0,
            'error' => "",
        );
        $nowpage = $this->input->post('nowpage') ? $this->input->post('nowpage') : 1;
        $email = $this->input->post('email');
        $status = $this->input->post('status');
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize
        );
        if ($email != '') {
            $search['email'] = $email;
        }
        if ($status > -1) {
            $search['status'] = $status;
        }
        $count = $this->admin_email_model->getEmailCount($search);
        $page_url = $this->pagenation->getPage($count, $this->pagesize, $nowpage);
        $list = $this->admin_email_model->getEmailList($search);
        if (!empty($list)) {
            foreach ($list as $k => $v) {
                $list[$k]->creattime = date('Y-m-d H:i:s', $v->creattime);
            }
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
     * @todo 载入详情页面 
     * 
     */
    public function detial(){
        $id=$this->uri->segment(3)?$this->uri->segment(3):0;
        if($id>0){
            $new=$this->admin_email_model->getEmailInfo($id);
            if(!empty($new)){
                $data['new']=$new;
                $this->load->view('admin/email/detial', $data);
            }else{
                $this->common->redirect('3','/admin_email/index','获取资讯失败！');
            }
        }else{
            $this->common->redirect('3','/admin_email/index','获取ID失败！');
        }
    }
    
    /**
     * 
     * @todo 删除 
     * 
     */
    public function del(){
        $code_id=  $this->uri->segment(3)?$this->uri->segment(3):0;
        if($code_id==0){
            error('未获取到信息');
        }
        if($this->admin_email_model->delMessageById($code_id)){
            redirect('/admin_email/index');
        }else{
            error('未知错误');
        }
    }

}

?>
