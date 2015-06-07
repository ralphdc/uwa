<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@UPLOAD-} - {-:$_SITE['name']-}</title>
<meta name="keywords" content="{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_SITE['description']-}" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="HandheldFriendly" content="true">
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}mua/css/mua.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/c.css" />
</head>

<body>
{-include:../header-}

<form id="formSearch" class="form" action="" method="post">
<div class="grid">
	<div class="row">
		<div class="col-sm-8">
			<select class="control-input" name="order_by">
				<option value="">{-:@DISPLAY_ORDER-}</option>
				<option value="u_filename"{-if:'u_filename'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@FILENAME-}</option>
				<option value="u_type"{-if:'u_type'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@TYPE-}</option>
				<option value="u_size"{-if:'u_size'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@SIZE-}</option>
				<option value="u_add_time"{-if:'u_add_time'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@ADD_TIME-}</option>
			</select>
		</div>
		<div class="col-sm-4">
			<select class="control-input" name="order_turn">
				<option value="desc"{-if:'desc'==ARequest::get('order_turn')-} selected="selected"{-:/if-}>{-:@DESC-}</option>
				<option value="asc"{-if:'asc'==ARequest::get('order_turn')-} selected="selected"{-:/if-}>{-:@ASC-}</option>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-8">
			<input placeholder="{-:@KEYWORDS-}" required="required" type="text" name="u_filename" value="{-php:echo ARequest::get('u_filename');-}" class="control-input" maxlength="64">
		</div>
		<div class="col-sm-4">
			<input type="submit" class="btn btn-block" value="{-:@SEARCH-}" />
		</div>
	</div>
</div>
</form>

<table id="uploadList" class="table">
	{-foreach:$_UL,$u-}
	<tr>
		<td>
			<strong>{-:@FILENAME-}</strong> <i class="ai ai_16 ai_16_file_type_{-:$u['u_type']-}"></i> {-:$u['u_filename']-}<br />
			<strong>{-:@SIZE-}</strong> {-:$u['u_size']|byte_format~@me-}<br />
			<strong>{-:@ADD_TIME-}</strong> {-:$u['u_add_time']|date~'Y-m-d',@me-}<br />
			<strong>{-:@ITEM_TYPE-}</strong> {-:$u['u_item_type']-} [{-:$u['u_item_id']-}]<br />
		<td><a target="_blank" href="{-:$u['u_src']-}" class="btn btn-primary"><i class="icon icon-search-plus"></i> {-:@VIEW-}</a></td>
	</tr>
	{-:/foreach-}
</table>

<!--next page-->
{-if:!empty($PAGING['nextPage']['url'])-}
<div class="grid">
	<span id="viewMore" to="#uploadList" nextpage="{-:$PAGING['nextPage']['url']-}" class="btn btn-block margin-bottom">{-:@VIEW_MORE-} <i class="icon icon-angle-double-down"></i></span>
</div>
{-:/if-}

<uwa:ad id="5">
{-include:../footer-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}mua/js/mua.js"></script>
<script>
document.write('<script src="{-url:member@common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:home@common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}member/js/c.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>
