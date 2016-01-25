<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class center extends Home_Controller {

    //put your code here
    const PAGESIZE = 3;
    private $pagesize = 4;

    public function __construct() {
        parent::__construct();
        $this->load->model('center_model');
        $this->load->model('center_point_model');
        $this->load->library('pagenation');
        $this->common->checkMemberLogin();
    }

    /**
     * 
     * @todo 个人中心首页 
     * 
     */
    public function index() {
        $header = array(
            'chosen' => "center",
            'title' => parent::HEADER_TITLE,
            'keywords' => parent::HEADER_KEYWORDS,
            'description' => parent::HEADER_DESCRIPTION
        );
        $id = $this->member->user_id;
        $data['info'] = $this->center_point_model->getPointsInfo($id);
        $data['cout'] = $this->center_model->getOrderCount($id);
        $data['order'] = $this->center_model->getOrdeCount($id);
        //var_dump($data);die;
        if($data['info']->iscate < 3){
            if($data['info']->points >= $data['info']->maxexp){
                $arr = array(
                    'iscate' => intval($data['info']->iscate) + 1
                );
                $this->center_point_model->autoLevelUp($arr,$id);
            }
        }
        $this->loadCenter($header);
        $this->load->view('home/center/index',$data);
        $this->loadFooter();
    }

    /**
     * 
     * @todo 报单首页 
     * 
     */
    public function trade() {
        $header = array(
            'chosen' => "trade",
            'title' => parent::HEADER_TITLE,
            'keywords' => parent::HEADER_KEYWORDS,
            'description' => parent::HEADER_DESCRIPTION
        );
        $this->loadCenter($header);
        $data['cate'] = $this->center_model->getProductCategory();
        $this->load->view('home/center/trade_list', $data);
        $this->loadFooter();
    }

    /**
     * 
     * @todo 保存报单 
     * 
     */
    public function saveOrder() {
        $_data = $this->input->post();
        $data = array(
            'order_sn' => $this->common->createOrderSn(),
            'product_id' => $_data['product_name'] ? $_data['product_name'] : 0,
            'user_id' => isset($this->member->user_id) ? $this->member->user_id : 0,
            'name' => htmlentities($_data['name']),
            'money' => $_data['money'],
            'date' => $_data['date'],
            'real_money' => '',
            'real_date' => '',
            'money_slip' => $_data['money_slip'],
            'bankcard_up' => $_data['bankcard_up'],
            'bankcard_back' => '',
            'idcard_up' => $_data['idcard_up'],
            'idcard_back' => $_data['idcard_back'],
            'signature1' => $_data['signature1'],
            'signature2' => '',
            'remark' => htmlentities($_data['remark']),
            'poster' => $this->member->account,
            'post_time' => time(),
            'status_time' => 0,
            'order_status' => 0,
            'status_remark' => '未审核'
        );
        $msg = array('flag' => 0, 'error' => "");
        if ($data['user_id'] == 0) {
            $msg['error'] = "报单失败，您的登录信息已经失效!";
            echo json_encode($msg);
            exit;
        }
        if ($data['product_id'] == 0) {
            $msg['error'] = "报单失败，您必须选择对应的产品!";
            echo json_encode($msg);
            exit;
        }
        if ($data['name'] == '') {
            $msg['error'] = "报单失败，客户姓名必须填写!";
            echo json_encode($msg);
            exit;
        }
        if ($data['money'] == '') {
            $msg['error'] = "报单失败，打款金额必须填写!";
            echo json_encode($msg);
            exit;
        }
        if ($data['date'] == '') {
            $msg['error'] = "报单失败，打款日期必须填写!";
            echo json_encode($msg);
            exit;
        }
        if (!is_numeric($data['money']) || $data['money'] <= 0) {
            $msg['error'] = "报单失败，打款金额必须是数字，并且大于0!";
            echo json_encode($msg);
            exit;
        }
        if ($data['money_slip'] == '') {
            $msg['error'] = "报单失败，打款凭证必须上传!";
            echo json_encode($msg);
            exit;
        }
        if ($data['idcard_up'] == '') {
            $msg['error'] = "报单失败，身份证正面必须上传!";
            echo json_encode($msg);
            exit;
        }
        if ($data['signature1'] == '') {
            $msg['error'] = "报单失败，签字页必须上传!";
            echo json_encode($msg);
            exit;
        }
        $order_id = $this->center_model->saveMyOrder($data);
        if ($order_id > 0) {
            $msg['flag'] = 1;
            $msg['error'] = "报单成功，跳转到‘我的订单’查看订单状态!";
            echo json_encode($msg);
            exit;
        } else {
            $msg['error'] = "报单失败，发生未知错误!";
            echo json_encode($msg);
            exit;
        }
    }

    /**
     *
     *  @todo 异步获取产品列表 
     * 
     */
    public function ajaxGetProduct() {
        $cate_id = $this->input->post('cate_id') ? $this->input->post('cate_id') : 0;
        $product = $this->center_model->getProductListByCate($cate_id);
        $msg = array('flag' => 0, 'error' => "");
        if (!empty($product)) {
            $msg['flag'] = 1;
            $msg['error'] = $product;
        } else {
            $msg['error'] = '没有对应的产品';
        }
        echo json_encode($msg);
    }

    /**
     * 
     * @todo 修改报单 
     * 
     */
    public function editOrder() {
        echo 'waiting!';
    }

    /**
     * 
     * @todo 合同首页 
     * 
     */
    public function contract() {
        $header = array(
            'chosen' => "contract",
            'title' => parent::HEADER_TITLE,
            'keywords' => parent::HEADER_KEYWORDS,
            'description' => parent::HEADER_DESCRIPTION
        );
        //$nowpage = $this->input->get('page') ? htmlentities($this->input->get('page')) : 1;
        //$search = array(
        //    'id' => $this->member->user_id,
        //    'start' => ($nowpage - 1) * $this->pagesize,
        //    'pagesize' => $this->pagesize
        //);
        //$param = array();
        //$count = $this->center_model->getListCount($search);
        //$data['pagenation'] = $this->pagenation->getContractUrl($count, $this->pagesize, $nowpage, base_url('center/contract'),$param);
        $data['cate'] = $this->center_model->getProductCategory();
        $this->loadCenter($header);
        $data['list'] = $this->center_model->getMyContractList($this->member->user_id);
        $this->load->view('home/center/contract', $data);
        $this->loadFooter();
    }

    /**
     * 
     * @todo 保存合同申请信息 
     * 
     */
    public function saveContract() {
        $_data = $this->input->post();
        $data = array(
            'pid' => $_data['product_name'] ? $_data['product_name'] : 0,
            'user_id' => $this->member->user_id ? $this->member->user_id : 0,
            'username' => htmlentities($_data['username']),
            'celphone' => $_data['celphone'],
            'address' => htmlentities($_data['address']),
            'status' => 1,
            'addtime' => time()
        );
        $msg = array('flag' => 0, 'error' => "");
        if ($data['pid'] == 0) {
            $msg['error'] = "您必须选择一款产品！";
            echo json_encode($msg);
            exit;
        }
        if ($data['user_id'] == 0) {
            $msg['error'] = "您的登录已经失效，请登录后申请！";
            echo json_encode($msg);
            exit;
        }
        if ($data['username'] == '') {
            $msg['error'] = "收货人名字必须填写！";
            echo json_encode($msg);
            exit;
        }
        if ($data['celphone'] == '') {
            $msg['error'] = "手机号码必须填写！";
            echo json_encode($msg);
            exit;
        }
        if ($data['address'] == '') {
            $msg['error'] = "您的收货地址必须填写";
            echo json_encode($msg);
            exit;
        }
        if (!$this->common->checkPhone($data['celphone'])) {
            $msg['error'] = "手机号码不合规范！";
            echo json_encode($msg);
            exit;
        }
        $c_id = $this->center_model->saveContractData($data);
        if ($c_id > 0) {
            $msg['flag'] = 1;
            $msg['error'] = "保存申请成功,请等待我们邮寄的资料！";
            echo json_encode($msg);
            exit;
        } else {
            $msg['error'] = "保存申请失败，未知错误！";
            echo json_encode($msg);
            exit;
        }
    }

    /**
     * 
     * @todo 订单列表
     * 
     */
    public function order() {
        $header = array(
            'chosen' => "order",
            'title' => parent::HEADER_TITLE,
            'keywords' => parent::HEADER_KEYWORDS,
            'description' => parent::HEADER_DESCRIPTION
        );
        $status = $this->input->get('status') ? $this->input->get('status') : 0;
        $search = array(
            'start' => 0,
            'pagesize' => self::PAGESIZE,
            'user_id' => $this->member->user_id
        );
        if ($status < 3) {
            $search['status'] = $status;
        }
        //订单总条数
        $count = $this->center_model->getMyOrderCount($search);
        //订单类表
        $list = $this->center_model->getMyOrderList($search);
        $data['order_wait'] = $this->center_model->getMyOrderStatusCount($this->member->user_id, 0);
        $data['order_success'] = $this->center_model->getMyOrderStatusCount($this->member->user_id, 1);
        $data['order_faild'] = $this->center_model->getMyOrderStatusCount($this->member->user_id, 2);
        $data['order_all'] = $this->center_model->getMyOrderStatusCount($this->member->user_id, 3);
        $data['list'] = $list;
        $data['status'] = $status;
        $this->loadCenter($header);
        $this->load->view('home/center/order', $data);
        $this->loadFooter();
    }

    /**
     * 
     * @todo 佣金首页 
     * 
     */
    public function commission() {
        $header = array(
            'chosen' => "commission",
            'title' => parent::HEADER_TITLE,
            'keywords' => parent::HEADER_KEYWORDS,
            'description' => parent::HEADER_DESCRIPTION
        );
        $this->loadCenter($header);
        $data['user_info'] = $this->center_model->getMyInfo($this->member->user_id);
        $data['tender_log'] = $this->center_model->getMyTenderLogTotal($this->member->user_id);
        $this->load->view('home/center/commission', $data);
        $this->loadFooter();
    }

    /**
     * 
     * @todo 预约首页 
     * 
     */
    public function appointment() {
        $header = array(
            'chosen' => "appointment",
            'title' => parent::HEADER_TITLE,
            'keywords' => parent::HEADER_KEYWORDS,
            'description' => parent::HEADER_DESCRIPTION
        );
        $nowpage = $this->input->get('page') ? htmlentities($this->input->get('page')) : 1;
        $search = array(
            'start' => ($nowpage - 1) * self::PAGESIZE,
            'pagesize' => self::PAGESIZE,
            'user_id' => $this->member->user_id
        );
        $param = array();
        $count = $this->center_model->getMyBookOrderCount($search);
        $list = $this->center_model->getMyBookOrderList($search);
        if (!empty($list)) {
            foreach ($list as $key => $value) {
                $list[$key]->interest_area = $this->common_model->getProductInterest($value->interest_area);
                $list[$key]->tender_area = $this->common_model->getProductTenderArea($value->tender_area);
                $list[$key]->pay_way = $this->common_model->getProductPayWay($value->pay_way);
            }
        }
        $data['pagenation'] = $this->pagenation->getFrontPointUrl($count, self::PAGESIZE, $nowpage, base_url('center/appointment'), $param);
        $data['list'] = $list;
        $this->loadCenter($header);
        $this->load->view('home/center/appointment', $data);
        $this->loadFooter();
    }

}
