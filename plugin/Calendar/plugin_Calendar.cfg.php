<?php
return array (
  'identification' => 'Calendar',
  'dir' => 'Calendar',
  'appid' => '10064',
  'plugin'=> array(
		  'version' => '1.0',
		  'name' => '日程安排',
		  'copyright' => 'phpcms team',
		  'description' =>'WebCalendar（在线日程安排）是一个基于Web的日历应用软件。多用户日历或访问者可以浏览的事件日历。',
		  'installfile' => 'install.php',
		  'uninstallfile' => 'uninstall.php',
		  'iframe' => array('width'=>'960','height'=>'640','url'=>'http://www.jgwnl.cn/calendar/'),		  
	),
   'plugin_var'=> array(   array('title'=>'宽度','description'=>'','fieldname'=>'width','fieldtype'=>'text','value'=>'960','formattribute'=>'style="width:50px"','listorder'=>'1',),		array('title'=>'高度','description'=>'','fieldname'=>'height','fieldtype'=>'text','value'=>'640','formattribute'=>'style="width:50px"','listorder'=>'2',),   
	),	
);
?>				