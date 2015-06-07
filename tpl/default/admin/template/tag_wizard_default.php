<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/dialog/artdialog.css" />
</head>
<body>
<dl class="atab">
	<dt><strong>{-:@ARCHIVE-}</strong><strong>{-:@OTHER-}</strong></dt>
	<dd>
		<div class="tabCntnt">
		<table class="listTable">
			<tr>
				<td>
					<label>
						<strong>{-:@CHANNEL-}</strong>
						<select id="a_list_cid">
							<option value="">{-:@PAGE_ENVIRONMENT-}</option>
							<option value="all">{-:@NOT_LIMIT-}</option>
							{-:$_ACLStr-}
						</select>
					</label>
					<label>
						<strong>{-:@ROW-}</strong>
						<input id="a_list_row" class="i" type="text" value="10" size="5" />
					</label>
					<span class="btn_l" onclick="build_tag_ac_list();">{-:@BUILD_CHANNEL_LIST-}</span>
					<label>
						<input id="ac_list_mobile" type="checkbox" />
						<span class="fc_gry">{-:@MOBILE_VERSION-}</span>
					</label>
					<label>
						<input id="ac_list_issub" type="checkbox" />
						<span class="fc_gry">{-:@TAG_AC_LIST_ISSUB_TIP-}</span>
					</label>
				</td>
			</tr>
			<tr>
				<td>
					<label>
						<strong>{-:@FLAG-}</strong>
						<select id="a_list_flag">
							<option value="">{-:@NOT_LIMIT-}</option>
						{-foreach:$_AFL,$f-}
							<option value="{-:$f['af_alias']-}">{-:$f['af_name']-}</option>
						{-:/foreach-}
						</select>
					</label>
					<label>
						<strong>{-:@TITLE_LENGTH-}</strong>
						<input id="a_list_titlelen" class="i" type="text" value="20" size="5" />
						<span class="fc_gry">{-:@TAG_A_LIST_TITLELEN_TIP-}</span>
					</label>
				</td>
			</tr>
			<tr>
				<td>
					<label>
						<strong>{-:@DAYS_LIMIT-}</strong>
						<input id="a_list_days" class="i" type="text" value="" size="5" />
						<span class="fc_gry">{-:@TAG_A_LIST_DAYS_TIP-}</span>
					</label>
					<label>
						<strong>{-:@KEYWORDS-}</strong>
						<input id="a_list_keywords" class="i" type="text" value="" size="10" />
						<span class="fc_gry">{-:@TAG_A_LIST_KEYWORDS_TIP-}</span>
					</label>
				</td>
			</tr>
			<tr>
				<td>
					<label>
						<strong>{-:@ORDER-}</strong>
						<select id="a_list_orderby">
							<option value="">{-:@DISPLAY_ORDER-}</option>
							<option value="archive_id">{-:@ID-}</option>
							<option value="a_edit_time">{-:@EDIT_TIME-}</option>
							<option value="a_rank">{-:@RANK-}</option>
							<option value="a_view_count">{-:@VIEW_COUNT-}</option>
							<option value="a_support_count">{-:@SUPPORT_COUNT-}</option>
							<option value="random">{-:@RANDOM-}</option>
						</select>
					</label>
					<label>
						<select id="a_list_order">
							<option value="">{-:@ORDER-}</option>
							<option value="desc">{-:@DESC-}</option>
							<option value="asc">{-:@ASC-}</option>
						</select>
					</label>
					<label>
						<strong>{-:@OFFSET-}</strong>
						<input id="a_list_offset" class="i" type="text" value="" size="5" />
						<span class="fc_gry">{-:@TAG_A_LIST_OFFSET_TIP-}</span>
					</label>
				</td>
			</tr>
			<tr>
				<td>
					<label>
						<strong>{-:@LIST_ITEM-}</strong><br />
						<textarea id="a_list_list_item" class="i" style="width:95%;height:50px;">[<a href="{-php:echo '{';-}-:$item['ac_url']-}">{-php:echo '{';-}-:$item['ac_name']-}</a>] <a href="{-php:echo '{';-}-:$item['a_url']-}">{-php:echo '{';-}-:$item['a_title']-}</a><br /></textarea>
						<p class="fc_gry">{-:@TAG_A_LIST_LIST_ITEM_TIP-}</p>
					</label>
				</td>
			</tr>
			<tr>
				<td>
					<span class="btn_b" onclick="build_tag_a_list();">{-:@BUILD-}</span>
					<label>
						<input id="a_list_issub" type="checkbox" />
						<span class="fc_gry">{-:@TAG_A_LIST_ISSUB_TIP-}</span>
					</label>
				</td>
			</tr>
		</table>
		</div><!--/ARCHIVE-->
		<div class="tabCntnt">
			<div class="mainTips">
				<a class="btn_l" href="{-url:template/update_tag_wizard_list_do-}">{-:@UPDATE_TAG_WIZARD_LIST-}</a>
				<span class="fs_12 fc_gry">{-:@UPDATE_TAG_WIZARD_LIST_TIP-}</span>
			</div>
			<table class="listTable">
				~tag_wizard~
			</table>
		</div><!--/OTHER-->
	</dd>
</dl><!--/.atab-->
<form id="formPreview" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@GET_CODE-}</strong></dt>
	<dd>
		<textarea id="code" name="code" class="i" style="width:95%;height:160px;"></textarea>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<span class="btn_l submit" action="{-url:template/tag_preview-}" to="#formPreview">{-:@TAG_PREVIEW-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
function build_tag_a_list() {
	var cid = $("#a_list_cid option:selected").val(),
		flag = $("#a_list_flag option:selected").val(),
		days = $("#a_list_days").val(),
		keywords = $("#a_list_keywords").val(),
		offset = $("#a_list_offset").val(),
		row = $("#a_list_row").val(),
		titlelen = $("#a_list_titlelen").val(),
		orderby = $("#a_list_orderby option:selected").val(),
		order = $("#a_list_order option:selected").val(),
		code = '{-php:echo '<';-}uwa:a_list';

	if('' != cid) {
		code += ' cid="'+cid+'"';
	}
	else if($('#a_list_issub').get(0).checked) {
		code += ' issub="yes"';
	}
	if('' != flag) {
		code += ' flag="'+flag+'"';
	}
	if('' != days) {
		code += ' days="'+days+'"';
	}
	if('' != keywords) {
		code += ' keywords="'+keywords+'"';
	}
	if('' != offset) {
		code += ' offset="'+offset+'"';
	}
	if('' != row) {
		code += ' row="'+row+'"';
	}
	if('' != titlelen) {
		code += ' titlelen="'+titlelen+'"';
	}
	if('' != orderby) {
		code += ' orderby="'+orderby+'"';
	}
	if('' != order) {
		code += ' order="'+order+'"';
	}
	
	code += '>\r\n';
	code += '\t'+$('#a_list_list_item').val()+'\r\n';
	code += '{-php:echo '<';-}/uwa:a_list>';
	$('#code').val(code);
}

function build_tag_ac_list() {
	var cid = $("#a_list_cid option:selected").val(),
		row = $("#a_list_row").val(),
		code = '{-php:echo '<';-}uwa:ac_list';

	if('' != cid) {
		code += ' cid="'+cid+'"';
	}
	else if($('#ac_list_issub').get(0).checked) {
		code += ' issub="yes"';
	}
	if('' != row) {
		code += ' row="'+row+'"';
	}
	
	code += '>\r\n';
	
	if($('#ac_list_mobile').get(0).checked) {
		code += '\t<a href="{-php:echo '{';-}-:$channel[\'ac_url_o\']-}">{-php:echo '{';-}-:$channel[\'ac_name\']-}</a>\r\n';
	}
	else {
		code += '\t<a href="{-php:echo '{';-}-:$channel[\'ac_url\']-}">{-php:echo '{';-}-:$channel[\'ac_name\']-}</a>\r\n';
	}

	code += '{-php:echo '<';-}/uwa:ac_list>';
	$('#code').val(code);
}

var url_choose_template_file = '{-url:template/choose_template_file-}',
	l_choose_template = '{-:@CHOOSE_TEMPLATE-}';
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/c_t.js"></script>
</body>
</html>