<?php

/**
 * @version    $Id info.tpl.php 1001 2011-7-3 qjp $
 * @copyright  Copyright (c) 2010-2011,qjp
 * @license    This is NOT a freeware, use is subject to license terms
 * @link       http://www.qjp.name
 */

defined('IN_ADMIN') or exit('No permission resources.');

?>
<div class="infobox">
    <div class="explain-col updatemsg">���ڼ��汾����</div>
    <div style="padding-top: 10px;">
        <p>��л��ѡ��PHPCMS�ɼ�����PHPCMS�ɼ�����һ����ݹؼ��ʻ�ָ��վ�㶨ʱ�Զ��ɼ��������д���ӵĲɼ����򣬶Բɼ������������Զ�����αԭ���������Ż������Զ��������ݵ���ɫ�����<br/>
        �����úú���ʵ��24Сʱ����ϲɼ�������αԭ��SEO����������վ������վȺ����ѡ�����</p>
        <p>&nbsp;</p>
        <p id="cjx_footer"></p>
    </div>
</div>

<script type="text/javascript">
$(".tabBut li").first().html("�ɼ�������");
//���¼��
$.getScript("http://www.dedeapps.com/v9cjx_checkupdate2.js",function(){
    setTimeout(function(){
        $(".updatemsg").hide('slow');
    },5000);
});
//ҳ��
$.getScript("http://www.dedeapps.com/v9cjx_copyright.js");
</script>