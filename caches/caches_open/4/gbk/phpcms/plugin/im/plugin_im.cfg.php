<?php
return array (
  'identification' => 'im',
  'realease' => '20110412',
  'dir' => 'im',
  'appid' => '4',
  //plugin������
  'plugin'=> array(
		  'version' => '0.0.2',
		  'name' => '���߿ͷ�',
		  'copyright' => 'phpcms team',
		  'description' => "��������qq,MSN,���������ȿͷ��ʺ���Ϣ��������վ�ͷ���������ڷ�Ĭ��ģ����ʹ����Ҫ��footer.htmlģ��������{php echo runhook('glogal_footer')}",
		  'installfile' => 'install.php',
		  'uninstallfile' => 'uninstall.php',
	),
   'plugin_var'=> array(
   		array('title'=>'���߿ͷ�λ��','description'=>'','fieldname'=>'postion','fieldtype'=>'select','setting'=>array('0'=>'�ر�','2'=>'���','3'=>'�Ҳ�'),'listorder'=>'1',),
		array('title'=>'����˵������','description'=>'','fieldname'=>'kefutitle','fieldtype'=>'textarea','value'=>'PHPCMS���߿ͷ�','formattribute'=>'style="width:200px"','listorder'=>'2',),
		array('title'=>'QQ����','description'=>'���������ʹ�û��зָ�','fieldname'=>'qq','fieldtype'=>'textarea','vaule'=>'1561683312','listorder'=>'3',),
		array('title'=>'���������ʺ�','description'=>'���������ʹ�û��зָ�','fieldname'=>'aliwangwang','fieldtype'=>'textarea','listorder'=>'4',),
		array('title'=>'MSN�ʺ�','description'=>'���������ʹ�û��зָ�','fieldname'=>'msn','fieldtype'=>'textarea','listorder'=>'5',),
		array('title'=>'skype�ʺ�','description'=>'���������ʹ�û��зָ�','fieldname'=>'skype','fieldtype'=>'textarea','listorder'=>'6',),
		array('title'=>'������Ϣ','description'=>'������Ϣ','fieldname'=>'tips','fieldtype'=>'text','value'=>'��ѯ�绰��010-88695679','formattribute'=>'size="50"','listorder'=>'7',),
	),
)
?>