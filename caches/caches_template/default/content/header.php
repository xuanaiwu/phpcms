<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?></title>
<meta name="keywords" content="<?php echo $SEO['keyword'];?>" />
<meta name="description" content="<?php echo $SEO['description'];?>" />
<meta name="baidu-site-verification" content="rqcPjxFAkpIG7BIv" />
<meta property="qc:admins" content="60000141076161656367" />
<meta property="wb:webmaster" content="cc5ee7975c214304" />
<link type="text/css" rel="stylesheet" href="<?php echo CSS_PATH;?>universal.css"/>
<script type="text/javascript" src="<?php echo JS_PATH;?>jquery.min.js"></script>
<script type="text/javascript" src="<?php echo JS_PATH;?>jquery.sgallery.js"></script>
<script type="text/javascript" src="<?php echo JS_PATH;?>search_common.js"></script>
<script type="text/javascript" src="<?php echo JS_PATH;?>jquery.KinSlideshow-1.1.js"></script>
</head>
<body>
<div class="zstart-header" id="zstart-header">
  <div class="zstart-aux">
    <h1> <a href="#"><img alt="<?php echo L('index_logo_alt');?>"  src="<?php echo IMG_PATH;?>logo.png" width="202" height="63" /> </a> </h1>
    <div class="zstart-hinfo">
      <div class="hinfo-plus">
        <ul>
             <li>享众网：<span>我们致力为你推荐最适合你的数码产品。</span> </li>
        </ul>
      </div>
      <br />
      <script type="text/javascript">document.write('<iframe src="<?php echo APP_PATH;?>index.php?m=member&c=index&a=mini&forward='+encodeURIComponent(location.href)+'&siteid=<?php echo get_siteid();?>" allowTransparency="true"  width="350" height="26" frameborder="0" scrolling="no"></iframe>')</script>
    </div>
  </div>
</div>
<div id="zstart-nav" class="zstart-nav">
  <div class="zstart-aux">
  <a id="tg" href="http://inave.cn/index.php?m=search" class="maia-button get-started" target="_blank"><?php echo L('all_search');?></a> <a id="cy" href="http://www.inave.cn/bbs/" class="maia-button2 get-started" target="_blank"><?php echo L('to_help');?></a>
  <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=6caa7ba4ec395355e30b69e4aaea72df&action=category&catid=0&num=25&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'0','order'=>'listorder ASC','limit'=>'25',));}?>
    <ul>
      <li><a href="index.php">首页</a> </li>
	  <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<li><a href="<?php echo $r['url'];?>"><?php echo $r['catname'];?></a></li>
	  <?php $n++;}unset($n); ?>
	  <li><a href="http://www.inave.cn/bbs/" target="_blank">论坛</a></li>
    </ul>
   <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
  </div>
</div>
<br />