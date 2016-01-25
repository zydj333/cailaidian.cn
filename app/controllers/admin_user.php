<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_user
 *
 * @createtime 2015-6-17 8:40:44
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_user
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_user extends Admin_Controller {

    protected $admin_user = 'aman';

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_user_model');
        $this->admin_user = $this->username;
    }

    /**
     * 
     * @todo 载入后台用户首页 
     * 
     */
    public function index() {
        $data['list'] = $this->admin_user_model->getUserList();
        $this->load->view('admin/user/list', $data);
    }

    /**
     * 
     * @todo 添加用户 
     * 
     */
    public function add() {
        $_data = $this->input->post();
        if (!empty($_data)) {
            $data = array(
                'account' => $_data['account'],
                'password' => $_data['password'],
                'username' => $_data['username'],
                'email' => $_data['email'],
                'telephone' => $_data['telephone'],
                'addtime' => date('Y-m-d H:i:s', time()),
                'adder' => $this->admin_user,
                'power' => 0,
                'is_del' => 0
            );
            $msg = array('flag' => 0, 'error' => "");
            if ($data['account'] == '' || $data['password'] == '' || $data['username'] == '' || $data['email'] == '' || $data['telephone'] == '') {
                $msg['error'] = "保存失败,信息请填写完整";
                echo json_encode($msg);
                exit();
            }
            if ($this->admin_user_model->checkUserIsDefind($data)) {
                $msg['error'] = "保存失败,该用户已经存在";
                echo json_encode($msg);
                exit();
            }
            $data['password'] = md5($data['password']);
            $user_id = $this->admin_user_model->saveUserData($data);
            if ($user_id > 0) {
                $msg['flag'] = 1;
                $msg['error'] = "保存成功！";
                echo json_encode($msg);
                exit();
            } else {
                $msg['error'] = "保存失败，错误未知!";
                echo json_encode($msg);
                exit();
            }
        } else {
            $this->load->view('admin/user/add');
        }
    }

    /**
     * 
     *  @todo 载入用户修改
     * 
     */
    public function edit() {
        $_data = $this->input->post();
        if (!empty($_data)) {
            $data = array(
                'username' => $_data['username'],
                'email' => $_data['email'],
                'telephone' => $_data['telephone']
            );
            $msg = array('flag' => 0, 'error' => "");
            $user_id = $_data['user_id'] ? $_data['user_id'] : 0;
            if ($user_id == 0) {
                $msg['error'] = "保存失败,参数丢失";
                echo json_encode($msg);
                exit();
            }
            if ($data['username'] == '' || $data['email'] == '' || $data['telephone'] == '') {
                $msg['error'] = "保存失败,信息请填写完整";
                echo json_encode($msg);
                exit();
            }
            if ($this->admin_user_model->editUserData($data, $user_id)) {
                $msg['flag'] = 1;
                $msg['error'] = "保存成功！";
                echo json_encode($msg);
                exit();
            } else {
                $msg['error'] = "保存失败，错误未知!";
                echo json_encode($msg);
                exit();
            }
        } else {
            $user_id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            if ($user_id == 0) {
                echo "参数丢失";
                exit();
            }
            $data['user'] = $this->admin_user_model->getUserInfoByUid($user_id);
            if (empty($data['user'])) {
                echo "初始化数据失败!";
                exit();
            }
            $this->load->view('admin/user/edit', $data);
        }
    }

    /**
     * 
     * @todo 删除用户 
     * 
     */
    public function del() {
        $user_id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($user_id == 0) {
            echo "删除失败,参数丢失";
            exit();
        }
        $data['is_del'] = 1;
        if ($this->admin_user_model->editUserData($data, $user_id)) {
            echo "删除成功!";
            exit();
        } else {
            echo "删除失败，错误未知";
            exit();
        }
    }

    /**
     * 
     * @todo 修改我的账户信息 
     * 
     */
    public function editMyInfo() {
        $userinfo = $this->userinfo;
        $_data = $this->input->post();
        if (!empty($_data)) {
            $data = array(
                'username' => $_data['username'],
                'email' => $_data['email'],
                'telephone' => $_data['telephone'],
            );
            $msg = array('flag' => 0, 'error' => "");
            if ($data['username'] == '' || $data['email'] == '' || $data['telephone'] == '') {
                $msg['error'] = "信息没有填写完整！";
                echo json_encode($msg);
                exit;
            }
            if ($this->admin_user_model->editUserData($data, $userinfo->user_id)) {
                $msg['flag'] = 1;
                $msg['error'] = "修改个人信息成功！";
                echo json_encode($msg);
                exit;
            } else {
                $msg['error'] = "修改失败，未知错误！";
                echo json_encode($msg);
                exit;
            }
        } else {
            $data['userinfo'] = $this->admin_user_model->getUserInfoByUid($userinfo->user_id);
            //$data['userinfo'] = $userinfo;
            $this->load->view('admin/user/myinfo', $data);
        }
    }

    /**
     * 
     * @todo 修改密码 
     * 
     */
    public function editMyPwd() {
        $_data = $this->input->post();
        $userinfo = $this->userinfo;
        if (!empty($_data)) {
            $password = trim($_data['password']);
            $newpassword = trim($_data['newpassword']);
            $renewpassword = trim($_data['renewpassword']);
            $msg = array('flag' => 0, 'error' => "");
            if ($newpassword == '' || $renewpassword == '') {
                $msg['error'] = "新密码不可以为空！";
                echo json_encode($msg);
                exit();
            }
            if ($newpassword != $renewpassword) {
                $msg['error'] = "新密码和新确认密码不一致！";
                echo json_encode($msg);
                exit();
            }
            if (!$this->admin_user_model->checkPasswordIsDefind($userinfo->user_id, md5($password))) {
                $msg['error'] = "初始密码不正确！";
                echo json_encode($msg);
                exit();
            }
            $data = array('password' => md5($newpassword));
            if ($this->admin_user_model->editUserData($data, $userinfo->user_id)) {
                $msg['flag'] = 1;
                $msg['error'] = "修改密码成功，下次登录请使用新密码！";
                echo json_encode($msg);
                exit();
            } else {
                $msg['error'] = "修改密码失败，错误未知！";
                echo json_encode($msg);
                exit();
            }
        } else {
            $this->load->view('admin/user/mypwd');
        }
    }

}
