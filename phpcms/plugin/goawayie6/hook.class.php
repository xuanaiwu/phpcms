<?php

defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_sys_class('hook','','0');

class goawayie6 extends hook{
	Final static function glogal_footer(){
        $str = '<link href="'.PLUGIN_STATICS_PATH.'goawayie6/awayie6.css" rel="stylesheet" type="text/css" />';
        $str .= '<script language="javascript" type="text/javascript" src="'.PLUGIN_STATICS_PATH.'goawayie6/awayie6.js"></script>';
        return $str;
	}
}
?>