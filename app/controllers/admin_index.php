<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_index
 *
 * @createtime 2015-6-16 15:00:31
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_index
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_index extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('admin_index_model');
        $this->load->model('admin_system_model');
    }

    /**
     * 
     * @todo 载入首页 
     * 
     */
    public function index() {
        $this->load->view('admin/public/index');
    }

    /**
     * 
     * @todo 载入头部 
     * 
     */
    public function top() {
        $data['userinfo']=  $this->userinfo;
        $this->load->view('admin/public/top',$data);
    }

    /**
     * 
     * @todo 载入菜单栏 
     * 
     */
    public function left() {
        $data['userinfo']=  $this->userinfo;
        //一级模块
        $list = $this->admin_system_model->getSystemList(0);
        if (!empty($list)) {
            //获取二级模块
            foreach ($list as $key => $value) {
                $list[$key]->second = $this->admin_system_model->getSystemList($value->id);
            }
        }
        $data['list'] = $list;
        $this->load->view('admin/public/left',$data);
    }

    /**
     * 
     * @todo 载入正文 
     * 
     */
    public function main() {
        $data['userinfo']=  $this->userinfo;
        $data['yesterday']=  $this->admin_index_model->yesterday();
        $data['week']=  $this->admin_index_model->week();
        $data['yesorder']=  $this->admin_index_model->yesterdayOrder();
        $data['weekorder']=  $this->admin_index_model->weekOrder();
        $data['count']=  $this->admin_index_model->getCount();
        $data['pro']=  $this->admin_index_model->getProduct();
        $data['order']=  $this->admin_index_model->getOrder();
        $data['message']=  $this->admin_index_model->getMessage();
        $data['num'] = $this->admin_index_model->getMoney();
        $data['mysql'] = $this->admin_index_model->getMysql();
        $this->load->view('admin/public/main',$data);
    }

}
