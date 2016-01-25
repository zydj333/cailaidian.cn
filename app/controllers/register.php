<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class register extends CI_Controller {

    /**
     * 
     * @todo 构造方法 
     * 
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('register_model');
        $this->load->helper('global');
    }

    /**
     * 
     * 载入注册页面 
     * 
     */
    public function index() {
        $member = json_decode($this->common->get_session('member'));
        if(!empty($member)){
            redirect('/');
        }
        $this->load->view('home/register/register');
    }

    /**
     * 
     * @todo 检查验证码 
     * 
     */
    public function checkPhoneCode($phonenumber, $phonecode) {
        $msg = array('flag' => 0, 'error' => '');
        if ($phonenumber != '' && $phonecode != '') {
            if ($this->register_model->checkPhoneCode($phonenumber, $phonecode)) {
                $msg['flag'] = 1;
                $msg['error'] = '手机验证码可用!';
            } else {
                $msg['error'] = '手机验证码不正确或者过期!';
            }
        } else {
            $msg['error'] = '手机验证码不可以为空！';
        }
        return $msg;
    }

    /**
     * 
     * @todo 检查注册
     * 
     */
    public function checkRegister() {
        $_data = $this->input->post();
        $accounts = trim($_data['account']);
        $data = array(
            'phone' => trim($accounts),
            'password' => trim($_data['password']),
            'repassword' => trim($_data['repassword']),
            'cardno' => trim($_data['cardno'])
        );
        if ($data['phone'] == '') {
            $code['error'] = '手机号码不能为空';
            $code['flag'] = 0;
            echo json_encode($code);
            exit;
        }
        if ($this->common->checkPhone($data['phone']) != 1) {
            $msg['error'] = '手机号码格式错误';
            echo json_encode($msg);
            exit;
        }
        if ($data['password'] == '') {
            $code['flag'] = 0;
            $code['error'] = '密码不能为空';
            echo json_encode($code);
            exit;
        }
        if ($data['password'] != $data['repassword']) {
            $code['flag'] = 0;
            $code['error'] = '两次输入的密码不一致';
            echo json_encode($code);
            exit;
        }

        $phonecode = trim($_data['phonecode']);
        $code = $this->checkPhoneCode($data['phone'], $phonecode);
        if ($code['flag'] == 0) {
            echo json_encode($code);
            exit;
        }
        $xieyi = $this->input->post('xieyi') ? $this->input->post('xieyi') : 0;
        if ($xieyi == 0) {
            $code['flag'] = 0;
            $code['error'] = '您必须先同意用户协议才能注册!';
            echo json_encode($code);
            exit;
        }
        $msg = array(
            'flag' => 1,
            'error' => "验证通过！等待提交表单！",
        );
        echo json_encode($msg);
    }

    /**
     * 
     * @todo 执行注册操作 
     * 
     */
    public function doregiter() {
        $_data = $this->input->post();
        $accounts = trim($_data['account']);
        $random_num = random(6, 'abcdefghigklmnopqrstuvwxwyABCDEFGHIGKLMNOPQRSTUVWXWY0123456789');
        $data = array(
            'account' => trim($accounts),
            'phone' => trim($accounts),
            'password' => trim($_data['password']),
            'cardno' => trim($_data['cardno']),
            'random' => trim($random_num),
            'createtime' => time()
        );
        $phonecode = trim($_data['phonecode']);
        $data['password'] = md5(md5($data['password'] . $random_num));
        $code_status = array(
            'status' => 2
        );
        //修改验证码状态
        $msg = array('flag' => 0, 'error' => "");
        if ($this->register_model->editPhoneCodeStatus($code_status, $data['phone'], $phonecode)) {
            $u_id = $this->register_model->saveMemberAccount($data);
            if ($u_id > 0) {
                //添加本次登录记录
                $data_log = array(
                    'user_id' => $u_id,
                    'login_time' => time(),
                    'login_ip' => $this->common->real_ip()
                );
                $this->register_model->addThisLogin($data_log);
                //添加用户中心记录
                $data_info = array(
                    'user_id' => $u_id
                );
                $this->register_model->saveMemberInfo($data_info);
                $member = array(
                    'user_id' => $u_id,
                    'account' => $data['phone'],
                    'phone' => $data['phone'],
                    'login_time' => $data_log['login_time'],
                    'login_ip' => $data_log['login_ip'],
                );
                $this->common->set_session('member', json_encode($member));
                $msg['flag'] = 1;
                $msg['error'] = "注册成功！";
                if (!empty($_data['cardno'])) {
                    $cardno = $_data['cardno'];
                    $info = $this->common_model->getCardInfo($cardno);
                    $id = $info->id;
                    $point = 50;
                    if ($this->common_model->editSignPoint($id, $point)) {
                        $member = $this->common_model->getMemInfo($id);
                        $pointsnow = $member->pointsnow;
                        $points = $member->points;
                        $pointsuse = $member->pointsuse;
                        $data = array(
                            'user_id' => $id,
                            'change' => $point,
                            'points' => $points,
                            'pointsnow' => $pointsnow,
                            'pointsuse' => $pointsuse,
                            'type' => 'register',
                            'createtime' => time(),
                            'passtime' => strtotime('tomorrow')
                        );
                        $this->common_model->savePointInfo($data);
                        $msg['error'] = '注册成功，推荐人增加50积分，您获得100元现金奖励！';
                    } else {
                        $msg['error'] = '推荐人获取积分失败，请联系管理员！';
                    }
                }
                echo json_encode($msg);
                exit;
            } else {
                $msg['error'] = '注册失败';
                echo json_encode($msg);
                exit;
            }
        } else {
            $msg['error'] = '验证码错误或过期';
            echo json_encode($msg);
            exit;
        }
    }

}

?>
