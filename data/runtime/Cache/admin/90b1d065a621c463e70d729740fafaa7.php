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
<div class="subnav">
    <h1 class="title_2 line_x">采集器修改</h1>
</div>
<div class="pad_lr_10" >
    <form id="info_form" action="<?php echo U('robots/edit');?>" name="searchform" method="post" >
    <table width="100%" cellspacing="0" class="table_form">
        <tbody>
			<tr>
                <th width="150"><?php echo L('tbk_name');?>：</th>
                <td>
                    <input name="name" type="text" id="J_name" class="input-text" size="20" value="<?php echo ($info["name"]); ?>"/>
                    <span class="gray ml10"><?php echo L('tbk_name_desc');?></span>
                </td>
            </tr>
			 <tr>
				<th><font color="red">[新]</font>&nbsp; 采集模式：</th>
				<td>
					<input type="radio" value="0" name="http_mode" class="radio" id="api_mod" <?php if($info["http_mode"] == '0'): ?>checked<?php endif; ?>>
                    <label for="api_mod" class="radio_lalel">API采集(禁用)</label>&nbsp;&nbsp;&nbsp;
                    <input type="radio" value="1" name="http_mode" id="tb_mod" class="radio"  <?php if($info["http_mode"] == '1'): ?>checked<?php endif; ?>>
                    <label for="tb_mod" class="radio_lalel">淘宝网采集(必选)</label>
				</td>
			</tr>
            <tr class="api_mod">
                <th><?php echo L('tbk_item_cate');?>：</th>
                <td>
                    <select class="J_tbcats mr10">
                        <option value="0">--<?php echo L('all');?>--</option>
                        <?php if(is_array($items_cate)): $i = 0; $__LIST__ = $items_cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?><option value="<?php echo ($cate["cid"]); ?>" <?php if($cate['cid'] == $info['cid']): ?>selected="selected"<?php endif; ?> ><?php echo ($cate["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>

					<select class="J_tbcats mr10" data-pid="0" data-uri="<?php echo U('items_cate/ajax_getchilds', array('type'=>0));?>" data-selected="<?php echo ($selected_ids); ?>"></select>
                    <input type="hidden" id="J_cid" name="cid" value="<?php echo ($info["cid"]); ?>">
                    <span class="gray ml10">API的分类ID</span>
                </td>
            </tr>
			<tr class="tb_mod">
                <th>淘宝商品分类ID：</th>
                <td>
                    <input name="tb_cid" type="text" class="input-text" size="35" value="<?php echo ($info["tb_cid"]); ?>" />
                    <span class="gray ml10"><a href="http://bbs.52jscn.com/thread-2740715-1-1.html" target="_blank">如何获取?</a></span>
                </td>
            </tr>
			<tr>
				<th>所属分类：</th>
                <td><select class="J_cate_select mr10" data-pid="0" data-uri="<?php echo U('items_cate/ajax_getchilds', array('type'=>0));?>" data-selected="<?php echo ($selected_ids); ?>"></select>
                <input type="hidden" name="cate_id" id="J_cate_id" value="<?php echo ($info["cate_id"]); ?>" /></td></td>
			</tr>


            <tr>
                <th><?php echo L('keyword');?>：</th>
                <td>
                    <input name="keyword" type="text" class="input-text" size="40" value="<?php echo ($info["keyword"]); ?>" />
                    <span class="gray ml10"><?php echo L('tbk_keyword_desc');?></span>
                </td>
            </tr>

			<tr>
                <th>采集页数：</th>
                <td>

					<select name="page" id="page">
					<?php for($a=1;$a<=100;$a++){?>
						<option value="<?=$a?>" <?php if($info["page"] == $a): ?>selected<?php endif; ?> >采集<?=$a?>页</option>
					<?php  } ?>
                    </select>
                </td>
            </tr>


            <tr>
                <th><?php echo L('sort_order');?>：</th>
                <td>
                    <select name="sort">
			<option value="normal|desc" <?php if($info["sort"] == 'normal|desc'): ?>selected<?php endif; ?>>默认</option>
			<option value="new|desc" <?php if($info["sort"] == 'new|desc'): ?>selected<?php endif; ?>>最新</option>
			<option value="volume|desc" <?php if($info["sort"] == 'volume|desc'): ?>selected<?php endif; ?>>销量</option>
			<option value="coefp|desc" <?php if($info["sort"] == 'coefp|desc'): ?>selected<?php endif; ?>>人气</option>
			<option value="ratesum|desc" <?php if($info["sort"] == 'ratesum|desc'): ?>selected<?php endif; ?>>信用</option>
                    </select>
                </td>
            </tr>
 
			<tr>
                <th><?php echo L('tbk_item_coupon_rate');?>：</th>
                <td>
                    <input type="text" name="start_coupon_rate" size="5" class="input-text" value="<?php echo ($info["start_coupon_rate"]); ?>"  />- 
                    <input type="text" name="end_coupon_rate" size="5" class="input-text" value="<?php echo ($info["end_coupon_rate"]); ?>" />
                    <span class="gray ml10"><?php echo L('tbk_item_coupon_rate_desc');?></span>
                </td>
            </tr>
			<tr>
                <th>价格：</th>
                <td>
                    <input type="text" name="start_price" size="5" class="input-text" value="<?php echo ($info["start_price"]); ?>"/> - 
                    <input type="text" name="end_price" size="5" class="input-text" value="<?php echo ($info["end_price"]); ?>"/> 
                    <span class="gray ml10">可不填，最低价格和最高最高一起设置才有效</span>
                </td>
            </tr>
            <tr>
                <th><?php echo L('tbk_item_commission_num');?>：</th>
                <td>
                    <input type="text" name="start_volume" size="5" class="input-text" value="<?php echo ($info["start_volume"]); ?>" /> - 
                    <input type="text" name="end_volume" size="5" class="input-text" value="<?php echo ($info["end_volume"]); ?>" /> 
                    <span class="gray ml10"><?php echo L('tbk_item_commission_num_desc');?></span>
                </td>
            </tr>
            <tr  class="api_mod" style="display:none">
                <th><?php echo L('tbk_seller_credit');?>：</th>
                <td>
                    <select name="start_credit">
                        <option value="1heart" <?php if($info["start_credit"] == '1heart'): ?>selected<?php endif; ?>><?php echo L('n1'); echo L('heart');?></option>
                        <option value="2heart" <?php if($info["start_credit"] == '2heart'): ?>selected<?php endif; ?>><?php echo L('n2'); echo L('heart');?></option>
                        <option value="3heart" <?php if($info["start_credit"] == '3heart'): ?>selected<?php endif; ?>><?php echo L('n3'); echo L('heart');?></option>
                        <option value="4heart" <?php if($info["start_credit"] == '4heart'): ?>selected<?php endif; ?>><?php echo L('n4'); echo L('heart');?></option>
                        <option value="5heart" <?php if($info["start_credit"] == '5heart'): ?>selected<?php endif; ?>><?php echo L('n5'); echo L('heart');?></option>
                        <option value="1diamond" <?php if($info["start_credit"] == '1diamond'): ?>selected<?php endif; ?>><?php echo L('n1'); echo L('diamond');?></option>
                        <option value="2diamond" <?php if($info["start_credit"] == '2diamond'): ?>selected<?php endif; ?>><?php echo L('n2'); echo L('diamond');?></option>
                        <option value="3diamond" <?php if($info["start_credit"] == '3diamond'): ?>selected<?php endif; ?>><?php echo L('n3'); echo L('diamond');?></option>
                        <option value="4diamond" <?php if($info["start_credit"] == '4diamond'): ?>selected<?php endif; ?>><?php echo L('n4'); echo L('diamond');?></option>
                        <option value="5diamond" <?php if($info["start_credit"] == '5diamond'): ?>selected<?php endif; ?>><?php echo L('n5'); echo L('diamond');?></option>
                        <option value="1crown" <?php if($info["start_credit"] == '1crown'): ?>selected<?php endif; ?>><?php echo L('n1'); echo L('crown');?></option>
                        <option value="2crown" <?php if($info["start_credit"] == '2crown'): ?>selected<?php endif; ?>><?php echo L('n2'); echo L('crown');?></option>
                        <option value="3crown" <?php if($info["start_credit"] == '3crown'): ?>selected<?php endif; ?>><?php echo L('n3'); echo L('crown');?></option>
                        <option value="4crown" <?php if($info["start_credit"] == '4crown'): ?>selected<?php endif; ?>><?php echo L('n4'); echo L('crown');?></option>
                        <option value="5crown" <?php if($info["start_credit"] == '5crown'): ?>selected<?php endif; ?>><?php echo L('n5'); echo L('crown');?></option>
                        <option value="1goldencrown" <?php if($info["start_credit"] == '1goldencrown'): ?>selected<?php endif; ?>><?php echo L('n1'); echo L('goldencrown');?></option>
                        <option value="2goldencrown" <?php if($info["start_credit"] == '2goldencrown'): ?>selected<?php endif; ?>><?php echo L('n2'); echo L('goldencrown');?></option>
                        <option value="3goldencrown" <?php if($info["start_credit"] == '3goldencrown'): ?>selected<?php endif; ?>><?php echo L('n3'); echo L('goldencrown');?></option>
                        <option value="4goldencrown" <?php if($info["start_credit"] == '4goldencrown'): ?>selected<?php endif; ?>><?php echo L('n4'); echo L('goldencrown');?></option>
                        <option value="5goldencrown" <?php if($info["start_credit"] == '5goldencrown'): ?>selected<?php endif; ?>><?php echo L('n5'); echo L('goldencrown');?></option>
                    </select>
                     - 
                    <select name="end_credit">
                        <option value="1heart" <?php if($info["end_credit"] == '1heart'): ?>selected<?php endif; ?>><?php echo L('n1'); echo L('heart');?></option>
                        <option value="2heart" <?php if($info["end_credit"] == '2heart'): ?>selected<?php endif; ?>><?php echo L('n2'); echo L('heart');?></option>
                        <option value="3heart" <?php if($info["end_credit"] == '3heart'): ?>selected<?php endif; ?>><?php echo L('n3'); echo L('heart');?></option>
                        <option value="4heart" <?php if($info["end_credit"] == '4heart'): ?>selected<?php endif; ?>><?php echo L('n4'); echo L('heart');?></option>
                        <option value="5heart" <?php if($info["end_credit"] == '5heart'): ?>selected<?php endif; ?>><?php echo L('n5'); echo L('heart');?></option>
                        <option value="1diamond" <?php if($info["end_credit"] == '1diamond'): ?>selected<?php endif; ?>><?php echo L('n1'); echo L('diamond');?></option>
                        <option value="2diamond" <?php if($info["end_credit"] == '2diamond'): ?>selected<?php endif; ?>><?php echo L('n2'); echo L('diamond');?></option>
                        <option value="3diamond" <?php if($info["end_credit"] == '3diamond'): ?>selected<?php endif; ?>><?php echo L('n3'); echo L('diamond');?></option>
                        <option value="4diamond" <?php if($info["end_credit"] == '4diamond'): ?>selected<?php endif; ?>><?php echo L('n4'); echo L('diamond');?></option>
                        <option value="5diamond" <?php if($info["end_credit"] == '5diamond'): ?>selected<?php endif; ?>><?php echo L('n5'); echo L('diamond');?></option>
                        <option value="1crown" <?php if($info["end_credit"] == '1crown'): ?>selected<?php endif; ?>><?php echo L('n1'); echo L('crown');?></option>
                        <option value="2crown" <?php if($info["end_credit"] == '2crown'): ?>selected<?php endif; ?>><?php echo L('n2'); echo L('crown');?></option>
                        <option value="3crown" <?php if($info["end_credit"] == '3crown'): ?>selected<?php endif; ?>><?php echo L('n3'); echo L('crown');?></option>
                        <option value="4crown" <?php if($info["end_credit"] == '4crown'): ?>selected<?php endif; ?>><?php echo L('n4'); echo L('crown');?></option>
                        <option value="5crown" <?php if($info["end_credit"] == '5crown'): ?>selected<?php endif; ?>><?php echo L('n5'); echo L('crown');?></option>
                        <option value="1goldencrown" <?php if($info["end_credit"] == '1goldencrown'): ?>selected<?php endif; ?>><?php echo L('n1'); echo L('goldencrown');?></option>
                        <option value="2goldencrown" <?php if($info["end_credit"] == '2goldencrown'): ?>selected<?php endif; ?>><?php echo L('n2'); echo L('goldencrown');?></option>
                        <option value="3goldencrown" <?php if($info["end_credit"] == '3goldencrown'): ?>selected<?php endif; ?>><?php echo L('n3'); echo L('goldencrown');?></option>
                        <option value="4goldencrown" <?php if($info["end_credit"] == '4goldencrown'): ?>selected<?php endif; ?>><?php echo L('n4'); echo L('goldencrown');?></option>
                        <option value="5goldencrown" <?php if($info["end_credit"] == '5goldencrown'): ?>selected<?php endif; ?>><?php echo L('n5'); echo L('goldencrown');?></option>
                    </select>
                </td>
            </tr>
			<tr>
				<th><font color="red">[新]</font> 是否包邮：</th>
				<td>
					<input name="ems" id="ems0" value="0"  type="radio" <?php if($info["ems"] == '0'): ?>checked<?php endif; ?>><label for="ems0">&nbsp;默&nbsp;认&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
					<input name="ems" id="ems1" value="1" type="radio"  <?php if($info["ems"] == '1'): ?>checked<?php endif; ?>><label for="ems1">&nbsp;包&nbsp;邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
					<span class="gray ml10"></span>
				</td>
			</tr>

			<tr>
				<th><font color="red">[新]</font> 是否更新分类：</th>
				<td>
					<input name="recid" id="recid0" value="0"  type="radio" <?php if($info["recid"] == '0'): ?>checked<?php endif; ?>><label for="recid0">&nbsp;不&nbsp;更&nbsp;新&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
					<input name="recid" id="recid1" value="1" type="radio"  <?php if($info["recid"] == '1'): ?>checked<?php endif; ?>><label for="recid1">&nbsp;更&nbsp;新&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
					<span class="gray ml10">如果采集的商品之前已经采集过更新信息时更正目前选择的分类</span>
				</td>
			</tr>

            <tr>
                <th>是否商城：</th>
                <td>
                    <label class="mr10"><input type="checkbox" name="shop_type" value="B" <?php if($info["shop_type"] == 'B'): ?>checked<?php endif; ?>> <?php echo L('only_tmall');?></label>
                </td>
            </tr>

            <tr>
                <th></th>
                <td>
					<input type="hidden" name="id"  value="<?php echo ($info["id"]); ?>" />
                    <input type="submit" name="search" class="smt  mr10" value="<?php echo L('submit');?>" />
                </td>
            </tr>
        </tbody>
    </table>
    </form>
</div>
<script src="__STATIC__/js/jquery/jquery.js"></script>
<script src="__STATIC__/js/jquery/plugins/jquery.tools.min.js"></script>
<script src="__STATIC__/js/jquery/plugins/formvalidator.js"></script>
<script src="__STATIC__/js/ftxia.js"></script>
<script src="__STATIC__/js/admin.js"></script>
<script src="__STATIC__/js/dialog.js"></script>
<script>
//初始化弹窗
(function (d) {
    d['okValue'] = lang.dialog_ok;
    d['cancelValue'] = lang.dialog_cancel;
    d['title'] = lang.dialog_title;
})($.dialog.defaults);
</script>

<?php if(isset($list_table)): ?><script src="__STATIC__/js/jquery/plugins/listTable.js"></script>
<script>
$(function(){
	$('.J_tablelist').listTable();
});
</script><?php endif; ?>
<div style="display:none"><script language="javascript" type="text/javascript" src="http://js.users.51.la/17114883.js"></script></div>
<script>
$('.J_cate_select').cate_select('请选择');
$(function(){
    var uri = "<?php echo U('robots/ajax_get_tbcats');?>";
	var selectcid= "<?php echo ($info["cid"]); ?>";
    $('.J_tbcats').die('change').live('change', function(){
        var _this = $(this),
            _cid = _this.val();
        _this.nextAll('.J_tbcats').remove();
        $.getJSON(uri, {cid:_cid}, function(result){
            if(result.status == '1'){
                var _childs = $('<select class="J_tbcats mr10"><option value="0">--'+lang.all+'--</option></select>')
                for(var i=0; i<result.data.length; i++){
					if(result.data[i].cid == selectcid){
						$('<option value="'+result.data[i].cid+'" selected>'+result.data[i].name+'</option>').appendTo(_childs);
					}else{
						$('<option value="'+result.data[i].cid+'">'+result.data[i].name+'</option>').appendTo(_childs);
					}
                }
                _childs.insertAfter(_this);
            }
        });
        $('#J_cid').val(_cid);
    });

	$.formValidator.initConfig({formid:"info_form",autotip:true});
	$("#J_name").formValidator({onshow:'请填写采集器名称',onfocus:'请填写采集器名称'}).inputValidator({min:1,onerror:'请填写采集器名称'});

    <?php if($info["http_mode"] == '0'): ?>$(".tb_mod").hide();
	<?php else: ?>
		$(".api_mod").hide();<?php endif; ?>
	
	$('#api_mod').click(function() {
		$(".api_mod").show();
		$(".tb_mod").hide();
	});

	$('#tb_mod').click(function() {
		$(".tb_mod").show();
		$(".api_mod").hide();
	});

});
</script>
</body>
</html>