<?php
	defined('IN_PHPCMS') or exit('No permission resources.');

	class wnw_renwu {
			public function init() 
			{
			$datas = json_decode($content_json,true);
			$cache_var = getcache('wnw_renwu_var','plugins');	
			$SEO = seo(1, '',$cache_var['title'],$cache_var['description'],$cache_var['title']);
			$wnwid= $cache_var['wnwid'];/*���������ƹ�ID*/
			$width= $cache_var['width'];/*ҳ����*/
			$height= $cache_var['height'];/*ҳ��߶�*/
			include template('plugin/wnw_renwu','index');
			
		    }
			}
?>