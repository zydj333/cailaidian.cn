<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of common
 *
 * @createtime 2015-6-16 14:47:48
 * 
 * @author ZhangPing'an
 * 
 * @todo common
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class common {

    function __construct() {
        log_message('debug', "error_report Class Initialized");
        $this->CI = &get_instance();
        $this->CI->load->library('session');
        $this->CI->load->helper('cookie');
    }

    /**
     *
     * 设置session
     * @param $str 为session名称 $value为相对于的值
     *
     */
    function set_session($str, $value) {
        if ($this->is_ie()) {
            $time = time() + 7200;
            $this->setCookie($str, $value, $time);
        } else {
            header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
            $_SESSION [$str] = "";
            $this->CI->session->unset_userdata($str);
            $this->CI->session->set_userdata($str, $value);
            $_SESSION [$str] = $value;
        }
    }

    /**
     *
     * 获取session的值
     *
     * string $str为session的名称
     *
     * 返回string类型的值
     *
     */
    function get_session($str) {
        $value = "";
        if ($this->is_ie()) {
            $value = get_cookie($str);
        } else {
            $value = $this->CI->session->userdata($str);
        }
        return $value;
    }

    /**
     *
     * 删除名为$str的session
     *
     * string $str为session的名称
     *
     * 返回布尔类型的结果   是否删除成功
     *
     */
    function del_session($str) {
        if ($this->is_ie()) {
            if (delete_cookie($str)) {
                return true;
            } else {
                return false;
            }
        } else {
            if ($this->CI->session->unset_userdata($str)) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     *
     * 创建Cookie
     *
     * @param $str cookie的名称
     *
     * @param $value cookie的值
     *
     * @param $time cookie 的过期时间
     *
     */
    function setCookie($str, $value, $time) {
        $expire = $time;
        $domain = $_SERVER["SERVER_NAME"];
        $path = "/";
        $prefix = "";
        delete_cookie($str);
        set_cookie($str, $value, $expire, $domain, $path, $prefix);
    }

    /**
     *
     * 检查当前浏览器及版本
     *
     * 返回布尔类型及是否为IE
     */
    function is_ie() {
        $is_ie = 0;
        $agent = isset($_SERVER["HTTP_USER_AGENT"]) ? $_SERVER["HTTP_USER_AGENT"] : '';
        if (strpos($agent, 'MSIE') !== false || strpos($agent, 'rv:11.0')) {
            $is_ie = 1;
        } else {
            $is_ie = 0;
        }
        return $is_ie;
    }

    /**
     *
     * 检查是否为有效邮箱格式
     *
     * @param string $str 为邮箱地址
     *
     * 返回布尔类型的结果
     *
     */
    function is_email($user_email) {
        $chars = "/^([a-z0-9+_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,6}\$/i";
        if (strpos($user_email, '@') !== false && strpos($user_email, '.') !== false) {
            if (preg_match($chars, $user_email)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     *
     * 截取字符串
     * @param string $string要截取的字符串
     * $sublen 要截取的长度
     * $start  从第几个字符开始截取默认为0
     * $code   字符串的编码格式  默认为UTF-8。
     * 返回 string类型的结果 及截取后的字符串
     * 
     */
    function cut_str($string, $sublen, $start = 0, $code = 'UTF-8') {
        if ($code == 'UTF-8') {
            $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
            preg_match_all($pa, $string, $t_string);
            if (count($t_string[0]) - $start > $sublen)
                return join('', array_slice($t_string[0], $start, $sublen)) . "**";
            return join('', array_slice($t_string[0], $start, $sublen));
        }else {
            $start = $start * 2;
            $sublen = $sublen * 2;
            $strlen = strlen($string);
            $tmpstr = '';
            for ($i = 0; $i < $strlen; $i++) {
                if ($i >= $start && $i < ($start + $sublen)) {
                    if (ord(substr($string, $i, 1)) > 129) {
                        $tmpstr.= substr($string, $i, 2);
                    } else {
                        $tmpstr.= substr($string, $i, 1);
                    }
                }
                if (ord(substr($string, $i, 1)) > 129)
                    $i++;
            }
            if (strlen($tmpstr) < $strlen)
                $tmpstr.= "***";
            return $tmpstr;
        }
    }

    /**
     * 获取字符串的长度
     * @param string $str要计算的字符串
     * 返回一个int整数  即为本字符串的长度
     *
     */
    function getStrLen($str) {
        $i = 0;
        $count = 0;
        $len = strlen($str);
        while ($i < $len) {
            $chr = ord($str[$i]);
            $count++;
            $i++;
            if ($i >= $len)
                break;
            if ($chr & 0x80) {
                $chr <<= 1;
                while ($chr & 0x80) {
                    $i++;
                    $chr <<= 1;
                }
            }
        }
        return $count;
    }

    /**
     *
     * 获取用户的ID地址
     *
     * 根据系统判断获取用户的当前IP地址
     *
     * 返回string类型的IP地址
     *
     */
    function real_ip() {
        static $realip = NULL;
        if ($realip !== NULL) {
            return $realip;
        }
        if (isset($_SERVER)) {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                /* 取X-Forwarded-For中第一个非unknown的有效IP字符串 */
                foreach ($arr AS $ip) {
                    $ip = trim($ip);
                    if ($ip != 'unknown') {
                        $realip = $ip;
                        break;
                    }
                }
            } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $realip = $_SERVER['HTTP_CLIENT_IP'];
            } else {
                if (isset($_SERVER['REMOTE_ADDR'])) {
                    $realip = $_SERVER['REMOTE_ADDR'];
                } else {
                    $realip = '0.0.0.0';
                }
            }
        } else {
            if (getenv('HTTP_X_FORWARDED_FOR')) {
                $realip = getenv('HTTP_X_FORWARDED_FOR');
            } elseif (getenv('HTTP_CLIENT_IP')) {
                $realip = getenv('HTTP_CLIENT_IP');
            } else {
                $realip = getenv('REMOTE_ADDR');
            }
        }
        $onlineip = array();
        preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
        $realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';
        return $realip;
    }

    /**
     *
     * 检查后台登录
     *
     * 检查当前用户是否已经登录
     *
     */
    function checkAdminLogin() {
        $url = "/admin_login/index";
        $m_id = $this->get_session('user_id');
        $m_name = $this->get_session('user_name');
        if ($m_id == "" && $m_name == "") {
            redirect($url);
        }
    }

    /**
     *
     * 检查前台
     *
     * 检查当前用户是否已经登录
     *
     */
    function checkMemberLogin() {
        $url = "/login/index";
        $member = json_decode($this->get_session('member'));
        if (empty($member)) {
            redirect($url);
        }
    }

    /**
     *
     * 生成Excel表格文件
     *
     * @param $array_name 表头参数（一维数组）
     *
     * @param $array 要导出的数据（二维数组）
     *
     * @param $filename 导出的excel文件的文件名称
     *
     */
    function array_to_excel($array_name, $array, $filename = 'exceloutput') {
        $filename = iconv("UTF-8", "gbk", $filename);
        $headers = '';
        $data = '';
        $obj = & get_instance();
        if (count($array) == 0) {
            echo '<p>The table appears to have no data.</p>';
        } else {
            foreach ($array_name as $field) {
                $headers .= iconv("utf-8", "GBK", $field) . "\t";
            }
            foreach ($array as $row) {
                $line = '';
                foreach ($row as $value) {
                    if ((!isset($value)) OR ( $value == "")) {
                        $value = "\t";
                    } else {
                        $value = str_replace('"', '""', $value);
                        $value = '"' . $value . '"' . "\t";
                    }
                    $line .= $value;
                }
                $data .= trim($line) . "\n";
            }
            $data = str_replace("\r", "", iconv("utf-8", "GBK", $data));
            header("Content-type: application/x-msdownload");
            header("Content-type:charset=utf-8");
            header("Content-Disposition: attachment; filename=$filename.xls");
            echo "$headers\n$data";
        }
    }

    /**
     *
     * @todo 订单号生成
     *
     */
    public function createOrderSn() {
        $year_code = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
        $order_sn = $year_code[intval(date('Y')) - 2010] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
        return $order_sn;
    }

    /**
     *
     * @todo 验证手机号码是否合法
     *
     * @param $mobilephone 手机号号码
     *
     * @return 返回真假类型的结果
     *
     */
    public function checkPhone($mobilephone) {
        if (preg_match("/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$|14[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}/", $mobilephone)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @todo 远程图片下载 
     * 
     */
    public function downloadFileWithCurl($file_url, $save_to) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_URL, $file_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $file_content = curl_exec($ch);
        curl_close($ch);
        $downloaded_file = fopen($save_to, 'w');
        fwrite($downloaded_file, $file_content);
        fclose($downloaded_file);
        return true;
    }

    function checkIdCard($idcard) {

        // 只能是18位  
        if (strlen($idcard) != 18) {
            return false;
        }

        // 取出本体码  
        $idcard_base = substr($idcard, 0, 17);

        // 取出校验码  
        $verify_code = substr($idcard, 17, 1);

        // 加权因子  
        $factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);

        // 校验码对应值  
        $verify_code_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');

        // 根据前17位计算校验码  
        $total = 0;
        for ($i = 0; $i < 17; $i++) {
            $total += substr($idcard_base, $i, 1) * $factor[$i];
        }

        // 取模  
        $mod = $total % 11;

        // 比较校验码  
        if ($verify_code == $verify_code_list[$mod]) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 定义redirect()跳转函数，是用来在用户操作后，页面根据要求跳转到指定页面 
     * 
     * @param unknown_type $ms 是用来调整跳转所需要的秒数 
     * @param unknown_type $url 是指定跳转到的地址 
     * @param unknown_type $text 是显示跳转时候的信息 
     */
    function redirect($ms = '', $url = '', $text = '') {
        echo <<<EOT
                <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="refresh" content=$ms;URL=$url>
                <meta charset="UTF-8">
                </head>
                <div align="center">
                <table width="600" height="800" border="0" cellpadding="1" cellspacing="1" class="tableoutline">
                <tr>
                <td colspan="3"><table width="100%" border="0" cellpadding="5" cellspacing="1">
                <tr>
                <td valign="bottom"><div align="center" style="font-size:20px;">页面操作提示</div></td>
                </tr>
                <tr>
                <td><div align="center" style="font-size:40px;">$text</div></td>
                </tr>
                <tr>  
                <td><div align="center"><a href="$url" mce_href="$url" style="font-size:20px;">本页面在 $ms 秒后自动跳转，如果您的浏览器没有跳转，点此链接返回。</a></div>
                </td>
                </tr>
                </table></td>
                </tr>
                </table>
                </div>
EOT;
    }

}
