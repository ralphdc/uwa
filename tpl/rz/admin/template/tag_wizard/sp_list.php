<tr>
	<td align="right" valign="top" width="20%"><strong>{-:@SINGLE_PAGE-}</strong></td>
	<td>
		<label>
			<strong>{-:@GROUP-}</strong>
			<input id="sp_group" class="i" type="text" value="default" size="10" />
		</label>
		<label>
			<strong>{-:@OFFSET-}</strong>
			<input id="sp_list_offset" class="i" type="text" value="" size="5" />
		</label>
		<label>
			<strong>{-:@ROW-}</strong>
			<input id="sp_list_row" class="i" type="text" value="10" size="5" />
		</label>
		<label>
			<input id="sp_list_mobile" type="checkbox" />
			<span class="fc_gry">{-:@MOBILE_VERSION-}</span>
		</label>
		<span class="btn_b" onclick="build_tag_sp_list();">{-:@BUILD-}</span>
<script>
function build_tag_sp_list() {
	var group = $("#sp_group").val(),
		offset = $("#sp_list_offset").val(),
		row = $("#sp_list_row").val(),
		code = '{-php:echo '<';-}uwa:sp_list';

	if('' != group) {
		code += ' group="' + group + '"';
	}
	if('' != offset) {
		code += ' offset="' + offset + '"';
	}
	if('' != row) {
		code += ' row="' + row + '"';
	}

	code += '>\r\n';

	if($('#sp_list_mobile').get(0).checked) {
		code += '\t<a href="{-php:echo '{';-}-:$item[\'sp_url_o\']-}">{-php:echo '{';-}-:$item[\'sp_title\']-}</a>\r\n';
	}
	else {
		code += '\t<a href="{-php:echo '{';-}-:$item[\'sp_url\']-}">{-php:echo '{';-}-:$item[\'sp_title\']-}</a>\r\n';
	}

	code += '{-php:echo '<';-}/uwa:sp_list>';
	$('#code').val(code);
}
</script>
	</td>
</tr>

