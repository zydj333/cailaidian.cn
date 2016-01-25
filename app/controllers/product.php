<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of product
 *
 * @createtime 2015-7-7 15:44:32
 * 
 * @author ZhangPing'an
 * 
 * @todo product
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class product extends Home_Controller {

    const TRUST = 1;
    const PLAN = 5;
    const PRIVATESUN = 6;
    const INSURANCE = 7;
    const PAGESIZE = 5;
    const TRUST_CHOSEN = "trust";
    const PLAN_CHOSEN = "plan";
    const PRIVATESUN_CHOSEN = "privatesun";
    const INSURANCE_CHOSEN = "insurance";

    public function __construct() {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->library('pagenation');
    }

    /**
     * 
     * @todo 载入产品首页 (信托产品)
     * 
     */
    public function index() {
        $param = array(
            'cate' => $this->input->get('cate') ? htmlentities($this->input->get('cate')) : 0,
            'status' => $this->input->get('status') ? htmlentities($this->input->get('status')) : 0,
            'date_area' => $this->input->get('date_area') ? htmlentities($this->input->get('date_area')) : 0,
            'fee' => $this->input->get('fee') ? htmlentities($this->input->get('fee')) : 0,
            'interest' => $this->input->get('interest') ? htmlentities($this->input->get('interest')) : 0,
            'province' => $this->input->get('province') ? htmlentities($this->input->get('province')) : 0,
            'tender_area' => $this->input->get('tender_area') ? htmlentities($this->input->get('tender_area')) : 0,
            'pay_way' => $this->input->get('pay_way') ? htmlentities($this->input->get('pay_way')) : 0,
            'comparison' => $this->input->get('comparison') ? htmlentities($this->input->get('comparison')) : 0,
            'level' => $this->input->get('level') ? htmlentities($this->input->get('level')) : 0,
            'order' => htmlentities($this->input->get('order'))
        );
        $nowpage = $this->input->get('page') ? htmlentities($this->input->get('page')) : 1;
        $header = array(
            'chosen' => $this->getChosen($param['cate']),
            'title' => parent::HEADER_TITLE,
            'keywords' => parent::HEADER_KEYWORDS,
            'description' => parent::HEADER_DESCRIPTION
        );
        $this->loadHeader($header);
        //用户信息
        $data['memeber'] = $this->member;
        //分类信息
        $data['category'] = $this->product_model->getCategoryList();
        //选中分类
        $data['cateinfo'] = $this->product_model->getCateInfoById($param['cate']);
        //产品期限区间
        $data['deadline'] = $this->common_model->getProductDeadline(0);
        //发行费用区间
        $data['issucost'] = $this->common_model->getProductIssuCost(0);
        //收益率  
        $data['interest'] = $this->common_model->getProductInterest(0);
        //收益类型
        $data['earning'] = $this->common_model->getProductEarning(0);
        //付息方式
        $data['payway'] = $this->common_model->getProductPayWay(0);
        //投资领域
        $data['area'] = $this->common_model->getProductTenderArea(0);
        //大小配比
        $data['comparison'] = $this->common_model->getProductComparison(0);
        //获取评级
        $data['level'] = $this->common_model->getProductLevel(0);
        //获取省份
        $data['province'] = $this->common_model->getProvinceCityArea(0);
        $data['params'] = $param;
        $search = $param;
        $search['start'] = ($nowpage - 1) * self::PAGESIZE;
        $search['pagesize'] = self::PAGESIZE;
        //获取产品总条数
        $count = $this->product_model->getProductCount($search);
        //获取数据列表
        $list = $this->product_model->getProductList($search);
        if (!empty($list)) {
            foreach ($list as $key => $value) {
                $list[$key]->tender_area = $this->common_model->getProductTenderArea($value->tender_area);
                $list[$key]->interest_area = $this->common_model->getProductInterest($value->interest_area);
                $list[$key]->pay_way = $this->common_model->getProductPayWay($value->pay_way);
                $list[$key]->items = $this->product_model->getProductItemsByPid($value->id);
            }
        }
        //获取分页信息
        $data['pagenation'] = $this->pagenation->getFrontPageUrl($count, self::PAGESIZE, $nowpage, base_url('product/index'), $param);
        $data['product'] = $list;
        $this->load->view('home/product/list', $data);
        $this->loadFooter();
    }

    /**
     * 
     * @todo 载入产品详情 
     * 
     */
    public function detial() {
        $product_id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        $product = $this->product_model->getProductDetial($product_id);
        if (!empty($product)) {
            $header = array(
                'chosen' => $this->getChosen($product->category),
                'title' => ($product->seo_title != '') ? $product->seo_title : parent::HEADER_TITLE,
                'keywords' => ($product->seo_keyword != '') ? $product->seo_keyword : parent::HEADER_KEYWORDS,
                'description' => ($product->seo_description != '') ? $product->seo_description : parent::HEADER_DESCRIPTION
            );
            $this->loadHeader($header);
            //修改浏览次数
            $this->common_model->editProductViewsTimes($product_id);
            //获取产品子项
            $product->items = $this->product_model->getProductItemsByPid($product->id);
            //投资领域
            $product->tender_area = $this->common_model->getProductTenderArea($product->tender_area);
            //发行费用区间
            $product->fee_area = $this->common_model->getProductIssuCost($product->fee_area);
            //收益率
            $product->interest_area = $this->common_model->getProductInterest($product->interest_area);
            //付息方式
            $product->pay_way = $this->common_model->getProductPayWay($product->pay_way);
            //大小匹配
            $product->comparison = $this->common_model->getProductComparison($product->comparison);
            //收益类型
            $product->earning = $this->common_model->getProductEarning($product->earning);
            //时间区间
            $product->month_area = $this->common_model->getProductDeadline($product->month_area);
            //项目评级
            $product->level = $this->common_model->getProductLevel($product->level);
            $data['product'] = $product;
            $data['member'] = $this->member;
            $this->load->view('home/product/detial', $data);
            $this->loadFooter();
        } else {
            show_404();
        }
    }

    /**
     * 
     * @todo  获取产品邮件
     * 
     */
    public function getProductMail() {
        $product_id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($product_id > 0) {
            $data['product_id'] = $product_id;
            $this->load->view('home/product/mail', $data);
        } else {
            echo "产品参数丢失！无法发送邮件";
        }
    }

    /**
     * 
     * @todo 发送邮件信息
     * 
     */
    public function sendEmail() {
        $product_id = $this->input->post('product_id') ? $this->input->post('product_id') : 0;
        $email = $this->input->post('email');
        $msg = array('flag' => 0, 'error' => "");
        if ($product_id == 0) {
            $msg['error'] = "产品编号丢失，无法发送邮件!";
            echo json_encode($msg);
            exit;
        }
        if (!$this->common->is_email($email)) {
            $msg['error'] = "邮箱格式不正确！";
            echo json_encode($msg);
            exit;
        }
        //获取产品信息
        $product = $this->product_model->getProductDetial($product_id);
        if (empty($product)) {
            $msg['error'] = "没有找到相应的产品信息，发送失败！";
            echo json_encode($msg);
            exit;
        }
        //获取邮件正文内容
        $get_url = base_url('product/getProductEmailTemplate') . '/' . $product_id;
        $content = file_get_contents($get_url);
        //发送邮件
        $config = Array(
            'protocol' => "smtp",
            'smtp_host' => "smtp.163.com",
            'smtp_port' => 25,
            'smtp_user' => '563775430@163.com',
            'smtp_pass' => 'aa_563775430',
            'wordwrap' => TRUE,
            'smtp_fromName' => '财来电',
            'smtp_from' => '563775430@163.com'
        );
        $result = $this->send($email, '产品资料_' . $product->product_name, $content, $config);
        if ($result) {
            //修改产品的邮件发送次数
            $this->common_model->editProductMailTimes($product_id);
            $msg['flag'] = 1;
            $msg['error'] = "发送成功，如果您还没有收到，可能是因为邮件服务器的延迟！";
            echo json_encode($msg);
            exit;
        } else {
            $msg['error'] = "发送失败,错误未知！";
            echo json_encode($msg);
            exit;
        }
    }

    /**
     * 
     * @todo 获取邮件的正文内容 
     * 
     */
    public function getProductEmailTemplate() {
        $product_id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        $product = $this->product_model->getProductDetial($product_id);
        //获取产品子项
        $product->items = $this->product_model->getProductItemsByPid($product->id);
        //投资领域
        $product->tender_area = $this->common_model->getProductTenderArea($product->tender_area);
        //发行费用区间
        $product->fee_area = $this->common_model->getProductIssuCost($product->fee_area);
        //收益率
        $product->interest_area = $this->common_model->getProductInterest($product->interest_area);
        //付息方式
        $product->pay_way = $this->common_model->getProductPayWay($product->pay_way);
        //大小匹配
        $product->comparison = $this->common_model->getProductComparison($product->comparison);
        //收益类型
        $product->earning = $this->common_model->getProductEarning($product->earning);
        //时间区间
        $product->month_area = $this->common_model->getProductDeadline($product->month_area);
        //项目评级
        $product->level = $this->common_model->getProductLevel($product->level);
        $data['product'] = $product;
        $this->load->view('home/product/mailtemp', $data);
    }

    /**
     * 
     * @todo 发送邮件 
     * 
     */
    public function send($to, $subject, $message, $config) {
        if ($to != '' && $subject != '' && $message != "") {
            //抽空补上，$to邮箱验证
            $_config = Array(
                'protocol' => $config['protocol'],
                'smtp_host' => $config['smtp_host'],
                'smtp_port' => $config['smtp_port'],
                'smtp_user' => $config['smtp_user'],
                'smtp_pass' => $config['smtp_pass'],
                'wordwrap' => $config['wordwrap'],
                'charset' => "utf-8",
                'mailtype' => 'html'
            );
            $this->load->library('email', $_config);
            $this->email->set_newline("/r/n");
            $this->email->from($config['smtp_from'], $config['smtp_fromName']);
            $this->email->to($to);
            $this->email->subject($subject);
            $this->email->message($message);
            //print_r($_config);exit;
            if ($this->email->send()) {
                return true;
            } else {
                return false;
                show_error($this->CI->email->print_debugger());
            }
        } else {
            return false;
        }
    }

    /**
     * 
     * @todo 在线预约检查  
     * 
     */
    public function checkBoot() {
        $_data = $this->input->post();
        $data = array(
            'order_sn' => $this->common->createOrderSn(),
            'pid' => $_data['product_id'] ? $_data['product_id'] : 0,
            'uid' => $this->member->user_id ? $this->member->user_id : 0,
            'username' => htmlentities($_data['username']),
            'telephone' => htmlentities($_data['cellphone']),
            'amount' => htmlentities($_data['amount']),
            'description' => htmlentities($_data['description']),
            'createtime' => time(),
            'is_success' => 0
        );
        $msg = array('flag' => 0, 'error' => "");
        if ($data['pid'] == 0) {
            $msg['error'] = "产品数据丢失，无法进行预约!";
            echo json_encode($msg);
            exit;
        }
        if ($data['uid'] == 0) {
            $msg['error'] = "登录信息获取失败，无法进行预约!";
            echo json_encode($msg);
            exit;
        }
        if ($data['username'] == '') {
            $msg['error'] = "客户姓名不能为空!";
            echo json_encode($msg);
            exit;
        }
        if ($data['telephone'] == '') {
            $msg['error'] = "您的手机号码不可以为空!";
            echo json_encode($msg);
            exit;
        }
        if (!$this->common->checkPhone($data['telephone'])) {
            $msg['error'] = "您的手机号码格式不正确!";
            echo json_encode($msg);
            exit;
        }
        if ($data['amount'] == '') {
            $msg['error'] = "预约金额不能为空!";
            echo json_encode($msg);
            exit;
        }
        //根据产品ID获取产品详情
        $product = $this->product_model->getProductDetial($data['pid']);
        if (empty($product)) {
            $msg['error'] = "获取产品信息失败，无法进行预约!";
            echo json_encode($msg);
            exit;
        }
        if ($product->support_limit > $data['amount']) {
            $msg['error'] = "预约的最小金额不能小于:" . $product->support_limit . '万';
            echo json_encode($msg);
            exit;
        }
        if (($product->support_amount + $data['amount']) > $product->amount) {
            $msg['error'] = "预约金额不能大于剩余可投额度:" . ($product->amount - $product->support_amount) . '万';
            echo json_encode($msg);
            exit;
        }
        //保存数据
        $order_id = $this->product_model->saveProductOrder($data);
        if ($order_id > 0) {
            //修改产品的邮件发送次数
            $this->common_model->editProductSupportTimes($data['pid']);
            $msg['flag'] = 1;
            $msg['error'] = "保存预约成功，正跳转到个人中心订单列表！";
            echo json_encode($msg);
            exit;
        } else {
            $msg['error'] = "保存数据失败，发生未知错误！";
            echo json_encode($msg);
            exit;
        }
    }

    /**
     * 
     * @todo 产品搜索 
     * 
     */
    public function search() {
        $keyword = htmlentities($this->input->post('keywords'));
        if ($keyword == '') {
            show_404();
            exit;
        }
        $list = $this->product_model->getProductBySearch($keyword);
        $header = array(
            'chosen' => '0',
            'title' => parent::HEADER_TITLE,
            'keywords' => parent::HEADER_KEYWORDS,
            'description' => parent::HEADER_DESCRIPTION
        );
        if (!empty($list)) {
            foreach ($list as $key => $value) {
                $list[$key]->tender_area = $this->common_model->getProductTenderArea($value->tender_area);
                $list[$key]->interest_area = $this->common_model->getProductInterest($value->interest_area);
                $list[$key]->pay_way = $this->common_model->getProductPayWay($value->pay_way);
                $list[$key]->items = $this->product_model->getProductItemsByPid($value->id);
            }
        }
        $this->loadHeader($header);
        $data['product'] = $list;
        $data['keyword']=$keyword;
        $this->load->view('home/product/searchList', $data);
        $this->loadFooter();
    }

    /**
     * 
     * @todo 获取样式选择 
     * 
     */
    public function getChosen($cate) {
        $chosen = '';
        switch ($cate) {
            case self::TRUST:
                $chosen = self::TRUST_CHOSEN;
                break;
            case self::PLAN:
                $chosen = self::PLAN_CHOSEN;
                break;
            case self::PRIVATESUN:
                $chosen = self::PRIVATESUN_CHOSEN;
                break;
            case self::INSURANCE:
                $chosen = self::INSURANCE_CHOSEN;
                break;
            default:
                $chosen = "NULL";
                break;
        }
        return $chosen;
    }

}
