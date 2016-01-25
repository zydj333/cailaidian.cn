<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_order
 *
 * @createtime 2015-7-15 13:30:49
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_order
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_order extends Admin_Controller {

    protected $pagesize = 10;

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_order_model');
        $this->load->model('admin_product_model');
        $this->load->library('pagenation');
    }

    /**
     * 
     * @todo 载入报单列表 
     * 
     */
    public function index() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize
        );
        $count = $this->admin_order_model->getOrderCount($search);
        $list = $this->admin_order_model->getOrderList($search);
        $pageurl = $this->pagenation->getPage($count, $this->pagesize, 1);
        $data['list'] = $list;
        $data['page_url'] = $pageurl;
        $this->load->view('admin/order/list', $data);
    }

    /**
     * 
     * @todo 异步获取报单列表 
     * 
     */
    public function ajaxList() {
        $nowpage = $this->input->post('nowpage') ? $this->input->post('nowpage') : 1;
        $order_sn = $this->input->post('order_sn');
        $username = $this->input->post('username');
        $order_status = $this->input->post('order_status');
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize
        );
        if ($order_sn != '') {
            $search['order_sn'] = $order_sn;
        }
        if ($username != '') {
            $search['username'] = $username;
        }
        if ($order_status > -1) {
            $search['order_status'] = $order_status;
        }
        $count = $this->admin_order_model->getOrderCount($search);
        $list = $this->admin_order_model->getOrderList($search);
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
            $data['error'] = '没有获取到对应条件下的数据!';
            $data['pageurl'] = '获取到0条数据';
        }
        echo json_encode($data);
        exit;
    }

    /**
     * 
     * @todo 进行订单处理操作 
     * 
     */
    public function delOrder() {
        $order_id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($order_id == 0) {
            echo "载入详情失败，参数错误！";
            exit;
        }
        $order = $this->admin_order_model->getOrderDetial($order_id);
        if (empty($order)) {
            echo "没有获取到对应的订单信息！";
            exit;
        }
        $product = $this->admin_product_model->getProductById($order->product_id);
        $data['order'] = $order;
        $data['product'] = $product;
        $this->load->view('admin/order/delorder', $data);
    }

    /**
     * 
     * @todo 进行数据处理 
     * 
     */
    public function dodeal() {
        $order_id = $this->input->post('order_id') ? $this->input->post('order_id') : 0;
        $status = $this->input->post('status') ? $this->input->post('status') : 0;
        $status_remark = $this->input->post('status_remark');
        $money = $this->input->post('money');
        $msg = array('flag' => 0, 'error' => "");
        if ($order_id == 0) {
            $msg['error'] = "订单ID丢失，无法进行处理!";
            echo json_encode($msg);
            exit;
        }
        if ($status == 0) {
            $msg['error'] = "审核状态没有选择，无法进行处理!";
            echo json_encode($msg);
            exit;
        }
        if ($status_remark == '') {
            $msg['error'] = "理由没有进行填写，无法进行处理!";
            echo json_encode($msg);
            exit;
        }
        if ($status == 1 && $money == '') {
            $msg['error'] = "当审核通过时，佣金必须计算后进行填写!";
            echo json_encode($msg);
            exit;
        }
        if ($status == 1 && !is_numeric($money)) {
            $msg['error'] = "填写的金额只能是数字，可以是小数!";
            echo json_encode($msg);
            exit;
        }
        if ($money < 0) {
            $msg['error'] = "只能填写大于0的数字，可以是小数!";
            echo json_encode($msg);
            exit;
        }
        //获取订单详情
        $order = $this->admin_order_model->getOrderDetial($order_id);
        if (empty($order)) {
            $msg['error'] = "没有获取到对应的订单信息!";
            echo json_encode($msg);
            exit;
        }
        //获取用户信息
        $member = $this->admin_order_model->getUserInfo($order->user_id);
        if (empty($member)) {
            $msg['error'] = "没有获取到对应的理财师信息!";
            echo json_encode($msg);
            exit;
        }
        $data = array(
            'status_time' => time(),
            'order_status' => $status,
            'status_remark' => $status_remark,
            'fee'=>$money
        );
        //开始事务
        $this->db->trans_begin();
        //修改报单状态
        if ($this->admin_order_model->editOrderStatus($data, $order_id)) {
            //审核通过时
            if ($status == 1 && $money > 0) {
                //修改用户帐户余额
                $user_data = array(
                    'turnover' => bcadd($member->turnover, $order->money, 2),
                    'commission' => bcadd($member->commission, $money, 2),
                    'available_predeposit' => bcadd($member->available_predeposit, $money, 2)
                );
                //保存资金修改
                if ($this->admin_order_model->saveUserInfo($user_data, $order->user_id)) {
                    //生成资金变动记录
                    $log = array(
                        'uid' => $order->user_id,
                        'amount' => $member->available_predeposit,
                        'money' => $money,
                        'total' => bcadd($member->available_predeposit, $money, 2),
                        'frozen' => $member->freeze_predeposit,
                        'type' => 'order',
                        'content' => '订单(ID:' . $order->id . ',编号:' . $order->order_sn . '金额:' . $order->money . ')报单审核成功,后台发放' . $money . '佣金',
                        'createtime' => time()
                    );
                    $log_id = $this->admin_order_model->saveUserAccountLog($log);
                    if ($log_id > 0) {
                        //结束事务
                        $this->db->trans_commit();
                        $msg['flag'] = 1;
                        $msg['error'] = "审核该订单信息成功!";
                    } else {
                        $this->db->trans_rollback();
                        $msg['error'] = "审核失败，无法生成资金变动记录!";
                    }
                } else {
                    $this->db->trans_rollback();
                    $msg['error'] = "审核失败，修改用户资金失败!";
                }
            } else {
                //结束事务
                $this->db->trans_commit();
                $msg['flag'] = 1;
                $msg['error'] = "审核成功";
            }
        } else {
            //事务回滚
            $this->db->trans_rollback();
            $msg['error'] = "审核失败，未知错误!";
        }
        echo json_encode($msg);
        exit;
    }

}
