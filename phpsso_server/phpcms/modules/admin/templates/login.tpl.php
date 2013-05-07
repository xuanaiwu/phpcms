<?php defined('IN_ADMIN') or exit('No permission resources.'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type"
	content="text/html; charset=<?php echo CHARSET;?>" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo L('phpsso')?></title>
<link href="<?php echo CSS_PATH?>/User_Login.css" rel="stylesheet"
	type="text/css" />
<script language="JavaScript">
function CheckForm(){
if (document.myform.username.value =="")
{
alert("请输入用户名！");
document.myform.username.focus();
return false;
}else if(document.myform.password.value==""){
alert("请输入密码！");
document.myform.password.focus();
return false;
}else if(document.myform.code.value==""){
alert("请输入验证码！");
document.myform.code.focus();
return false;
}else{
return true;
}
}
</script>
</head>
<body id="userlogin_body">
	<form action="?m=admin&c=login&a=logind"
		method="post" name="myform" onSubmit="return CheckForm();">
		<div id="user_login">
			<dl>
				<dd id="user_top">
					<ul>
						<li class="user_top_l"></li>
						<li class="user_top_c"></li>
						<li class="user_top_r"></li>
					</ul>
					<dd id="user_main">
						<ul>
							<li class="user_main_l"></li>
							<li class="user_main_c">
								<div class="user_main_box">
									<ul>
										<li class="user_main_text"><?php echo L('username')?>：</li>
										<li class="user_main_input">
											<input type="text" class="TxtUserNameCssClass"
												id="TxtUserName" maxlength="30" name="username" />
										</li>
									</ul>
									<ul>
										<li class="user_main_text"><?php echo L('password')?>：</li>
										<li class="user_main_input">
											<input class="TxtPasswordCssClass" id="TxtPassword"
												type="password" name="password" />
										</li>
									</ul>
									<ul>
										<li class="user_main_text"><?php echo L('checkcode')?>：</li>
										<li class="user_main_input">
											<input name="code" type="text" class="ipt ipt_reg" />
											<br />
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<?php echo form::checkcode('code_img', '4', '14', 84, 24)?>
									</li>
									</ul>
								</div>
							</li>
							<li class="user_main_r">
								<input class="IbtnEnterCssClass" id="IbtnEnter"
									style="BORDER-TOP-WIDTH: 0px; BORDER-LEFT-WIDTH: 0px; BORDER-BOTTOM-WIDTH: 0px; BORDER-RIGHT-WIDTH: 0px"
									type="image"
									src="<?php echo IMG_PATH?>/admin_img/user_botton.gif"
									name="dosubmit" />
							</li>
						</ul>
						<dd id="user_bottom">
							<ul>
								<li class="user_bottom_l"></li>
								<li class="user_bottom_c"></li>
								<li class="user_bottom_r"></li>
							</ul>
						</dd>
					</dd>
				</dd>
			</dl>
		</div>
	</form>
</body>
</html>