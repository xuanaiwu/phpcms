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
      <a class="add fb" href="javascript:void(0);" onclick="runtask();"><em> �����ɼ� </em></a>��    <a href='javascript:;' class="on"><em>�ɼ�����</em></a>  
    </div>
</div>
<form name="taskform" action="index.php" method="post" onSubmit="return closetasks();">
<div class="pad_10">
<div class="explain-col task_show_tip0" style="display:none">
��Ŀǰ������û���ÿ����Ŀֻ�����һ���ؼ��ʣ�������Ȩ�������и��๦�ܺͷ���
</div>
<div class="explain-col task_show_tip1" style="display:none">
��Ŀǰ����Ȩ���û�����л����ʹ�ã�
</div>
<div class="bk10"></div>
<div class="table-list">
    <table width="100%" cellspacing="0" >
        <thead>
            <tr>
            <th width="5%"><input type="checkbox" id="check_box" onclick="selectall('ids[]');"></th>
            <th width="10%">catid</th>
            <th width="20%" align="left">��Ŀ����</th>
            <th width="55%">�ɼ��ؼ���</th>
            <th>����</th>
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
                <a href="javascript:void(0)"><b>����</b></a>
            </td>
                <td align="center">
                <?php if($r['isclose']==1){ ?>
                <a href="?m=admin&c=plugin&a=config&pluginid=<?php echo $_GET['pluginid']?>&menuid=<?php echo $_GET['menuid']?>&id=<?php echo $r['catid'] ?>&close=0&module=closetasks"><font color="red">����</font></a></td>
                <?php }else{ ?>
                <a href="?m=admin&c=plugin&a=config&pluginid=<?php echo $_GET['pluginid']?>&menuid=<?php echo $_GET['menuid']?>&id=<?php echo $r['catid'] ?>&close=1&module=closetasks">�ر�</a></td>
                <?php } ?>
            </tr>
            <?php
                }
            }else
            {
                echo '<tr><td colspan="5">����û������κ���ĿŶ�����������Ŀ</td></tr>';
            }
            ?>
        </tbody>
    </table>

    <div class="btn">
        <input type="hidden" name="pc_hash" value="<?php echo $_SESSION['pc_hash'];?>" />
        <input type="submit" class="button" name="opensubmit" value="��������"/>
        <input type="submit" class="button" name="closesubmit" value="�����ر�"/>
    </div>
	
	
<div class="content-menu ib-a blue line-x">
      <a class="add fb" href="javascript:void(0);" onclick="runtask();"><em> �����ɼ� </em></a>  
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
             <span style="float: right;"><a href="http://www.dedeapps.com/Keyword" target="_blank">��β�ؼ��ʷ�������</a></span>
             <b>��Ŀ����</b><span id="typename" style="color:#F60;font-weight:bold"></span></td>
		   </tr>
           
		   <tr>
			 <td height="28"><hr></td>
		   </tr>  
		   <tr>
			 <td colspan="2"><b>�ؼ��ʲɼ�</b>(�Ƽ�) <a href="javascript:;" class="tip" tip="�ؼ��ʲɼ��ǲɼ����Զ����ݹؼ��ʵ�����������������<br>������������Ľ�����вɼ���<br>�Ӷ��������������Ϊ��Ȩ�����µ�һ�ֲɼ�����"><img src="<?php echo IMG_PATH.'admin_img/question-balloon.png';?>"></a>
             <a href="http://www.dedeadmin.com/?p=1642" target="_blank">�ؼ���ѡȡ����</a>
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
			 <td colspan="2"><b>RSS�ɼ� <a class="tip" tip="RSS�ɼ��ǲɼ����Զ����RSS��ַ�������²ɼ���һ�ַ���" href="javascript:;"><img src="<?php echo IMG_PATH.'admin_img/question-balloon.png';?>"></a></b>
             <a href="http://www.dedeadmin.com/?p=2109" target="_blank">ʹ�÷���</a>
             </td>
		   </tr>
           <tr>
			 <td colspan="2">RSS��ַ��<br /><input name="addrss" type="text" style="width:250px" value="http://">
             <input type="button" name="button" value="���" style="width:80px" onClick="window.right.addrss();" class="button"/></td>
		   </tr>

           <tr>
			 <td colspan="2">&nbsp;</td>
		   </tr>  
		   <tr>
			 <td colspan="2"><b>ҳ���زɼ� <a href="javascript:;" class="tip" tip="�ɼ����Զ����ҳ�棬�ɼ�����url���ӹ��������"><img src="<?php echo IMG_PATH.'admin_img/question-balloon.png';?>"></a></b></td>
		   </tr>
           <tr>
			 <td colspan="2" style="line-height:30px">
			 Ŀ��ҳ�����: <input name="char" type="radio" value="gb2312" checked>gb2312 <input name="char" type="radio" value="utf-8">utf8<br>
             ���ҳ���ַ��<input name="page" type="text" style="width:250px" value="http://"> <a href="javascript:;" class="tip" tip="��Ҫ��ص��б�ҳ��<br>����ʹ�� [2-8] ģʽƥ�����б�"><img src="<?php echo IMG_PATH.'admin_img/question-balloon.png';?>"></a><br>
             ����url���� ��<input name="rule" type="text" style="width:250px" value="http://"> <a href="javascript:;" class="tip" tip="��д���ҳ����Ҫ�ɼ����������ӹ���(*)Ϊͨ���</br>�磺http://www.dedeadmin.com/?p=(*)"><img src="<?php echo IMG_PATH.'admin_img/question-balloon.png';?>"></a><br>
             <input type="button" name="button" value="����" style="width:80px" onClick="window.right.testpage();" class="button"/>
             <input type="button" name="button" value="���" style="width:80px" onClick="window.right.addpage();" class="button"/>
             </td>
		   </tr>
		   <tr>
			 <td height="28"><hr></td>
		   </tr>
		   <tr align="center">
			 <td colspan="2">
             <input type="submit" name="Submit" value="����" style="width:80px" class="button"/>
             <input type="reset" name="button" value="����" style="width:80px" class="button"/></td>
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
            <input type="button" value="��ʼ" style="width:80px" onClick="if(window.right.start>0){alert('�ɼ��Ѿ�������');return false;}window.right.start=1;window.right.taskdialog('<font color=red>�ɹ������ɼ�</font>');window.right.ajaxtask();" class="button"/>
            <input type="button" value="��ͣ" style="width:80px" onClick="if(window.right.start==0){alert('����û�п����ɼ�');return false;};window.right.start=0;window.right.taskdialog('<font color=red>����׼����ͣ�����¿�ʼ����ɼ��ظ�������</font>');" class="button"/>
            <input type="button" value="����" style="width:80px" onClick="if(window.right.start==0){alert('���ȿ�ʼ�ɼ�');return false;};if(window.right.start>=5){alert('�Ѵ����ɼ��߳�');return false;};window.right.start++;window.right.taskdialog('<font color=red>�ɹ����ӵ�'+window.right.start+'�ɼ��߳�</font>');window.right.ajaxtask();" class="button"/>
        </div></td>
      </tr>
  </table>
  </div>
</div>
</body>
</html>