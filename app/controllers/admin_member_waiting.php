<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class admin_member_waiting extends  Admin_Controller {
    
    private $pagesize = 10;
    
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->library('pagenation');
        $this->load->model('admin_member_waiting_model');
    }

    /**
     * 
     * 载入待审核用户列表 
     * 
     */
    public function index() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize
        );
        $count = $this->admin_member_waiting_model->getUserCount($search);
        $data['url'] = $this->pagenation->getPage($count, $this->pagesize, 1);
        $data['list'] = $this->admin_member_waiting_model->getUserList($search);
        $this->load->view('admin/member/waiting', $data);
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
        $count = $this->admin_member_waiting_model->getUserCount($search);
        $page_url = $this->pagenation->getPage($count, $this->pagesize, $nowpage);
        $list = $this->admin_member_waiting_model->getUserList($search);
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
     * 用户审核 
     * 
     */
    public function check() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id == 0) {
            echo "审核失败，参数丢失！";
            exit();
        }
        $data = array(
                'ischeck' => 1,
            );
        if ($this->admin_member_waiting_model->checkMemberById($data,$id)) {
            exit();
        } else {
            echo "审核失败，错误未知！";
            exit();
        }
    }
}