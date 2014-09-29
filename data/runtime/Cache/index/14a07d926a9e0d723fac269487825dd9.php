<?php if (!defined('THINK_PATH')) exit(); if(!empty($ad_list)): ?><div class="box-play">
	<div id="img-list">
		<ul class="img-list">
		<?php if(is_array($ad_list)): $i = 0; $__LIST__ = $ad_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ad): $mod = ($i % 2 );++$i;?><li <?php if($i == 1): ?>class="cur"<?php endif; ?>style="background:url('<?php echo attach($ad['content'],'advert');?>') 49.99% top no-repeat;"><a class="<?php echo C('ftx_site_width');?>" href="<?php echo ($ad["url"]); ?>" target="_blank" hidefocus="true"  alt="<?php echo ($ad["desc"]); ?>"></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			 
		</ul>
		<ul class="count-num"></ul>
		<div class="<?php echo C('ftx_site_width');?> bc pr">
			<i class="ban-close" id="close_play" title="关闭幻灯片"></i>
		</div>
	</div>
	<div class="<?php echo C('ftx_site_width');?> bc pr">
		<i class="ban-open" id="open_play" title="打开幻灯片"></i>
	</div>
</div><?php endif; ?>