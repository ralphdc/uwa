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
	<label><select name="order_by">
		<option value="">{-:@DISPLAY_ORDER-}</option>
		<option value="member_credit_order_id"{-if:'member_credit_order_id'==arequest::get('order_by')-} selected="selected"{-:/if-}>{-:@ID-}</option>
		<option value="mco_points"{-if:'mco_points'==arequest::get('order_by')-} selected="selected"{-:/if-}>{-:@POINTS-}</option>
		<option value="mco_add_time"{-if:'mco_add_time'==arequest::get('order_by')-} selected="selected"{-:/if-}>{-:@ADD_TIME-}</option>
		<option value="mco_product_type"{-if:'mco_product_type'==arequest::get('order_by')-} selected="selected"{-:/if-}>{-:@PRODUCT_TYPE-}</option>
		<option value="mco_product_name"{-if:'mco_product_name'==arequest::get('order_by')-} selected="selected"{-:/if-}>{-:@PRODUCT_NAME-}</option>
		<option value="member_id"{-if:'member_id'==arequest::get('order_by')-} selected="selected"{-:/if-}>{-:@MEMBER_ID-}</option>
	</select></label>
	<label><select name="order_turn">
		<option value="desc"{-if:'desc'==arequest::get('order_turn')-} selected="selected"{-:/if-}>{-:@DESC-}</option>
		<option value="asc"{-if:'asc'==arequest::get('order_turn')-} selected="selected"{-:/if-}>{-:@ASC-}</option>
	</select></label>
	<label><select name="page_size">
		<option value=""{-if:''==arequest::get('page_size')-} selected="selected"{-:/if-}>{-:@PAGE_SIZE-}</option>
		<option value="10"{-if:'10'==arequest::get('page_size')-} selected="selected"{-:/if-}>10 {-:@ITEMS-}</option>
		<option value="20"{-if:'20'==arequest::get('page_size')-} selected="selected"{-:/if-}>20 {-:@ITEMS-}</option>
		<option value="50"{-if:'50'==arequest::get('page_size')-} selected="selected"{-:/if-}>50 {-:@ITEMS-}</option>
		<option value="100"{-if:'100'==arequest::get('page_size')-} selected="selected"{-:/if-}>100 {-:@ITEMS-}</option>
	</select></label>
	<label><span class="btn_l submit" action="{-url:member_credit_order/list_credit_order-}" to="#formSearch">{-:@SEARCH-}</span></label>
</div><!--/.mainTips-->
</form>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@MEMBER_CREDIT_ORDER_LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="18"><input type="checkbox" class="select_all" to="member_credit_order_id"></th>
				<th scope="col">{-:@ID-}</th>
				<th scope="col">{-:@PRODUCT_TYPE-}</th>
				<th scope="col">{-:@PRODUCT_NAME-}</th>
				<th scope="col">{-:@POINTS-}</th>
				<th scope="col">{-:@STATUS-}</th>
				<th scope="col">{-:@ADD_TIME-}</th>
				<th scope="col">{-:@MEMBER_ID-}</th>
				<th scope="col">{-:@SELLER_ID-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_MOL,$mco-}
			<tr>
				<td><input name="member_credit_order_id[]" type="checkbox" value="{-:$mco['member_credit_order_id']-}"></td>
				<td>{-:$mco['member_credit_order_id']-}</td>
				<td>{-:$mco['mco_product_type']-}</td>
				<td>{-:$mco['mco_product_name']-}</td>
				<td>{-:$mco['mco_points']-}</td>
				<td>
				{-if:1 == $mco['mco_status']-}
					<span class="fc_g">{-:@PAIED-}</span>
				{-else:-}
					<span class="fc_r">{-:@NOT_PAIED-}</span>
				{-:/if-}
				</td>
				<td>{-:$mco['mco_add_time']|date~C('APP.TIME_FORMAT'),@me-}</td>
				<td><a href="{-url:member_credit_order/list_credit_order?member_id={$mco['member_id']}-}">{-:$mco['member_id']-}</a></td>
				<td><a href="{-url:member_credit_order/list_credit_order?mco_seller_member_id={$mco['mco_seller_member_id']}-}">{-:$mco['mco_seller_member_id']-}</a></td>
				<td><a href="{-url:member_credit_order/pay_credit_order_do?member_credit_order_id={$mco['member_credit_order_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@PAY-}</a> | <a href="{-url:member_credit_order/delete_credit_order_do?member_credit_order_id={$mco['member_credit_order_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onClick="javascript:return delete_confirm();" >{-:@DELETE-}</a></td>
			</tr>
			{-:/foreach-}
		</table>
		{-include:../paging-}
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_l submit" action="{-url:member_credit_order/pay_credit_order_do-}" to="#formList">{-:@PAY_SELECTED-}</span>
	<span class="btn_l submit" action="{-url:member_credit_order/delete_credit_order_do-}" to="#formList">{-:@DELETE_SELECTED-}</span>
</div><!--/#operation-->
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>