<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of bbs
 *
 * @createtime 2015-7-27 16:42:21
 * 
 * @author ZhangPing'an
 * 
 * @todo bbs
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class bbs extends Home_Controller {

    protected $pagesize = 4;

    public function __construct() {
        parent::__construct();
        $this->load->model('bbs_model');
        $this->load->library('pagenation');
        $this->load->model('center_point_model');
    }

    /**
     * 
     * @todo 载入社区首页 
     * 
     */
    public function index() {
        $header = array(
            'chosen' => "index",
            'title' => parent::HEADER_TITLE,
            'keywords' => parent::HEADER_KEYWORDS,
            'description' => parent::HEADER_DESCRIPTION
        );
        $this->loadBbsHeader($header);

        //获取金融资讯列表
        $data['jinrong'] = $this->bbs_model->getArticleList(1, 14);
        $data['jinrong_count'] = count($data['jinrong']);
        //获取热点新闻列表
        $data['hotnew'] = $this->bbs_model->getArticleList(11, 14);
        $data['hotnew_count'] = count($data['hotnew']);
        //获取理财问答
        $data['question'] = $this->bbs_model->getQuestionList(14);
        $data['question_count'] = count($data['question']);

        $this->load->view('home/bbs/index', $data);
        $this->loadBbsFooter();
    }

    /**
     * 
     * @todo 载入金融资讯主页 
     * 
     */
    public function article() {
        $header = array(
            'chosen' => "article",
            'title' => parent::HEADER_TITLE,
            'keywords' => parent::HEADER_KEYWORDS,
            'description' => parent::HEADER_DESCRIPTION
        );
        $this->loadBbsHeader($header);
        $nowpage = $this->input->get('page') ? $this->input->get('page') : 1;
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize,
        );
        $count = $this->bbs_model->getArticleTotalCount();
        $list = $this->bbs_model->getArticleTotalList($search);
        $page_url = $this->pagenation->getFrontBbsUrl($count, $this->pagesize, $nowpage, base_url('bbs/article'), array());
        $data['list'] = $list;
        $data['page_url'] = $page_url;
        $this->load->view('home/bbs/article', $data);
        $this->loadBbsFooter();
    }

    /**
     * 
     * @todo 查看文章详情 
     * 
     */
    public function articleDetial() {
        $new_id = $this->uri->segment(3) ? intval($this->uri->segment(3)) : 0;
        $article = $this->bbs_model->getArticleDetialById($new_id);
        if (!empty($article)) {
            $header = array(
                'chosen' => "article",
                'title' => $article->seo_title,
                'keywords' => $article->seo_keyword,
                'description' => $article->seo_discription
            );
            $this->loadBbsHeader($header);
            $this->bbs_model->editArticleViewTimes($new_id);
            $data['news'] = $article;
            $this->load->view('home/bbs/articleDetial', $data);
            $this->loadBbsFooter();
        } else {
            show_404();
        }
    }

    /**
     * 
     * @todo 载入问题列表页面
     * 
     */
    public function question() {
        $pagesize = 10;
        $header = array(
            'chosen' => "question",
            'title' => parent::HEADER_TITLE,
            'keywords' => parent::HEADER_KEYWORDS,
            'description' => parent::HEADER_DESCRIPTION
        );
        $this->loadBbsHeader($header);
        $nowpage = $this->input->get('page') ? $this->input->get('page') : 1;
        $search = array(
            'start' => ($nowpage - 1) * $pagesize,
            'pagesize' => $pagesize,
        );
        $count = $this->bbs_model->getQuestionTotalCount($search);
        $list = $this->bbs_model->getQuestionTotalList($search);
        $page_url = $this->pagenation->getFrontBbsUrl($count, $pagesize, $nowpage, base_url('bbs/question'), array());
        $search['type'] = 2;
        $hotlist = $this->bbs_model->getQuestionTotalList($search);
        $data['list'] = $list;
        $data['page_url'] = $page_url;
        $data['hotlist'] = $hotlist;
        $this->load->view('home/bbs/question', $data);
        $this->loadBbsFooter();
    }

    /**
     * 
     * @todo 保存问题答案 
     * 
     */
    public function saveAnswer() {
        $qid = $this->input->post('q_id') ? $this->input->post('q_id') : 0;
        $id = $this->member->user_id;
        $type = 'answer';
        $content = htmlentities($this->input->post('content'));
        $msg = array('flag' => 0, 'error' => "");
        if ($qid == 0) {
            $msg['error'] = "参数出错，无法回答！";
            echo json_encode($msg);
            exit;
        }
        if (strlen($content) < 15) {
            $msg['error'] = "您回答的内容太过简单！";
            echo json_encode($msg);
            exit;
        }
        //获取原始问题信息
        $question = $this->bbs_model->getQuestionDetial($qid);
        if (empty($question)) {
            $msg['error'] = "获取初始数据失败，无法进行回答！";
            echo json_encode($msg);
            exit;
        }
        if (empty($this->member)) {
            $msg['error'] = "您在回答问题前，必须先进行登录！";
            echo json_encode($msg);
            exit;
        }
        //获取用户信息
        $member = $this->common_model->getMemInfo($this->member->user_id);
        if ($member->nickname == '') {
            $member->nickname = "匿名";
        }
        //构造回答数组
        $data = array(
            'qid' => $qid,
            'qtitle' => $question->title,
            'content' => $content,
            'user_id' => $member->user_id,
            'username' => $member->nickname,
            'is_del' => 0,
            'create_time' => time()
        );
        //检查是否已经存在
        if ($this->bbs_model->checkQuestionAnswerIsSet($data)) {
            $msg['error'] = "您不能连续的回复相同答案！";
            echo json_encode($msg);
            exit;
        }
        $questionData = array(
            'repaynums' => ($question->repaynums + 1),
            'updatetime' => time()
        );
        //保存回答信息
        $repay_id = $this->bbs_model->saveQuestionAnswerData($data);
        if ($repay_id > 0) {
            $this->bbs_model->saveQuestionEdit($questionData, $qid);
            $point = 2;
            if ($this->common_model->editSignPoint($id, $point)) {
                $member = $this->common_model->getMemInfo($id);
                $pointsnow = $member->pointsnow;
                $points = $member->points;
                $pointsuse = $member->pointsuse;
                $data = array(
                    'user_id' => $id,
                    'change' => $point,
                    'points' => $points,
                    'pointsnow' => $pointsnow,
                    'pointsuse' => $pointsuse,
                    'type' => $type,
                    'createtime' => time(),
                    'passtime' => strtotime('tomorrow')
                );
                $this->common_model->savePointInfo($data);
                $data['info'] = $this->center_point_model->getPointsInfo($id);
                if ($data['info']->iscate < 3) {
                    if ($data['info']->points >= $data['info']->maxexp) {
                        $arr = array(
                            'iscate' => intval($data['info']->iscate) + 1
                        );
                        $this->center_point_model->autoLevelUp($arr, $id);
                    }
                }
                $msg['falg'] = 1;
                $msg['error'] = "回答成功，积分增加2！";
                echo json_encode($msg);
                exit;
            } else {
                $msg['error'] = "回答失败，错误未知！";
                echo json_encode($msg);
                exit;
            }
        }
    }

    /**
     * 
     * @todo 载入问题详情
     * 
     */
    public function questionDetial() {
        $qid = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($qid == 0) {
            show_404();
        } else {
            $question = $this->bbs_model->getQuestionDetial($qid);
            if (!empty($question)) {
                $data['question'] = $question;
                $header = array(
                    'chosen' => "question",
                    'title' => $question->title,
                    'keywords' => $question->title,
                    'description' => $question->questions
                );
                $this->loadBbsHeader($header);
                $this->bbs_model->editQuestionViewTimes($qid);
                $data['repay'] = $this->bbs_model->getQuestionRepayList($qid);
                $this->load->view('home/bbs/questionDetial', $data);
                $this->loadBbsFooter();
            } else {
                show_404();
            }
        }
    }

    /**
     * 
     * @todo 添加支持记录 
     * 
     */
    public function saveAssist() {
        $rid = $this->input->post('aid') ? $this->input->post('aid') : 0;
        $msg = array('flag' => 0, 'error' => "");
        if ($rid == 0) {
            $msg['error'] = "无法点赞，参数丢失!";
            echo json_encode($msg);
            exit;
        }
        if (empty($this->member)) {
            $msg['error'] = "无法点赞，请登录后操作!";
            echo json_encode($msg);
            exit;
        }
        //获取用户信息
        $member = $this->common_model->getMemInfo($this->member->user_id);
        if ($member->nickname == '') {
            $member->nickname = "匿名";
        }
        $data = array(
            'rid' => $rid,
            'user_id' => $member->user_id,
            'username' => $member->nickname,
            'creattime' => time()
        );
        //检查是否已经支持过
        if ($this->bbs_model->checkQuestionRepayAssisted($data)) {
            $msg['error'] = "你已经对该答案点过赞了!";
            echo json_encode($msg);
            exit;
        }
        $assist_id = $this->bbs_model->saveQuestionRepayAssisted($data);
        if ($assist_id > 0) {
            $this->bbs_model->editQuestionAssistTimes($rid);
            $msg['flag'] = 1;
            $msg['error'] = "操作成功!";
            echo json_encode($msg);
            exit;
        } else {
            $msg['error'] = "支持失败，错误未知!";
            echo json_encode($msg);
            exit;
        }
    }

    /**
     * 
     * @todo 载入提问页面 
     * 
     */
    public function askQuestion() {
        if (empty($this->member)) {
            redirect('login/login');
        }
        $header = array(
            'chosen' => "question",
            'title' => self::HEADER_TITLE,
            'keywords' => self::HEADER_KEYWORDS,
            'description' => self::HEADER_DESCRIPTION
        );
        $this->loadBbsHeader($header);
        $this->load->view('home/bbs/askQuestion');
        $this->loadBbsFooter();
    }

    /**
     * 
     * @todo 保存问题 
     * 
     */
    public function saveAskQuestion() {
        $title = htmlentities($this->input->post('title'));
        $description = htmlentities($this->input->post('description'));
        $msg = array('flag' => 0, 'error' => "");
        if (strlen($title) < 10) {
            $msg['error'] = "标题不能少于10个字符或者4个汉字!";
            echo json_encode($msg);
            exit;
        }
        if ($description == '') {
            $msg['error'] = "问题的详细描述不可以为空!";
            echo json_encode($msg);
            exit;
        }
        if (empty($this->member)) {
            $msg['error'] = "登录已经失效，请重新登录后再提问!";
            echo json_encode($msg);
            exit;
        }
        //获取用户信息
        $member = $this->common_model->getMemInfo($this->member->user_id);
        if ($member->nickname == '') {
            $member->nickname = "匿名";
        }
        $data = array(
            'title' => $title,
            'questions' => $description,
            'user_id' => $member->user_id,
            'user_name' => $member->nickname,
            'views' => 0,
            'repaynums' => 0,
            'is_del' => 0,
            'updatetime' => time(),
            'create_time' => time()
        );
        //检查是否已经发布问题了
        if ($this->bbs_model->checkQuestionIsSet($data)) {
            $msg['error'] = "抱歉，你不能重复提交相同的问题!";
            echo json_encode($msg);
            exit;
        }
        $qid = $this->bbs_model->saveQuestionDataAdd($data);
        if ($qid > 0) {
            $msg['flag'] = 1;
            $msg['error'] = "保存问题成功，等待网友们的回答吧!";
            echo json_encode($msg);
            exit;
        } else {
            $msg['error'] = "保存失败，发生一个未知的错误!";
            echo json_encode($msg);
            exit;
        }
    }

    /**
     * 
     * @todo 载入我的问题答案页面 
     * 
     */
    public function myAnswer() {
        $pagesize = 10;
        $header = array(
            'chosen' => "question",
            'title' => parent::HEADER_TITLE,
            'keywords' => parent::HEADER_KEYWORDS,
            'description' => parent::HEADER_DESCRIPTION
        );
        $this->loadBbsHeader($header);
        $nowpage = $this->input->get('page') ? $this->input->get('page') : 1;
        $search = array(
            'start' => ($nowpage - 1) * $pagesize,
            'pagesize' => $pagesize,
            'user_id' => isset($this->member->user_id) ? $this->member->user_id : 0
        );
        $count = $this->bbs_model->getMyAnswerCount($search);
        $list = $this->bbs_model->getMyAnswerList($search);
        $page_url = $this->pagenation->getFrontBbsUrl($count, $pagesize, $nowpage, base_url('bbs/myAnswer'), array());
        $data['list'] = $list;
        $data['page_url'] = $page_url;
        $this->load->view('home/bbs/myAnswer', $data);
        $this->loadBbsFooter();
    }

    /**
     * 
     * @todo  获取我的问题列表
     * 
     */
    public function myQuestion() {
        $pagesize = 10;
        $header = array(
            'chosen' => "question",
            'title' => parent::HEADER_TITLE,
            'keywords' => parent::HEADER_KEYWORDS,
            'description' => parent::HEADER_DESCRIPTION
        );
        $this->loadBbsHeader($header);
        $nowpage = $this->input->get('page') ? $this->input->get('page') : 1;
        $search = array(
            'start' => ($nowpage - 1) * $pagesize,
            'pagesize' => $pagesize,
            'user_id' => isset($this->member->user_id) ? $this->member->user_id : 0
        );
        $count = $this->bbs_model->getMyQuestionCount($search);
        $list = $this->bbs_model->getMyQuestionList($search);
        $page_url = $this->pagenation->getFrontBbsUrl($count, $pagesize, $nowpage, base_url('bbs/myQuestion'), array());
        $data['list'] = $list;
        $data['page_url'] = $page_url;
        $this->load->view('home/bbs/myQuestion', $data);
        $this->loadBbsFooter();
    }

    /**
     * 
     * @todo 查询问题或者咨询 
     * 
     */
    public function search() {
        $type = $this->input->post('searchtype') ? $this->input->post('searchtype') : 1;
        $keyword = htmlentities($this->input->post('keywords'));
        if (empty($keyword)) {
            show_404();
            exit;
        }
        if ($type == 1) {
            $header = array(
                'chosen' => "question",
                'title' => parent::HEADER_TITLE,
                'keywords' => parent::HEADER_KEYWORDS,
                'description' => parent::HEADER_DESCRIPTION
            );
            $this->loadBbsHeader($header);
            $list = $this->bbs_model->getQuestionListByKeyword($keyword);
            $data['list'] = $list;
            $data['keyword']=$keyword;
            $this->load->view('home/bbs/searchQuestion', $data);
            $this->loadBbsFooter();
        } else {
            $header = array(
                'chosen' => "article",
                'title' => parent::HEADER_TITLE,
                'keywords' => parent::HEADER_KEYWORDS,
                'description' => parent::HEADER_DESCRIPTION
            );
            $this->loadBbsHeader($header);
            $list = $this->bbs_model->getArticleListByKeyword($keyword);
            $data['list'] = $list;
            $data['keyword']=$keyword;
            $this->load->view('home/bbs/searchArticle', $data);
            $this->loadBbsFooter();
        }
    }

}
