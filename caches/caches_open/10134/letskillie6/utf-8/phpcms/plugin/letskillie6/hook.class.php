<?php

defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_sys_class('hook','','0');

class letskillie6 extends hook{
	Final static function glogal_footer(){
        $str = '<!--[if lte IE 6]><script>var LETSKILLIE6_DELAY=3;</script><script language="javascript" type="text/javascript" src="'.PLUGIN_STATICS_PATH.'letskillie6/letskillie6.zh_CN.js"></script><![endif]-->';
        return $str;
	}
}
?>