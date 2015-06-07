<?php /* PFA Template Cache File. Create Time:2015-06-06 17:59:18 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/mf.css" />
<link rel="stylesheet" type="text/css" href="<?php echo(__PUBLIC__); ?>js/dialog/artdialog.css" />
</head>
<body>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong><?php echo(L("AD_SPACE_LIST")); ?></strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="ad_space_id"></th>
				<th scope="col"><?php echo(L("ID")); ?></th>
				<th scope="col"><?php echo(L("NAME")); ?></th>
				<th scope="col"><?php echo(L("SIZE")); ?></th>
				<th scope="col"><?php echo(L("TYPE")); ?></th>
				<th scope="col" width="90"><?php echo(L("STATUS")); ?></th>
				<th scope="col"><?php echo(L("MANAGE")); ?></th>
			</tr>
			<?php if(isset($_ASL) and is_array($_ASL)) : foreach($_ASL as $as) : ?>
			<tr>
				<td><input name="ad_space_id[<?php echo($as['ad_space_id']); ?>]" type="checkbox" value="<?php echo($as['ad_space_id']); ?>"></td>
				<td><?php echo($as['ad_space_id']); ?></td>
				<td><?php echo($as['as_name']); ?></td>
				<td><?php echo($as['as_width']); ?> &times; <?php echo($as['as_height']); ?></td>
				<td>
				<?php if('code' == $as['as_type']) :  ?><?php echo(L("CODE")); ?>
				<?php elseif('text' == $as['as_type']) :  ?><?php echo(L("TEXT")); ?>
				<?php elseif('image' == $as['as_type']) :  ?><?php echo(L("IMAGE")); ?>
				<?php elseif('flash' == $as['as_type']) :  ?><?php echo(L("FLASH")); ?>
				<?php elseif('slide' == $as['as_type']) :  ?><?php echo(L("SLIDE")); ?>
				<?php elseif('banner' == $as['as_type']) :  ?><?php echo(L("BANNER")); ?>
				<?php elseif('rolls' == $as['as_type']) :  ?><?php echo(L("ROLLS")); ?>
				<?php endif; ?>
				</td>
				<td><?php if('code' == $as['as_type']) :  ?><?php echo(L("CODE")); ?><?php elseif('text' == $as['as_type']) :  ?><?php echo(L("TEXT")); ?><?php elseif('image' == $as['as_type']) :  ?><?php echo(L("IMAGE")); ?><?php elseif('flash' == $as['as_type']) :  ?><?php echo(L("FLASH")); ?><?php elseif('slide' == $as['as_type']) :  ?><?php echo(L("SLIDE")); ?><?php elseif('banner' == $as['as_type']) :  ?><?php echo(L("BANNER")); ?><?php elseif('rolls' == $as['as_type']) :  ?><?php echo(L("ROLLS")); ?><?php endif; ?></td>
				<td>
				<?php if(1 == $as['as_status']) :  ?>
					<span class="status"><b class="on"><?php echo(L("ON")); ?></b><a href="<?php echo(Url::U("ad_space/toggle_space_status_do?ad_space_id={$as['ad_space_id']}&as_status=0&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>"><?php echo(L("TOGGLE")); ?></a></span>
				<?php else : ?>
					<span class="status"><b class="off"><?php echo(L("OFF")); ?></b><a href="<?php echo(Url::U("ad_space/toggle_space_status_do?ad_space_id={$as['ad_space_id']}&as_status=1&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>"><?php echo(L("TOGGLE")); ?></a></span>
				<?php endif; ?>
				</td>
				<td><a href="<?php echo(Url::U("ad/list_ad?ad_space_id={$as['ad_space_id']}")); ?>"><?php echo(L("AD_LIST")); ?></a> | <a href="<?php echo(Url::U("ad/add_ad?ad_space_id={$as['ad_space_id']}")); ?>"><?php echo(L("ADD_AD")); ?></a> | <a href="<?php echo(Url::U("ad_space/edit_space?ad_space_id={$as['ad_space_id']}")); ?>"><?php echo(L("EDIT")); ?></a> | <a href="<?php echo(Url::U("ad_space/delete_space_do?ad_space_id={$as['ad_space_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>" onclick="javascript:return delete_confirm();" ><?php echo(L("DELETE")); ?></a>
					<a class="btn_l" href="<?php echo(Url::U("ad_space/build_js_do?ad_space_id={$as['ad_space_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>"><?php echo(L("UPDATE_JS")); ?></a>
					<span class="btn_l" onclick="javascript:get_ad_code(<?php echo($as['ad_space_id']); ?>);" ><?php echo(L("GET_CODE")); ?></span>
				</td>
			</tr>
			<?php endforeach; endif; ?>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
	<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
	<a class="btn_l" href="<?php echo(Url::U("ad_space/add_space")); ?>"><?php echo(L("ADD_AD_SPACE")); ?></a>
	<span class="btn_l submit" action="<?php echo(Url::U("ad_space/delete_space_do")); ?>" to="#formList"><?php echo(L("DELETE_SELECTED")); ?></span>
	<span class="btn_l submit" action="<?php echo(Url::U("ad_space/build_js_do")); ?>" to="#formList"><?php echo(L("UPDATE_JS")); ?></span>
	<a class="btn_l" href="<?php echo(Url::U("ad/list_ad")); ?>"><?php echo(L("AD_LIST")); ?></a>
</div><!--/#operation-->
</form>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="<?php echo(__PUBLIC__); ?>js/dialog/artdialog.js"></script>
<script>
function get_ad_code(id) {
	var content = "<span><?php echo(L("HTML_CODE")); ?></span>";
		content += "<code style=\"font-family:'Courier New'; display:block\" class=\"fs_14 bg_gry_d fc_wht p_10 br_5\">";
		content += "&lt;uwa:ad id=&quot;"+ id +"&quot;&gt;";
		content += "</code>";
		content += "<span><?php echo(L("JS_CODE")); ?></span>";
		content += "<code style=\"font-family:'Courier New'; display:block\" class=\"fs_14 bg_gry_d fc_wht p_10 br_5\">";
		content += "&lt;script type=&quot;text/javascript&quot;<br />";
		content += "&nbsp;&nbsp;&nbsp;&nbsp;src=&quot;<?php echo '{'; ?>-:*__APP__-}runtime/js/~ad"+ id +".js&quot;&gt;<br />";
		content += "&lt;/script&gt;";
		content += "</code>";
	dialog({
		content:content,
		id:'ab_d',
		title:'<?php echo(L("GET_CODE")); ?>',
		padding:'10px'
	}).showModal();
}
</script>
<script src="/tpl/rz/admin/js/c.js"></script>
</body>
</html>