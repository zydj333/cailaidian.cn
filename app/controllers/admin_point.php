<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class admin_point extends Admin_Controller {
    
    private $now_time = 0;
    private $pagesize = 10;
    
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->library('pagenation');
        $this->load->model('admin_point_model');
        $this->load->model('admin_point_type_model');
        $this->now_time = time();
    }
    
    public function index() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize
        );
        $count = $this->admin_point_model->getPointCount($search);
        $data['url'] = $this->pagenation->getPage($count, $this->pagesize, 1);
        $data['list'] = $this->admin_point_model->getPointList($search);
        $data['type'] = $this->admin_point_type_model->getPointCategory();
        $this->load->view('admin/point/list', $data);
    }
    
    /**
     * 
     * @todo 载入详情页面 
     * 
     */
    public function detial(){
        $data['category'] = $this->admin_point_type_model->getPointCategory();
        $id=$this->uri->segment(3)?$this->uri->segment(3):0;
        if($id>0){
            $new=$this->admin_point_model->getPointInfo($id);
            if(!empty($new)){
                $data['new']=$new;
                $this->load->view('admin/point/detial', $data);
            }else{
                $this->common->redirect('3','/admin_point/index','获取资讯失败！');
            }
        }else{
            $this->common->redirect('3','/admin_point/index','获取ID失败！');
        }
    }
    
    /**
     * 
     * 
     * @todo 载入异步分页 
     * 
     */
    public function ajaxList() {
        $msg = array(
            'flag' => 0,
            'error' => "",
        );
        $nowpage = $this->input->post('nowpage') ? $this->input->post('nowpage') : 1;
        $name = $this->input->post('name');
        $type_id = $this->input->post('type_id');
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize
        );
        if ($name != '') {
            $search['name'] = $name;
        }
        if ($type_id > -1) {
            $search['type_id'] = $type_id;
        }
        $count = $this->admin_point_model->getPointCount($search);
        $page_url = $this->pagenation->getPage($count, $this->pagesize, $nowpage);
        $list = $this->admin_point_model->getPointList($search);
        if (!empty($list)) {
            $msg['flag'] = 1;
            $msg['error'] = $list;
            $msg['pageurl'] = $page_url;
        } else {
            $msg['flag'] = 0;
            $msg['error'] = '没有相应数据';
            $msg['pageurl'] = '';
        }
        echo json_encode($msg);
    }
    
    /**
     * 
     * @todo 新增商品
     * 
     */
    public function add() {
        $data['category'] = $this->admin_point_type_model->getPointCategory();
        $_data = $this->input->post();
        if (!empty($_data)) {
            $data = array(
                'type_id' => $_data['type_id'],
                'name' => $_data['name'],
                'price' => $_data['price'],
                'points' => $_data['points'],
                'img' => $_data['img'],
                'img2' => $_data['img2'],
                'img3' => $_data['img3'],
                'img4' => $_data['img4'],
                'content' => $_data['content'],
                'addtime' => time()
            );
            if ($data['type_id'] !== '' && $data['name'] !== '' && $data['content'] !== '') {
                $id = $this->admin_point_model->savePointData($data);
                if ($id > 0) {
                    $this->common->redirect('3','/admin_point/index','添加商品成功！');
                } else {
                    $this->common->redirect('3','/admin_point/index','添加商品失败！');
                }
            } else {
                $this->common->redirect('3','/admin_point/index','类别，名称，内容不能为空！');
            }
        }
        $this->load->view('admin/point/add', $data);
    }
    
    /*
     * 修改商品
     */

    public function edit() {
        $data['category'] = $this->admin_point_type_model->getPointCategory();
        if ($this->input->post()) {
            $_data = $this->input->post();
            $id = $_data['id'] ? $_data['id'] : 0;
            if ($id == 0) {
                $this->common->redirect('3','/admin_point/index','保存失败，数据丢失！');
                exit();
            }
            $data_info = array(
                'type_id' => $_data['type_id'],
                'name' => $_data['name'],
                'price' => $_data['price'],
                'points' => $_data['points'],
                'img' => $_data['img'],
                'img2' => $_data['img2'],
                'img3' => $_data['img3'],
                'img4' => $_data['img4'],
                'content' => $_data['content'],
                'addtime' => time()
            );
            if ($data_info['type_id'] !== '' && $data_info['name'] !== '' && $data_info['content'] !== '') {
                if ($this->admin_point_model->editPointData($data_info, $id))
                    $this->common->redirect('3','/admin_point/index','修改成功！');
            }else {
                $this->common->redirect('3','/admin_point/index','类别，名称，内容不能为空！');
            }
        } else {
            $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            if ($id > 0) {
                $data['new'] = $this->admin_point_model->getPointInfo($id);
            } else {
                $this->common->redirect('3','/admin_point/index','请选择商品');
            }
        }
        $this->load->view('admin/point/edit', $data);
    }
    
    /**
     * 
     * 删除产品 
     * 
     */
    public function del() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id == 0) {
            echo "删除失败，参数丢失！";
            exit();
        }
        $data = array(
                'status' => 1,
            );
        if ($this->admin_point_model->delPointById($data,$id)) {
            exit();
        } else {
            echo "删除失败，错误未知！";
            exit();
        }
    }
}