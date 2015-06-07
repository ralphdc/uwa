<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
</head>
<body>
<dl class="abox">
	<dt>
		{-if:'' == ARequest::get('e_type')-}
			<strong>{-:@ALL_EXTENSION-}</strong>
		{-else:-}
			<span><a href="{-url:extension/list_extension-}">{-:@ALL_EXTENSION-}</a></span>
		{-:/if-}
		{-if:'module' == ARequest::get('e_type')-}
			<strong>{-:@MODULE-}</strong>
		{-else:-}
			<span><a href="{-url:extension/list_extension?e_type=module-}">{-:@MODULE-}</a></span>
		{-:/if-}
		{-if:'plugin' == ARequest::get('e_type')-}
			<strong>{-:@PLUGIN-}</strong>
		{-else:-}
			<span><a href="{-url:extension/list_extension?e_type=plugin-}">{-:@PLUGIN-}</a></span>
		{-:/if-}
		{-if:'template' == ARequest::get('e_type')-}
			<strong>{-:@TEMPLATE-}</strong>
		{-else:-}
			<span><a href="{-url:extension/list_extension?e_type=template-}">{-:@TEMPLATE-}</a></span>
		{-:/if-}
		{-if:'patch' == ARequest::get('e_type')-}
			<strong>{-:@PATCH-}</strong>
		{-else:-}
			<span><a href="{-url:extension/list_extension?e_type=patch-}">{-:@PATCH-}</a></span>
		{-:/if-}
		{-if:'other' == ARequest::get('e_type')-}
			<strong>{-:@OTHER-}</strong>
		{-else:-}
			<span><a href="{-url:extension/list_extension?e_type=other-}">{-:@OTHER-}</a></span>
		{-:/if-}
	</dt>
	<dd>
		<div class="mainTips">
			<span class="fs_12">{-:@EXTENSION_MAIN_TIP-}</span>
		</div><!--/.mainTips-->
		<table class="listTable">
			<tr>
				<th scope="col">{-:@NAME-}</th>
				<th scope="col">{-:@AUTHOR-}</th>
				<th scope="col">{-:@VERSION-}</th>
				<th scope="col">{-:@PUBLISH_DATE-}</th>
				<th scope="col">{-:@TYPE-}</th>
				<th scope="col">{-:@STATUS-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_EL,$e-}
			<tr>
				<td>{-:$e['e_name']-} <span class="fc_gry fs_11 br_3 br_gry p_0_2">{-:$e['e_alias']-}</span></td>
				<td>{-:$e['e_author']-}</td>
				<td>{-:$e['e_version']-}</td>
				<td>{-:$e['e_publish_date']-}</td>
				<td>
				{-if:'module' == $e['e_type']-}
					{-:@MODULE-}
				{-elseif:'plugin' == $e['e_type']-}
					{-:@PLUGIN-}
				{-elseif:'template' == $e['e_type']-}
					{-:@TEMPLATE-}
				{-elseif:'patch' == $e['e_type']-}
					{-:@PATCH-}
				{-elseif:'other' == $e['e_type']-}
					{-:@OTHER-}
				{-:/if-}
				</td>
				<td>
				{-if:1 == $e['e_status']-}
					<span class="fc_g fs_11 br_3 br_g p_0_2">{-:@INSTALLED-}</span>
					<span class="fc_gry fs_11 br_3 br_gry p_0_2">{-:$e['e_install_datetime']|date~C('APP.TIME_FORMAT'),@me-}</span>
				{-else:-}
					<span class="fc_gry fs_11 br_3 br_gry p_0_2">{-:@NOT_INSTALLED-}</span>
				{-:/if-}
				</td>
				<td><a href="{-url:extension/show_extension?e_hashcode={$e['e_hashcode']}-}">{-:@DETAIL-}</a>
				{-if:1 == $e['e_status']-} | <a href="{-url:extension/uninstall_extension_do?e_hashcode={$e['e_hashcode']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@UNINSTALL-}</a>
				{-else:-} | <a href="{-url:extension/install_extension?e_hashcode={$e['e_hashcode']}-}">{-:@INSTALL-}</a> | <a href="{-url:extension/delete_extension_do?e_hashcode={$e['e_hashcode']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();" >{-:@DELETE-}</a>
				{-:/if-}</td>
			</tr>
			{-:/foreach-}
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<a class="btn_l" href="{-url:extension/upload_extension-}">{-:@UPLOAD_EXTENSION-}</a>
	<a class="btn_l" href="{-url:extension/package_extension-}">{-:@PACKAGE_EXTENSION-}</a>
</div><!--/#operation-->
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>