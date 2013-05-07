<?php
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_sys_class('hook','','0');
class loveit_hook extends hook{
	Final static function admin_content_init(){
		$steps = $_GET['steps'];
		if(!$steps) echo '<input type="button" class="button" value="ÍÆËÍµ½Ï²»¶Ëý" onclick="myform.action=\'plugin.php?id=loveit-loveit-push&catid='.$_GET['catid'].'\';myform.submit();"/>';
	}
}
?>