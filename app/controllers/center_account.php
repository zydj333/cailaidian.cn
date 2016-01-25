<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class center_account extends Home_Controller {
    
    private $pagesize = 8;
    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->model('center_model');
        $this->load->model('center_account_model');
        $this->load->model('center_point_model');
        $this->load->model('mysetting_model');
        $this->load->library('pagenation');
        $this->common->checkMemberLogin();
    }

    /**
     * 
     * @todo 个人资料首页 
     * 
     */
    public function index() {
        $header = array(
            'chosen' => "personal",
            'title' => parent::HEADER_TITLE,
            'keywords' => parent::HEADER_KEYWORDS,
            'description' => parent::HEADER_DESCRIPTION
        );
        $id = $this->member->user_id;
        $area = $this->common_model->getMemInfo($id);
        $pid = $area->province_id;
        $cid = $area->city_id;
        $aid = $area->area_id;
        $data['pro'] = $this->center_account_model->getArea($pid);
        $data['city'] = $this->center_account_model->getArea($cid);
        $data['area'] = $this->center_account_model->getArea($aid);
        $data['province'] = $this->common_model->getProvinceCityArea(0);
        $data['info'] = $this->center_account_model->getUserinfo($id);
        $data['point_info'] = $this->center_point_model->getPointsInfo($id);
        $this->loadCenter($header);
        $this->load->view('home/center_account/personal', $data);
        $this->loadFooter();
    }

    /**
     * 
     * @todo 上传头像 
     * 
     */
    public function wechat() {
        $header = array(
            'chosen' => "header",
            'title' => parent::HEADER_TITLE,
            'keywords' => parent::HEADER_KEYWORDS,
            'description' => parent::HEADER_DESCRIPTION
        );
        $this->loadCenter($header);
        $this->load->view('home/center_account/wechat');
        $this->loadFooter();
    }

    /**
     * 
     * @todo 保存用户头像 
     * 
     */
    public function savewechat() {
        /* 温馨提示：
         * 在flash的参数名upload_url中可自行定义一些参数（请求方式：GET），定义后在服务器端获取即可，比如可以应用到用户验证，文件的保存名等。
         * 本示例未作极致的用户体验与严谨的安全设计（如用户直接访问此页时该如何，万一客户端数据不可信时验证文件的大小、类型等），只保证正常情况下无误，请阁下注意。
         */
        header('Content-Type: text/html; charset=utf-8');
        $user = $this->member;
        $result = array();
        $result['success'] = false;
        $successNum = 0;
        $i = 0;
        $msg = '';
        //上传目录
        $dir = "upload/wechat";
        //echo json_encode($_FILES);exit;
        //遍历所有文件域
        $fileName = date("YmdHis") . "_" . $user->user_id;
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
                        'wechat_url' => $dir . "/" . $fileName . "_big.jpg"
                    );
                    $this->mysetting_model->saveMemberEdit($userimg, $user->user_id);
                    $user->avatar_big = $virtualPath;
                    $successNum++;
                    $i++;
                } else if ($key == '__avatar2') {
                    //中头像
                    $virtualPath = $dir . "/" . $fileName . "_middle.jpg";
                    $result['avatarUrls'][$i] = '/' . $virtualPath;
                    move_uploaded_file($_FILES[$key]["tmp_name"], $virtualPath);
                    $user->avatar_middle = $virtualPath;
                    $successNum++;
                    $i++;
                } else if ($key == '__avatar3') {
                    //小头像
                    $virtualPath = $dir . "/" . $fileName . "_small.jpg";
                    $result['avatarUrls'][$i] = '/' . $virtualPath;
                    move_uploaded_file($_FILES[$key]["tmp_name"], $virtualPath);
                    $user->avatar_small = $virtualPath;
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

    /**
     * 
     * @todo 实名认证 
     * 
     */
    public function truename() {
        $truename = trim($this->input->post('truename'));
        $idcard = trim($this->input->post('idcard'));
        $varifyCode = trim($this->input->post('safeCode'));
        $msg = array('flag' => 0, 'error' => "");
        if ($truename == '' || $idcard == '') {
            $msg['error'] = "认证信息不能为空！";
            echo json_encode($msg);
            exit;
        }
        $str = '/^[\x{4e00}-\x{9fa5}]{2,5}$/u';
        if (!preg_match($str, $truename)) {
            $msg['error'] = "请输入正确的姓名！";
            echo json_encode($msg);
            exit;
        }
        if ($varifyCode == '') {
            $msg['error'] = "验证码不能为空！";
            echo json_encode($msg);
            exit;
        }
        if ($varifyCode != $this->common->get_session('varifyCode')) {
            $msg['error'] = "验证码错误！";
            echo json_encode($msg);
            exit;
        }
        if (!$this->common->checkIdCard($idcard)) {
            $msg['error'] = "请输入正确的身份证信息！";
            echo json_encode($msg);
            exit;
        }
        $id = $this->member->user_id;
        $data = array(
            'truename' => $truename,
            'idcard' => $idcard,
            'is_true' => 1
        );
        if ($this->center_account_model->truename($data, $id)) {
            $msg['flag'] = 1;
            $msg['error'] = "认证通过！";
            echo json_encode($msg);
            exit;
        } else {
            $msg['error'] = '认证失败，错误未知！';
            echo json_encode($msg);
            exit;
        }
    }

    /*
     * 
     * 个人资料
     * 
     */

    public function person() {
            $id = $this->member->user_id;
            $msg = array('flag' => 0, 'error' => "");
            $province_id = trim($this->input->post('province_id'));
            $city_id = trim($this->input->post('city_id'));
            $area_id = trim($this->input->post('area_id'));
            $qq = trim($this->input->post('qq'));
            $sign = trim($this->input->post('sign'));
            if ($province_id == 0) {
                $msg['error'] = "请选择省份！";
                echo json_encode($msg);
                exit;
            }
            if ($city_id == 0) {
                $msg['error'] = "请选择城市！";
                echo json_encode($msg);
                exit;
            }
            if ($area_id == 0) {
                $msg['error'] = "请选择地区！";
                echo json_encode($msg);
                exit;
            }
            if ($qq == '') {
                $msg['error'] = "请输入QQ号码！";
                echo json_encode($msg);
                exit;
            }
            if ($sign == '') {
                $msg['error'] = "请输入个性签名！";
                echo json_encode($msg);
                exit;
            }
            $data = array(
                'province_id' => $province_id,
                'city_id' => $city_id,
                'area_id' => $area_id,
                'qq' => $qq,
                'sign' => $sign
            );
            if ($this->center_account_model->editMemberInfo($data, $id)) {
                $msg['flag'] = 1;
                $msg['error'] = "修改成功！";
                echo json_encode($msg);
                exit;
            } else {
                $msg['error'] = "修改失败！";
                echo json_encode($msg);
                exit;
            }
    }

    /*
     * 
     * 邮箱验证
     * 
     */

    public function email() {
        $type = ($this->input->post('type') != '') ? $this->input->post('type') : 'attestation';
        $email = trim($this->input->post('email'));
        $msg = array('flag' => 0, 'error' => "");
        if ($email == '') {
            $msg['error'] = "邮箱不能为空！";
            echo json_encode($msg);
            exit;
        }
        if ($this->common->is_email($email)) {
            $user_id = $this->member->user_id;
            $bata = array(
                'email' => $email
            );
            $this->center_account_model->updateEmail($bata, $user_id);
            $randnum = rand(1000000, 9999999);
            if ($type == 'attestation') {
                $title = '财来电邮箱验证';
                $str = '';
                $str1 = '';
                $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
                for ($i = 0; $i < 31; $i ++) {
                    $str .= $pattern {mt_rand(0, 61)}; //生成随机字符
                    $str1 .= $pattern {mt_rand(0, 61)}; //生成随机字符
                }
                $url = base_url() . 'email/verify/' . base64_encode($email) . '/' . base64_encode(md5($this->member->user_id)) . '/usrname=*' . $str1 . $randnum . '/passwd=*' . $str;
                $content = '亲爱的用户（' . $this->member->account . '）您好，感谢您对财来电的关注和支持，您的邮箱认证链接为' . $url .'
                该链接24小时内有效，如果点击失败请复制打开！如果非本人操作，请登录网站修改密码或与客服人员联系！谢谢。<br/><br/>链接：' . $url;
            }
            $data = array(
                'user_id' => $this->member->user_id,
                'email' => $email,
                'title' => $title,
                'content' => $content,
                'type' => $type,
                'creattime' => time(),
                'randnum' => $randnum
            );
            $id = $this->center_account_model->saveEmail($data);
            if ($id > 0) {
                //self::sendEmail();
                $msg['flag'] = 1;
                $msg['error'] = '创建邮件成功,去您的邮箱查看吧！';
            } else {
                $msg['error'] = '创建邮件失败！';
            }
        } else {
            $msg['error'] = '邮箱格式错误！';
        }
        echo json_encode($msg);
    }

    /*
     * @todo 修改认证手机
     * 
     */

    public function phone() {
        $_data = $this->input->post();
        $phone = trim($_data['account']);
        $password = trim($_data['password']);
        $msg = array('flag' => 0, 'error' => '');
        if ($phone == '') {
            $code['error'] = '手机号码不能为空！';
            echo json_encode($code);
            exit;
        }
        if ($password == '') {
            $code['error'] = '密码不能为空！';
            echo json_encode($code);
            exit;
        }
        $phonecode = trim($_data['phonecode']);
        if ($phonecode == '') {
            $code['error'] = '验证码不能为空！';
            echo json_encode($code);
            exit;
        }
        if ($this->center_account_model->checkPhoneCode($phone, $phonecode)) {
            $id = $this->member->user_id;
            $info = $this->common_model->getMemberInfo($id);
            if (!empty($info)) {
                $oldphone = $info->account;
                $pswd = $info->password;
                $random = $info->random;
                $result = md5(md5($password . $random));
                if ($result == $pswd) {
                    $code_status = array(
                        'status' => 2
                    );
                    $data = array(
                        'account' => $phone,
                        'phone' => $phone
                    );
                    $this->center_account_model->editPhoneCodeStatus($code_status, $phone, $phonecode);
                    if ($this->center_account_model->editMemberAccount($data, $oldphone)) {
                        $this->common->del_session('member');
                        $msg['flag'] = 1;
                        $msg['error'] = "修改成功，请重新登录！";
                        echo json_encode($msg);
                        exit;
                    } else {
                        $msg['error'] = "修改失败，请重试！";
                        echo json_encode($msg);
                        exit;
                    }
                } else {
                    $code['error'] = '密码错误，修改失败！';
                    echo json_encode($code);
                    exit;
                }
            } else {
                $code['error'] = '未获取到用户信息！';
                echo json_encode($code);
                exit;
            }
        } else {
            $code['error'] = '验证码错误或已过期！';
            echo json_encode($code);
            exit;
        }
    }

    /**
     * 
     * @todo 修改密码首页 
     * 
     */
    public function modify() {
        $header = array(
            'chosen' => "modify",
            'title' => parent::HEADER_TITLE,
            'keywords' => parent::HEADER_KEYWORDS,
            'description' => parent::HEADER_DESCRIPTION
        );
        $this->loadCenter($header);
        $this->load->view('home/center_account/modify');
        $this->loadFooter();
    }

    /**
     * 
     * @todo 修改密码 
     * 
     */
    public function checkNewPassword() {
        $id = $this->member->user_id;
        $password = $this->input->post('password');
        $newPassword = $this->input->post('newPassword');
        $confirmPassword = $this->input->post('confirmPassword');
        $msg = array('flag' => 0, 'error' => '');
        if (strlen($password) > 5) {
            if ($newPassword == $confirmPassword) {
                $info['list'] = $this->center_account_model->getMemberInfo($id);
                foreach ($info['list'] as $key => $value) {
                    if (md5(md5($password . $value->random)) == $value->password) {
                        $data = array('password' => md5(md5($newPassword . $value->random)));
                        if ($this->center_account_model->editMemberLoginPassword($data, $id)) {
                            $this->common->del_session('member');
                            $msg['flag'] = 1;
                            $msg['error'] = '密码已经成功修改，现在就去登录吧！';
                            echo json_encode($msg);
                            exit;
                        } else {
                            $msg['error'] = '修改失败，错误未知！';
                            echo json_encode($msg);
                            exit;
                        }
                    } else {
                        $msg['error'] = '原密码输入错误！';
                        echo json_encode($msg);
                        exit;
                    }
                }
            } else {
                $msg['error'] = '两次密码不一致！';
                echo json_encode($msg);
                exit;
            }
        } else {
            $msg['error'] = '密码长度不能小于6个字符';
            echo json_encode($msg);
            exit;
        }
    }

    /**
     * 
     * @todo 站内消息首页 
     * 
     */
    public function message() {
        $header = array(
            'chosen' => "message",
            'title' => parent::HEADER_TITLE,
            'keywords' => parent::HEADER_KEYWORDS,
            'description' => parent::HEADER_DESCRIPTION
        );
        $nowpage = $this->input->get('page') ? htmlentities($this->input->get('page')) : 1;
        $search = array(
            'id' => $this->member->user_id,
            'start' => ($nowpage - 1) * $this->pagesize,
            'pagesize' => $this->pagesize
        );
        $param = array();
        $count = $this->center_account_model->getMessageCount($search);

        $data['list'] = $this->center_account_model->getMessageList($search);
        $data['pagenation'] = $this->pagenation->getFrontMessageUrl($count, $this->pagesize, $nowpage, base_url('center_account/message'),$param);
        $this->loadCenter($header);
        $this->load->view('home/center_account/message', $data);
        $this->loadFooter();
    }

    /**
     * 
     * @todo 站内消息阅读
     * 
     */
    public function read() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        $to_id = $this->member->user_id;
        if ($id > 0) {
            $info = $this->center_account_model->getMessageInfo($id, $to_id);
            $this->center_account_model->editMessage($id, $to_id);
            if (!empty($info)) {
                $data['info'] = $info;
                $this->load->view('home/center_account/msginfo', $data);
            } else {
                $this->common->redirect('3','/center_account/msginfo','获取信息失败！');
            }
        } else {
            $this->common->redirect('3','/center_account/msginfo','获取数据失败！');
        }
    }

    /**
     * 
     * @todo 站内消息删除
     * 
     */
    public function del() {
        $id = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        $to_id = $this->member->user_id;
        if ($id > 0) {
            $this->center_account_model->delMessage($id, $to_id);
        } else {
            error('获取数据失败');
        }
    }

    /*
     * 
     * 积分功能
     * 
     */

    public function sign() {
        $msg = array('flag' => 0, 'error' => "");
        $id = $this->member->user_id;
        $type = $this->input->post('type');
        if ($type == 'sign') {
            $time = $this->common_model->getPointInfo($id);
            $passtime = isset($time->passtime) ? $time->passtime : 1;
            if (time() < $passtime) {
                $msg['error'] = '您今天已经签到，请勿重复签到！';
                echo json_encode($msg);
                exit;
            } else {
                $point = 10;
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
                    if($data['info']->iscate < 3){
                        if($data['info']->points >= $data['info']->maxexp){
                            $arr = array(
                                'iscate' => intval($data['info']->iscate) + 1
                            );
                            $this->center_point_model->autoLevelUp($arr,$id);
                        }
                    }
                    $msg['flag'] = 1;
                    $msg['error'] = '签到成功，增加10积分！';
                    echo json_encode($msg);
                } else {
                    $msg['error'] = '签到失败，请重新登录！';
                    echo json_encode($msg);
                }
            }
        }
    }

}
