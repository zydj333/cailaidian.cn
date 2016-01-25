<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class center_benefit extends Home_Controller {
    //put your code here
    
    public function __construct() {
        parent::__construct();
        $this->load->model('center_model');
        $this->common->checkMemberLogin();
    }
    
    /**
     * 
     * @todo 福利首页 
     * 
     */
    public function index(){
        $header = array(
            'chosen' => "benefit",
            'title' => parent::HEADER_TITLE,
            'keywords' => parent::HEADER_KEYWORDS,
            'description' => parent::HEADER_DESCRIPTION
        );
        $this->loadCenter($header);
        $this->load->view('home/center_benefit/benefit');
        $this->loadFooter();
    } 
}