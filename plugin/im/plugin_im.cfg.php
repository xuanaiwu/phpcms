<?php
return array (
  'identification' => 'im',
  'realease' => '20110412',
  'dir' => 'im',
  'appid' => '4',
  //plugin表配置
  'plugin'=> array(
		  'version' => '0.0.2',
		  'name' => '在线客服',
		  'copyright' => 'phpcms team',
		  'description' => "可以设置qq,MSN,阿里旺旺等客服帐号信息，方便网站客服需求，如果在非默认模板中使用需要在footer.html模板中增加{php echo runhook('glogal_footer')}",
		  'installfile' => 'install.php',
		  'uninstallfile' => 'uninstall.php',
	),
   'plugin_var'=> array(
   		array('title'=>'在线客服位置','description'=>'','fieldname'=>'postion','fieldtype'=>'select','setting'=>array('0'=>'关闭','2'=>'左侧','3'=>'右侧'),'listorder'=>'1',),
		array('title'=>'标题说明文字','description'=>'','fieldname'=>'kefutitle','fieldtype'=>'textarea','value'=>'PHPCMS在线客服','formattribute'=>'style="width:200px"','listorder'=>'2',),
		array('title'=>'QQ号码','description'=>'多个号码请使用换行分割','fieldname'=>'qq','fieldtype'=>'textarea','vaule'=>'1561683312','listorder'=>'3',),
		array('title'=>'阿里旺旺帐号','description'=>'多个号码请使用换行分割','fieldname'=>'aliwangwang','fieldtype'=>'textarea','listorder'=>'4',),
		array('title'=>'MSN帐号','description'=>'多个号码请使用换行分割','fieldname'=>'msn','fieldtype'=>'textarea','listorder'=>'5',),
		array('title'=>'skype帐号','description'=>'多个号码请使用换行分割','fieldname'=>'skype','fieldtype'=>'textarea','listorder'=>'6',),
		array('title'=>'其他信息','description'=>'其他信息','fieldname'=>'tips','fieldtype'=>'text','value'=>'咨询电话：010-88695679','formattribute'=>'size="50"','listorder'=>'7',),
	),
)
?>