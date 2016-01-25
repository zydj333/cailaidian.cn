<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of common_model
 *
 * @createtime 2015-6-16 14:47:24
 * 
 * @author ZhangPing'an
 * 
 * @todo common_model
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class common_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @todo 定义产品期限 
     * 
     * @param $index 索引
     * 
     * @return 返回一个字符串或者数组
     * 
     */
    public function getProductDeadline($index = 0) {
        $deadline = array(
            1 => "12个月以内",
            2 => "12个月",
            3 => "13-23个月",
            4 => "24个月",
            5 => "24个月以上"
        );
        if ($index == 0) {
            return $deadline;
        } else {
            return $deadline[$index];
        }
    }

    /**
     * 
     * @todo 发行费用
     * 
     * @param $index 索引
     * 
     * @return 返回一个字符串或者数组 
     * 
     */
    public function getProductIssuCost($index = 0) {
        $issucost = array(
            1 => "1%以下(不包含1%)",
            2 => "1%-3%(不包含3%)",
            3 => "3%及以上"
        );
        if ($index == 0) {
            return $issucost;
        } else {
            return $issucost[$index];
        }
    }

    /**
     * 
     * @todo 获取收益率  
     * 
     * @param $index索引
     * 
     * @return  返回一个字符串或者数组
     * 
     */
    public function getProductInterest($index = 0) {
        $interest = array(
            1 => "8%以内",
            2 => "8%-9.9%",
            3 => "10%-11.9%",
            4 => "12%及以上",
            5 => "浮动收益",
        );
        if ($index == 0) {
            return $interest;
        } else {
            return $interest[$index];
        }
    }

    /**
     * 
     * @todo 获取收益类型
     * 
     * @param $index 索引
     * 
     * @return 返回一个字符串或者数组 
     * 
     */
    public function getProductEarning($index = 0) {
        $earning = array(
            1 => "固定收益",
            2 => "浮动收益",
            3 => "固定加浮动收益",
        );
        if ($index == 0) {
            return $earning;
        } else {
            return $earning[$index];
        }
    }

    /**
     * 
     * @todo 付息方式
     * 
     * @param $index 索引
     *  
     * @return  返回一个字符串或者数组
     * 
     */
    public function getProductPayWay($index = 0) {
        $payway = array(
            1 => "按月付息",
            2 => "按季付息",
            3 => "半年付息",
            4 => "按年付息",
            5 => "到期付息",
        );
        if ($index == 0) {
            return $payway;
        } else {
            return $payway[$index];
        }
    }

    /**
     * 
     * @todo 获取投资领域
     * 
     * @param $index 索引
     * 
     * @return 返回一个字符串或者数组  
     * 
     */
    public function getProductTenderArea($index = 0) {
        $area = array(
            1 => "工商企业类",
            2 => "金融市场类",
            3 => "基础设施类",
            4 => "房地产类",
            5 => "其他类"
        );
        if ($index == 0) {
            return $area;
        } else {
            return $area[$index];
        }
    }

    /**
     * 
     * @todo 获取大小比率 
     * 
     */
    public function getProductComparison($index = 0) {
        $comparison = array(
            1 => "小额畅打",
            2 => "已配出小额",
            3 => "严格配比",
            4 => "全大额"
        );
        if ($index == 0) {
            return $comparison;
        } else {
            return $comparison[$index];
        }
    }

    /**
     * 
     * @todo 产品分级 
     * 
     */
    public function getProductLevel($index = 0) {
        $level = array(
            1 => "AAA",
            2 => "AA",
            3 => "A",
            4 => "BBB",
            5 => "BB",
            6 => "B",
            7 => "CCC",
            8 => "CC",
            9 => "C",
            10 => "无评级"
        );
        if ($index == 0) {
            return $level;
        } else {
            return $level[$index];
        }
    }

    /**
     * 
     * @todo 根据父级id获取省份城市区域
     * 
     * @param $pid 父级ID
     * 
     * @return 返回一个object类型的结果 
     * 
     */
    public function getProvinceCityArea($pid = 0) {
        $this->db->where(array('pid' => $pid));
        $this->db->order_by('order', 'asc');
        $query = $this->db->get('db_area');
        return $query->result();
    }

    /**
     * 
     * @todo 根据ID获取省份城市地区详细信息
     * 
     * @param $id 区域ID
     * 
     * @return 返回一个object类型的结果 
     * 
     */
    public function getAreaInfoById($id) {
        $this->db->where(array('id' => $id));
        $query = $this->db->get('db_area');
        return $query->row();
    }

    /**
     * 
     * @todo 修改产品资料下载次数
     * 
     * @param $product_id 产品ID 
     * 
     * @return 返回一个boolean类型的结果 
     * 
     */
    public function editProductDownloadTimes($product_id) {
        $sql = 'UPDATE `db_product` SET `download_times`=download_times+1 WHERE `id`=?';
        $this->db->query($sql, array($product_id));
        return $this->db->affected_rows();
    }

    /**
     * 
     * @todo 修改浏览次数次数
     * 
     * @param $product_id 产品ID 
     * 
     * @return 返回一个boolean类型的结果 
     * 
     */
    public function editProductViewsTimes($product_id) {
        $sql = 'UPDATE `db_product` SET `view_times`=view_times+1 WHERE `id`=?';
        $this->db->query($sql, array($product_id));
        return $this->db->affected_rows();
    }

    /**
     * 
     * @todo 修改产品预约次数
     * 
     * @param $product_id 产品ID 
     * 
     * @return 返回一个boolean类型的结果 
     * 
     */
    public function editProductSupportTimes($product_id) {
        $sql = 'UPDATE `db_product` SET `support_times`=support_times+1 WHERE `id`=?';
        $this->db->query($sql, array($product_id));
        return $this->db->affected_rows();
    }

    /**
     * 
     * @todo 修改产品邮件发送次数
     * 
     * @param $product_id 产品ID 
     * 
     * @return 返回一个boolean类型的结果 
     * 
     */
    public function editProductMailTimes($product_id) {
        $sql = 'UPDATE `db_product` SET `mail_times`=mail_times+1 WHERE `id`=?';
        $this->db->query($sql, array($product_id));
        return $this->db->affected_rows();
    }

    /**
     * 
     * @todo 修改用户积分
     * 
     * @param $id 用户ID $point 要修改的积分
     * 
     * @return 返回一个boolean类型的结果 
     * 
     */
    public function editSignPoint($id, $point) {
        $sql = "UPDATE `db_member_info` SET `points`=points+'$point',`pointsnow`=pointsnow+'$point' WHERE `user_id`='$id'";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }

    /**
     * 
     * @todo 添加积分记录
     * 
     * @param $data 要添加的数据
     * 
     * @return  返回插入的ID 
     * 
     */
    public function savePointInfo($data) {
        $this->db->insert('db_point_record', $data);
        return $this->db->insert_id();
    }

    /**
     * 
     * @todo 获取积分变动记录
     * 
     * @param $id 用户ID
     * 
     * @return 返回一个object类型的结果 
     * 
     */
    public function getPointInfo($id) {
        $this->db->where(array('user_id' => $id,'type' => 'sign'));
        $this->db->order_by('createtime', 'desc');
        $query = $this->db->get('db_point_record');
        return $query->row();
    }

    /**
     *
     * 根据ID获取用户详情
     *
     * $id 要获取的数据ID
     *
     * 返回一个结果集
     *
     */
    public function getMemInfo($id) {
        $sql = "SELECT a.*,b.account,email,email_status FROM `db_member_info` AS a LEFT JOIN `db_member` AS b ON b.id = a.user_id where b.id = '$id';";
        $query = $this->db->query($sql);
        return $query->row();
    }

    /*
     * 
     * 获取登录时间
     * 
     * $id 要获取数据的ID
     * 
     * 返回一个结果集
     * 
     */

    public function getLastLogin($id) {
        $this->db->where(array('user_id' => $id));
        $this->db->order_by('login_time', 'desc');
        $query = $this->db->get('db_member_log');
        return $query->row();
    }

    /**
     * 
     * @todo 读取用户信息 
     * 
     * @param $id
     * 
     * @return 返回一个结果集
     * 
     */
    public function getMemberInfo($id) {
        $this->db->where(array('id' => $id));
        $query = $this->db->get('db_member');
        return $query->row();
    }

    /**
     * 
     * 修改用户密码,根据ID进行修改 
     * 
     * $data 要修改的数据 
     * 
     * $id
     * 
     * 返回一个boolean类型的结果
     * 
     */
    public function editMemberLoginPassword($data, $id) {
        return $this->db->update('db_member', $data, array('id' => $id));
    }

    /**
     * 
     * @todo 读取推荐人信息 
     * 
     * @param $cardno 推荐人号码
     * 
     * @return 返回一个结果集
     * 
     */
    public function getCardInfo($cardno) {
        $this->db->where(array('account' => $cardno));
        $query = $this->db->get('db_member');
        return $query->row();
    }

    /**
     * 
     * @todo 获取产品分类及分类下的产品列表 
     * 
     * @return 返回一个结果集
     * 
     */
    public function getProductCategory() {
        $this->db->order_by('salt', 'asc');
        $query = $this->db->get('db_protype');
        return $query->result();
    }

    /**
     * 
     * @todo 根据产品分类ID获取产品分类信息
     * 
     * @param $type_id 产品分类ID
     * 
     * @return 返回一个object类型的结果 
     * 
     */
    public function getProductCategoryDetial($type_id) {
        $this->db->where(array('id' => $type_id));
        $query = $this->db->get('db_protype');
        return $query->row();
    }

    /**
     * 
     * @todo 获取用户站内信列表
     * 
     * @param $to_id 用户ID
     * 
     * @return 返回一个结果集
     * 
     */
    public function getMessageCount($to_id) {
        $sql = "select * from db_message where  to_uid = '$to_id' and status = 0";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    /**
     * 
     * @todo 获取友情链接列表 
     * 
     * @return 返回一个object类型的结果
     * 
     */
    public function getFriendLinkList() {
        $this->db->order_by('listorder', 'asc');
        $query = $this->db->get('db_link');
        return $query->result();
    }

    /**
     * 
     * @todo 获取最新动态 
     * 
     * @param $count 要获取的条数
     * 
     * @return 返回一个object类型的结果集
     * 
     */
    public function getNewFeedList($count = 3) {
        $sql = 'select id,ac_id,search_name,title,article_time,sts,imageurl from db_article where sts=0 order by id desc limit ' . $count;
        $query = $this->db->query($sql);
        return $query->result();
    }

    /**
     * 
     * @todo 获取我的问题总条数
     * 
     * @param $user_id 用户ID
     * 
     * @return 返回一个int类型的整数
     * 
     */
    public function getMyQuestionCount($user_id) {
        $this->db->where(array('user_id' => $user_id));
        $query = $this->db->get('db_bbs_question');
        return $query->num_rows();
    }

    /**
     * 
     * @todo 获取我的回答总数
     * 
     * @param $user_id 用户ID
     * 
     * @return 返回一个int类型的整数
     * 
     */
    public function getMyAnswerCount($user_id) {
        $this->db->where(array('user_id' => $user_id));
        $query = $this->db->get('db_bbs_question_repay');
        return $query->num_rows();
    }

}
