<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class admin_new extends Admin_Controller {
    private $now_time = 0;
    private $pagesize = 10;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_new_model');
        $this->load->model('admin_new_category_model');
        $this->load->library('pagenation');
        $this->user_id = $this->common->get_session('user_id');
        $this->user_name = $this->common->get_session('username');
        $this->now_time = time();
    }

    /**
     * 
     * @todo 载入资讯列表 
     * 
     */
    public function index() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize
        );
        $nowpage = $this->input->get('page') ? htmlentities($this->input->get('page')) : 1;
        $count = $this->admin_new_model->getNewCount($search);
        $data['url'] = $this->pagenation->getPage($count, $this->pagesize, 1);
        $data['list'] = $this->admin_new_model->getNewList($search);
        $data['type'] = $this->admin_new_category_model->getNewCategory();
        $this->load->view('admin/new/list', $data);
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
        $title = $this->input->post('title');
        $search_name = $this->input->post('search_name');
        $ac_id = $this->input->post('ac_id');
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize
        );
        if ($title != '') {
            $search['title'] = $title;
        }
        if ($ac_id > -1) {
            $search['ac_id'] = $ac_id;
        }
        if ($search_name != '') {
            $search['search_name'] = $search_name;
        }
        $count = $this->admin_new_model->getNewCount($search);
        $page_url = $this->pagenation->getPage($count, $this->pagesize, $nowpage);
        $list = $this->admin_new_model->getNewList($search);
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
     * @todo 载入资讯详情页面 
     * 
     */
    public function detial(){
        $data['category'] = $this->admin_new_category_model->getNewCategory();
        $id=$this->uri->segment(3)?$this->uri->segment(3):0;
        if($id>0){
            $new=$this->admin_new_model->getNewInfo($id);
            if(!empty($new)){
                $data['new']=$new;
                $this->load->view('admin/new/detial', $data);
            }else{
                $this->common->redirect('3','/admin_new/index','获取资讯失败！');
            }
        }else{
            $this->common->redirect('3','/admin_new/index','获取ID失败！');
        }
    }
    
    /**
     * 
     * @todo 新增资讯
     * 
     */
    public function add() {
        $data['category'] = $this->admin_new_category_model->getNewCategory();
        $_data = $this->input->post();
        if (!empty($_data)) {
            $data = array(
                'ac_id' => $_data['ac_id'],
                'search_name' => $_data['search_name'],
                'seo_title' => $_data['seo_title'],
                'seo_keyword' => $_data['seo_keyword'],
                'seo_discription' => $_data['seo_discription'],
                'discription' => $_data['discription'],
                'views' => $_data['views'],
                'replay' => $_data['replay'],
                'title' => $_data['title'],
                'imageurl' => $_data['imageurl'],
                'content' => $_data['content'],
                'article_time' => date("Y-m-d H:i:s", time())
            );
            if ($data['ac_id'] !== '' && $data['title'] !== '' && $data['content'] !== '' && $data['discription'] !== '') {
                $id = $this->admin_new_model->saveNewData($data);
                if ($id > 0) {
                    $this->common->redirect('3','/admin_new/index','添加成功！');
                } else {
                    $this->common->redirect('3','/admin_new/index','添加失败！');
                }
            } else {
                $this->common->redirect('3','/admin_new/index','标题,内容,分类和描述不能为空！');
            }
        }
        $this->load->view('admin/new/add', $data);
    }

    /*
     * 修改资讯
     */

    public function edit() {
        $data['category'] = $this->admin_new_category_model->getNewCategory();
        if ($this->input->post()) {
            $_data = $this->input->post();
            $id = $_data['id'] ? $_data['id'] : 0;
            if ($id == 0) {
                $this->common->redirect('3','/admin_new/index','保存失败，参数丢失！');
                exit();
            }
            $bata = array(
                'ac_id' => $_data['ac_id'],
                'search_name' => $_data['search_name'],
                'seo_title' => $_data['seo_title'],
                'seo_keyword' => $_data['seo_keyword'],
                'seo_discription' => $_data['seo_discription'],
                'discription' => $_data['discription'],
                'views' => $_data['views'],
                'replay' => $_data['replay'],
                'title' => $_data['title'],
                'imageurl' => $_data['imageurl'],
                'content' => $_data['content'],
                'article_time' => date("Y-m-d H:i:s", time())
            );
            if ($bata['ac_id'] !== '' && $bata['title'] !== '' && $bata['content'] !== '') {
                if ($this->admin_new_model->editNewData($bata, $id))
                    $this->common->redirect('3','/admin_new/index','修改成功！');
            }else {
                $this->common->redirect('3','/admin_new/index','类别，标题和内容不能为空！');
            }
        } else {
            $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            if ($id > 0) {
                $data['new'] = $this->admin_new_model->getNewInfo($id);
            } else {
                $this->common->redirect('3','/admin_new/index','请选择资讯！');
            }
        }
        $this->load->view('admin/new/edit', $data);
    }

    /**
     * 
     * 删除资讯 
     * 
     */
    public function del() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id == 0) {
            echo "删除失败，参数丢失！";
            exit();
        }
        $data = array(
                'sts' => 1,
            );
        if ($this->admin_new_model->delNewById($data,$id)) {
            exit();
        } else {
            echo "删除失败，错误未知！";
            exit();
        }
    }

}
