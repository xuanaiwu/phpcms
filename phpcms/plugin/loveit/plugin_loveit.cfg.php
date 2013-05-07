<?php
return array (
  'identification' => 'loveit',
  'realease' => '20110412',
  'dir' => 'loveit',
  'appid' => '6',
  //plugin表配置
  'plugin'=> array(
		  'version' => '0.0.1',
		  'name' => '喜欢她',
		  'copyright' => 'phpcms team',
		  'description' => '喜欢一件东西，不仅仅因为外表美，更因为那一刻我被深深的吸引',
		  'installfile' => 'install.php',
		  'uninstallfile' => 'uninstall.php',
	),
   'plugin_var'=> array(
		array('title'=>'插件名称','description'=>'插件的名称','fieldname'=>'title','fieldtype'=>'text','value'=>'喜欢她 - 一个的分享，一群人的追捧','formattribute'=>'size="50"','listorder'=>'7',),
		array('title'=>'SEO描述','description'=>'','fieldname'=>'description','fieldtype'=>'textarea','value'=>'喜欢她 - 一个的分享，一群人的追捧','formattribute'=>'size="50" style="width:300px"','listorder'=>'7',),
	),
	'license'=>
	'本插件由PHPCMS开发团队完成，可自由修改或者扩充！',
)
?>