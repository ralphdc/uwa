<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/dialog/artdialog.css" />
<style>
.progressBarBox{margin:10px auto;padding:2px;height:20px;width:80%;background:#eee;border:1px solid #ccc;border-radius:5px;box-shadow:0 0 5px rgba(0,0,0,0.2) inset}
.progressBarBox .progressBar{width:20%;height:20px;background:#3d6dcc;background-position:0 0;border-radius:3px}
#progressInfo{width:80%;margin:10px auto}
</style>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
</head>
<body>
<dl class="abox">
	<dt><strong>{-:@SCAN_CODE-}</strong><span><a href="{-url:toolbox/build_verify_file?timeKey={$_TK['timeKey']}&token={$_TK['token']}-}">{-:@BUILD_VERIFY_FILE-}</a></span></dt>
	<dd id="scan_form">
		<div class="mainTips">
			{-:@SCAN_CODE_TIP-}
		</div>
	<form id="formScan" action="" method="post">
		<table class="listTable">
			<tr>
				<th colspan="2" scope="col">{-:@SCAN_CODE-}</th>
			</tr>
			<tr>
				<td rowspan="5" width="200">
			{-foreach:$_TSD,$dir,$name-}
					<label style="display:inline-block;padding:5px;width:80%"><input name="tsd[]" type="checkbox" value="{-:$dir-}"{-if:in_array($dir, $_V['tsd'])-} checked="checked"{-:/if-} /> <i class="ai ai_16 ai_16_file_type_folder"></i> {-:$dir-} <span class="br_3 br_gry_l fc_gry fs_11 p_2_5">{-:$name-}</span></label>
			{-:/foreach-}</td>
				<td><strong>{-:@FILE_TYPE-}</strong><br /> <input name="file_type" class="i required" type="text" value="{-:$_V['file_type']-}" size="50" /> <span class="fc_gry"><span class="fc_r">*</span>{-:@SCAN_FILE_TYPE_TIP-}</span></td>
			</tr>
			<tr>
				<td><strong>{-:@FUNCTION_NAME-}</strong><br /> <input name="function_name" class="i" type="text" value="{-:$_V['function_name']-}" size="50" /> <span class="fc_gry">{-:@SCAN_FUNCTION_NAME_TIP-}</span></td>
			</tr>
			<tr>
				<td><strong>{-:@FEATURE_CODE-}</strong><br /> <input name="feature_code" class="i" type="text" value="{-:$_V['feature_code']-}" size="50" /> <span class="fc_gry">{-:@FEATURE_CODE_TIP-}</span></td>
			</tr>
			<tr>
				<td><strong>{-:@VERIFY_FILE-}</strong><br /> 
				<select name="verify_file">
					<option value="">{-:@SELECT_VERIFY_FILE-}</option>
				{-foreach:$_VFL,$vf-}
					<option value="{-:$vf['file']-}"{-if:$vf['file'] == $_V['verify_file']-} selected="selected"{-:/if-}>{-:$vf['file']-}</option>
				{-:/foreach-}
				</select>
				<span class="fc_gry">{-:@VERIFY_FILE_TIP-}</span></td>
			</tr>
			<tr>
				<td>
					<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
					<input name="token" type="hidden" value="{-:$_TK['token']-}">
					<input name="action" type="hidden" value="scan" />
					<span class="btn_b submit" action="{-url:toolbox/scan_code-}" to="#formScan">{-:@SCAN-}</span>
					<input class="btn_l" type="reset" value="{-:@RESET-}" />
					<label><input type="checkbox" name="ignore_case" value="1"{-if:$_V['ignore_case']-} checked="checked"{-:/if-} /> {-:@IGNORE_CASE-}</label>
				</td>
			</tr>
		</table>
	</form>
	</dd>
</dl><!--/.abox-->
<div id="progress" style="margin-top:20px;display:none;">
	<div class="progressBarBox"><div id="progressBar" class="progressBar"></div></div>
	<div id="progressInfo">progressInfo</div>
</div>
<div id="rescan_tip" class="mainTips" style="margin-top:10px;display:none;">
	{-:@SCAN_FINISH_TIP-} <span class="btn_l" onclick="$('#rescan_tip').hide();$('#scan_form').show();">{-:@RESCAN-}</span>
</div>
<dl id="suspicious_file" class="abox" style="display:none;">
	<dt><strong>{-:@SUSPICIOUS_FILE_LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="40">{-:@ID-}</th>
				<th scope="col">{-:@FILENAME-}</th>
				<th scope="col">{-:@EDIT_TIME-}</th>
				<th scope="col">{-:@TYPE-}</th>
				<th scope="col">{-:@FEATURE-}</th>
				<th scope="col">{-:@COUNT-}</th>
				<th scope="col">{-:@VERIFY_STATUS-}</th>
				<th scope="col">{-:@VIEW-}</th>
			</tr>
			<tr id="suspicious_file_end"><td colspan="8"></td></tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="show_code" style="display:none;">
	<textarea class="i" style="width:700px;height:360px"></textarea>
</div>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script>
$(document).on('click', '.view_file', function() {
	var filename = $(this).attr('filename');
	$.getJSON('{-url:ajax/get_file_content-}'+'&filename='+filename+'&'+Math.random(), function(result) {
		if(1 == result.data) {
			$('#show_code textarea').text(result.info);
		}
	});
	dialog({
		title:'{-:@VIEW_COUNT-}',
		content:document.getElementById('show_code')
	}).showModal();
});
$(document).on('click', '.delete_file', function() {
	var filename = $(this).attr('filename');
	$.getJSON('{-url:ajax/delete_file?timeKey={$_TK['timeKey']}&token={$_TK['token']}-}'+'&filename='+filename+'&'+Math.random(), function(result) {
		if(1 == result.data) {
			$('[filename="'+filename+'"]').parent().parent().remove();
		}
		var d = dialog({
			time:2,
			content:result.info
		});
		d.showModal();
		setTimeout(function () {
			d.close().remove();
		}, 2000);
	});
});

function start_progress(message) {
	$('#scan_form').hide();
	$('#progress').show();
	$('#progressInfo').html(message);
	$('#progressBar').css({'width':0});
}
function show_progress(message, barLength) {
	$('#progressInfo').html(message);
	$('#progressBar').css({'width':barLength});
}
function finish_progress(message) {
	$('#progressInfo').html(message);
	$('#progressBar').css({'width':"100%"});
	$('#progress').hide();
	$('#rescan_tip').show();
}
function show_suspicious_file() {
	$('#suspicious_file').show();
}
function add_suspicious_file(k, filename, edit_time, type, feature, count, verified, verify_info) {
		var status = '';
		switch(verified) {
			case 0:
				status = "fc_gry";
				break;
			case 1:
				status = "fc_g";
				break;
			case 2:
				status = "fc_r";
				break;
			default:
				status = "fc_gry";
		}
		var content = '<tr><td>'+k+'</td><td>'+filename+'</td><td>'+edit_time+'</td><td>'+type+'</td><td>'+feature+'</td><td>'+count+'</td><td><span class="'+status+'">'+verify_info+'</span></td><td>';
			content += '<span class="btn_l delete_file" filename="'+filename+'">{-:@DELETE-}</span> <span class="btn_l view_file" filename="'+filename+'">{-:@VIEW-}</span></td></tr>';
	$('#suspicious_file_end').before(content);
}
</script>
</body>
</html>