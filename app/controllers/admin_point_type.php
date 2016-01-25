<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class admin_point_type extends Admin_Controller {

    //put your code here
    private $user_name = "admin";

    /**
     *
     * 构造方法
     *
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_point_type_model');
    }
    /**
     *
     * 分类列表
     *
     */
    public function index() {
        $list = $this->admin_point_type_model->getTypeList();
        if (!empty($list)) {
            //获取二级模块
            foreach ($list as $key => $value) {
                $list[$key]->second = $this->admin_point_type_model->getTypeList($value->id);
            }
        }
        $data['list'] = $list;
        $this->load->view('admin/point_type/list', $data);
    }
    
    public function add() {
        $_data = $this->input->post();
        if (!empty($_data)) {
            $data = array(
                'name' => $_data['name'],
                'parent_id' => $_data['parent_id'] ? $_data['parent_id'] : 0,
                'listorder' => $_data['listorder'] ? $_data['listorder'] : 255
            );
            $msg = array('flag' => 0, 'error' => "");
            if ($data['name'] == '') {
                $msg['error'] = "信息没有填写完整";
                echo json_encode($msg);
                exit();
            }
            if ($this->admin_point_type_model->checkTypeIsDefind($data)) {
                $msg['error'] = "该信息已经存在";
                echo json_encode($msg);
                exit();
            }
            $s_id = $this->admin_point_type_model->saveType($data);
            if ($s_id > 0) {
                $msg['flag'] = 1;
                $msg['error'] = "保存成功!";
                echo json_encode($msg);
                exit();
            } else {
                $msg['error'] = "保存失败，错误未知";
                echo json_encode($msg);
                exit();
            }
        } else {
            $list = $this->admin_point_type_model->getTypeList(0);
            $data['list'] = $list;
            $this->load->view('admin/point_type/add', $data);
        }
    }

    /**
     * 
     * @todo 载入分类修改 
     * 
     */
    public function edit() {
        $_data = $this->input->post();
        if (!empty($_data)) {
            $msg = array('flag' => 0, 'error' => "");
            $id = $_data['id'] ? $_data['id'] : 0;
            $data = array(
                'name' => $_data['name'],
                'parent_id' => $_data['parent_id'] ? $_data['parent_id'] : 0,
                'listorder' => $_data['listorder'] ? $_data['listorder'] : 255
            );
            $msg = array('flag' => 0, 'error' => "");
            if ($data['name'] == '') {
                $msg['error'] = "信息没有填写完整";
                echo json_encode($msg);
                exit();
            }
            if ($id == 0) {
                $msg['error'] = "参数丢失";
                echo json_encode($msg);
                exit();
            }
            if ($this->admin_point_type_model->saveTypeEdit($data, $id)) {
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
                echo '参数错误！';
                exit();
            }
            $data['system'] = $this->admin_point_type_model->getTypeById($id);
            $data['list'] = $this->admin_point_type_model->getTypeList(0);
            if (empty($data['system'])) {
                echo '初始化数据失败！';
                exit();
            }
            $this->load->view('admin/point_type/edit', $data);
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
        $data = array(
            'status' => 1
        );
        if ($this->admin_point_type_model->delPointTypeById($data,$id)) {
            echo "删除分类成功！";
            exit();
        } else {
            echo "删除失败，错误未知！";
            exit();
        }
    }
}