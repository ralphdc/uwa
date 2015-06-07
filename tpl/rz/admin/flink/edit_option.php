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
	<dt><span><a href="{-url:flink/list_flink-}">{-:@FLINK_LIST-}</a></span><strong>{-:@FLINK_OPTION-}</strong></dt>
	<dd>
		<div class="tabCntnt">
			<table id="main_params" class="formTable">
				<tr>
					<td class="inputTitle">{-:@FLINK_SWITCH-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<label><input type="radio" value="0" name="switch"{-if:0==$_O['switch']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
						<label><input type="radio" value="1" name="switch"{-if:1==$_O['switch']-} checked="checked"{-:/if-}> {-:@ON-}</label>
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@FLINK_SWITCH_TIP-}
					</td>
				</tr>
				<tr>
					<td class="inputTitle">{-:@PAGE_SIZE-}</td>
					<td class=""></td>
				</tr>
				<tr>
					<td class="inputArea">
						<input class="i required" type="text" value="{-:$_O['page_size']-}" name="page_size" maxlength="10" size="4" />
					</td>
					<td class="inputTip">
						<span class="fc_r">*</span> {-:@FLINK_PAGE_SIZE_TIP-}
					</td>
				</tr>
			</table>
		</div><!--/.tabCntnt-->
	</dd>
</dl><!--/.atab-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:flink/edit_option_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>