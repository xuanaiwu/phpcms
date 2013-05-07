<?php

/**
 * @version    $Id plugin_caijixia.cfg.php 1001 2011-7-1 qjp $
 * @copyright  Copyright (c) 2010-2011,qjp
 * @license    This is NOT a freeware, use is subject to license terms
 * @link       http://www.qjp.name
 */

return array(
    'identification' => 'caijixia',
    'realease' => '20110701',
    'dir' => 'caijixia',
    'appid' => '10054',
    
    'plugin'=> array(
        'version' => '1.0',
        'name' => 'phpcms采集侠',
        'copyright' => 'caijixia team',
        'description' => '<div class="infomsg pad-10">正在加载</div>
            <script type="text/javascript">
                $(".infomsg").load(window.location.search+"&module=description");
            </script>',
        'installfile' => 'install.php',
        'uninstallfile' => 'uninstall.php',
        'setting' => array(
            array(
                'name'=>'setting',
                'menu'=>'基本设置',
                'url'=>'',
                'listorder'=>'0',
                'setting_var'=>array(
                    array('title'=>'是否开启自动采集：','description'=>'','fieldname'=>'enable','fieldtype'=>'radio','setting'=>array('0'=>'否','1'=>'是'),'value'=>1),
                    //array('title'=>'是否下载远程图片：','description'=>'','fieldname'=>'downpic','fieldtype'=>'radio','setting'=>array('0'=>'否','1'=>'是'),'value'=>1),
                    array('title'=>'是否自动分页：','description'=>'','fieldname'=>'cofy','fieldtype'=>'radio','setting'=>array('0'=>'否','1'=>'是'),'value'=>1),
                    array('title'=>'分页大小：','description'=>'（字符数 包含HTML标记）','fieldname'=>'spsize','fieldtype'=>'text','formattribute'=>'style="width:120px"','value'=>10000),
                    array('title'=>'是否采集分页：','description'=>'（如果你的服务器不好，并不推荐打开，此功能会消耗较多服务器负载）',
                        'fieldname'=>'getfy','fieldtype'=>'radio','setting'=>array('0'=>'否','1'=>'是'),'value'=>0),
                    array('title'=>'每小时采集上限：','description'=>'','fieldname'=>'maxcount','fieldtype'=>'text','formattribute'=>'style="width:120px"','value'=>10),
                ),
            ),
            array(
                'name'=>'adsetting',
                'menu'=>'高级设置',
                'url'=>'',
                'listorder'=>'0',
                'setting_var'=>array(
                    array('title'=>'内容分类：','description'=>'（综合信息采集的内容比较全面，新闻资讯文章质量比较高）',
                        'fieldname'=>'sitetype','fieldtype'=>'radio','setting'=>array('baidu'=>'综合信息','news'=>'新闻资讯'),'value'=>'baidu'),
                    array('title'=>'采集顺序：','description'=>'（单栏目关键词少建议按关键词顺序，否则用随机以保证栏目采集均匀）',
                        'fieldname'=>'sort','fieldtype'=>'radio','setting'=>array('0'=>'按关键词顺序','1'=>'随机采集'),'value'=>0),
                    array('title'=>'内容过滤：','description'=>'(<a href="javascript:void(0);" onClick="window.top.art.dialog({title:\'提示\',content:\'包含过滤词语的文章将不采集，如果只要删除该词语保留文章请写为{屏蔽词} ，每行一个 <br>如：<br>神马<br>{给力}\',width:350});"><u>提示?</u></a>)',
                        'fieldname'=>'textfb','fieldtype'=>'textarea','value'=>"//包含过滤词语的文章将不采集，\r\n如果只要删除该词语保留文章请写为{屏蔽词} ，每行一个 \r\n如：\r\n神马\r\n{给力}",
                        'formattribute'=>'cols="70" rows="7" onfocus="reg=/^\\\/\\\//gi;if(reg.test(this.value)){this.value=\'\';}"'),
                    array('title'=>'网址过滤：','description'=>'(<a href="javascript:void(0);" onClick="window.top.art.dialog({title:\'提示\',content:\'过滤域名内的网站的文章将直接抛弃，每行一个 <br>如：<br>163.com<br>qq.com\',width:350});"><u>提示?</u></a>)',
                        'fieldname'=>'urlfb','fieldtype'=>'textarea','value'=>"//过滤域名内的网站的文章将直接抛弃，每行一个 \r\n如：\r\n163.com\r\nqq.com",
                        'formattribute'=>'cols="70" rows="7" onfocus="reg=/^\\\/\\\//gi;if(reg.test(this.value)){this.value=\'\';}"'),
                    array('title'=>'自动采集开放时间段：','description'=>'时段设置格式 [2-6] 或 [2-6][18-23]','fieldname'=>'crontab','fieldtype'=>'text','formattribute'=>'style="width:200px"','value'=>'[0-24]'),
                ),
            ),
            array(
                'name'=>'seosetting',
                'menu'=>'伪原创设置',
                'url'=>'',
                'listorder'=>'0',
                'setting_var'=>array(
                    array('title'=>'伪原创比例：','description'=>'% （0-100，影响本页以下选项，每100篇文章中伪原创的数量）',
                        'fieldname'=>'percent','fieldtype'=>'text','formattribute'=>'style="width:120px"','value'=>10 ),
                    array('title'=>'自动标题：','description'=>'（从正文内提取一段内容做为文章标题，影响文章可读性，利于收录）',
                        'fieldname'=>'autot','fieldtype'=>'radio','setting'=>array('0'=>'否','1'=>'是'),'value'=>0),                    
                    array('title'=>'段落重排：','description'=>'（随机排列正文段落，高级伪原创方式，影响文章可读性，利于收录）',
                        'fieldname'=>'autop','fieldtype'=>'radio','setting'=>array('0'=>'否','1'=>'是'),'value'=>0),                    
                    array('title'=>'高级混淆：','description'=>'（随机排列正文语句，高级伪原创方式，影响文章可读性，利于收录）',
                        'fieldname'=>'autoa','fieldtype'=>'radio','setting'=>array('0'=>'否','1'=>'是'),'value'=>0),
                    array('title'=>'同义词替换：','description'=>'(<a href="javascript:void(0);" onClick="window.top.art.dialog({title:\'提示\',content:\'每行一对同义词，半角逗号分隔双向替换，→分隔单向替换<br>如：<br>高兴,幸福<br>高兴→幸福\',width:350});"><u>提示?</u></a>)',
                        'fieldname'=>'relaword','fieldtype'=>'textarea','value'=>"//每行一对同义词，半角逗号分隔双向替换，→分隔单向替换\r\n如：\r\n高兴,幸福\r\n高兴→幸福",
                        'formattribute'=>'cols="85" rows="15" onfocus="reg=/^\\\/\\\//gi;if(reg.test(this.value)){this.value=\'\';}"'),
                ),
            ),
            array(
                'name'=>'adseosetting',
                'menu'=>'搜索引擎优化设置',
                'url'=>'',
                'listorder'=>'0',
                'setting_var'=>array(
                    array('title'=>'自动内链：','description'=>'（推荐开启，对seo十分有利，对权重很有好处）',
                        'fieldname'=>'autol','fieldtype'=>'radio','setting'=>array('0'=>'否','1'=>'是'),'value'=>0),
                    array('title'=>'seo词频率：','description'=>'（每篇文章随机插入seo词的数量）',
                        'fieldname'=>'sec','fieldtype'=>'text','value'=>'','formattribute'=>'style="width:120px"','value'=>3 ),
                    array('title'=>'seo词语或链接：','description'=>"(<a href=\"javascript:void(0);\" onClick=\"alert('支持html，每个一行 例：&lt;a href=http://www.phpcms.cn&gt;phpcms&lt;/a&gt;');\"><u>提示?</u></a>)",
                        'fieldname'=>'sel','fieldtype'=>'textarea','value'=>"//支持html，每个一行\r\n例：\r\n<a href=\"http://www.sina.com.cn\">新浪</a>\r\n<a href=\"http://www.phpcms.cn\">phpcms</a>",
                        'formattribute'=>'cols="70" rows="8" onfocus="reg=/^\\\/\\\//gi;if(reg.test(this.value)){this.value=\'\';}"'),
                    array('title'=>'链接频率：','description'=>'（同一关键词在一篇文章内链接的次数）',
                        'fieldname'=>'lc','fieldtype'=>'text','value'=>'','formattribute'=>'style="width:120px"','value'=>2 ),
                    array('title'=>'关键词内链：','description'=>'(<a href="javascript:void(0);" onClick="window.top.art.dialog({title:\'提示\',content:\'采集回来的文章内包含设置的关键词将自动添加链接<br>例：<br>网易|http://www.163.com<br>百度|http://www.baidu.com<br>腾讯|http://www.qq.com\',width:350});"><u>提示?</u></a>)',
                        'fieldname'=>'keyl','fieldtype'=>'textarea','value'=>"//采集回来的文章内包含设置的关键词将自动添加链接\r\n例：\r\n网易|http://www.163.com\r\n百度|http://www.baidu.com\r\n腾讯|http://www.qq.com",
                        'formattribute'=>'cols="70" rows="8" onfocus="reg=/^\\\/\\\//gi;if(reg.test(this.value)){this.value=\'\';}"'),
                ),
            ),
        ),
    ),
    
/*
    'plugin_var'=> array(
        
    ),
*/

    'license'=>'',
)

?>