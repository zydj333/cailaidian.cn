<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of star 理财师控制器
 *
 * @createtime 2015-7-17 13:51:48
 * 
 * @author ZhangPing'an
 * 
 * @todo star
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class star extends Home_Controller {

    const PAGESIZE = 12;

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('star_model');
        $this->load->model('center_product_model');
        $this->load->library('pagenation');
    }

    /**
     * 
     * @todo 载入理财师首页
     * 
     */
    public function index() {
        $header = array(
            'chosen' => "star",
            'title' => parent::HEADER_TITLE,
            'keywords' => parent::HEADER_KEYWORDS,
            'description' => parent::HEADER_DESCRIPTION
        );
        $this->loadHeader($header);
        $nowpage = $this->input->get('page') ? htmlentities($this->input->get('page')) : 1;
        $province = $this->input->get('province') ? htmlentities($this->input->get('province')) : -1;
        $order = $this->input->get('order') ? htmlentities($this->input->get('order')) : 0;
        $search = array(
            'start' => ($nowpage - 1) * self::PAGESIZE,
            'pagesize' => self::PAGESIZE,
            'province' => $province,
            'order' => $order
        );
        $param = array(
            'province' => $province,
            'order' => $order
        );
        $count = $this->star_model->getStarCount($search);
        $data['list'] = $this->star_model->getStarList($search);
        if(!empty($data['list'])){
            foreach ($data['list'] as $key=>$value){
                $data['list'][$key]->truename=  $this->common->cut_str($value->truename,1,0);
            }
        }
        //获取分页信息
        $data['pagenation'] = $this->pagenation->getFrontStarUrl($count, self::PAGESIZE, $nowpage, base_url('star/index'), $param);
        $data['search'] = $search;
        $data['province'] = $this->common_model->getProvinceCityArea(0);
        $data['province_name'] = $this->common_model->getAreaInfoById($province);
        $this->load->view('home/star/list', $data);
        $this->loadFooter();
    }

    /**
     * 
     * @todo 在入理财师详情 
     * 
     */
    public function starList() {
        $header = array(
            'chosen' => "star",
            'title' => parent::HEADER_TITLE,
            'keywords' => parent::HEADER_KEYWORDS,
            'description' => parent::HEADER_DESCRIPTION
        );
        $this->loadHeader($header);
        $iser_id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($iser_id == 0) {
            show_404();
            exit;
        }
        //获取用户个人信息
        $member = $this->star_model->getMemberInfo($iser_id);
        if(empty($member)){
            show_404();
            $this->loadFooter();
            exit;
        }
        if (!empty($member)) {
             $member->truename=  $this->common->cut_str($member->truename,1,0);
            if ($member->province_id > 0) {
                $province = $this->common_model->getAreaInfoById($member->province_id);
                $member->province_id = $province->name;
            }
            if ($member->city_id > 0) {
                $city = $this->common_model->getAreaInfoById($member->city_id);
                $member->city_id = $city->name;
            }
        }
        $nowpage = $this->input->get('page') ? $this->input->get('page') : 1;
        $search = array(
            'start' => ($nowpage - 1) * self::PAGESIZE,
            'pagesize' => self::PAGESIZE,
            'user_id' => $iser_id
        );
        $count = $this->center_product_model->getProductCount($search);
        $list = $this->center_product_model->getProductList($search);
        //获取分页信息
        $data['pagenation'] = $this->pagenation->getFrontStarUrl($count, self::PAGESIZE, $nowpage, base_url('star/starList').'/'.$iser_id,array());
        if (!empty($list)) {
            foreach ($list as $key => $value) {
                $list[$key]->earning = $this->common_model->getProductEarning($value->earning);
            }
        }
        $data['member'] = $member;
        $data['list'] = $list;
        $this->load->view('home/star/starlist', $data);
        $this->loadFooter();
    }

    /**
     *
     * @todo 载入理财师产品详情 
     * 
     */
    public function detial() {
        $header = array(
            'chosen' => "star",
            'title' => parent::HEADER_TITLE,
            'keywords' => parent::HEADER_KEYWORDS,
            'description' => parent::HEADER_DESCRIPTION
        );
        $this->loadHeader($header);
        $product_id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($product_id == 0) {
            show_404();
            exit;
        }
        //获取产品详情
        $product = $this->star_model->getStarProductDetial($product_id);
        if (empty($product)) {
            show_404();
            exit;
        }
        $product->earning = $this->common_model->getProductEarning($product->earning);
        $product->pay_way = $this->common_model->getProductPayWay($product->pay_way);
        $product->tender_area = $this->common_model->getProductTenderArea($product->tender_area);
        $data['product'] = $product;
        $this->load->view('home/star/detial', $data);
        $this->loadFooter();
    }

    /**
     * 
     * @todo 发送站内信 
     * 
     */
    public function sendSiteLetter() {
        $_data = $this->input->post();
        $data = array(
            'to_uid' => $_data['to_user_id'] ? $_data['to_user_id'] : 0,
            'to_username' => "",
            'message' => htmlentities($_data['content']),
            'contact_type' => $_data['my_contact_type'] ? $_data['my_contact_type'] : 1,
            'contact_value' => htmlentities($_data['contact_value']),
            'from_uid' => isset($this->member->user_id) ? $this->member->user_id : 0,
            'from_username' => isset($this->member->user_id) ? $this->member->account : '',
            'status' => 0,
            'sendtime' => time()
        );
        $msg = array('flag' => 0, 'error' => "");
        if ($data['from_uid'] == '' || $data['from_uid'] == 0) {
            $msg['error'] = "无法发送站内信，您还没有进行登录！";
            echo json_encode($msg);
            exit;
        }

        if ($data['to_uid'] == 0) {
            $msg['error'] = "无法发送站内信，参数错误！";
            echo json_encode($msg);
            exit;
        }
        $member = $this->star_model->getMemberAccount($data['to_uid']);
        if (!empty($member)) {
            $data['to_username'] = $member->account;
        }
        if ($data['message'] == '') {
            $msg['error'] = "发送的站内信数据不可以为空！";
            echo json_encode($msg);
            exit;
        }
        if ($data['contact_value'] == '') {
            $msg['error'] = "您的联系方式不可以为空！";
            echo json_encode($msg);
            exit;
        }
        if ($data['contact_type'] == 1) {
            if (!$this->common->checkPhone($data['contact_value'])) {
                $msg['error'] = "您的手机号码格式不正确！";
                echo json_encode($msg);
                exit;
            }
        }
        if ($data['contact_type'] == 3) {
            if (!$this->common->is_email($data['contact_value'])) {
                $msg['error'] = "您的邮箱地址格式不正确！";
                echo json_encode($msg);
                exit;
            }
        }
        //入库
        $letter_id = $this->star_model->saveMyLettler($data);
        if ($letter_id > 0) {
            $msg['flag'] = 1;
            $msg['error'] = "发送站内信成功！";
            echo json_encode($msg);
            exit;
        } else {
            $msg['error'] = "发送站内信失败，错误未知！";
            echo json_encode($msg);
            exit;
        }
    }

    /**
     * 
     * @todo 获取用户的二维码 
     * 
     */
    public function getStarWechat() {
        $uid = $this->input->post('uid') ? $this->input->post('uid') : 0;
        $msg = array('flag' => 0, 'error' => "");
        if ($uid == 0) {
            $msg['error'] = "用户参数丢失!";
            echo json_encode($msg);
            exit;
        }
        //获取用户个人信息
        $member = $this->star_model->getMemberInfo($uid);
        if (empty($member)) {
            $msg['error'] = "没有获取到数据!";
            echo json_encode($msg);
            exit;
        }
        if ($member->wechat_url == '') {
            $msg['error'] = "用户没有上传微信二维码!";
            echo json_encode($msg);
            exit;
        }
        $msg['flag'] = 1;
        $msg['error'] = $member->wechat_url;
        echo json_encode($msg);
        exit;
    }

}
