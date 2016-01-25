<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_power
 *
 * @createtime 2015-6-17 9:56:11
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_power
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_power extends Admin_Controller {

    protected $admin_user = 'aman';

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_power_model');
        $this->load->model('admin_system_model');
        $this->admin_user=  $this->username;
    }

    /**
     * 
     * @todo 权限列表 
     * 
     */
    public function index() {
        $data['list'] = $this->admin_power_model->getPowerList();
        $this->load->view('admin/power/list', $data);
    }

    /**
     * 
     * @todo 载入权限添加 
     * 
     */
    public function add() {
        $_data = $this->input->post();
        if (!empty($_data)) {
            $data = array(
                'powername' => $_data['powername'],
                'power' => implode(',', $_data['power']),
                'addtime' => date('Y-m-d H:i:s', time())
            );
            $msg = array('flag' => 0, 'error' => "");
            if ($data['powername'] == '') {
                $msg['error'] = "保存失败，权限名称不可以为空";
                echo json_encode($msg);
                exit();
            }
            $pid = $this->admin_power_model->savePowerData($data);
            if ($pid > 0) {
                $msg['flag'] = 1;
                $msg['error'] = "保存成功！";
                echo json_encode($msg);
                exit();
            } else {
                $msg['error'] = "保存失败，错误未知";
                echo json_encode($msg);
                exit();
            }
        } else {
            $list = $this->admin_system_model->getSystemList(0);
            if (!empty($list)) {
                //获取二级模块
                foreach ($list as $key => $value) {
                    $list[$key]->second = $this->admin_system_model->getSystemList($value->id);
                }
            }
            $data['list'] = $list;
            $this->load->view('admin/power/add', $data);
        }
    }

    /**
     * 
     * @todo 修改权限 
     * 
     */
    public function edit() {
        $_data = $this->input->post();
        if (!empty($_data)) {
            $data = array(
                'powername' => $_data['powername'],
                'power' => implode(',', $_data['power'])
            );
            $msg = array('flag' => 0, 'error' => "");
            $power_id = $_data['power_id'] ? $_data['power_id'] : 0;
            if ($power_id == 0) {
                $msg['error'] = "保存失败，参数丢失";
                echo json_encode($msg);
                exit();
            }
            $msg = array('flag' => 0, 'error' => "");
            if ($data['powername'] == '') {
                $msg['error'] = "保存失败，权限名称不可以为空";
                echo json_encode($msg);
                exit();
            }
            if ($this->admin_power_model->editPowerData($data, $power_id)) {
                $msg['flag'] = 1;
                $msg['error'] = "保存成功！";
                echo json_encode($msg);
                exit();
            } else {
                $msg['error'] = "保存失败，错误未知";
                echo json_encode($msg);
                exit();
            }
        } else {
            $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            if ($id == 0) {
                echo "参数丢失！";
                exit();
            }
            $power = $this->admin_power_model->getPowerById($id);
            if (empty($power)) {
                echo "初始化数据失败！";
                exit();
            }
            $power->power = explode(',', $power->power);
            $list = $this->admin_system_model->getSystemList(0);
            if (!empty($list)) {
                //获取二级模块
                foreach ($list as $key => $value) {
                    $list[$key]->second = $this->admin_system_model->getSystemList($value->id);
                }
            }
            $data['list'] = $list;
            $data['power'] = $power;
            $this->load->view('admin/power/edit', $data);
        }
    }

    /**
     * 
     * @todo 删除权限设置 
     * 
     */
    public function del() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id == 0) {
            echo "删除失败，参数丢失！";
            exit();
        }

        if ($this->admin_power_model->delPowerById($id)) {
            echo "删除该权限成功！";
            exit();
        } else {
            echo "删除失败，错误未知！";
            exit();
        }
    }

}
