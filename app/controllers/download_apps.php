<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of download_apps
 *
 * @createtime 2015-7-20 18:17:08
 * 
 * @author ZhangPing'an
 * 
 * @todo download_apps
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class download_apps extends Home_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    function index(){
        redirect('http://www.cnaidai.com/mobile.html');
    }
}
