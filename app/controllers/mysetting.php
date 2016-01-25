<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class mysetting extends Home_Controller {

    protected $userinfo;

    public function __construct() {
        parent::__construct();
        $this->load->model('mysetting_model');
        $this->common->checkMemberLogin();
        $this->userinfo = $this->userinfo();
    }
    
    /**
     * 
     * @todo 上传头像 
     * 
     */
    public function avatar() {
        $header = array(
            'chosen' => "header",
            'title' => parent::HEADER_TITLE,
            'keywords' => parent::HEADER_KEYWORDS,
            'description' => parent::HEADER_DESCRIPTION
        );
        $user = $this->userinfo;
        $this->loadCenter($header);
        $this->load->view('home/mysetting/avatar');
        $this->loadFooter();
    }

    /**
     * 
     * @todo 保存用户头像 
     * 
     */
    public function saveavater() {
        /* 温馨提示：
         * 在flash的参数名upload_url中可自行定义一些参数（请求方式：GET），定义后在服务器端获取即可，比如可以应用到用户验证，文件的保存名等。
         * 本示例未作极致的用户体验与严谨的安全设计（如用户直接访问此页时该如何，万一客户端数据不可信时验证文件的大小、类型等），只保证正常情况下无误，请阁下注意。
         */
        header('Content-Type: text/html; charset=utf-8');
        $user = $this->userinfo;
        $result = array();
        $result['success'] = false;
        $successNum = 0;
        $i = 0;
        $msg = '';
        //上传目录
        $dir = "upload/avatar";
        //echo json_encode($_FILES);exit;
        //遍历所有文件域
        $fileName = date("YmdHis") . "_" . $user['user_id'];
        while (list($key, $val) = each($_FILES)) {
            if ($_FILES[$key]['error'] > 0) {
                $msg .= $_FILES[$key]['error'];
            } else {
                //上传原图
                if ($key == '__source') {
                    $virtualPath = $dir . "/" . $fileName . ".jpg";
                    $result['sourceUrl'] = '/' . $virtualPath;
                    move_uploaded_file($_FILES[$key]["tmp_name"], $virtualPath);
                    $successNum++;
                }
                //大头像
                else if ($key == '__avatar1') {
                    $virtualPath = $dir . "/" . $fileName . "_big.jpg";
                    $result['avatarUrls'][$i] = '/' . $virtualPath;
                    move_uploaded_file($_FILES[$key]["tmp_name"], $virtualPath);
                    //保存用户的头像
                    $userimg = array(
                        'head_ico' => $dir . "/" . $fileName . "_big.jpg"
                    );
                    $this->mysetting_model->saveMemberEdit($userimg, $user['user_id']);
                    $user['avatar_big'] = $virtualPath;
                    $successNum++;
                    $i++;
                } else if ($key == '__avatar2') {
                    //中头像
                    $virtualPath = $dir . "/" . $fileName . "_middle.jpg";
                    $result['avatarUrls'][$i] = '/' . $virtualPath;
                    move_uploaded_file($_FILES[$key]["tmp_name"], $virtualPath);
                    $user['avatar_middle'] = $virtualPath;
                    $successNum++;
                    $i++;
                } else if ($key == '__avatar3') {
                    //小头像
                    $virtualPath = $dir . "/" . $fileName . "_small.jpg";
                    $result['avatarUrls'][$i] = '/' . $virtualPath;
                    move_uploaded_file($_FILES[$key]["tmp_name"], $virtualPath);
                    $user['avatar_small'] = $virtualPath;
                    $successNum++;
                    $i++;
                }
            }
        }
        $this->common->set_session('member', json_encode($user));
        $result['msg'] = $msg;
        if ($successNum > 0) {
            $result['success'] = true;
        }
        //返回图片的保存结果（返回内容为json字符串）
        print json_encode($result);
    }
}