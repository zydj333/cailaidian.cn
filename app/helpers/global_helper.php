<?php

if ( ! function_exists('setcache'))
{
	/**
	 * 写入缓存，默认为文件缓存，不加载缓存配置。
	 * @param $name 缓存名称
	 * @param $data 缓存数据
	 * @param $filepath 数据路径（模块名称） caches/cache_$filepath/
	 * @param $type 缓存类型[file,memcache,apc]
	 * @param $config 配置名称
	 * @param $timeout 过期时间，默认为3650天
	 */
	function setcache($name, $data, $filepath='', $type='file',$timeout=315360000, $format='') {
		if(!isset($CI)) $CI =& get_instance();
		$CI->load->driver('cache');

		if($type=='file'){
			$id='caches_'.$filepath.'/'.$name.'.cache.php';
			if($format=='array'){
				$path = $CI->config->item('cache_path');
				$data = "<?php\nreturn ".var_export($data, true).";\n?>";
				return file_put_contents($path.$id, $data);
			}else{
				return $CI->cache->file->save($id,$data,$timeout);
			}
		}else{
			$id='caches_'.$filepath.'_'.$name;
			return $CI->cache->memcached->save($id,$data,$timeout);
		}
	}
}
if ( ! function_exists('getcache'))
{
	/**
	 * 读取缓存，默认为文件缓存，不加载缓存配置。
	 * @param string $name 缓存名称
	 * @param $filepath 数据路径（模块名称） caches/cache_$filepath/
	 * @param string $format 数据格式：array时一般为固定，所以删除、修改该参数暂时无效
	 */
	 function getcache($name, $filepath='', $type='file', $format='') {
		if(!isset($CI)) $CI =& get_instance();
		$CI->load->driver('cache');

		if($type=='file'){
			$id='caches_'.$filepath.'/'.$name.'.cache.php';
			if($format=='array'){
				$path = $CI->config->item('cache_path');
				if (!file_exists($path.$id)) {
					return false;
				}else{
					$data = @require($path.$id);
					return $data;
				}
			}else{

				return $CI->cache->file->get($id);
			}
		}else{
			$id='caches_'.$filepath.'_'.$name;
			return $CI->cache->memcached->get($id);
		}
	}
}
if ( ! function_exists('delcache'))
{
	/**
	 * 删除缓存，默认为文件缓存，不加载缓存配置。
	 * @param $name 缓存名称
	 * @param $filepath 数据路径（模块名称） caches/cache_$filepath/
	 * @param $type 缓存类型[file,memcache,apc]
	 * @param $config 配置名称
	 */
	function delcache($name, $filepath='', $type='file', $format='') {
		if(!isset($CI)) $CI =& get_instance();
		$CI->load->driver('cache');

		if($type=='file'){
			$id='caches_'.$filepath.'/'.$name.'.cache.php';
			return $CI->cache->file->delete($id);
		}else{
			$id='caches_'.$filepath.'_'.$name;
			return $CI->cache->memcached->delete($id);
		}
	}
}
if ( ! function_exists('ip'))
{
	/**
	 * 获取请求ip
	 *
	 * @return ip地址
	 */
	function ip() {
		if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
			$ip = getenv('HTTP_CLIENT_IP');
		} elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
			$ip = getenv('HTTP_X_FORWARDED_FOR');
		} elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
			$ip = getenv('REMOTE_ADDR');
		} elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return preg_match ( '/[\d\.]{7,15}/', $ip, $matches ) ? $matches [0] : '';
	}
}
if ( ! function_exists('random'))
{
	/**
	* 产生随机字符串
	*
	* @param    int        $length  输出长度
	* @param    string     $chars   可选的 ，默认为 0123456789
	* @return   string     字符串
	*/
	function random($length, $chars = '0123456789') {
		$hash = '';
		$max = strlen($chars) - 1;
		for($i = 0; $i < $length; $i++) {
			$hash .= $chars[mt_rand(0, $max)];
		}
		return $hash;
	}
}

if ( ! function_exists('get_url'))
{
	/**
	 * 获取当前页面完整URL地址
	 */
    function get_url() {
		$sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
		$php_self = $_SERVER['PHP_SELF'] ? safe_replace($_SERVER['PHP_SELF']) : safe_replace($_SERVER['SCRIPT_NAME']);
		$path_info = isset($_SERVER['PATH_INFO']) ? safe_replace($_SERVER['PATH_INFO']) : '';
		$relate_url = isset($_SERVER['REQUEST_URI']) ? safe_replace($_SERVER['REQUEST_URI']) : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.safe_replace($_SERVER['QUERY_STRING']) : $path_info);
		return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
	}
}
if ( ! function_exists('safe_replace'))
{
	/**
	 * 安全过滤函数
	 *
	 * @param $string
	 * @return string
	 */
	function safe_replace($string) {
		$string = str_replace('%20','',$string);
		$string = str_replace('%27','',$string);
		$string = str_replace('%2527','',$string);
		$string = str_replace('*','',$string);
		$string = str_replace('"','&quot;',$string);
		$string = str_replace("'",'',$string);
		$string = str_replace('"','',$string);
		$string = str_replace(';','',$string);
		$string = str_replace('<','&lt;',$string);
		$string = str_replace('>','&gt;',$string);
		$string = str_replace("{",'',$string);
		$string = str_replace('}','',$string);
		$string = str_replace('\\','',$string);
		return $string;
	}
}
if ( ! function_exists('print_current_date'))
{
	function print_current_date($params, $smarty)
	{
	  if(empty($params["format"])) {
	    $format = "%b %e, %Y";
	  } else {
	    $format = $params["format"];
	  }
	  return strftime($format,time());
	}
}
if ( ! function_exists('show_lang'))
{
	function show_lang($params)
	{
		$la=$params["la"];
	  	if(empty($la)) {
	    	return ;
	  	} else {
	   		$CI =& get_instance();
	  		$line = $CI->lang->line($la);
	  		return $line;
	  	}
	}
}

/**
 * iconv 编辑转换
 */
if (!function_exists('iv_iconv'))
{
	function iv_iconv($in_charset, $out_charset, $str) {
		$in_charset = strtoupper($in_charset);
		$out_charset = strtoupper($out_charset);
		if (function_exists('mb_convert_encoding')) {
			return mb_convert_encoding($str, $out_charset, $in_charset);
		} else {
			$CI =& get_instance();
			$CI->load->helper('iconv');
			$in_charset = strtoupper($in_charset);
			$out_charset = strtoupper($out_charset);
			if ($in_charset == 'UTF-8' && ($out_charset == 'GBK' || $out_charset == 'GB2312')) {
				return utf8_to_gbk($str);
			}
			if (($in_charset == 'GBK' || $in_charset == 'GB2312') && $out_charset == 'UTF-8') {
				return gbk_to_utf8($str);
			}
			return $str;
		}
	}
}
if ( ! function_exists('array_iconv'))
{
	/**
	 * 对数据进行编码转换
	 * @param array/string $data       数组
	 * @param string $input     需要转换的编码
	 * @param string $output    转换后的编码
	 */
	function array_iconv($data, $input = 'gbk', $output = 'utf-8') {
		if (!is_array($data)) {
			return iconv($input, $output, $data);
		} else {
			foreach ($data as $key=>$val) {
				if(is_array($val)) {
					$data[$key] = array_iconv($val, $input, $output);
				} else {
					$data[$key] = iv_iconv($input, $output, $val);
				}
			}
			return $data;
		}
	}
}
if ( ! function_exists('new_addslashes'))
{
	/**
	 * 返回经addslashes处理过的字符串或数组
	 * @param $string 需要处理的字符串或数组
	 * @return mixed
	 */
	function new_addslashes($string){
		if(!is_array($string)) return addslashes($string);
		foreach($string as $key => $val) $string[$key] = new_addslashes($val);
		return $string;
	}
}
if ( ! function_exists('new_stripslashes'))
{
	/**
	 * 返回经stripslashes处理过的字符串或数组
	 * @param $string 需要处理的字符串或数组
	 * @return mixed
	 */
	function new_stripslashes($string) {
		if(!is_array($string)) return stripslashes($string);
		foreach($string as $key => $val) $string[$key] = new_stripslashes($val);
		return $string;
	}
}
if ( ! function_exists('new_html_special_chars'))
{
	/**
	 * 返回经htmlspecialchars处理过的字符串或数组
	 * @param $obj 需要处理的字符串或数组
	 * @return mixed
	 */
	function new_html_special_chars($string) {
		if(!is_array($string)) return htmlspecialchars($string);
		foreach($string as $key => $val) $string[$key] = new_html_special_chars($val);
		return $string;
	}
}
if ( ! function_exists('remain_image_path'))
{
	/**
	 *	$imagepath:图片路径
	 *	$type:s表示图片名称加_s
	 *	$check:是否验证图片存在
	 */
	function remain_image_path($imagepath,$type='s',$isdefault = TRUE,$check = FALSE)
	{
		$defimg='uploadfile/common/default_image.png';
		if(empty($imagepath)) return $defimg;
		$paths=explode('.',$imagepath);
		if(count($paths)==0) return $isdefault==TRUE?$defimg:'';

		$res=$paths[0].'_'.$type.'.'.$paths[1];
		if($check===FALSE){
			return $res;
		}else{

			if(file_exists(FCPATH.$res))
				return $res;
			else
				return $isdefault==TRUE?$defimg:'';
		}
	}
}
if ( ! function_exists('create_order_number'))
{
	/**
	 *	生成订单号
	 */
	function create_order_number($prefix='')
	{
		$s=time();
		$ss=microtime();
		$sn1=date('Ymd',$s);
		$sn2=substr($s, - 4 );
		$sn3=substr($ss,6, 2);
		$sn4=sprintf('%02d' ,rand(0, 99));
		$orderSn=$prefix.$sn1.$sn2.$sn3.$sn4;
		return $orderSn;
	}
}
if ( ! function_exists('get_shop_credit'))
{
	/**
	 * 获取等级样式
	 */
	 function get_shop_credit($score)
	 {
		$setting=getcache('setting','commons');
		$res_string='buyer-heart level-1';
		$arr_setting=array();
		if(!empty($setting)){
			$arr=$setting['credit'];
			foreach($arr as $key=>$val){
				foreach($val as $k=>$v){
					if(intval($v[0])<intval($score) && intval($score)<=intval($v[1])){
						$res_string='buyer-'.$key.' level-'.$k;
					}
					//$arr_setting[]=array('class'=>'buyer-'.$key.' level-'.$k.'','s_score'=>$v[0],'e_score'=>$v[1]);
				}
			}
		}
		return $res_string;
	}
}
if ( ! function_exists('get_goods_evaluate'))
{
	/**
	 * 获取评论图标
	 */
	 function get_goods_evaluate($score)
	 {
		$setting=array(
				'1'=>'ncgeval-good',
				'0'=>'ncgeval-normal',
				'-1'=>'ncgeval-bad'
			);
		return isset($setting[$score])?$setting[$score]:'';
	}
}

if ( ! function_exists('cc_json_encode'))
{
	/**
	 * 转化为json数组
	 */
	function cc_json_encode($obj){
		$CI =& get_instance();

		$charset=$CI->config->item('charset');

		$CI->load->library('ijson');

		return $CI->ijson->encode($obj,$charset);
	}
}
if ( ! function_exists('cc_json_decode'))
{
	/**
	 * json数组转化为正常
	 */
	function cc_json_decode($obj){
		$CI =& get_instance();

		//$charset=$CI->config->item('charset');
		$CI->load->library('ijson');

		return $CI->ijson->decode($obj);
	}
}

if ( ! function_exists('cc_str_replace'))
{
	/***
	 * 字符串替换
	 * 说明$s='用户名{$username}或密码错误，你还有{$times}登录机会！';
	 * 	  $arr=array('times'=>9,'username'=>123456);
	 *    替换后：'用户名123456或密码错误，你还有9登录机会！';
	 */
	function cc_str_replace($msg,$arr){
		if(empty($msg)) return $msg;
		if(empty($arr)) return $msg;

		foreach($arr as $key=>$val){
			$msg=str_replace('{$'.$key.'}',$val,$msg);
		}
		return $msg;
	}
}
if(!function_exists('cc_array_to_str'))
{
	/**
	 * 数组装成字符串
	 * @param $list 数组
	 * @param $name 二维数组时需要组装的字段，一维数组是默认为空
	 * @param $zero 二维数组时需要组装的字段，一维数组是默认为空
	 * @param $spt  中间分隔符
	 */
	function cc_array_to_str($list,$name='',$spt=',') {
		$sp_ids='';
		foreach($list as $v){
			if(empty($name)){//一维数组
				$sp_ids.=$spt.$v;
			}else{//二维数组
				if(isset($v[$name]))$sp_ids.=$spt.$v[$name];
			}
		}
		if(!empty($sp_ids) ){
			$sp_ids=substr($sp_ids,1);
		}
		return $sp_ids;
	}
}
if(!function_exists('cc_substr'))
{
	/**
	 * @brief 字符串截取
	 * @param string $str 被截取的字符串
	 * @param int $length 截取的长度 值: 0:不对字符串进行截取(默认)
	 * @param bool $append 是否追加省略号 值: true:追加; false:不追加;
	 * @param string $charset $str的编码格式 值: utf8:默认;
	 * @return string 截取后的字符串
	 */
	function cc_substr($str, $length = 0, $append = true, $isUTF8=true)
	{
		$CI =& get_instance();

		//$charset=$CI->config->item('charset');
		$CI->load->library('ichar');

		return $CI->ichar->substr($str, $length, $append, $isUTF8);
	}
}
if ( ! function_exists('print_pre'))
{
	function print_pre($data = null)
	{
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}

}