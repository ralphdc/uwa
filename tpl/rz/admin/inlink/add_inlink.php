<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
</head>
<body>
<form id="formAdd" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@ADD_INLINK-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@WORD-}</td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="" name="il_word" maxlength="96" size="30">
					<span class="fc_gry"><span class="fc_r">*</span> <span class="fc_gry">{-:@IL_WORD_TIP-}</span></span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@TITLE-}</td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="il_title" style="width:480px;height:90px;"></textarea>
					<span class="fc_gry"><span class="fc_r">*</span> <span class="fc_gry">{-:@IL_TITLE_TIP-}</span></span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@URL-}</td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="http://" name="il_url" maxlength="255" size="50">
					<span class="fc_gry"><span class="fc_r">*</span> <span class="fc_gry">{-:@IL_URL_TIP-}</span></span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@TARGET-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="target" class="required i" type="text" name="il_target" size="20" value="_blank">
					<select id="target_select" onchange="$('#target').val($('#target_select').val());">
						<option value="">{-:@SELECT-}</option>
						<option{-if:'_self'==$_O['target']-} selected="selected"{-:/if-} value="_self">{-:@SELF_WINDOW-}</option>
						<option{-if:'_blank'==$_O['target']-} selected="selected"{-:/if-} value="_blank">{-:@NEW_WINDOW-}</option>
						<option{-if:'_parent'==$_O['target']-} selected="selected"{-:/if-} value="_parent">{-:@PARENT_FRAME-}</option>
						<option{-if:'_top'==$_O['target']-} selected="selected"{-:/if-} value="_top">{-:@TOP_FRAME-}</option>
						<option value="">{-:@CUSTOM-}</option>
					</select>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@IL_TARGET_TIP-}</span>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:inlink/add_inlink_do-}" to="#formAdd">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:inlink/list_inlink-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>