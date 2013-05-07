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
        'name' => 'phpcms�ɼ���',
        'copyright' => 'caijixia team',
        'description' => '<div class="infomsg pad-10">���ڼ���</div>
            <script type="text/javascript">
                $(".infomsg").load(window.location.search+"&module=description");
            </script>',
        'installfile' => 'install.php',
        'uninstallfile' => 'uninstall.php',
        'setting' => array(
            array(
                'name'=>'setting',
                'menu'=>'��������',
                'url'=>'',
                'listorder'=>'0',
                'setting_var'=>array(
                    array('title'=>'�Ƿ����Զ��ɼ���','description'=>'','fieldname'=>'enable','fieldtype'=>'radio','setting'=>array('0'=>'��','1'=>'��'),'value'=>1),
                    //array('title'=>'�Ƿ�����Զ��ͼƬ��','description'=>'','fieldname'=>'downpic','fieldtype'=>'radio','setting'=>array('0'=>'��','1'=>'��'),'value'=>1),
                    array('title'=>'�Ƿ��Զ���ҳ��','description'=>'','fieldname'=>'cofy','fieldtype'=>'radio','setting'=>array('0'=>'��','1'=>'��'),'value'=>1),
                    array('title'=>'��ҳ��С��','description'=>'���ַ��� ����HTML��ǣ�','fieldname'=>'spsize','fieldtype'=>'text','formattribute'=>'style="width:120px"','value'=>10000),
                    array('title'=>'�Ƿ�ɼ���ҳ��','description'=>'�������ķ��������ã������Ƽ��򿪣��˹��ܻ����Ľ϶���������أ�',
                        'fieldname'=>'getfy','fieldtype'=>'radio','setting'=>array('0'=>'��','1'=>'��'),'value'=>0),
                    array('title'=>'ÿСʱ�ɼ����ޣ�','description'=>'','fieldname'=>'maxcount','fieldtype'=>'text','formattribute'=>'style="width:120px"','value'=>10),
                ),
            ),
            array(
                'name'=>'adsetting',
                'menu'=>'�߼�����',
                'url'=>'',
                'listorder'=>'0',
                'setting_var'=>array(
                    array('title'=>'���ݷ��ࣺ','description'=>'���ۺ���Ϣ�ɼ������ݱȽ�ȫ�棬������Ѷ���������Ƚϸߣ�',
                        'fieldname'=>'sitetype','fieldtype'=>'radio','setting'=>array('baidu'=>'�ۺ���Ϣ','news'=>'������Ѷ'),'value'=>'baidu'),
                    array('title'=>'�ɼ�˳��','description'=>'������Ŀ�ؼ����ٽ��鰴�ؼ���˳�򣬷���������Ա�֤��Ŀ�ɼ����ȣ�',
                        'fieldname'=>'sort','fieldtype'=>'radio','setting'=>array('0'=>'���ؼ���˳��','1'=>'����ɼ�'),'value'=>0),
                    array('title'=>'���ݹ��ˣ�','description'=>'(<a href="javascript:void(0);" onClick="window.top.art.dialog({title:\'��ʾ\',content:\'�������˴�������½����ɼ������ֻҪɾ���ô��ﱣ��������дΪ{���δ�} ��ÿ��һ�� <br>�磺<br>����<br>{����}\',width:350});"><u>��ʾ?</u></a>)',
                        'fieldname'=>'textfb','fieldtype'=>'textarea','value'=>"//�������˴�������½����ɼ���\r\n���ֻҪɾ���ô��ﱣ��������дΪ{���δ�} ��ÿ��һ�� \r\n�磺\r\n����\r\n{����}",
                        'formattribute'=>'cols="70" rows="7" onfocus="reg=/^\\\/\\\//gi;if(reg.test(this.value)){this.value=\'\';}"'),
                    array('title'=>'��ַ���ˣ�','description'=>'(<a href="javascript:void(0);" onClick="window.top.art.dialog({title:\'��ʾ\',content:\'���������ڵ���վ�����½�ֱ��������ÿ��һ�� <br>�磺<br>163.com<br>qq.com\',width:350});"><u>��ʾ?</u></a>)',
                        'fieldname'=>'urlfb','fieldtype'=>'textarea','value'=>"//���������ڵ���վ�����½�ֱ��������ÿ��һ�� \r\n�磺\r\n163.com\r\nqq.com",
                        'formattribute'=>'cols="70" rows="7" onfocus="reg=/^\\\/\\\//gi;if(reg.test(this.value)){this.value=\'\';}"'),
                    array('title'=>'�Զ��ɼ�����ʱ��Σ�','description'=>'ʱ�����ø�ʽ [2-6] �� [2-6][18-23]','fieldname'=>'crontab','fieldtype'=>'text','formattribute'=>'style="width:200px"','value'=>'[0-24]'),
                ),
            ),
            array(
                'name'=>'seosetting',
                'menu'=>'αԭ������',
                'url'=>'',
                'listorder'=>'0',
                'setting_var'=>array(
                    array('title'=>'αԭ��������','description'=>'% ��0-100��Ӱ�챾ҳ����ѡ�ÿ100ƪ������αԭ����������',
                        'fieldname'=>'percent','fieldtype'=>'text','formattribute'=>'style="width:120px"','value'=>10 ),
                    array('title'=>'�Զ����⣺','description'=>'������������ȡһ��������Ϊ���±��⣬Ӱ�����¿ɶ��ԣ�������¼��',
                        'fieldname'=>'autot','fieldtype'=>'radio','setting'=>array('0'=>'��','1'=>'��'),'value'=>0),                    
                    array('title'=>'�������ţ�','description'=>'������������Ķ��䣬�߼�αԭ����ʽ��Ӱ�����¿ɶ��ԣ�������¼��',
                        'fieldname'=>'autop','fieldtype'=>'radio','setting'=>array('0'=>'��','1'=>'��'),'value'=>0),                    
                    array('title'=>'�߼�������','description'=>'���������������䣬�߼�αԭ����ʽ��Ӱ�����¿ɶ��ԣ�������¼��',
                        'fieldname'=>'autoa','fieldtype'=>'radio','setting'=>array('0'=>'��','1'=>'��'),'value'=>0),
                    array('title'=>'ͬ����滻��','description'=>'(<a href="javascript:void(0);" onClick="window.top.art.dialog({title:\'��ʾ\',content:\'ÿ��һ��ͬ��ʣ���Ƕ��ŷָ�˫���滻�����ָ������滻<br>�磺<br>����,�Ҹ�<br>���ˡ��Ҹ�\',width:350});"><u>��ʾ?</u></a>)',
                        'fieldname'=>'relaword','fieldtype'=>'textarea','value'=>"//ÿ��һ��ͬ��ʣ���Ƕ��ŷָ�˫���滻�����ָ������滻\r\n�磺\r\n����,�Ҹ�\r\n���ˡ��Ҹ�",
                        'formattribute'=>'cols="85" rows="15" onfocus="reg=/^\\\/\\\//gi;if(reg.test(this.value)){this.value=\'\';}"'),
                ),
            ),
            array(
                'name'=>'adseosetting',
                'menu'=>'���������Ż�����',
                'url'=>'',
                'listorder'=>'0',
                'setting_var'=>array(
                    array('title'=>'�Զ�������','description'=>'���Ƽ���������seoʮ����������Ȩ�غ��кô���',
                        'fieldname'=>'autol','fieldtype'=>'radio','setting'=>array('0'=>'��','1'=>'��'),'value'=>0),
                    array('title'=>'seo��Ƶ�ʣ�','description'=>'��ÿƪ�����������seo�ʵ�������',
                        'fieldname'=>'sec','fieldtype'=>'text','value'=>'','formattribute'=>'style="width:120px"','value'=>3 ),
                    array('title'=>'seo��������ӣ�','description'=>"(<a href=\"javascript:void(0);\" onClick=\"alert('֧��html��ÿ��һ�� ����&lt;a href=http://www.phpcms.cn&gt;phpcms&lt;/a&gt;');\"><u>��ʾ?</u></a>)",
                        'fieldname'=>'sel','fieldtype'=>'textarea','value'=>"//֧��html��ÿ��һ��\r\n����\r\n<a href=\"http://www.sina.com.cn\">����</a>\r\n<a href=\"http://www.phpcms.cn\">phpcms</a>",
                        'formattribute'=>'cols="70" rows="8" onfocus="reg=/^\\\/\\\//gi;if(reg.test(this.value)){this.value=\'\';}"'),
                    array('title'=>'����Ƶ�ʣ�','description'=>'��ͬһ�ؼ�����һƪ���������ӵĴ�����',
                        'fieldname'=>'lc','fieldtype'=>'text','value'=>'','formattribute'=>'style="width:120px"','value'=>2 ),
                    array('title'=>'�ؼ���������','description'=>'(<a href="javascript:void(0);" onClick="window.top.art.dialog({title:\'��ʾ\',content:\'�ɼ������������ڰ������õĹؼ��ʽ��Զ��������<br>����<br>����|http://www.163.com<br>�ٶ�|http://www.baidu.com<br>��Ѷ|http://www.qq.com\',width:350});"><u>��ʾ?</u></a>)',
                        'fieldname'=>'keyl','fieldtype'=>'textarea','value'=>"//�ɼ������������ڰ������õĹؼ��ʽ��Զ��������\r\n����\r\n����|http://www.163.com\r\n�ٶ�|http://www.baidu.com\r\n��Ѷ|http://www.qq.com",
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