<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class forget extends CI_Controller {

    /**
     * 
     * @todo 构造方法 
     * 
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('register_model');
    }

    public function index() {
        $this->load->view('home/forget/xiugai_1');
    }

    public function second() {
        $this->load->view('home/forget/xiugai_2');
    }
    
    public function third() {
        $this->load->view('home/forget/xiugai_3');
    }
    
    /**
     * 
     * @todo 验证验证码 
     * 
     */
    public function checkcellphonecode() {
        $phone = $this->input->post('phonenumber');
        $code = $this->input->post('phonecode');
        $msg = array('flag' => 0, 'error' => "");
        $varifyCode = trim($this->input->post('safeCode'));
        if ($phone == '') {
            $msg['error'] = '手机号码不能为空';
            echo json_encode($msg);
            exit;
        }
        if ($this->common->checkPhone($phone) != 1) {
            $msg['error'] = '手机号码格式错误';
            echo json_encode($msg);
            exit;
        }
        if ($varifyCode == '') {
            $msg['error'] = '验证码不能为空';
            echo json_encode($msg);
            exit;
        }
        if ($varifyCode != $this->common->get_session('varifyCode')) {
            $msg['error'] = '验证码错误';
            echo json_encode($msg);
            exit;
        }
        if ($this->register_model->checkPhoneCode($phone, $code)) {
            $data = array('status' => 2);
            if ($this->register_model->editPhoneCodeStatus($data, $phone, $code)) {
                $this->common->set_session('phone_num', $phone);
                $msg['flag'] = 1;
                $msg['error'] = "检测通过！";
                echo json_encode($msg);
                exit;
            } else {
                $msg['error'] = '修改失败，错误未知';
                echo json_encode($msg);
                exit;
            }
        } else {
            $msg['error'] = '修改失败，验证码于手机不符合';
            echo json_encode($msg);
            exit;
        }
    }

    /**
     * 
     * @todo 检查新密码 
     * 
     */
    public function checkNewPassword() {
        $password = $this->input->post('password');
        $repassword = $this->input->post('repassword');
        $phone = $this->common->get_session('phone_num');
        $msg = array('flag' => 0, 'error' => '');
        if (strlen($password) > 5) {
            if ($repassword == $password) {
                $info['list'] = $this->register_model->getMemberInfo($phone);
                foreach ($info['list'] as $key => $value) {
                    $data = array('password' => md5(md5($password . $value->random)));
                    if ($this->register_model->editMemberLoginPassword($data, $phone)) {
                        $this->common->del_session('phone_num');
                        $msg['flag'] = 1;
                        $msg['error'] = '密码已经成功修改，现在就去登录吧！';
                        echo json_encode($msg);
                        exit;
                    } else {
                        $msg['error'] = '修改失败，错误未知！';
                        echo json_encode($msg);
                        exit;
                    }
                }
            } else {
                $msg['error'] = '两次密码不一致！';
                echo json_encode($msg);
                exit;
            }
        } else {
            $msg['error'] = '密码长度不能小于6个字符';
            echo json_encode($msg);
            exit;
        }
    }

}

?>