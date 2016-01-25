<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class email extends Home_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->model('center_model');
        $this->load->model('center_account_model');
        $this->member = json_decode($this->common->get_session('member'));
    }

    /**
     * 
     * @todo 邮件认证 
     * 
     */
    public function verify() {
        $getemail = $this->uri->segment(3) ? $this->uri->segment(3) : '';
        $str = $this->uri->segment(4) ? $this->uri->segment(4) : '';
        $pass = base64_decode($str);
        $email = base64_decode($getemail);
        $info = $this->center_account_model->getEmail($email);
        $user_id = $info->user_id;
        $value = md5($user_id);
        $now = $info->creattime + (60 * 60 * 24);
        if (empty($getemail) || empty($str)) {
            $this->common->redirect('3','/center_account/index','验证失败，请重新点击！');
        }
        if ($pass != $value) {
            $this->common->redirect('3','/center_account/index','验证失败，请重新点击！');
        }
        if ($now < time()) {
            $this->common->redirect('3','/center_account/index','链接超时，请重新验证！');
        }
        $member = $this->center_account_model->getUserinfo($user_id);
        if (empty($this->member)) {
            $id = $user_id;
            $data_log = array(
                'user_id' => $member->id,
                'login_time' => time(),
                'login_ip' => $this->common->real_ip()
            );
            $this->center_account_model->addThisLogin($data_log);
            $user = array(
                'user_id' => $member->id,
                'account' => $member->account,
                'phone' => $member->phone,
                'login_time' => $data_log['login_time'],
                'login_ip' => $data_log['login_ip']
            );
            $this->common->set_session('member', json_encode($user));
            $data = array(
                'email_status' => 1
            );
            if ($this->center_account_model->updateEmail($data, $id)) {
                $data_status = array(
                    'status' => 2
                );
                if ($this->center_account_model->changeEmail($data_status, $id)) {
                    $this->common->redirect('2','/center_account/index','验证成功！');
                } else {
                    $this->common->redirect('3','/center_account/index','验证失败，请重新验证！');
                }
            } else {
                $this->common->redirect('3','/center_account/index','验证失败，请重新验证！');
            }
        } elseif ($user_id == $this->member->user_id) {
            $id = $this->member->user_id;
            $data = array(
                'email_status' => 1
            );
            if ($this->center_account_model->updateEmail($data, $id)) {
                $data_status = array(
                    'status' => 2
                );
                if ($this->center_account_model->changeEmail($data_status, $id)) {
                    $this->common->redirect('2','/center_account/index','验证成功！');
                } else {
                    $this->common->redirect('3','/center_account/index','验证失败，请重新验证！');
                }
            } else {
                $this->common->redirect('3','/center_account/index','验证失败，请重新验证！');
            }
        } else {
            $this->common->redirect('3','/center_account/index','验证失败，请登录验证账号！');
        }
    }

}
