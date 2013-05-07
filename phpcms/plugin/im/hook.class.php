<?php
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_sys_class('hook','','0');
class im extends hook{
	Final static function glogal_footer(){
		$wangwangcode = $qqcode = $skypecode = $msncode = '';
		$var = getcache('im_var','plugins');
		$title = $var['kefutitle'];
		if($var['postion']) {
			if($var['qq']) {	
				foreach(self::_handle_parameter($var['qq']) as $v) {
					$qqcode .= '<li class=odd><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin='.$v[0].'&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:'.$v[0].':42" alt="'.pluginlang('sendsms','','im').'" title="'.pluginlang('sendsms','','im').'"></a></li>';

				}
			} 
			if($var['aliwangwang']) {
				foreach(self::_handle_parameter($var['aliwangwang']) as $v) {
				$wangwangcode .= '<li><a target="_blank" href="http://amos.im.alisoft.com/msg.aw?v=2&uid='.$v['0'].'&site=cntaobao&s=1&charset=utf-8" ><img border="0" src="http://amos.im.alisoft.com/online.aw?v=2&uid='.$v['0'].'&site=cntaobao&s=1&charset=utf-8" alt="点击这里给我发消息" /></a></li>';
				}
			}
			if($var['msn']) {
				foreach(self::_handle_parameter($var['msn']) as $v) {
				$msncode .= '<li><a href="msnim:chat?contact='.$var['msn'].'"><img width="30" height="30" border="0" src="http://im.live.com/Messenger/IM/Images/Icons/Messenger.Logo.gif"/></a></li>';
				}
			}
			
			if($var['skype']) {
				foreach(self::_handle_parameter($var['skype']) as $v) {
				$skypecode .='<li><a href="callto://'.$var['skype'].'"><img border="0" src="http://goodies.skype.com/graphics/skypeme_btn_small_green.gif"/></a></li>';
				}
			}							
			if($var['postion'] == 2)include template('plugin/im','left_float');			
			elseif($var['postion'] == 3) include template('plugin/im','right_float');			
			//return $code;
		}
	}

	private static function _handle_parameter($data) {
		$return = array();
		$s = explode("\n",$data);
		if(is_array($s)) {
			foreach($s as $_k) {
				$v = explode("|",$_k);
				if($v[0]) $return[] = $v;
			}
		}
		return $return;
	}	
}
?>