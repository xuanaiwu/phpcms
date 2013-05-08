<?php

class qqapi{

	private $appid,$appkey,$callback;
	
	public function __construct($appid, $appkey, $callback){
		$this->appid = $appid;
		$this->appkey = $appkey;
		$this->callback = $callback;
		pc_base::load_app_func('utils');
	}
	
	/**
	 * @brief 跳转到QQ登录页面.请求需经过URL编码，编码时请遵循 RFC 1738
	 *
	 */
	public function redirect_to_login()
	{
		//step1:获取Authorization Code
		$code=$_REQUEST["code"];
		if (empty($code)) {
		$_SESSION['state']=md5(uniqid(rand(),true));
		$redirect="https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id="
				. $this->appid . "&redirect_uri=" . urlencode($this->callback) ."&scope=get_user_info" ."&state="
						. $_SESSION['state'];
		echo ("<script>top.location.href='".$redirect."'</script>");
		}
	}

	public function get_openid(){
		/**
		 * Tips：
		 * QQ互联登录，授权成功后会回调注册的callback地址
		 * 必须要用授权的request token换取access token
		 * 访问QQ互联的任何资源都需要access token
		 * 目前access token是长期有效的，除非用户解除与第三方绑定
		 * 如果第三方发现access token失效，请引导用户重新登录QQ互联，授权，获取access token
		 */

		$access_str = $this->get_access_token($this->appid,$this->callback,$this->appkey, $_REQUEST["code"], $_SESSION["state"]);
		$_SESSION['access_token'] = $access_str;
		//Step3：使用Access Token来获取用户的OpenID		
		$graph_url="https://graph.qq.com/oauth2.0/me?access_token=".$access_str;
		$str=file_get_contents($graph_url);
		if (strpos($str,"callback")!==false) {
			$lpos=strpos($str,"(");
			$rpos=strpos($str, ")");
			$str=substr($str,$lpos+1,$rpos-$lpos-1);
		}
		$user=json_decode($str);
		if (isset($user->error)) {
		echo "<h3>error:</h3>".$user->error;
		echo "<h3>msg  :</h3>".$user->error_description;
		exit;
		}
		$_SESSION['openid']  = $user->openid;
	}
	
	/**
	 * @brief 获取access_token。请求需经过URL编码，编码时请遵循 RFC 1738
	 *
	 * @param $appid
	 * @param $appkey
	 * @return 返回字符串格式为access_token=xxx&
	 */
	public function get_access_token($appid, $callback, $appkey, $code, $state)
	{
		//step2:通过Authorization Code获取Access Token
		if ($_REQUEST['state']==$_SESSION['state']) {
			$token_url="https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&"
					. "client_id=" . $appid . "&redirect_uri=" . urlencode($callback)
					. "&client_secret=" . $appkey . "&code=" . $code."&state="
							.$state ;
			$response = file_get_contents($token_url);
			if (strpos($response, "callback")!==false) {
				$lpos=strpos($response, "(");
				$rpos=strpbrk($response,")");
				$response=substr($response, $lpos+1,$rpos-$lpos-1);
				$msg=json_decode($response);
				if (isset($msg->error)) {
					echo "<h3>error:</h3>".$msg->error;
					echo "<h3>msg  :</h3>".$msg->error_description;
					exit;
				}
			}
		    $params=array();
			parse_str($response,$params);
			if ($params['access_token'] == "") {
				$url="404.html";
				redirect($url);
			}
			return $params['access_token'];
		}else {
			echo ("The state does not match. You may be a victim of CSRF.");
		}
	}
	
	 /*
	 * @brief 获取用户信息.请求需经过URL编码，编码时请遵循 RFC 1738
	 */
	public function get_user_info($access_token,$appid,$openid)
	{
		//Step3：使用Access Token来获取用户的OpenID
		$url= "https://graph.qq.com/user/get_user_info?access_token=".$access_token
		."&oauth_consumer_key=".$appid."YOUR_APP_ID&openid=".$openid;
		$str = file_get_contents($url);
		if (strpos($str, "callback")!==false) {
			$lpos=strpos($str, "(");
			$rpos=strpbrk($str,")");
			$str=substr($str, $lpos+1,$rpos-$lpos-1);
			$msg=json_decode($str);
			if (isset($msg->error)) {
				echo "<h3>error:</h3>".$msg->error;
				echo "<h3>msg  :</h3>".$msg->error_description;
				exit;
			}
			return $msg;
			
		}
		$user=json_decode($str);
		if (empty($user->nickname)) {
			$url="404.html";
			redirect($url);;
		}
		return $user;
	}
}
?>