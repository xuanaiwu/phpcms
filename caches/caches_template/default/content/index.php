<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<!--main-->
<script type="text/javascript">
$(function(){
	$("#KinSlideshow").KinSlideshow({
			moveStyle:"right",
			titleBar:{titleBar_height:30,titleBar_bgColor:"#08355c",titleBar_alpha:0.5},
			titleFont:{TitleFont_size:12,TitleFont_color:"#FFFFFF",TitleFont_weight:"normal"},
			btn:{btn_bgColor:"#FFFFFF",btn_bgHoverColor:"#1072aa",btn_fontColor:"#000000",btn_fontHoverColor:"#FFFFFF",btn_borderColor:"#cccccc",btn_borderHoverColor:"#1188c0",btn_borderWidth:1}
	});
})
</script>

<div style="width:978px;margin:0 auto;margin-top:-1em;">
<!--修改了css的news-hot去掉高度属性-->
<div class="news-hot">
        	<div class="content">
        	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=7a7a0e753182bcf4d42b038435e627ed&action=position&posid=2&order=listorder+DESC&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'2','order'=>'listorder DESC','limit'=>'3',));}?>
        	 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                <h4 class="blue"><a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>"><?php echo str_cut($r[title],45,'');?></a></h4>
                <p><?php if($n==1) { ?><img src="<?php echo thumb($r[thumb],90,60);?>" width="90" height="60" alt="<?php echo $r['title'];?>"/><?php } ?><?php echo str_cut($r[description],200);?></p>
                <div class="bk20 hr"><hr /></div>
               <?php $n++;}unset($n); ?>  
             <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>   
            </div>
</div>

 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=dcd1c47627b910509414b85662be50cc&action=position&posid=1&order=listorder+DESC&thumb=1&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'1','order'=>'listorder DESC','thumb'=>'1','limit'=>'5',));}?>			
    <div id="KinSlideshow" style="visibility:hidden;">
	 <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
        <a href="<?php echo $r['url'];?>" title="<?php echo str_cut($r['title'],50);?>" target="_blank"><img src="<?php echo thumb($r['thumb'],578,335);?>" 
		alt="<?php echo $r['title'];?>" width="578" height="335" /></a>
  	  <?php $n++;}unset($n); ?>
    </div>
  <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
  
</div>
	<div class="zstart-aux">
		<div class="zstart-cols">
			<!-- 文章内容  -->
			<div class="zstart-col-01">
				<div class="tab-content">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=2130977244bece5f49707be8523bf760&action=lists&catid=6&order=updatetime+DESC&thumb=1&num=15&page=%24_GET%5Bpage%5D&return=info\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 15;$page = intval($_GET[page]) ? intval($_GET[page]) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>'6','order'=>'updatetime DESC','thumb'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($content_total, $page, $pagesize, $urlrule);$info = $content_tag->lists(array('catid'=>'6','order'=>'updatetime DESC','thumb'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
					<?php $n=1;if(is_array($info)) foreach($info AS $v) { ?>
					<div class="zpost clearfix">
						<div class="pic">
							<a class="thumbnail"
								href="<?php echo $v['url'];?>" target="_blank">
								<img src="<?php echo thumb($v[thumb],90,67);?>" width="90" height="67" alt="<?php echo $v['title'];?>"/>
							</a>
						</div>
						<div class="zheader">
							<div class="zcomment-number">
								<span class="number">
									<a
										href="<?php echo $v['url'];?>"><?php echo L('read');?></a>
								</span>
								<span class="corner"></span>
							</div>
							<h2 class="ztitle yahei">
								<a target="_blank"
									href="<?php echo $v['url'];?>"
									rel="external"><?php echo str_cut($v['title'],75);?></a>
							</h2>
						</div>
						<div class="zpost-detail ">
							<p><?php echo str_cut($v['description'],200);?>
							</p>
							<br />
							<span class="zpost-info">
								<span class="new_time">
									<i class="icon-time"></i>
									<?php echo date('Y-m-d h:i:s',$r[inputtime]);?>
								</span>
								|
								<span class="new_laiyuan">
									<i class="icon-list-alt"></i>
									<?php echo L('author');?>：<?php echo $v['username'];?>
								</span>
							</span>
						</div>
					</div>		
					 <?php $n++;}unset($n); ?>
                     <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					 		
				</div>
				
				<!--分页-->
				<div id="pages" class="text-c"><?php echo $pages;?></div>
				
			</div>
		
			
			<div class="zstart-col-04">
			   	     
       	      	<!--系统公告-->
				<div class="wiget-title clearfix">
					<h2><font color="#FF0000"><?php echo L('annoceun');?></font></h2>
					<span class="bg_c">&nbsp;</span>
				</div>
				<div class="wiget-box">
				 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"announce\" data=\"op=announce&tag_md5=b79fc9110a09c6680d3768c9c06f8518&action=lists&siteid=%24siteid&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$announce_tag = pc_base::load_app_class("announce_tag", "announce");if (method_exists($announce_tag, 'lists')) {$data = $announce_tag->lists(array('siteid'=>$siteid,'limit'=>'5',));}?>
				 <ul class="widget-posts-thumbnail">
                  <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>	
					<br /><li class="clearfix"><a href="<?php echo APP_PATH;?>index.php?m=announce&c=index&a=show&aid=<?php echo $r['aid'];?>"><?php echo $r['title'];?></a></li>
				 <?php $n++;}unset($n); ?>
				 </ul>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				
				</div>
       	     
       	     
   	            <!--测试专题-->	
				<div class="wiget-title clearfix">
					<h2><?php echo L('special');?></h2>
					<span class="bg_c">&nbsp;</span>
				</div>
				<div class="wiget-box">
					<ul class="widget-posts-thumbnail">
					 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"special\" data=\"op=special&tag_md5=acb159c1fdfd861801ced36aa5433ae9&action=lists&elite=1&listorder=3&num=2\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$special_tag = pc_base::load_app_class("special_tag", "special");if (method_exists($special_tag, 'lists')) {$data = $special_tag->lists(array('elite'=>'1','listorder'=>'3','limit'=>'2',));}?>
                     <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li class="clearfix">
						    <br />
							<h4>
								<a href="<?php echo $r['url'];?>" target="_blank"><?php echo str_cut($r[title],'50');?></a>
							</h4>
							<br />
							<div class="wiget-box-sum">
								<a href="<?php echo $r['url'];?>">
									<img class="dream-img"
										src="<?php echo thumb($r[thumb],90,67);?>" width="90"   height="67"  alt="<?php echo $r['title'];?>">
								</a>
								<p><?php echo str_cut($r['description'],50);?></p>
							</div>
						</li>
						<?php $n++;}unset($n); ?>
                        <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</ul>
				</div>
             
             
				<div class="wiget-title clearfix">
					<h2><?php echo L('hot_c_readboard');?></h2>
					<span class="bg_c">&nbsp;</span>
				</div>
				<div class="wiget-box">
					<ul id="recent_hots">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"comment\" data=\"op=comment&tag_md5=fdedcf5999ffa2bc123d32c044969dd3&action=bang&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$comment_tag = pc_base::load_app_class("comment_tag", "comment");if (method_exists($comment_tag, 'bang')) {$data = $comment_tag->bang(array('limit'=>'10',));}?>
				    <?php $n=1; if(is_array($data)) foreach($data AS $key => $val) { ?>
				    
							 <li><a href="<?php echo $val['url'];?>"><?php echo $val['title'];?></a><FONT color="red">(<?php echo $val['total'];?>)</FONT></li>
					
						<?php $n++;}unset($n); ?>
			            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</ul>
				</div>

				<div class="wiget-title clearfix">
					<h2><?php echo L('hot_article_list');?></h2>
					<span class="bg_c">&nbsp;</span>
				</div>
				<div class="wiget-box">
					<ul class="widget-posts-thumbnail">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=7c481b68a0034af1abf1c4b40c4e3058&action=hits&catid=6&num=7&order=views+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>'6','order'=>'views DESC','limit'=>'7',));}?>
				        <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li class="clearfix">
							<div class="widget-thumb">
								<a class=""
									href="<?php echo $r['url'];?>">
									<img
										src="<?php echo thumb($r[thumb],90,40);?>"
										 class="widget-thumb" width="90" height="40" alt="<?php echo $r['title'];?>">
								</a>
							</div>
							<a href="<?php echo $r['url'];?>"
								class="widget-thumb-title" target="_blank"><?php echo $r['title'];?></a>
						</li>
						<?php $n++;}unset($n); ?>
			            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</ul>
				</div>
				
			<div class="bk10"></div>	
			<div class="box">
				<h5 class="title-2">
					<?php echo L('questionnaire');?>
					<a href="<?php echo APP_PATH;?>index.php?m=vote&c=index&siteid=<?php echo $siteid;?>"
						class="more"><?php echo L('more');?>>></a>
				</h5>
				<script language="javascript"
					src="<?php echo APP_PATH;?>index.php?m=vote&c=index&a=show&action=js&subjectid=1&type=3"></script>
			</div>

		</div>
		</div>
	</div>
<div class="g4e-grid">
  <div id="zstart-footer" class="zstart-footer">
    <div id="zstart-footer-t">
      <div class="zstart-aux">
        <div id="footer">
          <div class="footer clearfix">
            <ul class="things unstyled clearfix">
			 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"link\" data=\"op=link&tag_md5=80574ec69aa2a6c10ed30f7c49e0eda7&action=type_list&siteid=%24siteid&linktype=1&order=listorder+DESC&num=8&return=pic_link\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$link_tag = pc_base::load_app_class("link_tag", "link");if (method_exists($link_tag, 'type_list')) {$pic_link = $link_tag->type_list(array('siteid'=>$siteid,'linktype'=>'1','order'=>'listorder DESC','limit'=>'8',));}?>
			 <?php $n=1;if(is_array($pic_link)) foreach($pic_link AS $v) { ?>
              <li class="weibo"> <a href="<?php echo $v['url'];?>" title="<?php echo $v['name'];?>" target="_blank"> <span class="icon"></span>
              <img src="<?php echo $v['logo'];?>" width="88" height="31" alt="<?php echo $v['name'];?>"/>
                </a></li>
			 <?php $n++;}unset($n); ?>
             <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            </ul>
          </div>
        </div>
      </div>
    </div>
<?php include template("content","footer"); ?>