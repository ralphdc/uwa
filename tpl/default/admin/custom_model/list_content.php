<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
</head>
<body>
<form id="formSearch" action="" method="post">
<div class="mainTips">
	<label><select name="status">
		<option value=""{-if:'' == ARequest::get('status')-} selected="selected"{-:/if-}>{-:@STATUS-}</option>
		<option value="n"{-if:'n' == ARequest::get('status')-} selected="selected"{-:/if-}>{-:@NOT_PASSED-}</option>
		<option value="p"{-if:'p' == ARequest::get('status')-} selected="selected"{-:/if-}>{-:@PASSED-}</option>
		<option value="r"{-if:'r' == ARequest::get('status')-} selected="selected"{-:/if-}>{-:@REFUNDED-}</option>
	</select></label>
	<label><select name="order_by">
		<option value="">{-:@DISPLAY_ORDER-}</option>
		<option value="id"{-if:'id'==ARequest::get('order_by')-} selected="selected"{-:/if-}>{-:@ID-}</option>
	</select></label>
	<label><select name="order_turn">
		<option value="desc"{-if:'desc'==ARequest::get('order_turn')-} selected="selected"{-:/if-}>{-:@DESC-}</option>
		<option value="asc"{-if:'asc'==ARequest::get('order_turn')-} selected="selected"{-:/if-}>{-:@ASC-}</option>
	</select></label>
	<label><select name="page_size">
		<option value=""{-if:''==ARequest::get('page_size')-} selected="selected"{-:/if-}>{-:@PAGE_SIZE-}</option>
		<option value="10"{-if:'10'==ARequest::get('page_size')-} selected="selected"{-:/if-}>10 {-:@ITEMS-}</option>
		<option value="20"{-if:'20'==ARequest::get('page_size')-} selected="selected"{-:/if-}>20 {-:@ITEMS-}</option>
		<option value="50"{-if:'50'==ARequest::get('page_size')-} selected="selected"{-:/if-}>50 {-:@ITEMS-}</option>
		<option value="100"{-if:'100'==ARequest::get('page_size')-} selected="selected"{-:/if-}>100 {-:@ITEMS-}</option>
	</select></label>
	<input name="custom_model_id" type="hidden" value="{-:$_CMI['custom_model_id']-}">
	<label><span class="btn_l submit" action="{-url:custom_model/list_content-}" to="#formSearch">{-:@SEARCH-}</span></label>
</div><!--/.mainTips-->
</form>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong>{-:$_CMI['cm_name']-} {-:@CONTENT_LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="id"></th>
				<th scope="col" width="50">{-:@ID-}</th>
				<th scope="col">{-:@DETAIL-}</th>
				<th scope="col" width="50">{-:@MEMBER_ID-}</th>
				<th scope="col" width="50">{-:@STATUS-}</th>
				<th scope="col" width="180">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_CMCL,$cmc-}
			<tr>
				<td>
					<input name="id[]" type="checkbox" value="{-:$cmc['id']-}">
				</td>
				<td>{-:$cmc['id']-}</td>
				<td>
					{-if:!empty($_CMI['cm_field'])-}<ul>
					{-foreach:$_CMI['cm_field'],$field,$params-}
						{-if:1==$params['f_is_list'] and !empty($cmc[$field])-}
						<li><strong>{-:$params['f_item_name']-}</strong>:
							{-if:'img' == $params['f_type'] and 0 == $params['f_multi_upload']-}
								<a href="{-:$cmc[$field]-}" target="_blank">{-:@IMAGE_ATTACHMENT-}</a>
							{-elseif:'addon' == $params['f_type'] and 0 == $params['f_multi_upload']-}
								<a href="{-:$cmc[$field]-}" target="_blank">{-:@FILE_ATTACHMENT-}</a>
							{-else:-}
								{-:$cmc[$field]-}
							{-:/if-}
						</li>
						{-:/if-}
					{-:/foreach-}
					</ul>{-:/if-}
				</td>
				<td>
					<a href="{-url:custom_model/list_content?custom_model_id={$_CMI['custom_model_id']}&member_id={$cmc['member_id']}-}">{-:$cmc['member_id']-}</a>
				</td>
				<td>
					{-if:0 == $cmc['status']-}<span class="fc_gry">{-:@NOT_PASSED-}</span>{-elseif:1 == $cmc['status']-}<span class="fc_g">{-:@PASSED-}</span>{-elseif:2 == $cmc['status']-}<span class="fc_r">{-:@REFUNDED-}</span>{-:/if-}
				</td>
				<td><a target="_blank" href="{-url:home@custom_model/show_content?custom_model_id={$_CMI['custom_model_id']}&id={$cmc['id']}-}">{-:@PREVIEW-}</a> | <a href="{-url:custom_model/edit_content?custom_model_id={$_CMI['custom_model_id']}&id={$cmc['id']}-}">{-:@EDIT-}</a> | <a href="{-url:custom_model/delete_content_do?custom_model_id={$_CMI['custom_model_id']}&id={$cmc['id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();" >{-:@DELETE-}</a></td>
			</tr>
			{-:/foreach-}
		</table>
		{-include:../paging-}
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<input name="custom_model_id" type="hidden" value="{-:$_CMI['custom_model_id']-}">
	<a class="btn_l" href="{-url:custom_model/list_model-}">{-:@CUSTOM_MODEL_LIST-}</a>
	<a class="btn_l" href="{-url:custom_model/add_content?custom_model_id={$_CMI['custom_model_id']}-}">{-:@ADD_CONTENT-}</a>
	<span class="btn_l submit" action="{-url:custom_model/pass_content_do-}" to="#formList">{-:@PASS_SELECTED-}</span>
	<span class="btn_l submit" action="{-url:custom_model/refund_content_do-}" to="#formList">{-:@REFUND_SELECTED-}</span>
	<span class="btn_l submit" action="{-url:custom_model/delete_content_do-}" to="#formList">{-:@DELETE_SELECTED-}</span>
</div><!--/#operation-->
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>