<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_setpower
 *
 * @createtime 2015-6-17 12:31:43
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_setpower
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_setpower extends Admin_Controller {

    //put your code here
    protected $admin_user = 'aman';

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_setpower_model');
        $this->load->model('admin_user_model');
        $this->load->model('admin_power_model');
        $this->admin_user=  $this->username;
    }

    /**
     * 
     * @todo 项目首页 
     * 
     */
    public function index() {
        $data['list'] = $this->admin_setpower_model->getUserPowerList();
        $this->load->view('admin/setpower/list', $data);
    }

    /**
     *
     * @todo 修改用户权限 
     * 
     */
    public function edit() {
        $uid = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($uid == 0) {
            echo "用户参数丢失!";
            exit();
        }
        $user = $this->admin_user_model->getUserInfoByUid($uid);
        $power = $this->admin_power_model->getPowerList();
        $data['user'] = $user;
        $data['power'] = $power;
        $this->load->view('admin/setpower/edit', $data);
    }

    /**
     *
     * @todo 保存用户权限修改 
     * 
     */
    public function saveEdit() {
        $_data = $this->input->post();
        $data = array(
            'power' => $_data['power_id']
        );
        $msg = array('flag' => 0, 'error' => "");
        $uid = $_data['user_id'] ? $_data['user_id'] : 0;
        if ($uid == 0) {
            $msg['error'] = "用户参数丢失，保存失败";
            echo json_encode($msg);
            exit;
        }
        if ($this->admin_user_model->editUserData($data, $uid)) {
            $msg['flag'] = 1;
            $msg['error'] = "保存成功！";
            echo json_encode($msg);
            exit;
        } else {
            $msg['error'] = "出现未知的错误，保存失败";
            echo json_encode($msg);
            exit;
        }
    }

}
