<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/v.css" />
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/dialog/artdialog.css" />
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/calendar/calendar.css" />
<script src="{-:*__PUBLIC__-}js/calendar/calendar.js"></script>
<script src="{-:*__PUBLIC__-}js/calendar/lang/{-:+lang-}.js"></script>
</head>

<body>
<form id="formEdit" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@EDIT_VOTE-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@NAME-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_VI['v_name']-}" name="v_name" maxlength="96" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@V_NAME_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@DESCRIPTION-} <span class="fc_gry fw_n">{-:@V_DESCRIPTION_TIP-}</span></td>
				<td></td>
			</tr>
			<tr id="a_content">
				<td colspan="2" class="inputArea">
					<textarea class="i editor" name="v_description" style="width:450px;height:120px;">{-:$_VI['v_description']-}</textarea>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@TIME_LIMIT-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="v_time_limit"{-if:0==$_VI['v_time_limit']-} checked="checked"{-:/if-}> {-:@NOT_LIMIT-}</label>
					<label><input type="radio" value="1" name="v_time_limit"{-if:1==$_VI['v_time_limit']-} checked="checked"{-:/if-}> {-:@VALIDITY_PERIOD-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@V_TIME_LIMIT_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@VALIDITY_PERIOD-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="i calendar" type="text" value="{-:$_VI['v_start_time']|date~C('APP.TIME_FORMAT'),@me-}" format="{-:#APP.TIME_FORMAT-}" id="v_start_time" name="v_start_time" maxlength="20" size="20"> ~
					<input class="i calendar" type="text" value="{-:$_VI['v_end_time']|date~C('APP.TIME_FORMAT'),@me-}" format="{-:#APP.TIME_FORMAT-}" id="v_end_time" name="v_end_time" maxlength="20" size="20">
				</td>
				<td class="inputTip">
					{-:@VOTE_VALIDITY_PERIOD_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@VOTE_INTERVAL-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="{-:$_VI['v_interval']-}" name="v_interval" maxlength="20" size="10">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@V_INTERVAL_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@ALLOW_VIEW-}</td>
				<td class="inputTitle">{-:@IS_MULTI-}</td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="v_allow_view"{-if:0==$_VI['v_allow_view']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="v_allow_view"{-if:1==$_VI['v_allow_view']-} checked="checked"{-:/if-}> {-:@ON-}</label>
					<span class="fc_r">*</span> <span class="fc_gry">{-:@V_ALLOW_VIEW_TIP-}</span>
				</td>
				<td class="inputArea">
					<label><input type="radio" value="0" name="v_is_multi"{-if:0==$_VI['v_is_multi']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="v_is_multi"{-if:1==$_VI['v_is_multi']-} checked="checked"{-:/if-}> {-:@ON-}</label>
					<span class="fc_r">*</span> <span class="fc_gry">{-:@V_IS_MULTI_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@STATUS-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="0" name="v_status"{-if:0==$_VI['v_status']-} checked="checked"{-:/if-}> {-:@OFF-}</label>
					<label><input type="radio" value="1" name="v_status"{-if:1==$_VI['v_status']-} checked="checked"{-:/if-}> {-:@ON-}</label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@V_IS_MULTI_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@VOTE_OPTION-}</td>
				<td></td>
			</tr>
			<tr>
				<td colspan="2" class="inputTitle">
					<span class="btn_l" id="add_vote_option">{-:@ADD_VOTE_OPTION-}</span>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="inputArea">
					<ul id='vote_option_set'>
						{-foreach:$_VI['v_option_set'],$k,$vo-}<li k="{-:$k-}" class="a">
							<p><textarea name="v_option_set[{-:$k-}][description]" class="i required" style="width:260px;height:40px;" placeholder="{-:@DESCRIPTION-}" >{-:$vo['description']-}</textarea></p>
							<p><input type="text" name="v_option_set[{-:$k-}][link]" value="{-:$vo['link']-}" size="40" class="i" placeholder="{-:@LINK-}" /></p>
							<p><input type="text" name="v_option_set[{-:$k-}][votes]" value="{-:$vo['votes']-}" size="6" class="i required" placeholder="{-:@VOTES-}" /></p>
							<p><span class="btn_l delete">{-:@DELETE-}</span></p>
						</li>{-:/foreach-}
					</ul>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@V_TPL_RESULT-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="v_tpl_result" class="required i" type="text" value="{-:$_VI['v_tpl_result']-}" name="v_tpl_result" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="v_tpl_result">{-:@CHOOSE-}</span>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@V_TPL_RESULT_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@V_TPL_TAG-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="v_tpl_tag" class="required i" type="text" value="{-:$_VI['v_tpl_tag']-}" name="v_tpl_tag" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="v_tpl_tag">{-:@CHOOSE-}</span>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@V_TPL_TAG_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@V_TPL_JS-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input id="v_tpl_js" class="required i" type="text" value="{-:$_VI['v_tpl_js']-}" name="v_tpl_js" maxlength="255" size="40"> <span class="btn_l choose_template" base_dir="home" to_id="v_tpl_js">{-:@CHOOSE-}</span>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> {-:@V_TPL_JS_TIP-}
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<input type="hidden" value="{-:$_VI['vote_id']-}" name="vote_id">
	<span class="btn_b submit" action="{-url:vote/edit_vote_do-}" to="#formEdit">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:vote/list_vote-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/editor/ckeditor.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
$(document).ready(function() {
	var editor_option = {
		filebrowserBrowseUrl : '{-url:finder/browse?typeset=all&type=vote-}',
		filebrowserImageBrowseUrl : '{-url:finder/browse?typeset=image&type=vote-}',
		filebrowserUploadUrl : '{-url:upload/upload_file?typeset=all&upload_type=vote&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
		filebrowserImageUploadUrl : '{-url:upload/upload_file?typeset=image&upload_type=vote&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
		toolbar : [
			{ name: 'document', items : [ 'Source','-','Preview'] },
			{ name: 'clipboard', items : [ 'Cut','Copy','Paste','-','Undo','Redo' ] },
			{ name: 'editing', items : [ 'Replace','SelectAll'] },
			{ name: 'insert', items : [ 'Image','Table','SpecialChar' ] },
			{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
			{ name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] },
			'/',
			{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
			{ name: 'styles', items : [ 'Format','Font','FontSize' ] },
			{ name: 'colors', items : [ 'TextColor','BGColor' ] },
			{ name: 'tools', items : [ 'UwaPaging' ] },
			{ name: 'view', items : [ 'Maximize' ] }
		],
		width : 690, height : 90
	};
	$('.editor').each(function(){
		CKEDITOR.replace(this, editor_option);
	});
});

var url_choose_template_file = '{-url:template/choose_template_file-}',
	l_choose_template = '{-:@CHOOSE_TEMPLATE-}';

var l_votes = '{-:@VOTES-}',
	l_link = '{-:@LINK-}',
	l_description = '{-:@DESCRIPTION-}',
	l_delete = '{-:@DELETE-}';
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/cal.js"></script>
<script src="{-:*__THEME__-}admin/js/c_t.js"></script>
<script src="{-:*__THEME__-}admin/js/v.js"></script>
</body>
</html>