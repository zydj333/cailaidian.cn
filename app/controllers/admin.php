<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin
 *
 * @createtime 2015-6-16 14:54:36
 * 
 * @author ZhangPing'an
 * 
 * @todo admin
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class admin extends CI_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    
    public function index(){
        redirect('/admin_index/index');
    }
}
