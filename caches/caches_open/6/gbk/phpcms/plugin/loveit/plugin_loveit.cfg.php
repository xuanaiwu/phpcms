<?php
return array (
  'identification' => 'loveit',
  'realease' => '20110412',
  'dir' => 'loveit',
  'appid' => '6',
  //plugin������
  'plugin'=> array(
		  'version' => '0.0.1',
		  'name' => 'ϲ����',
		  'copyright' => 'phpcms team',
		  'description' => 'ϲ��һ����������������Ϊ�����������Ϊ��һ���ұ����������',
		  'installfile' => 'install.php',
		  'uninstallfile' => 'uninstall.php',
	),
   'plugin_var'=> array(
		array('title'=>'�������','description'=>'���������','fieldname'=>'title','fieldtype'=>'text','value'=>'ϲ���� - һ���ķ���һȺ�˵�׷��','formattribute'=>'size="50"','listorder'=>'7',),
		array('title'=>'SEO����','description'=>'','fieldname'=>'description','fieldtype'=>'textarea','value'=>'ϲ���� - һ���ķ���һȺ�˵�׷��','formattribute'=>'size="50" style="width:300px"','listorder'=>'7',),
	),
	'license'=>
	'�������PHPCMS�����Ŷ���ɣ��������޸Ļ������䣡',
)
?>