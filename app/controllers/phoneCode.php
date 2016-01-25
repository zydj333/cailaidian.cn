<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of phoneCode
 *
 * @createtime 2015-7-3 12:00:36
 * 
 * @author ZhangPing'an
 * 
 * @todo phoneCode
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class phoneCode extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('phone_code_model');
    }

    /**
     * 
     * @todo 生成手机验证码 
     * 
     */
    public function createPhoneCode() {
        $msg = array(
            'flag' => 0,
            'error' => ''
        );
        //取一个随机数作为手机验证码
        $code = rand('100000', '999999');
        $type = $this->input->post('codetype');
        $content = '';
        $phone = $this->input->post('phone');
        if ($phone == '') {
                $msg['error'] = '手机号码不能为空!';
                echo json_encode($msg);
                exit;
            }
        if ($type == 'real_phone') {
            if ($this->phone_code_model->checkPhone($phone)) {
                $msg['error'] = '该手机号码已经存在，获取短信失败!';
                echo json_encode($msg);
                exit;
            }
            $content = '您申请账号的手机验证码为' . $code . '，请不要向任何无关人员提供该验证码！';
        } elseif ($type == 'find_password') {
            if (!$this->phone_code_model->checkPhone($phone)) {
                $msg['error'] = '该手机号码尚未注册,获取短信失败!';
                echo json_encode($msg);
                exit;
            }
            $content = '您正在申请找回密码操作，您的手机验证码为：' . $code . ',任何人索取验证码均为诈骗，如果不是您本人操作，请尽快登录账号修改信息。';
        } elseif($type == 'cash') {
            $content = '账户提现验证码为' . $code . ',任何人索取验证码均为诈骗，如果不是您本人操作，请尽快更换账户密码。';
        } elseif($type == 'register') {
            if ($this->phone_code_model->checkPhone($phone)) {
                $msg['error'] = '该手机号码已经注册!';
                echo json_encode($msg);
                exit;
            }
            $content = '您申请账号的手机验证码为' . $code . '，请不要向任何无关人员提供该验证码，祝您生活愉快！';
        } elseif($type == 'change') {
            if ($this->phone_code_model->checkPhone($phone)) {
                $msg['error'] = '该手机号码已经注册!';
                echo json_encode($msg);
                exit;
            }
            $content = '您正在申请更换验证手机操作，验证码为：' . $code . ',任何人索取验证码均为诈骗，如果不是您本人操作，请尽快登录账号修改信息。';
        }
        $data = array(
            'uid' => 0,
            'phonenumber' => $phone,
            'phonecode' => $code,
            'content' => $content,
            'status' => 0,
            'trytimes' => 0,
            'passtime' => time() + 1800,
            'createtime' => time()
        );
        $id = $this->phone_code_model->saveCode($data);
        if ($id > 0) {
            $msg['flag'] = 1;
            $msg['error'] = '创建验证码成功，等待系统发送验证码';
        } else {
            $msg['error'] = '发送验证码失败，请联系客服处理！';
        }
        echo json_encode($msg);
    }

}