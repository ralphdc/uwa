<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@UPLOAD-} - {-:$_SITE['name']-}</title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/m.css" />
<meta name="keywords" content="{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_SITE['description']-}" />
</head>

<body>
{-include:../header-}
<div class="m w_960">
	<div class="w_190 f_l">
{-include:../sidebar_content-}
	</div><!--/.w_190-->
	<div class="w_10 h_10 o_h f_l">&nbsp;</div>
	<div class="w_760 f_l">
		<form id="formSearch" action="" method="post">
		<div class="ta_r">
			<label><select name="order_by">
				<option value="">{-:@DISPLAY_ORDER-}</option>
				<option value="u_filename"{-if:'u_filename'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@FILENAME-}</option>
				<option value="u_type"{-if:'u_type'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@TYPE-}</option>
				<option value="u_size"{-if:'u_size'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@SIZE-}</option>
				<option value="u_add_time"{-if:'u_add_time'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@ADD_TIME-}</option>
			</select></label>
			<label><select name="order_turn">
				<option value="desc"{-if:'desc'==ARequest::get('order_turn')-} selected="selected"{-:/if-}>{-:@DESC-}</option>
				<option value="asc"{-if:'asc'==ARequest::get('order_turn')-} selected="selected"{-:/if-}>{-:@ASC-}</option>
			</select></label>
			<label>{-:@KEYWORDS-} <input class="i" type="text" size="10" maxlength="64" name="u_filename" value="{-php:echo ARequest::get('u_filename');-}"></label>
			<label><span class="btn_l submit" action="{-url:member_upload/list_upload-}" to="#formSearch">{-:@SEARCH-}</span></label>
		</div>
		</form>
		<div class="h_10 o_h"></div>
		<dl class="atab_1 adiv">
			<dt><strong class="on">{-:@UPLOAD_LIST-}</strong></dt>
			<dd class="p_10">
				<table class="listTable">
					<tr>
						<th scope="col">{-:@FILENAME-}</th>
						<th scope="col">{-:@SIZE-}</th>
						<th scope="col">{-:@ADD_TIME-}</th>
						<th scope="col">{-:@ITEM_TYPE-}</th>
						<th scope="col">{-:@MANAGE-}</th>
					</tr>
					{-foreach:$_UL,$u-}
					<tr>
						<td><i class="ai ai_16 ai_16_file_type_{-:$u['u_type']-}"></i> {-:$u['u_filename']-}</td>
						<td>{-:$u['u_size']|byte_format~@me-}</td>
						<td>{-:$u['u_add_time']|date~'Y-m-d',@me-}</td>
						<td>{-:$u['u_item_type']-} [{-:$u['u_item_id']-}]</td>
						<td><a target="_blank" href="{-:$u['u_src']-}">{-:@VIEW-}</a></td>
					</tr>
					{-:/foreach-}
				</table>
				{-include:../clip/paging-}
			</dd>
		</dl>
	</div><!--/.w_760-->
	<div class="c"></div>
</div>
{-include:../footer-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script>
document.write('<script src="{-url:common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}member/js/c.js"></script>
<script src="{-:*__THEME__-}member/js/m.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>