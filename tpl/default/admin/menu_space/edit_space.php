<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
</head>
<body>
<form id="formEdit" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@EDIT_MENU_SPACE-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@ALIAS-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_MSI['ms_alias']-}" name="ms_alias" maxlength="64" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@MS_ALIAS_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@NAME-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_MSI['ms_name']-}" name="ms_name" maxlength="64" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@MS_NAME_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@DESCRIPTION-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" type="text" name="ms_description" style="width:360px;height:60px;">{-:$_MSI['ms_description']-}</textarea>
				</td>
				<td class="inputTip">
					{-:@MS_DESCRIPTION_TIP-}
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<input type="hidden" value="{-:$_MSI['menu_space_id']-}" name="menu_space_id">
	<span class="btn_b submit" action="{-url:menu_space/edit_space_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:menu_space/list_space-}">{-:@BACK-}</a>
</div>
</form>
<dl class="abox">
	<dt><strong>{-:@CODE-}</strong></dt>
	<dd>
		<span>HTML{-:@CODE-}</span>
		<code style="font-family:'Courier New'; display:block" class="fs_14 bg_gry_d fc_wht p_10 br_5">
&lt;uwa:menu alias=&quot;{-:$_MSI['ms_alias']-}&quot;&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&lt;a href=&quot;{-php:echo '{';-}-:$m['url']-}&quot; title=&quot;{-php:echo '{';-}-:$m['m_tip']-}&quot; target=&quot;{-php:echo '{';-}-:$m['m_target']-}&quot;&gt;{-php:echo '{';-}-:$m['m_name']-}&lt;/a&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;{-php:echo '{';-}-if:!empty($m['m_sub_menu'])-}&lt;span&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;{-php:echo '{';-}-foreach:$m['m_sub_menu'],$ms-}<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;a href=&quot;{-php:echo '{';-}-:$ms['url']-}&quot; title=&quot;{-php:echo '{';-}-:$ms['m_tip']-}&quot; target=&quot;{-php:echo '{';-}-:$ms['m_target']-}&quot;&gt;{-php:echo '{';-}-:$ms['m_name']-}&lt;/a&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;{-php:echo '{';-}-:/foreach-}<br />
&nbsp;&nbsp;&nbsp;&nbsp;&lt;/span&gt;{-php:echo '{';-}-:/if-}<br />
&lt;/uwa:menu&gt;
		</code>
	</dd>
</dl><!--/.abox-->
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>