<?php
return array (
  'identification' => 'wnw_renwu',
  'realease' => '20110727',
  'dir' => 'wnw_renwu',
  'appid' => '10070',
  //plugin表配置
  'plugin'=> array(
		  'version' => '0.0.1',
		  'name' => '万能威客',
		  'copyright' => 'jgwnl',
		  'description' => '万能威客网是全球领先的创意服务交易平台,提供悬赏任务，招标任务，发帖任务，微博任务，和雇佣任务等5大任务 模型。安装此插件成为万能网合作伙伴，通过你的网站注册万能网会员并通过实名认证可以提到佣金；通过你的网站注册的会员1年内发布任务可以得到佣金；通过你的网站的会员参与任务中标可以获得佣金；还有很多获得佣金的途径， 从而让你的网站从此盈利，无需投入成本，无需承担风险，真正实现零成本创业!',
		  'installfile' => 'install.php',
		  'uninstallfile' => 'uninstall.php',
	),
   'plugin_var'=> array(
		array('title'=>'插件名称','description'=>'插件的名称','fieldname'=>'title','fieldtype'=>'text','value'=>'万能威客','formattribute'=>'size="50" style="width:300px"','listorder'=>'1',),
		array('title'=>'万能威客网推广ID','description'=>'申请万能威客网营销推广,网址：http://www.wnw.cn/index.php?do=user','fieldname'=>'wnwid','fieldtype'=>'text','value'=>'158','formattribute'=>'size="50" style="width:50px"','listorder'=>'2',),
		array('title'=>'宽度','description'=>'','fieldname'=>'width','fieldtype'=>'text','value'=>'960','formattribute'=>'style="width:50px"','listorder'=>'3',),
		array('title'=>'高度','description'=>'','fieldname'=>'height','fieldtype'=>'text','value'=>'1080','formattribute'=>'style="width:50px"','listorder'=>'4',), 	

	),
	'license'=>
	'本插件版权归万能威客网所有，万能威客网许可，禁止修改，插件作者主页：http://www.jgwnl.cn，欢迎您提供建议和咨询！',
)
?>