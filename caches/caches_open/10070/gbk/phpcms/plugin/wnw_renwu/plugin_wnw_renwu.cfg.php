<?php
return array (
  'identification' => 'wnw_renwu',
  'realease' => '20110727',
  'dir' => 'wnw_renwu',
  'appid' => '10070',
  //plugin������
  'plugin'=> array(
		  'version' => '0.0.1',
		  'name' => '��������',
		  'copyright' => 'jgwnl',
		  'description' => '������������ȫ�����ȵĴ��������ƽ̨,�ṩ���������б����񣬷�������΢�����񣬺͹�Ӷ�����5������ ģ�͡���װ�˲����Ϊ������������飬ͨ�������վע����������Ա��ͨ��ʵ����֤�����ᵽӶ��ͨ�������վע��Ļ�Ա1���ڷ���������Եõ�Ӷ��ͨ�������վ�Ļ�Ա���������б���Ի��Ӷ�𣻻��кܶ���Ӷ���;���� �Ӷ��������վ�Ӵ�ӯ��������Ͷ��ɱ�������е����գ�����ʵ����ɱ���ҵ!',
		  'installfile' => 'install.php',
		  'uninstallfile' => 'uninstall.php',
	),
   'plugin_var'=> array(
		array('title'=>'�������','description'=>'���������','fieldname'=>'title','fieldtype'=>'text','value'=>'��������','formattribute'=>'size="50" style="width:300px"','listorder'=>'1',),
		array('title'=>'�����������ƹ�ID','description'=>'��������������Ӫ���ƹ�,��ַ��http://www.wnw.cn/index.php?do=user','fieldname'=>'wnwid','fieldtype'=>'text','value'=>'158','formattribute'=>'size="50" style="width:50px"','listorder'=>'2',),
		array('title'=>'���','description'=>'','fieldname'=>'width','fieldtype'=>'text','value'=>'960','formattribute'=>'style="width:50px"','listorder'=>'3',),
		array('title'=>'�߶�','description'=>'','fieldname'=>'height','fieldtype'=>'text','value'=>'1080','formattribute'=>'style="width:50px"','listorder'=>'4',), 	

	),
	'license'=>
	'�������Ȩ���������������У�������������ɣ���ֹ�޸ģ����������ҳ��http://www.jgwnl.cn����ӭ���ṩ�������ѯ��',
)
?>