<?php

/**
 * @version    $Id caijixia_setting.tpl.php 1001 2011-7-3 qjp $
 * @copyright  Copyright (c) 2010-2011,qjp
 * @license    This is NOT a freeware, use is subject to license terms
 * @link       http://www.qjp.name
 */

defined('IN_ADMIN') or exit('No permission resources.');

?>
<script>
//为了解决某些问题，不得已采用的方式
include_js = (function(){
	var uid = 0;
	var remove = function(id){
		var head = document.getElementsByTagName('head')[0];
		head.removeChild( document.getElementById('jsInclude_'+id) );
	};
	return function(file,callback){
		var callback;
		var id = ++uid;
		var head = document.getElementsByTagName('head')[0];
		var js = document.createElement('script');
		js.setAttribute('type','text/javascript');
		js.setAttribute('src',file);
		js.setAttribute('id','jsInclude_'+id);
		if( document.all )
			js.onreadystatechange = function(){
				if(/(complete|loaded)/.test(js.readyState)){ callback&&callback(id);remove(id);}
			};
		else
			js.onload = function(){callback(id); remove(id); };
		head.appendChild(js);
		return uid;
	};
})(); 
include_js("<?php echo PLUGIN_STATICS_PATH.PLUGIN_ID;?>/plugin_admin.js",function(){settingform('<?php echo $this->app;?>');});
</script>
<?php if(empty($cfg_cache)){ ?>
<div class="explain-col">首次使用请提交一次设置，以便生成配置文件</div>
<?php } ?>
<div class="contentList pad-10">
	<table width="100%"  class="table_form">
        <?php echo $form?>
    </table>
<div class="bk15"></div>
<input type="hidden" value="<?php echo $_SESSION['pc_hash']?>" name="pc_hash">
<input name="caijixiasubmit" type="submit" value="<?php echo L('submit')?>" class="button">
</div>
<div id="check" style="display:none;">
    <div class="contentList pad-10 check_content">
        <div>请输入授权码<!--本功能为授权功能，请输入授权码 --></div>
        <div>
            <input name="checkcode" type="text" value="" class="input-text" style="width:250px;">
            <input name="checksubmit" type="submit" value="<?php echo L('submit')?>" class="button" style="width:60px;" onClick="window.right.saveapp();">
        </div>
        <div class="bk15"></div>
		<div>本页面功能是商业版插件功能，需 购买授权 后方可使用。</div>
		<div class="bk15"></div>
		<div>官方站点：<a href="http://www.caijixia.com" target="_blank">http://www.caijixia.com</a><br>
	    官方博客：<a href="http://www.dedeadmin.com" target="_blank">http://www.dedeadmin.com</a></div>
		<div>客服QQ:79702151  采集侠QQ群:<span class="qqqun"></span></div>
    </div>
</div>
<script type="text/javascript">if(typeof(qqgroup)!=='undefined') $(".qqqun").html(qqgroup);</script>