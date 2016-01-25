<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class admin_bbs_question extends Admin_Controller {

    private $now_time = 0;
    private $pagesize = 10;

    public function __construct() {
        parent::__construct();
        $this->load->model('admin_bbs_question_model');
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
        $count = $this->admin_bbs_question_model->getQuestionCount($search);
        $data['url'] = $this->pagenation->getPage($count, $this->pagesize, 1);
        $data['list'] = $this->admin_bbs_question_model->getQuestionList($search);
        $this->load->view('admin/question/list', $data);
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
        $questions = $this->input->post('questions');
        $user_name = $this->input->post('user_name');
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize
        );
        if ($title != '') {
            $search['title'] = $title;
        }
        if ($questions != '') {
            $search['questions'] = $questions;
        }
        if ($user_name != '') {
            $search['user_name'] = $user_name;
        }
        $count = $this->admin_bbs_question_model->getQuestionCount($search);
        $page_url = $this->pagenation->getPage($count, $this->pagesize, $nowpage);
        $list = $this->admin_bbs_question_model->getQuestionList($search);
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
     * @todo 载入详情页面 
     * 
     */
    public function detial() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id > 0) {
            $info = $this->admin_bbs_question_model->getQuestionInfo($id);
            $data['info'] = $info;
            $this->load->view('admin/question/detial', $data);
        } else {
            $this->common->redirect('3', '/admin_bbs_question/index', '获取ID失败！');
        }
    }

    /**
     * 
     * @todo 回复首页
     * 
     */
    public function add() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        $question = $this->admin_bbs_question_model->getQuestionDetial($id);
        if ($id > 0) {
            $data['info'] = $question;
        }
        $this->load->view('admin/question/add', $data);
    }
    
    /**
     * 
     * @todo 保存回复
     * 
     */
    public function savaAdd() {
        $_data = $this->input->post();
        $id = $this->input->post('id') ? $this->input->post('id') : 0;
        $question = $this->admin_bbs_question_model->getQuestionDetial($id);
        if (empty($question)) {
            $msg['error'] = "获取初始数据失败，无法进行回答！";
            echo json_encode($msg);
            exit;
        }
        //var_dump($question);die;
        if (!empty($_data)) {
            $data = array(
                'qid' => $_data['id'],
                'qtitle' => $_data['qtitle'],
                'content' => $_data['content'],
                'user_id' => $this->user_id,
                'username' => '财来电管理员',
                'create_time' => time()
            );
            $msg = array('flag' => 0, 'error' => "");
            if ($id == 0) {
                $msg['error'] = "参数出错，无法回答！";
                echo json_encode($msg);
                exit;
            }
            if (strlen($data['content']) < 15) {
                $msg['error'] = "您回答的内容太过简单！";
                echo json_encode($msg);
                exit;
            }
            //检查是否已经存在
            if ($this->admin_bbs_question_model->checkQuestionAnswerIsSet($data)) {
                $msg['error'] = "您不能连续的回复相同答案！";
                echo json_encode($msg);
                exit;
            }
            $pid = $this->admin_bbs_question_model->saveQuestion($data);
            if ($pid > 0) {
                $questionData = array(
                    'repaynums' => ($question->repaynums + 1),
                    'updatetime' => time()
                );
                $this->admin_bbs_question_model->saveQuestionEdit($questionData, $id);
                $msg['flag'] = 1;
                $msg['error'] = "回复成功！";
                echo json_encode($msg);
                exit();
            } else {
                $msg['error'] = "回复失败，错误未知";
                echo json_encode($msg);
                exit();
            }
        }
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
        if ($this->admin_bbs_question_model->delQuestionById($id)) {
            exit();
        } else {
            echo "删除失败，错误未知！";
            exit();
        }
    }

}

?>