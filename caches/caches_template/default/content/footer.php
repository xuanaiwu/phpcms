<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><br />
<div class="nav-bottom">
      <div class="company-info">
	   <span style="float:left"><?php echo L('copyright');?></span>
	   <span style="float:right">
	   
	   <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=e3d146232857be4579899ac97dbd2f7c&action=category&catid=1&num=15&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'1','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'15',));}?>
	   <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<a href="<?php echo $r['url'];?>" target="_blank"><?php echo $r['catname'];?></a> |  
		<?php $n++;}unset($n); ?>
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
	   <a target="_blank" href="<?php echo APP_PATH;?>index.php?m=link"><?php echo L('link');?></a> 
	   </span>
      </div>
    </div>
  </div>
</div>
</body>
</html>