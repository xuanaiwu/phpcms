<?php

defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_sys_class('hook','','0');

class zztool extends hook{

    Final static function admin_top_left_menu(){
        $str = '<script type="text/javascript">';
        $str .= 'var host = window.location.host;';
        $str .= "window.top.art.dialog({id:'zztool',title:'seo综合信息 (10秒后自动关闭)',iframe:'http://www.dedeapps.com/?m=v9&a=tool&ver=0.01&host='+host,lock:false,left:'100%',top:'100%',fixed:true,width:'350px',height:'180px',time:15});";
        $str .= "</script>";
        return $str;
    }
    
    
    
}
?>