<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class admin_newcate extends Admin_Controller {

    //put your code here
    private $user_name = "admin";

    /**
     *
     * 构造方法
     *
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_new_category_model');
    }
    /**
     *
     * 分类列表
     *
     */
    public function index() {
        $data['list'] = $this->admin_new_category_model->getNewCategory();
        //var_dump($data);die;
        $this->load->view('admin/newcate/list', $data);
    }
    
    /**
     * 
     * 新增资讯分类
     * 
     */
    public function add() {
        $_data = $this->input->post();
        if (!empty($_data)) {
            $data = array(
                'name' => $_data['name'],
                'listorder' => $_data['listorder']
            );
            $msg = array('flag' => 0, 'error' => "");
            if ($data['name'] == '') {
                $msg['error'] = "添加失败，名称不可以为空";
                echo json_encode($msg);
                exit();
            }
            $id = $this->admin_new_category_model->saveNewType($data);
            if ($id > 0) {
                $msg['flag'] = 1;
                $msg['error'] = "添加成功！";
                echo json_encode($msg);
                exit();
            } else {
                $msg['error'] = "添加失败，错误未知";
                echo json_encode($msg);
                exit();
            }
        } else {
            $this->load->view('admin/newcate/add');
        }
    }

    /*
     * 修改资讯分类
     */

    public function edit() {
        $_data = $this->input->post();
        if (!empty($_data)) {
            $data = array(
                'name' => $_data['name'],
                'listorder' => $_data['listorder']
            );
            $msg = array('flag' => 0, 'error' => "");
            $id = $_data['ac_id'] ? $_data['ac_id'] : 0;
            if ($id == 0) {
                $msg['error'] = "修改失败，参数丢失";
                echo json_encode($msg);
                exit();
            }
            $msg = array('flag' => 0, 'error' => "");
            if ($data['name'] == '') {
                $msg['error'] = "修改失败，分类名称不可以为空";
                echo json_encode($msg);
                exit();
            }
            if ($this->admin_new_category_model->saveNewTypeEdit($data, $id)) {
                $msg['flag'] = 1;
                $msg['error'] = "修改成功！";
                echo json_encode($msg);
                exit();
            } else {
                $msg['error'] = "修改失败，错误未知";
                echo json_encode($msg);
                exit();
            }
        } else {
            $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            if ($id == 0) {
                echo "参数丢失！";
                exit();
            }
            $data['category'] = $this->admin_new_category_model->getNewTypeInfoById($id);
            $this->load->view('admin/newcate/edit', $data);
        }
    }

    /**
     * 
     * 删除资讯分类 
     * 
     */
    public function del() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id == 0) {
            echo "删除失败，参数丢失！";
            exit();
        }

        if ($this->admin_new_category_model->delNewTypeById($id)) {
            echo "删除分类成功！";
            exit();
        } else {
            echo "删除失败，错误未知！";
            exit();
        }
    }
}
