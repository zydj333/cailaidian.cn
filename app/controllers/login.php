<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @createtime 2015-7-2 16:52:57
 * 
 * @author ZhangPing'an
 * 
 * @todo login
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class login extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('register_model');
    }

    /**
     * 
     * @todo 载入登录 
     * 
     */
    public function index() {
        $member = json_decode($this->common->get_session('member'));
        if (!empty($member)) {
            redirect('/');
        }
        $from = '/';
        if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != '') {
            $from = $_SERVER['HTTP_REFERER'];
        }
        if (strrpos($from, 'register') || strrpos($from, 'forget') || strrpos($from, 'login')) {
            $from = '/';
        }
        $data['from'] = $from;
        $this->load->view('home/login/index', $data);
    }

    /**
     * 
     * @todo 进行登录操作 
     * 
     */
    public function doLogin() {
        $uri = '/';
        $from = trim($this->input->post('from_url'));
        $account = trim($this->input->post('account'));
        $password = trim($this->input->post('password'));
        if ($from != '') {
            $uri = $from;
        }
        if ($account == '' || $password == '') {
            show_error('帐号/密码不能为空！');
        } else {
            $member = $this->login_model->getUserinfo($account);
            if (empty($member)) {
                show_error('帐号/密码错误！');
            } else {
                $hashpwd = md5(md5($password . $member->random));
                if ($member->password == $hashpwd) {
                    //登录成功
                    //添加本次登录记录
                    $data_log = array(
                        'user_id' => $member->id,
                        'login_time' => time(),
                        'login_ip' => $this->common->real_ip()
                    );
                    $this->register_model->addThisLogin($data_log);
                    $user = array(
                        'user_id' => $member->id,
                        'account' => $member->account,
                        'phone' => $member->phone,
                        'login_time' => $data_log['login_time'],
                        'login_ip' => $data_log['login_ip'],
                    );
                    $this->common->set_session('member', json_encode($user));
                    redirect($uri);
                } else {
                    show_error('帐号/密码错误！');
                }
            }
        }
    }

    /**
     * 
     * @todo 检查登录 
     * 
     */
    public function checkLogin() {
        $account = trim($this->input->post('account'));
        $password = trim($this->input->post('password'));
        $msg = array('flag' => 0, 'error' => "");
        if ($account == '' || $password == '') {
            $msg['error'] = "帐号密码不能为空！";
            echo json_encode($msg);
            exit;
        }
        if ($this->input->post('from_url') != '') {
            $varifyCode = trim($this->input->post('safeCode'));
            if ($varifyCode != $this->common->get_session('varifyCode')) {
                $msg['error'] = '验证码错误';
                echo json_encode($msg);
                exit;
            }
        }
        $member = $this->login_model->getUserinfo($account);
        if (empty($member)) {
            $msg['error'] = "帐号/密码错误！";
            echo json_encode($msg);
            exit;
        }
        $hashpwd = md5(md5($password . $member->random));
        if ($member->password == $hashpwd) {
            $msg['flag'] = 1;
            $msg['error'] = "验证通过，正在登录！";
            echo json_encode($msg);
            exit;
        } else {
            $msg['error'] = '帐号/密码错误';
            echo json_encode($msg);
            exit;
        }
    }

    /**
     * 
     * @todo 退出登录 
     * 
     */
    public function logout() {
        $this->common->del_session('member');
        $from = '/';
        if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != '') {
            $from = $_SERVER['HTTP_REFERER'];
        }
        redirect($from);
    }

}
