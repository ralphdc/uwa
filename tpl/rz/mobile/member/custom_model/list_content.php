<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:$_CMI['cm_name']-} {-:@LIST-} - {-:$_SITE['name']-}</title>
<meta name="keywords" content="{-:$_CMI['keywords']-}" />
<meta name="description" content="{-:$_CMI['description']-}" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="HandheldFriendly" content="true">
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}mua/css/mua.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/c.css" />
</head>

<body>
{-include:../header-}

<div class="grid">
	<div class="text-right">
		<a class="btn btn-success" href="{-url:custom_model/add_content?custom_model_id={$_CMI['custom_model_id']}-}"><i class="icon icon-plus"></i> {-:@PUBLISH-} {-:$_CMI['cm_name']-}</a>
	</div>
	<ul class="subnav subnav-tab">
		<li{-if:!ARequest::get('status')-} class="active"{-:/if-}><a href="{-url:custom_model/list_content?custom_model_id={$_CMI['custom_model_id']}-}">{-:@ALL-}</a></li>
		<li{-if:'n'==ARequest::get('status')-} class="active"{-:/if-}><a href="{-url:custom_model/list_content?custom_model_id={$_CMI['custom_model_id']}&status=n-}">{-:@NOT_PASSED-}</a></li>
		<li{-if:'p'==ARequest::get('status')-} class="active"{-:/if-}><a href="{-url:custom_model/list_content?custom_model_id={$_CMI['custom_model_id']}&status=p-}">{-:@PASSED-}</a></li>
		<li{-if:'r'==ARequest::get('status')-} class="active"{-:/if-}><a href="{-url:custom_model/list_content?custom_model_id={$_CMI['custom_model_id']}&status=r-}">{-:@REFUNDED-}</a></li>
	</ul>
</div>

<table id="contentList" class="table">
	{-foreach:$_CMCL,$cmc-}
	<tr>
		<td>
			{-if:!empty($_CMI['cm_field'])-}<ul class="list-unstyled">
				<li>
					<strong>{-:@ID-}</strong>: {-:$cmc['id']-}
					{-if:0 == $cmc['status']-}
						<span class="text-muted">{-:@NOT_PASSED-}</span>
					{-elseif:1 == $cmc['status']-}
						<span class="text-success">{-:@PASSED-}</span>
					{-elseif:2 == $cmc['status']-}
						<span class="text-danger">{-:@REFUNDED-}</span>
					{-:/if-}
				</li>
			{-foreach:$_CMI['cm_field'],$field,$params-}
				{-if:1==$params['f_is_list'] and !empty($cmc[$field])-}
				<li><strong>{-:$params['f_item_name']-}</strong>:
					{-if:'img' == $params['f_type'] and 0 == $params['f_multi_upload']-}
						<a href="{-:$cmc[$field]-}" target="_blank"><i class="icon icon-image"></i> {-:@IMAGE_ATTACHMENT-}</a>
					{-elseif:'addon' == $params['f_type'] and 0 == $params['f_multi_upload']-}
						<a href="{-:$cmc[$field]-}" target="_blank"><i class="icon icon-paperclip"></i> {-:@FILE_ATTACHMENT-}</a>
					{-else:-}
						{-:$cmc[$field]-}
					{-:/if-}
				</li>
				{-:/if-}
			{-:/foreach-}
			</ul>{-:/if-}
		</td>
		<td>
			<div class="btn-group-vertical">
				<a class="btn btn-primary" target="_blank" href="{-url:home@custom_model/show_content?custom_model_id={$_CMI['custom_model_id']}&id={$cmc['id']}-}"><i class="icon icon-search-plus"></i> {-:@PREVIEW-}</a>
				<a class="btn btn-primary" href="{-url:custom_model/edit_content?custom_model_id={$_CMI['custom_model_id']}&id={$cmc['id']}-}"><i class="icon icon-edit"></i> {-:@EDIT-}</a>
			</div>
		</td>
	</tr>
	{-:/foreach-}
</table>

<!--next page-->
{-if:!empty($PAGING['nextPage']['url'])-}
<div class="grid">
	<span id="viewMore" to="#contentList" nextpage="{-:$PAGING['nextPage']['url']-}" class="btn btn-block margin-bottom">{-:@VIEW_MORE-} <i class="icon icon-angle-double-down"></i></span>
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
