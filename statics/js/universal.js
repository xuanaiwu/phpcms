/*
 *	sGallery 1.0 - simple gallery with jQuery
 *	made by bujichong 2009-11-25
 *	作者：不羁虫  2009-11-25
 * http://hi.baidu.com/bujichong/
 *	欢迎交流转载，但请尊重作者劳动成果，标明插件来源及作者
 */

(function ($) {
$.fn.sGallery = function (o) {
    return  new $sG(this, o);
			//alert('do');
    };

	var settings = {
		thumbObj:null,//预览对象
		titleObj:null,//标题
		botLast:null,//按钮上一个
		botNext:null,//按钮下一个
		thumbNowClass:'now',//预览对象当前的class,默认为now
		slideTime:800,//平滑过渡时间
		autoChange:true,//是否自动切换
		changeTime:5000,//自动切换时间
		delayTime:100//鼠标经过时反应的延迟时间
	};

 $.sGalleryLong = function(e, o) {
    this.options = $.extend({}, settings, o || {});
	var _self = $(e);
	var set = this.options;
	var thumb;
	var size = _self.size();
	var nowIndex = 0; //定义全局指针
	var index;//定义全局指针
	var startRun;//预定义自动运行参数
	var delayRun;//预定义延迟运行参数

//初始化
	_self.eq(0).show();

//主切换函数
function fadeAB () {
	if (nowIndex != index) {
		if (set.thumbObj!=null) {
		$(set.thumbObj).removeClass().eq(index).addClass(set.thumbNowClass);}
		_self.eq(nowIndex).stop(false,true).fadeOut(set.slideTime);
		_self.eq(index).stop(true,true).fadeIn(set.slideTime);
		$(set.titleObj).eq(nowIndex).hide();//新增加title
		$(set.titleObj).eq(index).show();//新增加title
		nowIndex = index;
		if (set.autoChange==true) {
		clearInterval(startRun);//重置自动切换函数
		startRun = setInterval(runNext,set.changeTime);}
		}
}

//切换到下一个
function runNext() {
	index =  (nowIndex+1)%size;
	fadeAB();
}

//点击任一图片
	if (set.thumbObj!=null) {
	thumb = $(set.thumbObj);
//初始化
	thumb.eq(0).addClass(set.thumbNowClass);
		thumb.bind("mousemove",function(event){
			index = thumb.index($(this));
			fadeAB();
			delayRun = setTimeout(fadeAB,set.delayTime);
			clearTimeout(delayRun);
			event.stopPropagation();
		})
	}

//点击上一个
	if (set.botNext!=null) {
		var botNext = $(set.botNext);
		botNext.mousemove(function () {
			runNext();
			return false;
		});
	}

//点击下一个
	if (set.botLast!=null) {
		var botLast = $(set.botLast);
		botLast.mousemove(function () {
			index = (nowIndex+size-1)%size;
			fadeAB();
			return false;
	});
	}

//自动运行
	if (set.autoChange==true) {
	startRun = setInterval(runNext,set.changeTime);
	}

}

var $sG = $.sGalleryLong;

})(jQuery);

function slide(Name,Class,Width,Height,fun){
	$(Name).width(Width);
	$(Name).height(Height);
	
	if(fun == true){
		$(Name).append('<div class="title-bg"></div><div class="title"></div><div class="change"></div>')
		var atr = $(Name+' div.changeDiv a');
		var sum = atr.length;
		for(i=1;i<=sum;i++){
			var title = atr.eq(i-1).attr("title");
			var href = atr.eq(i-1).attr("href");
			$(Name+' .change').append('<i>'+i+'</i>');
			$(Name+' .title').append('<a href="'+href+'">'+title+'</a>');
		}
		$(Name+' .change i').eq(0).addClass('cur');
	}
	$(Name+' div.changeDiv a').sGallery({//对象指向层，层内包含图片及标题
		titleObj:Name+' div.title a',
		thumbObj:Name+' .change i',
		thumbNowClass:Class
	});
	$(Name+" .title-bg").width(Width);
}

//缩略图
jQuery.fn.LoadImage=function(scaling,width,height,loadpic){
    if(loadpic==null)loadpic="../images/msg_img/loading.gif";
return this.each(function(){
   var t=$(this);
   var src=$(this).attr("src")
   var img=new Image();
   img.src=src;
   //自动缩放图片
   var autoScaling=function(){
    if(scaling){
     if(img.width>0 && img.height>0){ 
           if(img.width/img.height>=width/height){ 
               if(img.width>width){ 
                   t.width(width); 
                   t.height((img.height*width)/img.width); 
               }else{ 
                   t.width(img.width); 
                   t.height(img.height); 
               } 
           } 
           else{ 
               if(img.height>height){ 
                   t.height(height); 
                   t.width((img.width*height)/img.height); 
               }else{ 
                   t.width(img.width); 
                   t.height(img.height); 
               } 
           } 
       } 
    } 
   }
   //处理ff下会自动读取缓存图片
   if(img.complete){
    autoScaling();
      return;
   }
   $(this).attr("src","");
   var loading=$("<img alt=\"加载中...\" title=\"图片加载中...\" src=\""+loadpic+"\" />");
  
   t.hide();
   t.after(loading);
   $(img).load(function(){
    autoScaling();
    loading.remove();
    t.attr("src",this.src);
    t.show();
	//$('.photo_prev a,.photo_next a').height($('#big-pic img').height());
   });
  });
}

//向上滚动代码
function startmarquee(elementID,h,n,speed,delay){
 var t = null;
 var box = '#' + elementID;
 $(box).hover(function(){
  clearInterval(t);
  }, function(){
  t = setInterval(start,delay);
 }).trigger('mouseout');
 function start(){
  $(box).children('ul:first').animate({marginTop: '-='+h},speed,function(){
   $(this).css({marginTop:'0'}).find('li').slice(0,n).appendTo(this);
  })
 }
}

//TAB切换
function SwapTab(name,title,content,Sub,cur){
  $(name+' '+title).mouseover(function(){
	  $(this).addClass(cur).siblings().removeClass(cur);
	  $(content+" > "+Sub).eq($(name+' '+title).index(this)).show().siblings().hide();
  });
}


function setmodel(value, id, siteid, q) {
	$("#typeid").val(value);
	$("#search a").removeClass();
	id.addClass('on');
	if(q!=null && q!='') {
		window.location='?m=search&c=index&a=init&siteid='+siteid+'&typeid='+value+'&q='+q;
	}
}


/**
 * 
 *
 * jQuery KinSlideshow plugin
 * 
 * 
 * ========================================================================================================
 * @name jquery.KinSlideshow.js
 * @version 1.1
 * @author Mr.Kin
 * @date 2010-07-25
 * @Email:Mr.Kin@Foxmail.com
 * @QQ:87190493
 *
 *
 *
 **/


(function($) {

$.fn.KinSlideshow = function(settings){

	  settings = jQuery.extend({
		   intervalTime : 5, 
		   moveSpeedTime : 400,
		   moveStyle:"left",
		   mouseEvent:"mouseclick",
		   isHasTitleBar:true,
		   titleBar:{titleBar_height:40,titleBar_bgColor:"#000000",titleBar_alpha:0.5},
		   isHasTitleFont:true,
		   titleFont:{TitleFont_size:12,TitleFont_color:"#FFFFFF",TitleFont_family:"Verdana",TitleFont_weight:"bold"},
		   isHasBtn:true, 
		   btn:{btn_bgColor:"#666666",btn_bgHoverColor:"#CC0000",btn_fontColor:"#CCCCCC",btn_fontHoverColor:"#000000",btn_fontFamily:"Verdana",btn_borderColor:"#999999",btn_borderHoverColor:"#FF0000",btn_borderWidth:1,btn_bgAlpha:0.7} 
	  },settings);
	  var titleBar_Bak = {titleBar_height:40,titleBar_bgColor:"#000000",titleBar_alpha:0.5}
	  var titleFont_Bak = {TitleFont_size:12,TitleFont_color:"#FFFFFF",TitleFont_family:"Verdana",TitleFont_weight:"bold"}
	  var btn_Bak = {btn_bgColor:"#666666",btn_bgHoverColor:"#CC0000",btn_fontColor:"#CCCCCC",btn_fontHoverColor:"#000000",btn_fontFamily:"Verdana",btn_borderColor:"#999999",btn_borderHoverColor:"#FF0000",btn_borderWidth:1,btn_bgAlpha:0.7} 
	  for (var key in titleBar_Bak){
		  if(settings.titleBar[key] == undefined){
			  settings.titleBar[key] = titleBar_Bak[key];
		  }
	  }	
	  for (var key in titleFont_Bak){
		  if(settings.titleFont[key] == undefined){
			  settings.titleFont[key] = titleFont_Bak[key];
		  }
	  }
	  for (var key in btn_Bak){
		  if(settings.btn[key] == undefined){
			  settings.btn[key] = btn_Bak[key];
		  }
	  }	  
	  
	 var KinSlideshow_BoxObject = this;
	 var KinSlideshow_BoxObjectSelector = $(KinSlideshow_BoxObject).selector;
	 var KinSlideshow_DateArray = new Array();
	 var KinSlideshow_imgaeLength = 0;
	 var KinSlideshow_Size =new Array();
	 var KinSlideshow_changeFlag = 0;
	 var KinSlideshow_IntervalTime = settings.intervalTime;
	 var KinSlideshow_setInterval;
	 var KinSlideshow_firstMoveFlag = true;
	 if(isNaN(KinSlideshow_IntervalTime) || KinSlideshow_IntervalTime <= 1){
			KinSlideshow_IntervalTime = 5;
	 }
	 if(settings.moveSpeedTime > 500){
		 settings.moveSpeedTime = 500;
	 }else if(settings.moveSpeedTime < 100){
		 settings.moveSpeedTime = 100;
	 }
	 
	 function KinSlideshow_initialize(){
		 $(KinSlideshow_BoxObject).css({visibility:"hidden"});
		 $(KinSlideshow_BoxObjectSelector+" a img").css({border:0});
		 KinSlideshow_start();
		 KinSlideshow_mousehover();
	 };
   
     function KinSlideshow_start(){
		 KinSlideshow_imgaeLength = $(KinSlideshow_BoxObjectSelector+" a").length;
		 KinSlideshow_Size.push($(KinSlideshow_BoxObjectSelector+" a img").width());
		 KinSlideshow_Size.push($(KinSlideshow_BoxObjectSelector+" a img").height());
		 
		$(KinSlideshow_BoxObjectSelector+" a img").each(function(i){
			KinSlideshow_DateArray.push($(this).attr("alt"));		
		});
		$(KinSlideshow_BoxObjectSelector+" a").wrapAll("<div id='KinSlideshow_content'></div>");
		
	    $("#KinSlideshow_content").clone().attr("id","KinSlideshow_contentClone").appendTo(KinSlideshow_BoxObject);
		KinSlideshow_setTitleBar();
		KinSlideshow_setTitleFont();
		KinSlideshow_setBtn();
		KinSlideshow_action();
		KinSlideshow_btnEvent(settings.mouseEvent);
		$(KinSlideshow_BoxObject).css({visibility:"visible"});
	 };
	 function KinSlideshow_setTitleBar(){
		$(KinSlideshow_BoxObject).css({width:KinSlideshow_Size[0],height:KinSlideshow_Size[1],overflow:"hidden",position:"relative"});
		$(KinSlideshow_BoxObject).append("<div class='KinSlideshow_titleBar'></div>");
		var getTitleBar_Height = settings.titleBar.titleBar_height;//��ȡ���߶�
		
		if(isNaN(getTitleBar_Height)){
			getTitleBar_Height = 40;
		}else if(getTitleBar_Height < 25){
			getTitleBar_Height = 25;
		};
		
		$(KinSlideshow_BoxObjectSelector+" .KinSlideshow_titleBar").css({height:getTitleBar_Height,width:"100%",position:"absolute",bottom:0,left:0})
		 if(settings.isHasTitleBar){
		 		$(KinSlideshow_BoxObjectSelector+" .KinSlideshow_titleBar").css({background:settings.titleBar.titleBar_bgColor,opacity:settings.titleBar.titleBar_alpha})	 
		 }
	 };
	 function KinSlideshow_setTitleFont(){
		 if(settings.isHasTitleFont){
			$(KinSlideshow_BoxObjectSelector+" .KinSlideshow_titleBar").append("<h2 class='title' style='margin:3px 0 0 6px;padding:0;'></h2>");	
			$(KinSlideshow_BoxObjectSelector+" .KinSlideshow_titleBar .title").css({fontSize:settings.titleFont.TitleFont_size,color:settings.titleFont.TitleFont_color,fontFamily:settings.titleFont.TitleFont_family,fontWeight:settings.titleFont.TitleFont_weight});
			setTiltFontShow(0);
		 };
		 
	 };
	 function KinSlideshow_setBtn(){
		 if(settings.btn.btn_borderWidth > 2){settings.btn.btn_borderWidth = 2}
		 if(settings.btn.btn_borderWidth < 0 || isNaN(settings.btn.btn_borderWidth)){settings.btn.btn_borderWidth = 0}
		 if(settings.isHasBtn && KinSlideshow_imgaeLength >= 2){
			 $(KinSlideshow_BoxObject).append("<div class='KinSlideshow_btnBox' style='position:absolute;right:10px;bottom:5px; z-index:100'></div>");
			 var KinSlideshow_btnList = "";
			 for(i=1;i<=KinSlideshow_imgaeLength;i++){
					KinSlideshow_btnList+="<li>"+i+"</li>";
			 }
			 KinSlideshow_btnList = "<ul id='btnlistID' style='margin:0;padding:0; overflow:hidden'>"+KinSlideshow_btnList+"</ul>";
			 $(KinSlideshow_BoxObjectSelector+" .KinSlideshow_btnBox").append(KinSlideshow_btnList);
			 $(KinSlideshow_BoxObjectSelector+" .KinSlideshow_btnBox #btnlistID li").css({listStyle:"none",float:"left",width:18,height:18,borderWidth:settings.btn.btn_borderWidth,borderColor:settings.btn.btn_borderColor,borderStyle:"solid",background:settings.btn.btn_bgColor,textAlign:"center",cursor:"pointer",marginLeft:3,fontSize:12,fontFamily:settings.btn.btn_fontFamily,lineHeight:"18px",opacity:settings.btn.btn_bgAlpha,color:settings.btn.btn_fontColor});
			 $("#btnlistID li:eq(0)").css({background:settings.btn.btn_bgHoverColor,borderColor:settings.btn.btn_borderHoverColor,color:settings.btn.btn_fontHoverColor});
		 };
	 };
	 function KinSlideshow_action(){
		switch(settings.moveStyle){
			case "left":  KinSlideshow_moveLeft(); break;
			case "right": KinSlideshow_moveRight();break;
			case "up":    KinSlideshow_moveUp();   break;
			case "down":  KinSlideshow_moveDown(); break;
			default:      settings.moveStyle = "left"; KinSlideshow_moveLeft();
		}	 
	 };
	 function KinSlideshow_moveLeft(){
		$(KinSlideshow_BoxObjectSelector+" div:lt(2)").wrapAll("<div id='KinSlideshow_moveBox'></div>");
		$("#KinSlideshow_moveBox").css({width:KinSlideshow_Size[0],height:KinSlideshow_Size[1],overflow:"hidden",position:"relative"});
		$("#KinSlideshow_content").css({float:"left"});
		$("#KinSlideshow_contentClone").css({float:"left"});
		$(KinSlideshow_BoxObjectSelector+" #KinSlideshow_moveBox div").wrapAll("<div id='KinSlideshow_XposBox'></div>");
		$(KinSlideshow_BoxObjectSelector+" #KinSlideshow_XposBox").css({float:"left",width:"2000%"});
		
		KinSlideshow_setInterval = setInterval(function(){KinSlideshow_move(settings.moveStyle)},KinSlideshow_IntervalTime*1000+settings.moveSpeedTime);
	 };
	 function KinSlideshow_moveRight(){
		$(KinSlideshow_BoxObjectSelector+" div:lt(2)").wrapAll("<div id='KinSlideshow_moveBox'></div>");
		$("#KinSlideshow_moveBox").css({width:KinSlideshow_Size[0],height:KinSlideshow_Size[1],overflow:"hidden",position:"relative"});
		$("#KinSlideshow_content").css({float:"left"});
		$("#KinSlideshow_contentClone").css({float:"left"});
		$(KinSlideshow_BoxObjectSelector+" #KinSlideshow_moveBox div").wrapAll("<div id='KinSlideshow_XposBox'></div>");
		$(KinSlideshow_BoxObjectSelector+" #KinSlideshow_XposBox").css({float:"left",width:"2000%"});
		$("#KinSlideshow_contentClone").html("");
		$("#KinSlideshow_content a").wrap("<span></span>")
		$("#KinSlideshow_content a").each(function(i){
			$("#KinSlideshow_contentClone").prepend($("#KinSlideshow_content span:eq("+i+")").html());
		})
		
		$("#KinSlideshow_content").html($("#KinSlideshow_contentClone").html());
		var KinSlideshow_offsetLeft = (KinSlideshow_imgaeLength-1)*KinSlideshow_Size[0];
		$("#KinSlideshow_moveBox").scrollLeft(KinSlideshow_offsetLeft);
		KinSlideshow_setInterval = setInterval(function(){KinSlideshow_move(settings.moveStyle)},KinSlideshow_IntervalTime*1000+settings.moveSpeedTime);
	 };	 
	 function KinSlideshow_moveUp(){
		$(KinSlideshow_BoxObjectSelector+" div:lt(2)").wrapAll("<div id='KinSlideshow_moveBox'></div>");//��div���
		$("#KinSlideshow_moveBox").css({width:KinSlideshow_Size[0],height:KinSlideshow_Size[1],overflow:"hidden",position:"relative"});
		
		$("#KinSlideshow_moveBox").animate({scrollTop: 0}, 1);
		KinSlideshow_setInterval = setInterval(function(){KinSlideshow_move(settings.moveStyle)},KinSlideshow_IntervalTime*1000+settings.moveSpeedTime);
		
	 };	 
	 
	 function KinSlideshow_moveDown(){
		$(KinSlideshow_BoxObjectSelector+" div:lt(2)").wrapAll("<div id='KinSlideshow_moveBox'></div>");//��div���
		$("#KinSlideshow_moveBox").css({width:KinSlideshow_Size[0],height:KinSlideshow_Size[1],overflow:"hidden",position:"relative"});
		$("#KinSlideshow_contentClone").html("");
		$("#KinSlideshow_content a").wrap("<span></span>")
		$("#KinSlideshow_content a").each(function(i){
			$("#KinSlideshow_contentClone").prepend($("#KinSlideshow_content span:eq("+i+")").html());
		})
		$("#KinSlideshow_content").html($("#KinSlideshow_contentClone").html());
		
		var KinSlideshow_offsetTop = (KinSlideshow_imgaeLength-1)*KinSlideshow_Size[1];
		$("#KinSlideshow_moveBox").animate({scrollTop: KinSlideshow_offsetTop}, 1);
		KinSlideshow_setInterval = setInterval(function(){KinSlideshow_move(settings.moveStyle)},KinSlideshow_IntervalTime*1000+settings.moveSpeedTime);
	 };
	function KinSlideshow_move(style){
			
			switch(style){
				case "left":
					if(KinSlideshow_changeFlag >= KinSlideshow_imgaeLength){
						KinSlideshow_changeFlag = 0;
						$("#KinSlideshow_moveBox").scrollLeft(0);
						$("#KinSlideshow_moveBox").animate({scrollLeft:KinSlideshow_Size[0]}, settings.moveSpeedTime);
					}else{
						sp =(KinSlideshow_changeFlag+1)*KinSlideshow_Size[0];
						if ($("#KinSlideshow_moveBox").is(':animated')){ 
							$("#KinSlideshow_moveBox").stop();
							$("#KinSlideshow_moveBox").animate({scrollLeft: sp}, settings.moveSpeedTime);
						}else{
							$("#KinSlideshow_moveBox").animate({scrollLeft: sp}, settings.moveSpeedTime);
						}
					}
					setTiltFontShow(KinSlideshow_changeFlag+1);
					break;
				case "right":
					var KinSlideshow_offsetLeft = (KinSlideshow_imgaeLength-1)*KinSlideshow_Size[0];
					if(KinSlideshow_changeFlag >= KinSlideshow_imgaeLength){
						KinSlideshow_changeFlag = 0;
						$("#KinSlideshow_moveBox").scrollLeft(KinSlideshow_offsetLeft+KinSlideshow_Size[0]);
						$("#KinSlideshow_moveBox").animate({scrollLeft:KinSlideshow_offsetLeft}, settings.moveSpeedTime);
					}else{
						if(KinSlideshow_firstMoveFlag){
							KinSlideshow_changeFlag++;
							KinSlideshow_firstMoveFlag = false;
						}
						sp =KinSlideshow_offsetLeft-(KinSlideshow_changeFlag*KinSlideshow_Size[0]);
						if ($("#KinSlideshow_moveBox").is(':animated')){ 
							$("#KinSlideshow_moveBox").stop();
							$("#KinSlideshow_moveBox").animate({scrollLeft: sp}, settings.moveSpeedTime);
						}else{
							$("#KinSlideshow_moveBox").animate({scrollLeft: sp}, settings.moveSpeedTime);
						}
					}
					setTiltFontShow(KinSlideshow_changeFlag);
					break;
				case "up":
					if(KinSlideshow_changeFlag >= KinSlideshow_imgaeLength){
						KinSlideshow_changeFlag = 0;
						$("#KinSlideshow_moveBox").scrollTop(0);
						$("#KinSlideshow_moveBox").animate({scrollTop:KinSlideshow_Size[1]}, settings.moveSpeedTime);
					}else{
						sp =(KinSlideshow_changeFlag+1)*KinSlideshow_Size[1];
						if ($("#KinSlideshow_moveBox").is(':animated')){ 
							$("#KinSlideshow_moveBox").stop();
							$("#KinSlideshow_moveBox").animate({scrollTop: sp}, settings.moveSpeedTime);
						}else{
							$("#KinSlideshow_moveBox").animate({scrollTop: sp}, settings.moveSpeedTime);
						}
					}
					setTiltFontShow(KinSlideshow_changeFlag+1);
					break;
				case "down":
					var KinSlideshow_offsetLeft = (KinSlideshow_imgaeLength-1)*KinSlideshow_Size[1];
					if(KinSlideshow_changeFlag >= KinSlideshow_imgaeLength){
						KinSlideshow_changeFlag = 0;
						$("#KinSlideshow_moveBox").scrollTop(KinSlideshow_offsetLeft+KinSlideshow_Size[1]);
						$("#KinSlideshow_moveBox").animate({scrollTop:KinSlideshow_offsetLeft}, settings.moveSpeedTime);
					}else{
						if(KinSlideshow_firstMoveFlag){
							KinSlideshow_changeFlag++;
							KinSlideshow_firstMoveFlag = false;
						}
						sp =KinSlideshow_offsetLeft-(KinSlideshow_changeFlag*KinSlideshow_Size[1]);
						if ($("#KinSlideshow_moveBox").is(':animated')){ 
							$("#KinSlideshow_moveBox").stop();
							$("#KinSlideshow_moveBox").animate({scrollTop: sp}, settings.moveSpeedTime);
						}else{
							$("#KinSlideshow_moveBox").animate({scrollTop: sp}, settings.moveSpeedTime);
						}
					}
					setTiltFontShow(KinSlideshow_changeFlag);
					break;
			}
			
			KinSlideshow_changeFlag++;
	}	 
	 
	 function setTiltFontShow(index){
		 if(index == KinSlideshow_imgaeLength){index = 0};
		 if(settings.isHasTitleFont){
			$(KinSlideshow_BoxObjectSelector+" .KinSlideshow_titleBar h2").html(KinSlideshow_DateArray[index]);
		 };
		$("#btnlistID li").each(function(i){
			if(i == index){
				$(this).css({background:settings.btn.btn_bgHoverColor,borderColor:settings.btn.btn_borderHoverColor,color:settings.btn.btn_fontHoverColor});						
			}else{
				$(this).css({background:settings.btn.btn_bgColor,borderColor:settings.btn.btn_borderColor,color:settings.btn.btn_fontColor});						
			}
		 })		 
	 };
	
	function KinSlideshow_btnEvent(Event){
		switch(Event){
			case "mouseover" : KinSlideshow_btnMouseover(); break;
			case "mouseclick" : KinSlideshow_btnMouseclick(); break;			
			default : KinSlideshow_btnMouseclick();//���ֵ����Ĭ��ʹ��mouseclick�л�
		}
	};
	
	function KinSlideshow_btnMouseover(){
		$("#btnlistID li").mouseover(function(){
			var curLiIndex = $("#btnlistID li").index($(this)); 
	  		switch(settings.moveStyle){
				case  "left" :
					KinSlideshow_changeFlag = curLiIndex-1; break;
				case  "right" :
					if(KinSlideshow_firstMoveFlag){
						KinSlideshow_changeFlag = curLiIndex-1; break;
					}else{
						KinSlideshow_changeFlag = curLiIndex; break;
					}
				case  "up" :
					KinSlideshow_changeFlag = curLiIndex-1; break;
				case  "down" :
					if(KinSlideshow_firstMoveFlag){
						KinSlideshow_changeFlag = curLiIndex-1; break;
					}else{
						KinSlideshow_changeFlag = curLiIndex; break;
					}
			}
			KinSlideshow_move(settings.moveStyle);
			$("#btnlistID li").each(function(i){
				if(i ==curLiIndex){
					$(this).css({background:settings.btn.btn_bgHoverColor,borderColor:settings.btn.btn_borderHoverColor,color:settings.btn.btn_fontHoverColor});						
				}else{
					$(this).css({background:settings.btn.btn_bgColor,borderColor:settings.btn.btn_borderColor,color:settings.btn.btn_fontColor});						
				}
			})
		})
			
	};
	function KinSlideshow_btnMouseclick(){
		$("#btnlistID li").click(function(){
			var curLiIndex = $("#btnlistID li").index($(this)); 
			switch(settings.moveStyle){
				case  "left" :
					KinSlideshow_changeFlag = curLiIndex-1; break;
				case  "right" :
					if(KinSlideshow_firstMoveFlag){
						KinSlideshow_changeFlag = curLiIndex-1; break;
					}else{
						KinSlideshow_changeFlag = curLiIndex; break;
					}
				case  "up" :
					KinSlideshow_changeFlag = curLiIndex-1; break;
				case  "down" :
					if(KinSlideshow_firstMoveFlag){
						KinSlideshow_changeFlag = curLiIndex-1; break;
					}else{
						KinSlideshow_changeFlag = curLiIndex; break;
					}					
				
			}
			KinSlideshow_move(settings.moveStyle);
			$("#btnlistID li").each(function(i){
				if(i ==curLiIndex){
					$(this).css({background:settings.btn.btn_bgHoverColor,borderColor:settings.btn.btn_borderHoverColor,color:settings.btn.btn_fontHoverColor});						
				}else{
					$(this).css({background:settings.btn.btn_bgColor,borderColor:settings.btn.btn_borderColor,color:settings.btn.btn_fontColor});						
				}
			})
		})
			
	};	
	function KinSlideshow_mousehover(){
			$("#btnlistID li").mouseover(function(){
				clearInterval(KinSlideshow_setInterval); 
			})
			$("#btnlistID li").mouseout(function(){
				KinSlideshow_setInterval = setInterval(function(){KinSlideshow_move(settings.moveStyle)},KinSlideshow_IntervalTime*1000+settings.moveSpeedTime);
			})
	};
	
	return KinSlideshow_initialize();
};
 })(jQuery);