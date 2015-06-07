<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
</head>
<body>
<form id="formImport" action="" method="post" enctype="multipart/form-data">
<dl class="abox">
	<dt><strong>{-:@UPLOAD_MODEL-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@PACKAGE_FILE-}</td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="file" name="uwa_package_file" /></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">* {-:@UWA_PACKAGE_FILE_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" name="compressed" value="0"> {-:@UNCOMPRESSED-}</label>
					<label><input type="radio" name="compressed" value="1" checked="checked"> {-:@COMPRESSED-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@MEMBER_MODEL_COMPRESSED_TIP-}
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:member_model/import_model_guide-}" to="#formImport">{-:@UPLOAD-}</span>
	<a class="btn_l" href="{-url:member_model/list_model-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>