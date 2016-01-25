<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

    private static $instance;

    /**
     * Constructor
     */
    public function __construct() {
        self::$instance = & $this;

        // Assign all the class objects that were instantiated by the
        // bootstrap file (CodeIgniter.php) to local class variables
        // so that CI can run as one big super object.
        foreach (is_loaded() as $var => $class) {
            $this->$var = & load_class($class);
        }

        $this->load = & load_class('Loader', 'core');

        $this->load->initialize();

        log_message('debug', "Controller Class Initialized");
    }

    public static function &get_instance() {
        return self::$instance;
    }

}

// END Controller class

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */
class Admin_Controller extends CI_Controller {

    protected $userid;
    protected $username;
    protected $userinfo;

    public function __construct() {
        parent::__construct();
        $this->common->checkAdminLogin();
        $this->userid = $this->common->get_session('user_id');
        $this->username = $this->common->get_session('user_name');
        $this->userinfo = json_decode($this->common->get_session('user_info'));
    }

}

/**
 * 
 * @todo 前台公用控制器类
 * 
 */
class Home_Controller extends CI_Controller {

    const HEADER_TITLE = "财来电-理财产品收益率高，理财规划师专业解读理财技巧";
    const HEADER_KEYWORDS = "信托、信托公司、信托产品、小额信托、阳光私募、阳光私募基金、保险理财、理财型保险、理财保险、资产管理、资管产品、理财咨询、理财规划师、理财师";
    const HEADER_DESCRIPTION = "财来电，专业为投资者提供资产管理计划，私募基金，保险理财及信托产品，佣金绝对高，结算绝对快！ 理财规划师专业解读理财方法，解答各类理财问题，欢迎理财师入驻！欢迎投资者进行理财咨询！";

    protected $member;

    public function __construct() {
        parent::__construct();
        $this->member = json_decode($this->common->get_session('member'));
    }

    /**
     * 
     * @todo 载入页面头部
     * 
     * @param $param 头部参数
     * 
     */
    public function loadHeader($param) {
        $param['member'] = $this->member;
        $this->load->view('home/public/header', $param);
    }

    /**
     * 
     * @todo 载入个人中心头部
     * 
     * @param $param 头部参数
     * 
     */
    public function loadCenter($param) {
        $id = $this->member->user_id;
        $param['sess'] = $this->member;
        $param['member'] = $this->common_model->getMemInfo($id);
        $param['log'] = $this->common_model->getLastLogin($id);
        $param['count'] = $this->common_model->getMessageCount($id);
        $this->load->model('center_point_model');
        $param['info'] = $this->center_point_model->getPointsInfo($id);
        $this->load->view('home/public/center', $param);
    }

    /**
     * 
     * @todo 载入底部信息 
     * 
     * @param $param 底部参数
     * 
     */
    public function loadFooter() {
        $param = array();
        $this->load->view('home/public/footer', $param);
    }

    public function userinfo() {
        return json_decode($this->common->get_session('member'), TRUE);
    }

    /**
     * 
     * @todo 载入社区头部
     * 
     * @param $param 头部参数 
     * 
     */
    public function loadBbsHeader($param) {
        $param['member'] = $this->member;
        $this->load->view('home/public/bbs_header', $param);
    }

    /**
     * 
     * @todo 载入社区底部
     * 
     * @param $param 底部参数 
     * 
     */
    public function loadBbsFooter() {
        $param['userlogin'] = $this->getMemberDetial();
        //获取最新动态
        $param['feed'] = $this->getNewFeed();
        $param['link'] = $this->common_model->getFriendLinkList();
        $this->load->view('home/public/bbs_footer', $param);
    }

    /**
     * 
     * @todo 获取最新动态 
     * 
     */
    public function getNewFeed() {
        return $this->common_model->getNewFeedList(3);
    }

    /**
     * 
     * @todo 获取用户信息 
     * 
     */
    public function getMemberDetial() {
        $user_id = isset($this->member->user_id) ? $this->member->user_id : 0;
        $member = $this->common_model->getMemInfo($user_id);
        if (!empty($member)) {
            $member->truename = $this->common->cut_str($member->truename, 1, 0);
            $member->account = substr_replace($member->account, '****', 3,4);
            $member->questionCount = $this->common_model->getMyQuestionCount($user_id);
            $member->answerCount = $this->common_model->getMyAnswerCount($user_id);
        }
        return $member;
    }

}
