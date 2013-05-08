<?php

/**
 * @version    $Id task.tpl.php 1001 2011-7-6 qjp $
 * @copyright  Copyright (c) 2010-2011,qjp
 * @license    This is NOT a freeware, use is subject to license terms
 * @link       http://www.qjp.name
 */

defined('IN_ADMIN') or exit('No permission resources.');
$show_header = 1;
include $this->admin_tpl('header');
?>
<script type="text/javascript">var appkey = '<?php echo $this->app;?>';</script>
<script language="javascript" type="text/javascript" src="<?php echo PLUGIN_STATICS_PATH.PLUGIN_ID;?>/plugin_admin.js"></script>
<div class="subnav">
    <div class="content-menu ib-a blue line-x">
      <a class="add fb" href="javascript:void(0);" onclick="runtask();"><em> 立即采集 </em></a>　    <a href='javascript:;' class="on"><em>采集任务</em></a>  
    </div>
</div>
<form name="taskform" action="index.php" method="post" onSubmit="return closetasks();">
<div class="pad_10">
<div class="explain-col task_show_tip0" style="display:none">
您目前是免费用户，每个栏目只能添加一个关键词，购买授权可以享有更多功能和服务！
</div>
<div class="explain-col task_show_tip1" style="display:none">
您目前是授权版用户，感谢您的使用！
</div>
<div class="bk10"></div>
<div class="table-list">
    <table width="100%" cellspacing="0" >
        <thead>
            <tr>
            <th width="5%"><input type="checkbox" id="check_box" onclick="selectall('ids[]');"></th>
            <th width="10%">catid</th>
            <th width="20%" align="left">栏目名称</th>
            <th width="55%">采集关键词</th>
            <th>操作</th>
            </tr>
        </thead>
        <tbody>
			<?php
            if(!empty($category)){
                foreach($category as $r){
            ?>
            <tr>
            	<td align="center"><input name="ids[]" value="<?php echo $r['catid'] ?>" type="checkbox"></td>
                <td align="center"><?php echo $r['catid'] ?></td>
                <td><?php echo $r['catname'] ?></td>
                <td onclick="Showdialog(<?php echo $r['catid'] ?>,'<?php echo $r['catname'] ?>',<?php echo $r['isclose'] ?>);" class="tasksettingbutton">
                <?php echo $r['keyword'] ?>
                <a href="javascript:void(0)"><b>设置</b></a>
            </td>
                <td align="center">
                <?php if($r['isclose']==1){ ?>
                <a href="?m=admin&c=plugin&a=config&pluginid=<?php echo $_GET['pluginid']?>&menuid=<?php echo $_GET['menuid']?>&id=<?php echo $r['catid'] ?>&close=0&module=closetasks"><font color="red">开启</font></a></td>
                <?php }else{ ?>
                <a href="?m=admin&c=plugin&a=config&pluginid=<?php echo $_GET['pluginid']?>&menuid=<?php echo $_GET['menuid']?>&id=<?php echo $r['catid'] ?>&close=1&module=closetasks">关闭</a></td>
                <?php } ?>
            </tr>
            <?php
                }
            }else
            {
                echo '<tr><td colspan="5">您还没有添加任何栏目哦，请先添加栏目</td></tr>';
            }
            ?>
        </tbody>
    </table>

    <div class="btn">
        <input type="hidden" name="pc_hash" value="<?php echo $_SESSION['pc_hash'];?>" />
        <input type="submit" class="button" name="opensubmit" value="批量开启"/>
        <input type="submit" class="button" name="closesubmit" value="批量关闭"/>
    </div>
	
	
<div class="content-menu ib-a blue line-x">
      <a class="add fb" href="javascript:void(0);" onclick="runtask();"><em> 立即采集 </em></a>  
    </div>
	
    </div>
</div>
</form>
<div id="keywordform" style="display:none">
	<form name="addform" action="index.php" method="post" target="right" onSubmit="return window.right.keywordsave()"  class="tasktable">
    	<input type="hidden" name="nurl" value="<?php echo get_url();?>" />
		<input type="hidden" name="catid" value="" />
        <input type="hidden" name="pc_hash" value="<?php echo $_SESSION['pc_hash'];?>" />
		<table border="0" cellspacing="0" cellpadding="0">
		   <tr>
			 <td height="28" colspan="2">
             <span style="float: right;"><a href="http://www.dedeapps.com/Keyword" target="_blank">长尾关键词分析工具</a></span>
             <b>栏目名：</b><span id="typename" style="color:#F60;font-weight:bold"></span></td>
		   </tr>
           
		   <tr>
			 <td height="28"><hr></td>
		   </tr>  
		   <tr>
			 <td colspan="2"><b>关键词采集</b>(推荐) <a href="javascript:;" class="tip" tip="关键词采集是采集侠自动根据关键词到搜索引擎里搜索，<br>根据搜索引擎的结果进行采集，<br>从而获得搜索引擎认为高权重文章的一种采集方法"><img src="<?php echo IMG_PATH.'admin_img/question-balloon.png';?>"></a>
             <a href="http://www.dedeadmin.com/?p=1642" target="_blank">关键词选取建议</a>
             <br><span id="free"></span>
             </td>
		   </tr>
		   <tr>
			 <td colspan="2"><textarea name="keyword" style="width:390px;height:110px"></textarea></td>
		   </tr>
           
           <tr>
			 <td colspan="2">&nbsp;</td>
		   </tr>  
		   <tr>
			 <td colspan="2"><b>RSS采集 <a class="tip" tip="RSS采集是采集侠自动监控RSS地址进行文章采集的一种方法" href="javascript:;"><img src="<?php echo IMG_PATH.'admin_img/question-balloon.png';?>"></a></b>
             <a href="http://www.dedeadmin.com/?p=2109" target="_blank">使用方法</a>
             </td>
		   </tr>
           <tr>
			 <td colspan="2">RSS地址：<br /><input name="addrss" type="text" style="width:250px" value="http://">
             <input type="button" name="button" value="添加" style="width:80px" onClick="window.right.addrss();" class="button"/></td>
		   </tr>

           <tr>
			 <td colspan="2">&nbsp;</td>
		   </tr>  
		   <tr>
			 <td colspan="2"><b>页面监控采集 <a href="javascript:;" class="tip" tip="采集侠自动监控页面，采集符合url链接规则的文章"><img src="<?php echo IMG_PATH.'admin_img/question-balloon.png';?>"></a></b></td>
		   </tr>
           <tr>
			 <td colspan="2" style="line-height:30px">
			 目标页面编码: <input name="char" type="radio" value="gb2312" checked>gb2312 <input name="char" type="radio" value="utf-8">utf8<br>
             监控页面地址：<input name="page" type="text" style="width:250px" value="http://"> <a href="javascript:;" class="tip" tip="需要监控的列表页面<br>可以使用 [2-8] 模式匹配多个列表"><img src="<?php echo IMG_PATH.'admin_img/question-balloon.png';?>"></a><br>
             文章url规则 ：<input name="rule" type="text" style="width:250px" value="http://"> <a href="javascript:;" class="tip" tip="填写监控页面内要采集的文章链接规则，(*)为通配符</br>如：http://www.dedeadmin.com/?p=(*)"><img src="<?php echo IMG_PATH.'admin_img/question-balloon.png';?>"></a><br>
             <input type="button" name="button" value="测试" style="width:80px" onClick="window.right.testpage();" class="button"/>
             <input type="button" name="button" value="添加" style="width:80px" onClick="window.right.addpage();" class="button"/>
             </td>
		   </tr>
		   <tr>
			 <td height="28"><hr></td>
		   </tr>
		   <tr align="center">
			 <td colspan="2">
             <input type="submit" name="Submit" value="保存" style="width:80px" class="button"/>
             <input type="reset" name="button" value="重置" style="width:80px" class="button"/></td>
		   </tr>
	  </table>
	</form>
</div>
<div class="runtask" style="display:none">
  <div class="taskbox" style="width:550px;">
    <table width="100%" border="0">
      <tr>
        <td>
          <div class="runtaskmsg" style="overflow:scroll;height:300px;"></div>
          <div>
            <input type="button" value="开始" style="width:80px" onClick="if(window.right.start>0){alert('采集已经在运行');return false;}window.right.start=1;window.right.taskdialog('<font color=red>成功开启采集</font>');window.right.ajaxtask();" class="button"/>
            <input type="button" value="暂停" style="width:80px" onClick="if(window.right.start==0){alert('您还没有开启采集');return false;};window.right.start=0;window.right.taskdialog('<font color=red>正在准备暂停，重新开始不会采集重复的文章</font>');" class="button"/>
            <input type="button" value="加速" style="width:80px" onClick="if(window.right.start==0){alert('请先开始采集');return false;};if(window.right.start>=5){alert('已达最大采集线程');return false;};window.right.start++;window.right.taskdialog('<font color=red>成功增加第'+window.right.start+'采集线程</font>');window.right.ajaxtask();" class="button"/>
        </div></td>
      </tr>
  </table>
  </div>
</div>
</body>
</html>