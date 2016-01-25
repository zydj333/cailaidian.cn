<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of download
 *
 * @createtime 2015-7-10 14:18:32
 * 
 * @author ZhangPing'an
 * 
 * @todo download
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class download extends Home_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('product_model');
        //$this->load->helper('download');
        $this->common->checkMemberLogin();
    }

    public function index() {
        $product_id = $this->input->get('type');
        $pid = base64_decode($product_id);
        if ($pid > 0) {
            $product = $this->product_model->getProductDetial($pid);
            if (!empty($product)) {
                if ($product->download_file != '' && file_exists($product->download_file)) {
                    $this->common_model->editProductDownloadTimes($pid);
                    redirect(base_url() . $product->download_file);
                } else {
                    show_error('该产品没有上传相关资料！');
                }
            } else {
                show_error('下载文件失败，没有获取到相关产品！');
            }
        } else {
            show_error('下载文件失败，参数错误！');
        }
    }

}
