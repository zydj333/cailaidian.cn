<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_planner
 *
 * @createtime 2015-7-21 10:12:48
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_planner
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_planner extends Admin_Controller {

    protected $pagesize = 10;

    public function __construct() {
        parent::__construct();
        $this->load->model('admin_planner_model');
        $this->load->library('pagenation');
    }

    /**
     * 
     * @todo 载入理财师列表 
     * 
     */
    public function index() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize
        );
        $count = $this->admin_planner_model->getPlannerCount($search);
        $list = $this->admin_planner_model->getPlannerList($search);
        $page_url = $this->pagenation->getPage($count, $this->pagesize, 1);
        $data['province'] = $this->common_model->getProvinceCityArea(0);
        $data['list'] = $list;
        $data['page_url'] = $page_url;
        $this->load->view('admin/planner/list', $data);
    }

    /**
     *
     * @todo 异步获取理财师列表 
     * 
     */
    public function ajaxList() {
        $nowpage = $this->input->post('nowpage') ? $this->input->post('nowpage') : 1;
        $cellphone = $this->input->post('cellphone');
        $username = $this->input->post('username');
        $province = $this->input->post('province') ? $this->input->post('province') : 0;
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize
        );
        if ($cellphone != '') {
            $search['cellphone'] = $cellphone;
        }
        if ($username != '') {
            $search['username'] = $username;
        }
        if ($province > 0) {
            $search['province'] = $province;
        }
        $msg = array('flag' => 0, 'error' => "");
        $count = $this->admin_planner_model->getPlannerCount($search);
        $list = $this->admin_planner_model->getPlannerList($search);
        $page_url = $this->pagenation->getPage($count, $this->pagesize, $nowpage);
        if ($count > 0) {
            $msg['flag'] = 1;
            $msg['error'] = $list;
            $msg['pageurl'] = $page_url;
        } else {
            $msg['error'] = '没有获取到对应条件下的数据!';
            $msg['pageurl'] = '获取到0条数据';
        }
        echo json_encode($msg);
        exit;
    }

    /**
     * 
     * @todo 获取理财师详情
     * 
     */
    public function showDetial() {
        $user_id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($user_id == 0) {
            echo "获取用户参数失败，无法查看该用户详细信息!";
        }
        //获取个人信息基本信息
        $data['member'] = $this->admin_planner_model->getMemberLoginList($user_id);
        $data['detial'] = $this->admin_planner_model->getMemberInfo($user_id);
        $data['list'] = $this->admin_planner_model->getMemberProductList($user_id);
        $this->load->view('admin/planner/detial',$data);
    }

}
