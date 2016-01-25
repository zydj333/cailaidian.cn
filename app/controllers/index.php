<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of index
 *
 * @createtime 2015-7-2 14:55:02
 * 
 * @author ZhangPing'an
 * 
 * @todo index
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 * @todo 前台首页
 * 
 */
class index extends Home_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('index_model');
    }

    /**
     * 
     * @todo 前台首页 
     * 
     */
    public function index() {
        $header = array(
            'chosen' => "index",
            'title' => parent::HEADER_TITLE,
            'keywords' => parent::HEADER_KEYWORDS,
            'description' => parent::HEADER_DESCRIPTION
        );
        $this->loadHeader($header);
        $data['memeber'] = $this->member;
        //获取banner列表
        $banner = $this->index_model->getBannerList(8);
        //获取个分类下产品的总条数
        $count = $this->index_model->getProductCountEachType();
        //获取首页产品列表
        foreach ($count as $count_key => $count_value) {
            $product[$count_key]=new stdClass();
            $product[$count_key]->project = $this->index_model->productList($count_value->id);
            if (!empty($product[$count_key]->project)) {
                foreach ($product[$count_key]->project as $key => $value) {
                    $product[$count_key]->project[$key]->tender_area = $this->common_model->getProductTenderArea($value->tender_area);
                    $product[$count_key]->project[$key]->interest_area = $this->common_model->getProductInterest($value->interest_area);
                    $product[$count_key]->project[$key]->pay_way = $this->common_model->getProductPayWay($value->pay_way);
                }
            }
        }
        //获取信托快报
        $news = $this->index_model->getArticleList(1, 5);
        //获取新手帮助
        $help = $this->index_model->getArticleList(2, 5);
        //获取合作伙伴
        $partner = $this->index_model->getPartnerList(10);
        $data['banner'] = $banner;
        $data['count'] = $count;
        $data['product'] = $product;
        $data['news'] = $news;
        $data['help'] = $help;
        $data['partner'] = $partner;
        $this->load->view('home/index/index', $data);
        $this->loadFooter();
    }

}
