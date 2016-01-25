<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class admin_bbs_questionrepay extends Admin_Controller {

    private $now_time = 0;
    private $pagesize = 10;

    public function __construct() {
        parent::__construct();
        $this->load->model('admin_bbs_questionrepay_model');
        $this->load->library('pagenation');
        $this->user_id = $this->common->get_session('user_id');
        $this->user_name = $this->common->get_session('username');
        $this->now_time = time();
    }

    /**
     * 
     * @todo 载入问答列表 
     * 
     */
    public function index() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize
        );
        $nowpage = $this->input->get('page') ? htmlentities($this->input->get('page')) : 1;
        $count = $this->admin_bbs_questionrepay_model->getQuestionCount($search);
        $data['url'] = $this->pagenation->getPage($count, $this->pagesize, 1);
        $data['list'] = $this->admin_bbs_questionrepay_model->getQuestionList($search);
        //var_dump($data);die;
        $this->load->view('admin/questionrepay/list', $data);
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
        $qtitle = $this->input->post('qtitle');
        $content = $this->input->post('content');
        $username = $this->input->post('username');
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize
        );
        if ($qtitle != '') {
            $search['qtitle'] = $qtitle;
        }
        if ($content != '') {
            $search['content'] = $content;
        }
        if ($username != '') {
            $search['username'] = $username;
        }
        $count = $this->admin_bbs_questionrepay_model->getQuestionCount($search);
        $page_url = $this->pagenation->getPage($count, $this->pagesize, $nowpage);
        $list = $this->admin_bbs_questionrepay_model->getQuestionList($search);
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
     * 删除回复
     * 
     */
    public function del() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id == 0) {
            echo "删除失败，参数丢失！";
            exit();
        }
        if ($this->admin_bbs_questionrepay_model->delQuestionById($id)) {
            exit();
        } else {
            echo "删除失败，错误未知！";
            exit();
        }
    }

}

?>