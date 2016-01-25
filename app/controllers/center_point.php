<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class center_point extends Home_Controller {
    //put your code here
    
    private $pagesize = 8;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('center_model');
        $this->load->library('pagenation');
        $this->load->model('center_point_model');
        $this->common->checkMemberLogin();
    }
    
    /**
     * 
     * @todo 积分首页 
     * 
     */
    public function index(){
        $id = $this->member->user_id;
        $header = array(
            'chosen' => "point",
            'title' => parent::HEADER_TITLE,
            'keywords' => parent::HEADER_KEYWORDS,
            'description' => parent::HEADER_DESCRIPTION
        );
        $data['info'] = $this->center_point_model->getPointsInfo($id);
        $this->loadCenter($header);
        $this->load->view('home/center_point/point',$data);
        $this->loadFooter();
    }
    /**
     * 
     * @todo 积分商品首页 
     * 
     */
    public function exchange(){
        $header = array(
            'chosen' => "exchange",
            'title' => parent::HEADER_TITLE,
            'keywords' => parent::HEADER_KEYWORDS,
            'description' => parent::HEADER_DESCRIPTION
        );
        $nowpage = $this->input->get('page') ? htmlentities($this->input->get('page')) : 1;
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize
        );
        $param = array();
        $count = $this->center_point_model->getListCount();
        $data['list'] = $this->center_point_model->getList($search);
        $data['pagenation'] = $this->pagenation->getFrontPointUrl($count, $this->pagesize, $nowpage, base_url('center_point/exchange'),$param);
        $this->loadCenter($header);
        $this->load->view('home/center_point/point_exchange',$data);
        $this->loadFooter();
    }
}