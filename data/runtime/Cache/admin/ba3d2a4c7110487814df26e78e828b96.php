<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link href="__STATIC__/css/admin/style.css" rel="stylesheet"/>
	<title><?php echo L('website_manage');?></title>
	<script>
	var URL = '__URL__';
	var SELF = '__SELF__';
	var ROOT_PATH = '__ROOT__';
	var APP	 =	 '__APP__';
	//语言项目
	var lang = new Object();
	<?php $_result=L('js_lang');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>lang.<?php echo ($key); ?> = "<?php echo ($val); ?>";<?php endforeach; endif; else: echo "" ;endif; ?>
	</script>
</head>

<body>
<div id="J_ajax_loading" class="ajax_loading"><?php echo L('ajax_loading');?></div>
<?php if(($sub_menu != '') OR ($big_menu != '')): ?><div class="subnav">
    <div class="content_menu ib_a blue line_x">
    	<?php if(!empty($big_menu)): ?><a class="add fb J_showdialog" href="javascript:void(0);" data-uri="<?php echo ($big_menu["iframe"]); ?>" data-title="<?php echo ($big_menu["title"]); ?>" data-id="<?php echo ($big_menu["id"]); ?>" data-width="<?php echo ($big_menu["width"]); ?>" data-height="<?php echo ($big_menu["height"]); ?>"><em><?php echo ($big_menu["title"]); ?></em></a>　<?php endif; ?>
        <?php if(!empty($sub_menu)): if(is_array($sub_menu)): $key = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($key % 2 );++$key; if($key != 1): ?><span>|</span><?php endif; ?>
        <a href="<?php echo U($val['module_name'].'/'.$val['action_name'],array('menuid'=>$menuid)); echo ($val["data"]); ?>" class="<?php echo ($val["class"]); ?>"><em><?php echo ($val['name']); ?></em></a><?php endforeach; endif; else: echo "" ;endif; endif; ?>
    </div>
</div><?php endif; ?>
<script src="__STATIC__/js/jquery/jquery.js"></script>
<script src="__STATIC__/js/ftxia.js"></script>
<script src="__STATIC__/js/admin.js"></script>
<link rel="stylesheet" type="text/css" href="__STATIC__/css/admin/index.css" />
<!--  -->


<div class="bk30"></div>
<div class="div-user lr10">
	<h1>Hello, <font color="#4c95b6"><?php echo ($my_admin["username"]); ?></font></h1><h1>
    <span>所属角色: 超级管理员</span>
    <span>上次登录时间: <?php echo ($time); ?></span>
    <span>上次登录IP: <?php echo ($ip); ?></span>
</h1></div>
<div class="div-button">
<div class="bk15"></div>
	<ul>
    	<li><a href="#"><img src="__STATIC__/css/admin/bgimg/btn_60_60_t.png"><span>添加文章</span></a></li>
        <li><a href="#"><img src="__STATIC__/css/admin/bgimg/btn_60_60_g.png"><span>添加商品</span></a></li>
        <li><a href="#"><img src="__STATIC__/css/admin/bgimg/btn_60_60_m.png"><span>会员管理</span></a></li>
        <li><a href="#"><img src="__STATIC__/css/admin/bgimg/btn_60_60_s.png"><span>系统设置</span></a></li>
        <li><a href="#"><img src="__STATIC__/css/admin/bgimg/btn_60_60_i.png"><span>网站首页</span></a></li>
    </ul>
</div>

<div class="bk10"></div>
<div class="lr10 CMS_message" id="roll">
	<li>已购买授权用户，遇到任何技术问题，可到官网(<a target="_black" href="#">wokaoCMS</a>)&gt;会员中心提交工单，我们会优先处理！</li>
	<li>如果您还在使用 IE6 的版本就out了,此后台不支持这么古董的浏览器，操作后台请升级浏览器内核至IE8或使用火狐,谷歌,opera,浏览器！</li>
	<li>已购买授权用户，请加群交流运营经验：123456789【加群须备注授权域名】</li>
</div>
<div class="bk10"></div>
<script type="text/javascript">
(function(A){
   function _ROLL(obj){
      this.ele = document.getElementById(obj);
	  this.interval = false;
	  this.currentNode = 0;
	  this.passNode = 0;
	  this.speed = 100;
	  this.childs = _childs(this.ele);
	  this.childHeight = parseInt(_style(this.childs[0])['height']);
	      addEvent(this.ele,'mouseover',function(){
				                               window._loveYR.pause();
											});
		  addEvent(this.ele,'mouseout',function(){
				                               window._loveYR.start(_loveYR.speed);
											});
   }
   function _style(obj){
     return obj.currentStyle || document.defaultView.getComputedStyle(obj,null);
   }
   function _childs(obj){
	  var childs = [];
	  for(var i=0;i<obj.childNodes.length;i++){
		 var _this = obj.childNodes[i];
		 if(_this.nodeType===1){
			childs.push(_this);
		 }
	  }   
	  return childs;
   }
	function addEvent(elem,evt,func){
	   if(-[1,]){
		   elem.addEventListener(evt,func,false);   
	   }else{
		   elem.attachEvent('on'+evt,func);
	   };
	}
	function innerest(elem){
      var c = elem;
	  while(c.childNodes.item(0).nodeType==1){
	      c = c.childNodes.item(0);
	  }
	  return c;
	}
   _ROLL.prototype = {
      start:function(s,v){
	          var _this = this;
			  
			  _this.hh=v;
			  _this.speed = s || 100;//速度
		      _this.interval = setInterval(function(){
									
						    _this.ele.scrollTop += 1;							
							if(_this.ele.scrollTop==_this.hh){								
								//clearInterval(_this.interval);
							}
							
							_this.passNode++;
							if(_this.passNode%_this.childHeight==0){
								  var o = _this.childs[_this.currentNode] || _this.childs[0];
								  _this.currentNode<(_this.childs.length-1)?_this.currentNode++:_this.currentNode=0;
								  _this.passNode = 0;
								  _this.ele.scrollTop = 0;
								  _this.ele.appendChild(o);
							}
						  },_this.speed);
	  },
	
	  pause:function(){
		 var _this = this;
	     clearInterval(_this.interval);
	  }
   }
    A.marqueen = function(obj){A._loveYR = new _ROLL(obj); return A._loveYR;}
})(window);

marqueen('roll').start(50,30);
</script>

<div style="overflow:hidden">
<!------------>
    <div class="div-system width30">
        <div class="title">系统信息</div>
        	<div class="bk10"></div>
            <ul>        
                <li><i>操作系统: </i><?php echo ($system_info["server_os"]); ?></li>
                <li><i>服务器版本: </i><?php echo ($system_info["web_server"]); ?></li>
                <li><i>PHP版本: </i><?php echo ($system_info["php_version"]); ?></li>
                <li><i>MYSQL版本: </i><?php echo ($system_info["mysql_version"]); ?></li>
                <li><i>时区: </i><?php echo ($system_info["timezone"]); ?></li>
                <li><i>远程读取: </i><font color="#1194be"><?php echo ($system_info["curl"]); ?></font></li>
                <li><i>页面压缩: </i><font color="#1194be"><?php echo ($system_info["zlib"]); ?></font></li>
                <li><i>POST限制: </i><?php echo ($system_info["upload_max_filesize"]); ?></li>
                <li><i>脚本超时时间: </i><?php echo ($system_info["max_execution_time"]); ?></li>
      
            </ul>      
    </div>
	    <div class="div-webinfo width30">
        <div class="title">网站信息统计</div>
        <div class="bk10"></div>
        <ul>
           <li><i>栏目:</i>6</li>
           <li><i>品牌:</i>11</li>
           <li><i>文章:</i>11</li>
           <li><i>商品数量:</i>12</li>
           <li><i>限时揭晓:</i>0</li>
           <li style="border-bottom:none;"><i>会员人数:</i>2</li>
           <li class="bk30"></li>
           <li><i>今日新增会员:</i>0</li>
           <li><i>今日新增商品:</i>0</li>
           <li style="border-bottom:none;"><i>今日账户收入:</i>0</li>
        </ul>
    </div>
    
    <div class="div-about width30">
        <div class="title">授权信息</div>
        <div class="bk10"></div>
        <ul>
        	<li><i>程序版本:</i><span style="color: #260BEE;font-weight: bold;" id="new_version"><?php echo ($system_info["version"]); ?></span><span class="STYLE3">【企业版】</span></li>
			<li><i>更新时间:</i><?php echo ($system_info["release"]); ?></li>
            <li><i>程序开发:</i>重庆韬龙网络科技有限公司</li>
            <li><i>版权所有:</i>重庆韬龙网络科技有限公司</li>    
            <li><i>官方微博:</i><a href="http://weibo.com/xxx" target="_black" style="color:#0f0">关注官方微博</a></li>        
        </ul>
            <p style="color:#666; padding:20px;font: 12px/1.5 tahoma,arial,宋体b8b\4f53,sans-serif;">
            	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;云购源码是一款专为云购系统设计的CMS系统,
                具有圈子,限时揭晓,晒单等云购功能。
            </p> 
    </div>
<!------------>
</div>
 

<!--  -->

<script>
var updateurl = "<?php echo U('upgrade/version');?>";
</script>
</body>
</html>