<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><script>function parentreload(){parent.location.reload()}</script>
<style type="text/css">
img{ border:none}
div{font:12px/18px "宋体",Verdana, Geneva, sans-serif}
.text{ position:absolute; left:50%; top:50%; width:200px; margin-top:-30px; margin-left:-190px; color:#999}
.icon{ position:absolute; top:50%; right:50%; margin-top:-30px; margin-right:-150px}
.login{height:26px; margin-bottom:14px;width:123px;background:url(<?php echo IMG_PATH;?>member/mbg.png) no-repeat}
.login a{text-decoration: none;display:block; color:#377ABE;background-repeat:no-repeat; background-position:6px 5px;height:26px; padding-left:36px; line-height:26px}
.login a:hover{text-decoration: none;}
</style>
<div class="text"><?php echo L('sina_login_notice');?></div>
<div class="icon"><div class="login"><a href='javascript:;' style="background-image:url(<?php echo IMG_PATH;?>member/logo/sina_16_16.png)" onclick="window.open('<?php echo $aurl;?>', 'login');return false;" title="<?php echo L('sina_login');?>">新浪微博登录</a></div></div>