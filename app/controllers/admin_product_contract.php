<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_product_contract
 *
 * @createtime 2015-7-17 11:41:30
 * 
 * @author ZhangPing'an
 * 
 * @todo admin_product_contract
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin_product_contract extends Admin_Controller {

    //put your code here
    protected $pagesize = 10;

    /**
     * 
     * @todo  构造方法 
     * 
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('admin_product_contract_model');
        $this->load->library('pagenation');
    }

    /**
     * 
     * @todo 载入列表 
     * 
     */
    public function index() {
        $search = array(
            'start' => 0,
            'pagesize' => $this->pagesize
        );
        $count = $this->admin_product_contract_model->getProductContractCount($search);
        $list = $this->admin_product_contract_model->getProductContractList($search);
        $pageurl = $this->pagenation->getPage($count, $this->pagesize, 1);
        $data['list'] = $list;
        $data['page_url'] = $pageurl;
        $this->load->view('admin/product_contract/list', $data);
    }

    /**
     * 
     * @todo 异步获取列表数据 
     * 
     */
    public function ajaxList() {
        $nowpage = $this->input->post('nowpage') ? $this->input->post('nowpage') : 1;
        $celphone = $this->input->post('celphone');
        $username = $this->input->post('username');
        $status = $this->input->post('status') ? $this->input->post('status') : 0;
        $search = array(
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize
        );
        if ($celphone != '') {
            $search['celphone'] = $celphone;
        }
        if ($username != '') {
            $search['username'] = $username;
        }
        if ($status > 0) {
            $search['status'] = $status;
        }
        $count = $this->admin_product_contract_model->getProductContractCount($search);
        $list = $this->admin_product_contract_model->getProductContractList($search);
        $pageurl = $this->pagenation->getPage($count, $this->pagesize, $nowpage);
        $data = array(
            'flag' => 0,
            'error' => ""
        );
        if ($count > 0) {
            foreach ($list as $key => $value) {
                $list[$key]->addtime = date('Y-m-d H:i:s', $value->addtime);
                if ($value->posttime > 0) {
                    $list[$key]->posttime = date('Y-m-d H:i:s', $value->posttime);
                } else {
                    $list[$key]->posttime = '';
                }
                if ($value->resavetime > 0) {
                    $list[$key]->resavetime = date('Y-m-d H:i:s', $value->resavetime);
                } else {
                    $list[$key]->resavetime = '';
                }
                if ($value->canceltime > 0) {
                    $list[$key]->canceltime = date('Y-m-d H:i:s', $value->canceltime);
                } else {
                    $list[$key]->canceltime = '';
                }
            }
            $data['flag'] = 1;
            $data['error'] = $list;
            $data['pageurl'] = $pageurl;
        } else {
            $data['error'] = '没有获取到对于条件下的数据!';
            $data['pageurl'] = '获取到0条数据';
        }
        echo json_encode($data);
        exit;
    }

    /**
     * 
     * @todo 邮寄资料 
     * 
     */
    public function send() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id == 0) {
            echo "参数ID丢失，无法进行操作";
            exit;
        }
        $data = array(
            'status' => 2,
            'posttime' => time()
        );
        if ($this->admin_product_contract_model->editContractData($data, $id)) {
            echo "操作成功，点击确定回到列表!";
            exit;
        } else {
            echo "操作失败，发生未知错误!";
            exit;
        }
    }

    /**
     * 
     * @todo 撤销申请 
     * 
     */
    public function del() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        if ($id == 0) {
            echo "参数ID丢失，无法进行操作";
            exit;
        }
        $data = array(
            'status' => 4,
            'canceltime' => time()
        );
        if ($this->admin_product_contract_model->editContractData($data, $id)) {
            echo "操作成功，点击确定回到列表!";
            exit;
        } else {
            echo "操作失败，发生未知错误!";
            exit;
        }
    }

}
