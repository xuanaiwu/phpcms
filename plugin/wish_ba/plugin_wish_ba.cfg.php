<?php
return array (
  'identification' => 'wish_ba',
  'dir' => 'wish_ba',
  'appid' => '10063',
  'plugin'=> array(
		  'version' => '1.0',
		  'name' => '一起许愿吧',
		  'copyright' => 'phpcms team',
		  'description' =>'一起许愿吧，提供大家一起许愿的平台，不仅可以给自己许愿，也可以给他人许愿，同时可以了解他人许的愿望！',
		  'installfile' => 'install.php',
		  'uninstallfile' => 'uninstall.php',
		  'iframe' => array('width'=>'960','height'=>'640','url'=>'http://www.jgwnl.cn/wish'),		  
	),
   'plugin_var'=> array(   array('title'=>'宽度','description'=>'','fieldname'=>'width','fieldtype'=>'text','value'=>'960','formattribute'=>'style="width:50px"','listorder'=>'1',),		array('title'=>'高度','description'=>'','fieldname'=>'height','fieldtype'=>'text','value'=>'640','formattribute'=>'style="width:50px"','listorder'=>'2',),   
	),	
);
?>				