<tr>
	<td align="right" valign="top" width="20%"><strong>{-:@FLINK-}</strong></td>
	<td>
		<label>
			<select id="fl_list_cid">
				<option value="">{-:@CATEGORY-}</option>
			{-php:$_FCL = M('FlinkCategory')->get_categoryList();-}
			{-foreach:$_FCL,$fc-}
				<option value="{-:$fc['flink_category_id']-}">{-:$fc['fc_name']-}</option>
			{-:/foreach-}
			</select>
		</label>
		<label>
			<select id="fl_list_type">
				<option value="">{-:@TYPE-}</option>
				<option value="text">{-:@TEXT_LINK-}</option>
				<option value="logo">{-:@LOGO_LINK-}</option>
			</select>
		</label>
		<label>
			<strong>{-:@OFFSET-}</strong>
			<input id="fl_list_offset" class="i" type="text" value="" size="5" />
		</label>
		<label>
			<strong>{-:@ROW-}</strong>
			<input id="fl_list_row" class="i" type="text" value="10" size="5" />
		</label>
		<span class="btn_b" onclick="build_tag_fl_list();">{-:@BUILD-}</span>
<script>
function build_tag_fl_list() {
	var cid = $("#fl_list_cid option:selected").val(),
		type = $("#fl_list_type option:selected").val(),
		offset = $("#fl_list_offset").val(),
		row = $("#fl_list_row").val(),
		code = '{-php:echo '<';-}uwa:fl_list';

	if('' != cid) {
		code += ' cid="' + cid + '"';
	}
	if('' != type) {
		code += ' type="' + type + '"';
	}
	if('' != offset) {
		code += ' offset="' + offset + '"';
	}
	if('' != row) {
		code += ' row="' + row + '"';
	}

	code += '>\r\n';
	code += '\t[{-php:echo '{';-}-:$item[\'fc_name\']-}] <a href="{-php:echo '{';-}-:$item[\'f_site_url\']-}">{-php:echo '{';-}-:$item[\'f_site_name\']-}</a>\r\n';
	code += '{-php:echo '<';-}/uwa:fl_list>';
	$('#code').val(code);
}
</script>
	</td>
</tr>

