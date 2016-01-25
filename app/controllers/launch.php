<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of launch  上传产品控制器
 *
 * @createtime 2015-7-17 15:32:56
 * 
 * @author ZhangPing'an
 * 
 * @todo launch
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class launch extends Home_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('launch_model');
        $this->load->library('pagenation');
        $this->common->checkMemberLogin();
    }

    /**
     * 
     * @todo 载入上传 
     * 
     */
    public function index() {
        $header = array(
            'chosen' => "launch",
            'title' => parent::HEADER_TITLE,
            'keywords' => parent::HEADER_KEYWORDS,
            'description' => parent::HEADER_DESCRIPTION
        );
        $this->loadHeader($header);
        //获取产品系列 
        $data['category'] = $this->common_model->getProductCategory();
        //收益类型
        $data['earning'] = $this->common_model->getProductEarning(0);
        //付息方式
        $data['payway'] = $this->common_model->getProductPayWay(0);
        //投资领域
        $data['area'] = $this->common_model->getProductTenderArea(0);
        //获取省份
        $data['province'] = $this->common_model->getProvinceCityArea(0);
        $this->load->view('home/launch/index', $data);
        $this->loadFooter();
    }

    /**
     * 
     * @todo 添加产品信息 
     * 
     */
    public function saveProduct() {
        $_data = $this->input->post();
        $data = array(
            'user_id' => $this->member->user_id ? $this->member->user_id : 0,
            'username' => $this->member->account,
            'category' => $_data['category'] ? $_data['category'] : 0,
            'category_name' => '',
            'province' => $_data['province'] ? $_data['province'] : 0,
            'province_name' => '',
            'city' => $_data['city'] ? $_data['city'] : 0,
            'city_name' => '',
            'product_name' => htmlentities($_data['product_name']),
            'company' => htmlentities($_data['company']),
            'support_limit' => htmlentities($_data['support_limit']),
            'month' => htmlentities($_data['month']),
            'amount' => htmlentities($_data['amount']),
            'tender_area' => $_data['tender_area'] ? $_data['tender_area'] : 0,
            'interest' => htmlentities($_data['interest']),
            'pay_way' => $_data['pay_way'] ? $_data['pay_way'] : 0,
            'interest_detial' => htmlentities($_data['interest_detial']),
            'earning' => $_data['earning'] ? $_data['earning'] : 0,
            'fee' => htmlentities($_data['fee']),
            'account' => htmlentities($_data['account']),
            'use_for' => htmlentities($_data['use_for']),
            'repayment_from' => htmlentities($_data['repayment_from']),
            'risk_control' => htmlentities($_data['risk_control']),
            'highlights' => htmlentities($_data['highlights']),
            'status' => 0,
            'is_del' => 0,
            'createtime' => time()
        );
        $msg = array('flag' => 0, 'error' => "");
        if ($data['user_id'] == 0) {
            $msg['error'] = "很抱歉，您的登录已经失效，需要重新登录后操作！";
            echo json_encode($msg);
            exit;
        }
        if ($data['category'] == 0) {
            $msg['error'] = "保存失败，您没有选择产品分类！";
            echo json_encode($msg);
            exit;
        }
        if ($data['product_name'] == '') {
            $msg['error'] = "保存失败，您没有填写产品名称！";
            echo json_encode($msg);
            exit;
        }
        if ($data['company'] == '') {
            $msg['error'] = "保存失败，您没有填写产品发行机构！";
            echo json_encode($msg);
            exit;
        }
        if ($data['support_limit'] == '' || !is_numeric($data['support_limit'])) {
            $msg['error'] = "保存失败，投资门槛必须为数字！";
            echo json_encode($msg);
            exit;
        }
        if ($data['month'] == '' || !is_numeric($data['month'])) {
            $msg['error'] = "保存失败，期限只能为数字！";
            echo json_encode($msg);
            exit;
        }
        if ($data['amount'] == '' || !is_numeric($data['amount'])) {
            $msg['error'] = "保存失败,资金总额只能问数字！";
            echo json_encode($msg);
            exit;
        }
        if ($data['tender_area'] == 0) {
            $msg['error'] = "您必须选择投资领域！";
            echo json_encode($msg);
            exit;
        }
        if ($data['interest'] == '') {
            $msg['error'] = "您必须填写收益率！";
            echo json_encode($msg);
            exit;
        }
        if ($data['pay_way'] == 0) {
            $msg['error'] = "您必须选择付息方式！";
            echo json_encode($msg);
            exit;
        }
        if ($data['interest_detial'] == '') {
            $msg['error'] = "您必须填写收益明细！";
            echo json_encode($msg);
            exit;
        }
        if ($data['earning'] == 0) {
            $msg['error'] = "您必须选择收益类型！";
            echo json_encode($msg);
            exit;
        }
        if ($data['fee'] == '') {
            $msg['error'] = "发行费用必须填写！";
            echo json_encode($msg);
            exit;
        }
        if ($data['account'] == '') {
            $msg['error'] = "募资账户不可以为空！";
            echo json_encode($msg);
            exit;
        }
        if ($data['use_for'] == '') {
            $msg['error'] = "自己用途不可以为空！";
            echo json_encode($msg);
            exit;
        }
        if ($data['repayment_from'] == '') {
            $msg['error'] = "还款来源不可以为空！";
            echo json_encode($msg);
            exit;
        }
        if ($data['risk_control'] == '') {
            $msg['error'] = "风控措施必须填写！";
            echo json_encode($msg);
            exit;
        }
        if ($data['highlights'] == '') {
            $msg['error'] = "项目亮点必须填写！";
            echo json_encode($msg);
            exit;
        }
        //获取项目分类
        $cate = $this->common_model->getProductCategoryDetial($data['category']);
        if (!empty($cate)) {
            $data['category_name'] = $cate->title;
        }
        $province = $this->common_model->getAreaInfoById($data['province']);
        if (!empty($province)) {
            $data['province_name'] = $province->name;
        }
        $city = $this->common_model->getAreaInfoById($data['city']);
        if (!empty($city)) {
            $data['city_name'] = $city->name;
        }
        $p_id = $this->launch_model->saveProductData($data);
        if ($p_id > 0) {
            $msg['flag'] = 1;
            $msg['error'] = "保存成功，请耐心等待管理员审核！";
            echo json_encode($msg);
            exit;
        } else {
            $msg['error'] = "保存失败，发送未知错误！";
            echo json_encode($msg);
            exit;
        }
    }

}
