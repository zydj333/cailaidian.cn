<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class admin_banner extends Admin_Controller{
    private $id = 0;
    private $account = "AMAN";
    private $now_time = 0;
    private $pagesize = 10;

    /**
     *
     * 构造方法
     *
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_banner_model');
        $this->load->model('common_model');
        $this->load->library('pagenation');
        $this->id = $this->common->get_session('id');
        $this->account = $this->common->get_session('account');
        $this->now_time = time();
    }

    /**
     *
     * 广告列表
     *
     */
    public function index() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize
        );
        $count = $this->admin_banner_model->getAdCountBySearch($search);
        $data['url'] = $this->pagenation->getPage($count, $this->pagesize, 1);
        $data['list'] = $this->admin_banner_model->getAdListBySearch($search);
        $this->load->view('admin/banner/list', $data);
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
        $type = $this->input->post('type');
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize
        );
        if ($title != '') {
            $search['title'] = $title;
        }
        if ($type != '') {
            $search['type'] = $type;
        }
        $count = $this->admin_banner_model->getAdCountBySearch($search);
        $page_url = $this->pagenation->getPage($count, $this->pagesize, $nowpage);
        $list = $this->admin_banner_model->getAdListBySearch($search);
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
     * 添加广告
     *
     */
    public function add() {
        if ($this->input->post()) {
            $msg = array(
                'flag' => 0,
                'error' => ''
            );
            $_data = $this->input->post();
            $data = array(
                'title' => $_data['title'],
                'imageurl' => $_data['imageurl'],
                'color' => $_data['color'],
                'url' => $_data['url'],
                'listorder' => $_data['listorder'],
                'type' => $_data['type']
            );
            if ($data['title'] != '' && $data['imageurl'] != '' && $data['url'] !== ''  && $data['type'] !== '') {
                $id = $this->admin_banner_model->saveAdData($data);
                if ($id > 0) {
                    $msg['flag'] = 1;
                    $msg['error'] = "添加成功！";
                    echo json_encode($msg);
                    exit();
                } else {
                    $msg['error'] = "添加失败！";
                    echo json_encode($msg);
                    exit();
                }
            } else {
                $msg['error'] = '标题，链接，图片，广告类型不能为空！';
                echo json_encode($msg);
                exit();
            }
        } else {
            $data['bannertype'] = $this->admin_banner_model->getBannerType();
            //var_dump($data);die;
            $this->load->view('admin/banner/add', $data);
        }
    }

    /**
     *
     * 修改广告信息
     *
     */
    public function edit() {
        if ($this->input->post()) {
            $msg = array(
                'flag' => 0,
                'error' => ''
            );
            $_data = $this->input->post();
            $id = $_data['id'];
            if ($id > 0) {
                $data = array(
                'title' => $_data['title'],
                'imageurl' => $_data['imageurl'],
                'color' => $_data['color'],
                'url' => $_data['url'],
                'listorder' => $_data['listorder'],
                'type' => $_data['type']
            );
                if ($data['title'] != '' && $data['imageurl'] != '' && $data['url'] !== ''  && $data['type'] !== '') {

                    if ($this->admin_banner_model->saveAdDataEdit($data, $id)) {
                        $msg['flag'] = 1;
                        $msg['error'] = "修改成功！";
                    } else {
                        $msg['error'] = "修改失败！";
                    }
                } else {
                    $msg['error'] = "标题，链接，图片，广告类型不能为空！";
                }
            } else {
                $msg['error'] = "修改失败！";
            }
            echo json_encode($msg);
        } else {
            $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
            if ($id > 0) {
                $data['banner'] = $this->admin_banner_model->getAdInfoById($id);
                $data['bannertype'] = $this->admin_banner_model->getBannerType();
                $this->load->view('admin/banner/edit', $data);
            } else {
                $msg['error'] = "获取信息失败！";
            }
        }
    }

    /**
     *
     * 删除广告信息
     *
     */
    public function del() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id == 0) {
            echo "删除失败，参数丢失！";
            exit();
        }
        $data = array(
                'is_del' => 1,
            );
        if ($this->admin_banner_model->delBanById($data,$id)) {
            exit();
        } else {
            echo "删除失败，错误未知！";
            exit();
        }
    }
}