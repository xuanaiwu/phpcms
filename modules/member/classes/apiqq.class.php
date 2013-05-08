<?php
//应用的APPID
$app_id="100434664";
//应用的APPKEY
$app_secret="5ce5245097f0ace6506d630befb259cd";
//成功授权后的回调地址
$my_url="inave.cn";
//step1:获取Authorization Code
session_start();
$code=$_REQUEST["code"];
if (empty($code)) {
	//state参数用于防止csrf攻击,成功授权后回调时会原样带回
	$_SESSION['state']=md5(uniqid(rand(),true));
	//拼接URL
	$dialog_url="https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=" 
        . $app_id . "&redirect_uri=" . urlencode($my_url) . "&state="
        . $_SESSION['state'];
	echo ("<script>top.location.href='".$dialog_url."'</script>");
}
//step2:通过Authorization Code获取Access Token
if ($_REQUEST['state']==$_SESSION['state']) {
	//拼接url
	$token_url="https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&"
     . "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
     . "&client_secret=" . $app_secret . "&code=" . $code;
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
     		;
     	}
     }

//Step3：使用Access Token来获取用户的OpenID
$params=array();
parse_str($response,$params);
$graph_url="https://graph.qq.com/oauth2.0/me?access_token=".$params['access_token'];
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
echo ("hello".$user->openid);
}
else {
	echo ("The state does not match. You may be a victim of CSRF.");
}
