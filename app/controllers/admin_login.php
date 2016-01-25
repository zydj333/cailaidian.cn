<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_login
 *
 * @createtime 2015-6-17 13:48:56
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_login
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_login extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_login_model');
    }

    /**
     * 
     * @todo 载入登录界面 
     * 
     */
    public function index() {
        $this->load->view('admin/login/index');
    }

    /**
     * 
     * @todo 进行登录操作 
     * 
     */
    public function doLogin() {
        $account = trim($this->input->post('account'));
        $password = trim($this->input->post('password'));
        $msg = array('flag' => 0, 'error' => "");
        $user = $this->admin_login_model->getUser($account, md5($password));
        if (empty($user)) {
            $msg['error'] = "未能成功登录(帐号/密码)错误！";
            echo json_encode($msg);
            exit();
        }
        $userinfo = array(
            'user_id' => $user->id,
            'user_account' => $user->account,
            'user_name' => $user->username,
            'user_email' => $user->email,
            'user_telephone' => $user->telephone,
            'user_power' => $user->power_value
        );
        $this->common->set_session('user_id', $user->id);
        $this->common->set_session('user_name', $user->username);
        $this->common->set_session('user_info', json_encode($userinfo));
        $msg['flag'] = 1;
        $msg['error'] = "登录成功！";
        echo json_encode($msg);
        exit();
    }

    /**
     * 
     * @todo 登出 
     * 
     */
    public function logout() {
        $this->common->del_session('user_id');
        $this->common->del_session('user_name');
        $this->common->del_session('user_info');
        redirect('admin_login/index');
    }

}
