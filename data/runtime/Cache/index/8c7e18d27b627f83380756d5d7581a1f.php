<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title><?php echo ($page_seo["title"]); ?>  <?php echo C('ftx_site_name');?> - Powered by bbs.52jscn.com</title>
<meta name="keywords" content="<?php echo ($page_seo["keywords"]); ?>" />
<meta name="description" content="<?php echo ($page_seo["description"]); ?>" />
<meta name="generator" content="52jscn" />
<meta name="renderer" content="webkit">
<meta name="author" content="Ftxia Team  bbs.52jscn.com" />
<meta name="copyright" content="2010-2014 52jscn Inc." />
<meta name="MSSmartTagsPreventParsing" content="True" />
<meta http-equiv="MSThemeCompatible" content="Yes" />
<script type="text/javascript">
	SITEURL="<?php echo C('ftx_site_url');?>";
	CURURL="<?php echo C('ftx_site_url');?>";
	WEBNICK="<?php echo C('ftx_site_name');?>";
	URL_COOKIE=0;
</script>
<link rel=stylesheet type=text/css href="__STATIC__/jky/css/base.css" />
<link rel=stylesheet type=text/css href="__STATIC__/jky/css/global.css" />
<link rel=stylesheet type=text/css href="__STATIC__/jky/css/alert.css" />
<link rel=stylesheet type=text/css href="__STATIC__/jky/css/page.css" />
<link rel=stylesheet type=text/css href="__STATIC__/jky/css/kefu.css" />
<script src="http://siteapp.baidu.com/static/webappservice/uaredirect.js" type="text/javascript"></script><script type="text/javascript">uaredirect("<?php echo C('ftx_header_html');?>");</script>
<script type="text/javascript" src="__STATIC__/jky/js/jquery.js"></script>
<script type="text/javascript" src="__STATIC__/jky/js/jquery.cookie.js"></script>
<script type="text/javascript" src="__STATIC__/jky/js/lazyload.js"></script>
<script type="text/javascript" src="__STATIC__/jky/js/fun.js"></script>
<script type="text/javascript" src="__STATIC__/jky/js/jumpbox.js"></script>
<script type="text/javascript" src="__STATIC__/jky/js/funs.js"></script>
<link rel="stylesheet" type="text/css" href="__STATIC__/jky/css/view.css" />
</head>
<body>
<!-- 头部开始 -->
<div class="head">
	<div class="logo <?php echo C('ftx_site_width');?>">
		<?php if(C('ftx_site_logo') != ''): ?><h1><a title="<?php echo C('ftx_site_name');?>" href="<?php echo C('ftx_site_url');?>"><img src="<?php echo C('ftx_site_logo');?>" width="240" height="45" /></a></h1>
		<?php else: ?>
			<h1><a title="<?php echo C('ftx_site_name');?>" href="<?php echo C('ftx_site_url');?>"><img src="/static/jky/images/logo3.png" width="240" height="45" /></a></h1><?php endif; ?>
		<div class="search_box">
			<form method="get" action="index.php" onsubmit="return search_submit();" >
				<input type="hidden" name="m" value="index" />
				<input type="hidden" name="a" value="so" />
				<input x-webkit-speech name="k" id="keywords" placeholder="请输入您要找的宝贝！" value="" class="text" />
				<button type="submit" value="" class="btn2">搜折扣</button>
			</form>
		</div>
		<div class="top-nav <?php echo C('ftx_site_width');?>">
			<p class="top-txt fl">
			<a href="javascript:void(0)" onclick="AddFavorite(true)">加入收藏夹</a>
			<a onclick="SetHome(window.location)" href="javascript:void(0)">设为首页</a>
			<a href="<?php echo C('ftx_kefu_html');?>">在线客服</a>
			<a href="<?php echo U('user/union');?>">邀请好友</a>
			</p>
			<div id="userlogin" style="display:block">
				<p class="other-links fr">
					<span><a href="<?php echo U('user/login');?>" class="whi">登录</a> / <a href="<?php echo U('user/register');?>" class="whi">免费注册</a></span>
					<span>|</span>
					<span><a href="<?php echo U('baoming/index');?>">卖家报名</a></span>
				</p>
				<ul class="login-union fr">

				<?php if(is_array($oauth_list)): $i = 0; $__LIST__ = $oauth_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('oauth/index', array('mod'=>$val['code']));?>"><i class="icon-<?php echo ($val["code"]); ?>"></i><span><?php echo ($val["name"]); ?></span></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
					 
				</ul>
			</div>
			<script>
			function topHtml() {/*<p class="other-links fr">
				<span class="{:U('bm/index')}">|</span>
				<span><a href="<?php echo U('baoming/index');?>">卖家报名</a></span></p>
				<p class="info fr ffv"><a href="<?php echo U('user/msg');?>">{$msgsrc}</a></p>
				
				<p class="info fr ffv"><a href="<?php echo U('user/mingxi');?>">积分：{$jifen}</a></p> 
				<div class="login-ed fr">
					<div class="normal">
						<a href="<?php echo U('user/index');?>" class="nor-a" onmouseover="this.className='nor-a active'" onmouseout="this.className='nor-a'"><span class="ffv">{$name}</span><em class="cur"></em></a>
						<div class="login-box">
						<ul>
							<li><a href="<?php echo U('user/gift');?>"><i class="icon-04"></i><span>我的订单</span></a></li>
							<li><a href="<?php echo U('user/mingxi');?>"><i class="icon-05"></i><span>账户明细</span></a></li>
							<li><a href="<?php echo U('user/index');?>"><i class="icon-06"></i><span>账号设置</span></a></li>
							<li><a href="<?php echo U('user/logout');?>" class="exit" ><i class="icon-07"></i><span>退出</span></a></li>
						</ul>
						</div>
					</div>
				</div>
				<p class="fr">Hi~欢迎回来</p>*/;}
				$.ajax({
					url: '<?php echo U('ajax/userinfo');?>',
					dataType:'jsonp',
					jsonp:"callback",
					success: function(data){
						if(data.s==1){
							topHtml=getTplObj(topHtml,data.user);
							$('#userlogin').html(topHtml).show();
						}
						else{
							$('#userlogin').show();
						}
					}
				});
			</script>
		</div>
	</div>
	<div class="nav <?php echo C('ftx_site_width');?>">
		<ul class="navigation">
			<li <?php if($nav_curr == 'index'): ?>class="current"<?php endif; ?>><a href="<?php echo C('ftx_site_url');?>"><?php echo L('index_page');?></a></li>
			<?php $tag_nav_class = new navTag;$data = $tag_nav_class->lists(array('type'=>'lists','style'=>'main','cache'=>'0','return'=>'data',)); if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li class="split <?php if($nav_curr == $val['alias']): ?>current<?php endif; ?>"><a href="<?php echo ($val["link"]); ?>" <?php if($val["target"] == 1): ?>target="_blank"<?php endif; ?>><?php echo ($val["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
		<div class="state-show">
			<div class="sign fr"><a id="signIn_btn" href="javascript:;" class="signin_a sign_btn"><i></i><span>签到</span></a></div>
			 
		</div>
	</div>
</div>
<!--头部结束-->
<!--商品详细-->
<div class="main <?php echo C('ftx_site_width');?>">

	<div class="place-explain">
		您的位置：<a target="_blank" href="<?php echo C('ftx_site_url');?>"><?php echo C('ftx_site_name');?></a>
		<?php if(!empty($item["cate_id"])): ?>&nbsp;&gt;&nbsp;
			<?php if($cate_data[$item['cate_id']]['pid'] > 0): if($cate_data[$cate_data[$item['cate_id']]['pid']]['pid'] > 0): ?><a target="_blank" href="<?php echo U('index/cate',array('cid'=>$cate_data[$cate_data[$item['cate_id']]['pid']]['pid']));?>"><?php echo ($cate_data[$cate_data[$cate_data[$item['cate_id']]['pid']]['pid']]['name']); ?></a>&nbsp;&gt;&nbsp;<?php endif; ?>
				<a target="_blank" href="<?php echo U('index/cate',array('cid'=>$cate_data[$item['cate_id']]['pid']));?>"><?php echo ($cate_data[$cate_data[$item['cate_id']]['pid']]['name']); ?></a>&nbsp;&gt;&nbsp;<?php endif; ?>
			<a target="_blank" href="<?php echo U('index/cate',array('cid'=>$item['cate_id']));?>"><?php echo ($cate_data[$item['cate_id']]['name']); ?></a><?php endif; ?>		
		&nbsp;&gt;&nbsp; 
		<a class="bady-xx-seo" href="<?php echo U('item/index',array('id'=>$item['num_iid']));?>"><?php echo ($item["title"]); ?></a>
	</div>
	<div class="container fl">
		<div class="product clear">
			<div class="product-pic fl">
				<a href="<?php echo U('jump/index',array('iid'=>$item['num_iid']));?>" target="_blank" rel="nofollow"><img src="<?php echo attach(get_thumb($item['pic_url'], '_b'),'item');?>" alt="<?php echo ($item["title"]); ?>"    /></a>
				<span></span>
			</div>
			<div class="product-info fl">
				<h3><a href="<?php echo U('jump/index',array('iid'=>$item['num_iid']));?>" target="_blank" rel="nofollow"><?php echo ($item["title"]); ?></a></h3>
				<div class="share"><a class="buy_ed report" znid="<?php echo ($item["num_iid"]); ?>" title="<?php echo ($item["title"]); ?>" href="javascript:;"><i class="report-icon"></i>举报</a></div>
				<dl class="jp-size">
					<dt>宝贝属性：</dt>
					<dd>
						<ul>
						<?php if(is_array($tags)): $i = 0; $__LIST__ = $tags;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?><li><a class="active" href="<?php echo U('tag/'.$tag);?>" target="_blank"><span><?php echo ($tag); ?></span></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</dd>
					
				</dl>
				<p class="tips clear">
				<?php if($item["coupon_price"] == $item['price'] ): ?><span class="item-pr fl">已卖出：<em class="ffv"><?php echo ($item["volume"]); ?>件</em></span>
					<span class="fl">有 <em class="org_2 ffv"><?php echo ($item["likes"]); ?></em>人喜欢</span><?php else: ?><span class="item-pr fl">原价：<em class="old-price ffv"><?php echo ($item["price"]); ?>元</em></span>
					<span class="fl">折扣：<em class="org_2 ffv"><?php echo ($item["zk"]); ?>折</em></span><?php endif; ?>
				</p>
				<p class="price">
					<span class="title-tips01">折扣价格<em class="tip-b"></em></span>
					<em class="org">￥</em><span class="jd-current"><?php echo ($item["coupon_price"]); ?></span> 
					<?php if($item["ems"] == 1): ?>/包邮<?php endif; ?></span>
				</p>
				<div class="pg"></div>
				<div class="item-btn clear">
					<span class="btn-tip fl">
						<a class="btn fl <?php echo ($item["class"]); ?>" href="<?php echo U('jump/index',array('iid'=>$item['num_iid']));?>" target="_blank" rel="nofollow">
						<span>
						<?php if($item["class"] == 'wait'): ?>即将开始
						<?php elseif($item["class"] == 'sellout'): ?>
							已卖光
						<?php elseif($item["class"] == 'end'): ?>
							已结束
						<?php elseif($item["class"] == 'buy'): ?>
							<?php if($item["shop_type"] == 'C' ): ?>去淘宝抢购<?php endif; ?>
							<?php if($item["shop_type"] == 'B' ): ?>去天猫抢购<?php endif; endif; ?>
						</span></a>
					</span>
					<div id="tq_html" class="tq_html"></div>
				</div>
				<p class="price bady-time">
				  <?php if($item["class"] == 'tag_wait' ): ?><span class="fl">开抢时间：</span>
					<span class="time fl" id="end_date_0" data-time="<?php echo ($item["coupon_start_time"]); ?>"></span>
					<span class="common nomind shoot_time"><a href="http://qzs.qq.com/snsapp/app/bee/widget/open.htm#content=亲，您在 <?php echo C('ftx_site_name');?> 关注的【<?php echo ($item["title"]); ?>】马上就要开始抢购了哦。&time=<?php echo (date('20y-m-d H:i',$item["coupon_start_time"])); ?>&advance=5&url=<?php echo C('ftx_site_url');?>index.php?m=item&a=index&id=<?php echo ($item["num_iid"]); ?>" target="_blank">设置提醒</a></span>	
                   
                <?php else: ?>				  
                <?php if($item["class"] == 'end' ): ?><span class="fl">结束时间：</span>
					<span class="time fl"><?php echo (date("m月d日 H时i分",$item["coupon_start_time"])); ?></span>
					<span class="common nomind shoot_time"><a href="http://qzs.qq.com/snsapp/app/bee/widget/open.htm#content=亲，您在 <?php echo C('ftx_site_name');?> 关注的【<?php echo ($item["title"]); ?>】下期活动马上就要开始了哦。&time=<?php echo (date('20y-m-d H:i',$item["coupon_end_time"])); ?>&advance=5&url=<?php echo C('ftx_site_url');?>index.php?m=item&a=index&id=<?php echo ($item["num_iid"]); ?>" target="_blank">下期提醒</a></span>	                	
				<?php else: ?>
                <if condition="$item.class eq 'buy' ">
					<span class="fl">离结束还剩：</span>
					<span class="time fl" id="end_date_0" data-time="<?php echo ($item["coupon_end_time"]); ?>"></span>
					<span class="common nomind shoot_time"><a href="http://qzs.qq.com/snsapp/app/bee/widget/open.htm#content=亲，您在 <?php echo C('ftx_site_name');?> 关注的【<?php echo ($item["title"]); ?>】优惠活动马上就要结束了哦。&time=<?php echo (date('20y-m-d H:i',$item["coupon_end_time"])); ?>&advance=5&url=<?php echo C('ftx_site_url');?>index.php?m=item&a=index&id=<?php echo ($item["num_iid"]); ?>" target="_blank">结束提醒</a></span><?php endif; endif; ?>				
				</p>
				<p class="fenxiang">
					<span class="fl">分享商品：</span>
					<div id="bdshare" class="fl bdshare_t bds_tools get-codes-bdshare fl">
						<a class="bds_sqq" rel="nofollow"></a>
						<a class="bds_qzone" rel="nofollow"></a>
						<a class="bds_tsina" rel="nofollow"></a>
						<a class="bds_tqq" rel="nofollow"></a>
						<a class="bds_renren" rel="nofollow"></a>
						<a class="bds_taobao tjh" rel="nofollow"></a>
						<span class="bds_more"></span>
					</div>
				</p>
			</div>
		</div>
		
		<div class="product-comment">
			<div class="bady-tab" id="bady-tab">
				<ul>
					<li class="tab1">
						<a class="badyactive" href="#desc">宝贝详情</a>
						<div class="bady-line-top"></div>
					</li>
					<li class="tab2">
						<a class="" href="#comm">评论一下</a>
						<div class=""></div>
					</li>
					<li class="tab3">
						<a href="#user_comment" class="">同类推荐<em></em></a>
						<div class=""></div>
					</li>
					<li class="tab4">
						<a href="#xihuan" class="">猜你喜欢<em></em></a>
						<div class=""></div>
					</li>
				</ul>
				<div class="gobuy fr" style="display: none; ">
					<span class="title-tips01">折扣价格<em class="tip-b"></em></span>
					<p class="price fl">
						<em class="org">￥</em> 
						<span class="jd-current"><?php echo ($item["coupon_price"]); ?></span> <?php if($item["ems"] == 1): ?>/包邮<?php endif; ?>
					</p>
					<a target="_blank" id="dealGone" class="btn fl buy" href="<?php echo U('jump/index',array('iid'=>$item['num_iid']));?>" rel="nofollow"><span>
						<?php if($item["shop_type"] == 'C' ): ?>去淘宝抢购<?php endif; ?>
						<?php if($item["shop_type"] == 'B' ): ?>去天猫抢购<?php endif; ?>
					</span></a>
				</div>
			</div>
			<div class="information" style="display: block;" >
				<h3><a name="desc" >商品描述</a></h3>
				<p><p><?php echo ($item["intro"]); ?></p></p>
			</div>
			<div class="bady-tab bady-tab01" >
				<ul>
					<li style="border-right: none">
						<a  name="comm" class="" href="#tab3">发表评论<em></em></a>
						<div class=""></div>
					</li>
				</ul>
			</div>
		<div  style="display: block;"  class="information comment" >
		<div class="ds-thread" data-thread-key="<?php echo ($item["id"]); ?>" data-title="<?php echo ($item["title"]); ?>" data-url="<?php echo C('ftx_site_url');?>index.php?m=item&a=index&id=<?php echo ($item["num_iid"]); ?>"></div>  
		</div> 
		<div class="bady-tab bady-tab02"  >
		  <ul>
		      <li style="border-right: none;">
			  <a name="user_comment" class="" href="#tab3">同类推荐<em></em></a>
			  <div class=""></div>
		      </li>
		  </ul>
		</div>
		<div style="display: block;" class="information comment" >	
<a data-type="10" biz-itemid="<?php echo ($item["num_iid"]); ?>" data-tmpl="720x220" data-tmplid="143" data-rd="2" data-style="2" data-border="1" href="#"></a>
<a data-type="12" biz-sellerid="<?php echo ($item["sellerId"]); ?>" data-tmpl="720x200" data-tmplid="145" data-rd="2" data-style="2" data-border="1" href="#"></a>		
		</div>
		<a name="xihuan" ></a>
	</div>
 
	</div> 
	<div class="clear"></div>
</div>
		
<link rel=stylesheet type=text/css href="__STATIC__/jky/css/good.css" />
<!--List Start-->
<div class="main <?php echo C('ftx_site_width');?> clear">
			<ul class="goods-list <?php echo C('ftx_site_wc');?>">
		<?php if(is_array($items_list)): $i = 0; $__LIST__ = $items_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 4 );++$i;?><li  class="<?php if(($mod) == "3"): ?>last<?php endif; ?>">
			<div class="sid_<?php echo ($item["sellerId"]); ?>  list-good   <?php echo ($item["class"]); ?> " id="nid_<?php echo ($item["num_iid"]); ?>">
				<div class="good-pic">
					<a href="<?php echo U('item/index',array('id'=>$item['num_iid']));?>" target="_blank"><img src="/static/jky/images/blank.gif" data-original="<?php echo attach(get_thumb($item['pic_url'], '_b'),'item');?>" alt="<?php echo ($item["title"]); ?>" class="lazy"   /></a>
					<div class="yhq"> </div>
					<div class="zhekou"><?php if($item["zk"] == '10'): echo ($item["likes"]); ?>人喜欢<?php else: echo ($item["zk"]); ?>折<?php endif; ?></div>
				</div>
				<h5 class="good-title">
					<?php if($item["shop_type"] == 'C' ): ?><b class="icon tao-n" title="淘宝网"></b><?php endif; ?>
					<?php if($item["shop_type"] == 'B' ): ?><b class="icon tao-t" title="天猫商城"></b><?php endif; ?>

					<a target="_blank" href="<?php echo U('item/index',array('id'=>$item['num_iid']));?>" class="title"><?php echo ($item["title"]); ?></a>
				</h5>
				<div class="good-price">
					<span class="price-current"><em>￥</em><?php echo ($item["coupon_price"]); ?></span>
					<span class="des-other">
						<?php if($item["coupon_price"] == $item['price'] ): ?><span class="price-old">已卖出<?php echo ($item["volume"]); ?>件 </span><?php else: ?><span class="price-old"><em>¥<?php echo ($item["price"]); ?></em> </span><?php endif; ?>
						<span class="discount show">
							<?php if($item["ems"] == 1): ?><b class="i2" title="包邮"></b><?php endif; ?>
							<?php if(!empty($visitor)): if($visitor['username'] == C('ftx_index_admin')): ?><a title="不显示" href="javascript:void(0);" data-id="<?php echo ($item["num_iid"]); ?>">取消</a><?php endif; endif; ?>
						</span>
					</span>
					<div class="btn-new <?php echo ($item["class"]); ?>">
						<a href="<?php echo U('jump/index',array('id'=>$item['num_iid']));?>" target="_blank" rel="nofollow"><span>
						<?php if($item["class"] == 'wait'): ?>即将开始<?php endif; ?>
						<?php if($item["class"] == 'sellout'): ?>已卖光<?php endif; ?>
						<?php if($item["class"] == 'end'): ?>已结束<?php endif; ?>
						<?php if($item["class"] == 'buy'): ?>去抢购<?php endif; ?></span></a>
					</div>
				</div>
				<div class="pic-des">
					<div class="des-state">
						<span class="state-time fl">开始：<?php echo (date("m月d日 H时i分",$item["coupon_start_time"])); ?></span>
						<a class="des-report report buy_ed fr" znid="<?php echo ($item["id"]); ?>" title="<?php echo ($item["title"]); ?>" href="javascript:;">举报</a>
					</div>
				</div>
				<?php echo (newicon($item["coupon_start_time"])); ?>
			</div>
		</li><?php endforeach; endif; else: echo "" ;endif; ?>
	</ul>

	<div class="clear"></div> 

	<div class="page">
		<div class="pageNav"><?php echo ($page); ?></div>
	</div>
</div>
<!--List End-->
<script type="text/javascript"> var duoshuoQuery = {short_name:"52jscn2"}; (function() { var ds = document.createElement('script'); ds.type = 'text/javascript';ds.async = true; ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js'; ds.charset = 'UTF-8'; (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ds); })(); </script>
<script type="text/javascript">
function show_date_time(end,style,id){
    today=new Date(); 
	timeold=((end)*1000-today.getTime()); 
	if (timeold < 0) {
        return;
    }
    setTimeout("show_date_time("+end+','+style+','+id+")", 100); 
    sectimeold=timeold/1000;
	secondsold=Math.floor(sectimeold); 
	msPerDay=24*60*60*1000;
	e_daysold=timeold/msPerDay;
	daysold=Math.floor(e_daysold); 
	e_hrsold=(e_daysold-daysold)*24;
	hrsold=Math.floor(e_hrsold); 
	e_minsold=(e_hrsold-hrsold)*60;
	minsold=Math.floor((e_hrsold-hrsold)*60); 
	e_seconds = (e_minsold-minsold)*60;
	seconds=Math.floor((e_minsold-minsold)*60); 
	ms = e_seconds-seconds;
	ms = new String(ms);
	ms1 = ms.substr(2,1);
	ms2 = ms.substr(2,2);
	hrsold1=daysold*24+hrsold;
	if(style == 1){
		$("#end_date_"+id).html((hrsold1<10?'0'+hrsold1:hrsold1)+"小时"+(minsold<10?'0'+minsold:minsold)+"分"+(seconds<10?'0'+seconds:seconds)+"秒");
	}else if(style == 2){
		$("#end_date_"+id).html(daysold+"天"+(hrsold<10?'0'+hrsold:hrsold)+"时"+(minsold<10?'0'+minsold:minsold)+"分"+(seconds<10?'0'+seconds:seconds)+"秒");
	}else if(style == 3){
		$("#end_date_"+id).html((hrsold1<10?'0'+hrsold1:hrsold1)+"小时"+(minsold<10?'0'+minsold:minsold)+"分"+(seconds<10?'0'+seconds:seconds)+"."+ms1+"秒");
	}else{
		$("#end_date_"+id).html(daysold+"天"+(hrsold<10?'0'+hrsold:hrsold)+"小时"+(minsold<10?'0'+minsold:minsold)+"分"+(seconds<10?'0'+seconds:seconds)+"秒."+ms2);
	}
}
$(".time").each(function() {
        var reg = /^[0-9]+$/;
        var time = $(this).attr('data-time');
        if (reg.test(time)) {
            show_date_time(time, 2, 0);
        }
	});
</script>
 
<script type="text/javascript" src="__STATIC__/jky/js/deal.js"></script>
<script type="text/javascript" id="bdshare_js" data="type=button" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
    $(".bady-tab:eq(0) li:eq(0)").find("a").addClass("badyactive");
    $(".bady-tab:eq(0) li:eq(0)").find("div").addClass("bady-line-top");
    //评论处js切换效果
    $(".bady-tab:eq(0) li").click(function(){
        $(document).scrollTop($('.bady-part').offset().top-50);
        $(".bady-tab").not( $(".bady-tab:eq(0)")).hide();
        $(this).parents("ul").find("a").removeClass("badyactive");
        $(this).parents("ul").find("div").removeClass("bady-line-top");
        $(this).find("a").addClass("badyactive");
        $(this).find("div").addClass("bady-line-top");
        if($(this).index() == 0){
            $(".bady-tab,.information").show();
            if($(".bady-tab").size() - $(".information").size() == 1){
                $(".bady-tab01").hide();
            }else if($(".bady-tab").size() - $(".information").size() == 2){
                $(".bady-tab01").hide();
                $(".bady-tab02").hide();
            }
        }else{
            $(".information").hide();
            $(".information:eq("+$(this).index()+")").show();
        }
    });

    $(".bady-tab:eq(0) li").each(function(index){
        if(typeof($(this).attr("name"))!="undefined"){
            $("#"+$(this).attr("name")).click();
            $("#"+$(this).attr("name")).parents("ul").find("a").removeClass("badyactive");
            $("#"+$(this).attr("name")).parents("ul").find("div").removeClass("bady-line-top");
            $("#"+$(this).attr("name")).find("a").addClass("badyactive");
            $("#"+$(this).attr("name")).find("div").addClass("bady-line-top");
        }
    });

    var F_jkyCeleMenuAni = function(){
        var jiuMenuObj = $('#bady-tab');
        var Tab01Obj= $('.tab1').find("a")
        var Tab02Obj= $('.tab1').find("div")
        var Tab03Obj= $('.tab2').find("a")
        var Tab04Obj= $('.tab2').find("div")
        var Tab05Obj= $('.tab3').find("a")
        var Tab06Obj= $('.tab3').find("div")
	var Tab07Obj= $('.tab4').find("a")
        var Tab08Obj= $('.tab4').find("div")
        var menuScrolFunc = function(){
            scrolY = $(window).scrollTop();
            if(scrolY < 580){
                jiuMenuObj.removeClass('fixed');
                $('div.gobuy').hide();
            }else{
                jiuMenuObj.addClass('fixed');
                $('div.gobuy').show();
            }
            if(scrolY >=$('.goods-list').offset().top && !($(".information:eq(0)").is(":hidden"))){
		Tab05Obj.removeClass("badyactive");
                Tab06Obj.removeClass("bady-line-top");
                Tab03Obj.removeClass("badyactive");
                Tab04Obj.removeClass("bady-line-top");
                Tab01Obj.removeClass("badyactive");
                Tab02Obj.removeClass("bady-line-top");
                Tab07Obj.addClass("badyactive");
                Tab08Obj.addClass("bady-line-top")
            }else if(scrolY >=$('.bady-tab02').offset().top && !($(".information:eq(0)").is(":hidden"))){
	        Tab07Obj.removeClass("badyactive");
                Tab08Obj.removeClass("bady-line-top");
                Tab03Obj.removeClass("badyactive");
                Tab04Obj.removeClass("bady-line-top");
                Tab01Obj.removeClass("badyactive");
                Tab02Obj.removeClass("bady-line-top");
                Tab05Obj.addClass("badyactive");
                Tab06Obj.addClass("bady-line-top")
            }else if(scrolY >= $('.bady-tab01').offset().top && !($(".information:eq(0)").is(":hidden"))){
	        Tab07Obj.removeClass("badyactive");
                Tab08Obj.removeClass("bady-line-top");
                Tab01Obj.removeClass("badyactive");
                Tab02Obj.removeClass("bady-line-top");
                Tab05Obj.removeClass("badyactive");
                Tab06Obj.removeClass("bady-line-top");
                Tab03Obj.addClass("badyactive");
                Tab04Obj.addClass("bady-line-top")
            }else if(!($(".information:eq(0)").is(":hidden"))){
	        Tab07Obj.removeClass("badyactive");
                Tab08Obj.removeClass("bady-line-top");
                Tab03Obj.removeClass("badyactive");
                Tab04Obj.removeClass("bady-line-top");
                Tab05Obj.removeClass("badyactive");
                Tab06Obj.removeClass("bady-line-top");
                Tab01Obj.addClass("badyactive");
                Tab02Obj.addClass("bady-line-top")
            }

        }
        var F_nmenu_scroll = function () {
            if (!window.XMLHttpRequest) {
                return;
            }else{
                //默认执行一次
                menuScrolFunc();
                $(window).bind("scroll", menuScrolFunc);
            }
        }
        F_nmenu_scroll();
    }
    F_jkyCeleMenuAni();

var bds_config = {
	'bdDesc' : '发现个灰常给力的商品！<?php echo ($item["title"]); ?>，赶紧来抢吧！',
	'bdText' : '发现个灰常给力的商品！<?php echo ($item["title"]); ?>，赶紧来抢吧！' ,
		'bdPic' : '<?php echo ($item["pic"]); ?>',
		'review' : 'off'
};
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + new Date().getHours();
</script>
<script type="text/javascript" src="__STATIC__/ftxia/js/report.js"></script>
<?php if(C('ftx_kefu_open') == '1'): ?><!-- S 客服 -->
<script type="text/javascript" src="__STATIC__/jky/js/jquery.fixed.js"></script>
<script>
$(function(){
	//悬浮客服
	$("#fixedBox").fix({
		position 	: "right",	//悬浮位置 - left或right
		horizontal  	: 0,		//水平方向的位置 - 默认为数字
		vertical    	: null,		//垂直方向的位置 - 默认为null
		halfTop     	: true,		//是否垂直居中位置
		minStatue 	: true,		//是否最小化
		hideCloseBtn 	: false,	//是否隐藏关闭按钮
		skin 		: "<?php echo C('ftx_kefu_color');?>",	//皮肤
		showBtnWidth 	: 28,		//show_btn_width
		contentBoxWidth : 154, 		//side_content_width
		durationTime 	: 100		//完成时间
	});
});
</script>
<div class="fixed_box" id="fixedBox">
	<div class="content_box">
		<div class="content_inner">
			<div class="close_btn"><a title="关闭"><span>关闭</span></a></div>
			<div class="content_title"><span>客服中心</span></div>
			<div class="content_list">            	
				<div class="qqserver">
					<?php if(C('ftx_kefu_one_value') != ''): ?><if condition="C('ftx_kefu_one_value') eq 'ss'"><?php endif; endif; ?>

					<?php if(C('ftx_kefu_one_value') != ''): ?><p>
						
						<?php if(C('ftx_kefu_one_value') == 'ss'): endif; ?>
						<?php if(C('ftx_kefu_one_su') == 'qq'): ?><span><?php echo C('ftx_kefu_one_name');?>:</span> 
							<a href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo C('ftx_kefu_one_value');?>&amp;site=qq&amp;menu=yes" rel="nofollow" target="_blank"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo C('ftx_kefu_one_value');?>:41" alt="点击这里给我发消息" title="点击这里给我发消息"></a>
						<?php elseif(C('ftx_kefu_one_su') == 'ww'): ?>
							<span><?php echo C('ftx_kefu_one_name');?>:</span> 
							<a href="http://amos.im.alisoft.com/msg.aw?v=2&uid=<?php echo C('ftx_kefu_one_value');?>&site=cntaobao&s=2&charset=utf-8" rel="nofollow" target="_blank"><img border="0" src="http://amos.im.alisoft.com/online.aw?v=2&uid=<?php echo C('ftx_kefu_one_value');?>&site=cntaobao&s=1&charset=utf-8" alt="点击这里给我发消息" title="点击这里给我发消息"></a><?php endif; ?>
					</p><?php endif; ?>

					<?php if(C('ftx_kefu_two_value') != ''): ?><p>
						<span><?php echo C('ftx_kefu_two_name');?>:</span> 
						<?php if(C('ftx_kefu_two_su') == 'qq'): ?><a href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo C('ftx_kefu_two_value');?>&amp;site=qq&amp;menu=yes" rel="nofollow" target="_blank"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo C('ftx_kefu_two_value');?>:41" alt="点击这里给我发消息" title="点击这里给我发消息"></a>
						<?php elseif(C('ftx_kefu_two_su') == 'ww'): ?>
							<a href="http://amos.im.alisoft.com/msg.aw?v=2&uid=<?php echo C('ftx_kefu_two_value');?>&site=cntaobao&s=2&charset=utf-8" rel="nofollow" target="_blank"><img border="0" src="http://amos.im.alisoft.com/online.aw?v=2&uid=<?php echo C('ftx_kefu_two_value');?>&site=cntaobao&s=1&charset=utf-8" alt="点击这里给我发消息" title="点击这里给我发消息"></a><?php endif; ?>
					</p><?php endif; ?>


					<?php if(C('ftx_kefu_three_value') != ''): ?><p>
						<span><?php echo C('ftx_kefu_three_name');?>:</span> 
						<?php if(C('ftx_kefu_three_su') == 'qq'): ?><a href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo C('ftx_kefu_three_value');?>&amp;site=qq&amp;menu=yes" rel="nofollow" target="_blank"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo C('ftx_kefu_three_value');?>:41" alt="点击这里给我发消息" title="点击这里给我发消息"></a>
						<?php elseif(C('ftx_kefu_three_su') == 'ww'): ?>
							<a href="http://amos.im.alisoft.com/msg.aw?v=2&uid=<?php echo C('ftx_kefu_three_value');?>&site=cntaobao&s=2&charset=utf-8" rel="nofollow" target="_blank"><img border="0" src="http://amos.im.alisoft.com/online.aw?v=2&uid=<?php echo C('ftx_kefu_three_value');?>&site=cntaobao&s=1&charset=utf-8" alt="点击这里给我发消息" title="点击这里给我发消息"></a><?php endif; ?>
					</p><?php endif; ?>




					<?php if(C('ftx_kefu_four_value') != ''): ?><p>
						<span><?php echo C('ftx_kefu_four_name');?>:</span> 
						<?php if(C('ftx_kefu_four_su') == 'qq'): ?><a href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo C('ftx_kefu_four_value');?>&amp;site=qq&amp;menu=yes" rel="nofollow" target="_blank"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo C('ftx_kefu_four_value');?>:41" alt="点击这里给我发消息" title="点击这里给我发消息"></a>
						<?php elseif(C('ftx_kefu_four_su') == 'ww'): ?>
							<a href="http://amos.im.alisoft.com/msg.aw?v=2&uid=<?php echo C('ftx_kefu_four_value');?>&site=cntaobao&s=2&charset=utf-8" rel="nofollow" target="_blank"><img border="0" src="http://amos.im.alisoft.com/online.aw?v=2&uid=<?php echo C('ftx_kefu_four_value');?>&site=cntaobao&s=1&charset=utf-8" alt="点击这里给我发消息" title="点击这里给我发消息"></a><?php endif; ?>
					</p><?php endif; ?>



					<?php if(C('ftx_kefu_five_value') != ''): ?><p>
						<span><?php echo C('ftx_kefu_five_name');?>:</span> 
						<?php if(C('ftx_kefu_five_su') == 'qq'): ?><a href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo C('ftx_kefu_five_value');?>&amp;site=qq&amp;menu=yes" rel="nofollow" target="_blank"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo C('ftx_kefu_five_value');?>:41" alt="点击这里给我发消息" title="点击这里给我发消息"></a>
						<?php elseif(C('ftx_kefu_five_su') == 'ww'): ?>
							<a href="http://amos.im.alisoft.com/msg.aw?v=2&uid=<?php echo C('ftx_kefu_five_value');?>&site=cntaobao&s=2&charset=utf-8" rel="nofollow" target="_blank"><img border="0" src="http://amos.im.alisoft.com/online.aw?v=2&uid=<?php echo C('ftx_kefu_five_value');?>&site=cntaobao&s=1&charset=utf-8" alt="点击这里给我发消息" title="点击这里给我发消息"></a><?php endif; ?>
					</p><?php endif; ?>
				</div>
				<hr>
				<div class="phoneserver">
					<h5>客户服务热线</h5>
					<p><?php echo C('ftx_kefu_telephone');?></p>
				</div>
				<hr>
				<div class="msgserver"><p><a href="<?php echo U('user/msg',array('do'=>'send'));?>" target="_blank">给我们留言</a></p></div>
			</div>
			<div class="content_bottom"></div>
		</div>
	</div>
	<div class="show_btn"><span>展开客服</span></div>
</div>
<!-- E 客服 -->
</if>
<?php if(!empty($visitor)): if($visitor['username'] == C('ftx_index_admin')): ?><script type="text/javascript">
	function noshow(id){
		if(!$.ftxia.dialog.islogin()) return ;
		$(this).html('<img src="/static/ftxia/images/loading.gif" />');
		$.ajax({
			url: FTXIAER.root + '/?m=item&a=noshow',
				type: 'POST',
				data: {
					id: id
				},
			dataType: 'json',
			success: function(result){
				if(result.status == 1){
					$.ftxia.tip({content:result.msg, icon:'success'});
				}else{
					$.ftxia.tip({content:result.msg, icon:'error'});
				}
			}
		});
	}

	$(".show a").click(function() {
		id = $(this).attr("data-id");
		if(!$.ftxia.dialog.islogin()) return ;
		$(this).html('<img src="/static/ftxia/images/loading.gif" />');
		$.ajax({
			url: FTXIAER.root + '/?m=item&a=noshow',
				type: 'POST',
				data: {
					id: id
				},
			dataType: 'json',
			success: function(result){
				if(result.status == 1){
					$(this).html('成功');
					$.ftxia.tip({content:result.msg, icon:'success'});
				}else{
					$(this).html('已取消');
					$.ftxia.tip({content:result.msg, icon:'error'});
				}
			}
		});
	});  
</script><?php endif; endif; ?>
<!-- 页脚 -->
<div class="foot">
	<div class="white_bg <?php echo C('ftx_site_width');?>">
		<div class="xd_info <?php echo C('ftx_site_width');?>">
			<div class="jky-info fl">
				<?php if(C('ftx_site_flogo') != ''): ?><h2><img src="<?php echo C('ftx_site_flogo');?>" height="38" /></h2>
				<?php else: ?>
					<h2><img src="/static/jky/images/foot_logo.jpg" height="38" /></h2><?php endif; ?>
				<div class="attentionlist">
					<a class="sina" href="<?php echo C('ftx_sina_url');?>" target="_blank" rel="nofollow">新浪微博</a>
					<a class="zone" href="<?php echo C('ftx_qzone_url');?>" target="_blank" rel="nofollow">QQ空间</a>
					<a class="tt" href="<?php echo C('ftx_tenxun_url');?>" target="_blank" rel="nofollow">腾讯微博</a>
				</div>
			</div>
			<div class="fl">
				<div class="abouts">
					<ul>
				<li class="tit">关于我们</li>
				<li><a href="<?php echo U('help/read',array('id'=>1));?>" target="_blank">关于我们</a></li>
				<li><a href="<?php echo U('help/read',array('id'=>3));?>" target="_blank">联系我们</a></li>
				<li><a href="<?php echo U('help/read',array('id'=>2));?>" target="_blank">广告合作</a></li>
					</ul>
				</div>
					<div class="help">
					<ul>
						<li class="tit">用户帮助</li>
						<li><a href="<?php echo U('help/read',array('id'=>6));?>" target="_blank">常见问题</a></li>
						<li><a href="<?php echo U('help/qianggou');?>" target="_blank">抢购小技巧</a></li>
						<li><a href="<?php echo U('article/index');?>" target="_blank">文章中心</a></li>
					</ul>
				</div>
				<div class="user">
					<ul>
						<li class="tit">会员服务</li>
						<li><a href="<?php echo U('user/register');?>" target="_blank">免费注册</a></li>
						<li><a href="<?php echo U('user/login');?>" target="_blank">登录本站</a></li>
						<li><a href="<?php echo U('forget/index');?>" target="_blank">找回密码</a></li>
					</ul>
				</div>
			</div>
			<div class="wechat">
				<div class="slide-img">
					<ul id="ft-box">
						<li>
							<?php if(C('ftx_site_weixin') != ''): ?><div class="fl"><img src="<?php echo C('ftx_site_weixin');?>" width="80" height="80" /></div>
							<?php else: ?>
							<div class="fl"><img src="__STATIC__/jky/images/foot_weixin.png" width="80" height="80" /></div><?php endif; ?>
							<p class="wx-img fr"></p>
						</li>
						<li>
							<?php if(C('ftx_site_browser') != ''): ?><div class="fl"><img src="<?php echo C('ftx_site_browser');?>" width="80" height="80" /></div>
							<?php else: ?>
							<div class="fl"><img src="__STATIC__/jky/images/foot_browser.png" width="80" height="80" /></div><?php endif; ?>
							<p class="br-img fr"></p>
						</li>
					</ul>
				</div>
				<div class="slide-btn" id="boxbtn">
    				<b class="left-cur" href=""></b><b class="right-cur" href=""></b>
				</div>
			</div>
			<!--  -->
			<div class="links <?php echo C('ftx_site_width');?>">
				<span>友情链接：</span>
				<div class="links_list_box">
					<div class="links_list">
					<?php $tag_link_class = new linkTag;$data = $tag_link_class->lists(array('type'=>'lists','cache'=>'0','return'=>'data',)); if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 11 );++$i;?><a href="<?php echo ($val["url"]); ?>" target="_blank"><?php echo ($val["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<p class="f_miibeian <?php echo C('ftx_site_width');?>"><a href="http://www.miibeian.gov.cn/" rel="nofollow" target="_blank"><?php echo C('ftx_site_icp');?></a> © 2010-2014 飞天侠 FtxiaV6.0 正式版 all Rights Reserved <a href="http://bbs.52jscn.com/" target="_blank">飞天侠淘宝客官方</a>
		<?php echo C('ftx_statistics_code');?></p>
		
	</div>
</div>
<!-- /页脚 -->
<script type="text/javascript" src="__STATIC__/ftxia/js/report.js"></script>
<script type="text/javascript">
var FTXIAER = {
    root: "__ROOT__",
	site: "<?php echo C('ftx_site_url');?>",
    uid: "<?php echo $visitor['id'];?>", 
    url: {}
};
var lang = {};
<?php $_result=L('js_lang');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>lang.<?php echo ($key); ?> = "<?php echo ($val); ?>";<?php endforeach; endif; else: echo "" ;endif; ?>
</script>
<?php $tag_load_class = new loadTag;$data = $tag_load_class->js(array('type'=>'js','href'=>'__STATIC__/js/jquery/plugins/jquery.tools.min.js,__STATIC__/js/jquery/plugins/jquery.masonry.js,__STATIC__/js/jquery/plugins/formvalidator.js,__STATIC__/js/fileuploader.js,__STATIC__/js/ftxia.js,__STATIC__/js/front.js,__STATIC__/js/dialog.js,__STATIC__/js/item.js,__STATIC__/js/user.js,__STATIC__/js/comment.js,__STATIC__/jky/js/comm.js','cache'=>'0','return'=>'data',));?>
<?php echo C('ftx_taojindian_html');?>
</body>
</html>