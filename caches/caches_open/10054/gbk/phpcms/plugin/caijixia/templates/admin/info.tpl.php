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
    <div class="explain-col updatemsg">正在检查版本更新</div>
    <div style="padding-top: 10px;">
        <p>感谢您选择PHPCMS采集侠，PHPCMS采集侠是一款根据关键词或指定站点定时自动采集，无须编写复杂的采集规则，对采集回来的内容自动进行伪原创和搜索优化处理，自动发布内容的绿色插件。<br/>
        简单配置好后能实现24小时不间断采集、进行伪原创SEO及发布，是站长建立站群的首选插件。</p>
        <p>&nbsp;</p>
        <p id="cjx_footer"></p>
    </div>
</div>

<script type="text/javascript">
$(".tabBut li").first().html("采集侠介绍");
//更新检测
$.getScript("http://www.dedeapps.com/v9cjx_checkupdate2.js",function(){
    setTimeout(function(){
        $(".updatemsg").hide('slow');
    },5000);
});
//页脚
$.getScript("http://www.dedeapps.com/v9cjx_copyright.js");
</script>