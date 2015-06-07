<tr>
	<td align="right" valign="top" width="20%"><strong>{-:@TAG-}</strong></td>
	<td>
		<label>
			<strong>{-:@ORDER-}</strong>
			<select id="tag_list_orderby">
				<option value="">{-:@DISPLAY_ORDER-}</option>
				<option value="tag_id">{-:@ID-}</option>
				<option value="t_add_time">{-:@ADD_TIME-}</option>
				<option value="t_update_time">{-:@UPDATE_TIME-}</option>
				<option value="t_archive_count">{-:@ARCHIVE_COUNT-}</option>
				<option value="t_view_count">{-:@VIEW_COUNT-}</option>
			</select>
		</label>
		<label>
			<select id="tag_list_order">
				<option value="">{-:@ORDER-}</option>
				<option value="desc">{-:@DESC-}</option>
				<option value="asc">{-:@ASC-}</option>
			</select>
		</label>
		<label>
			<strong>{-:@DAYS_LIMIT-}</strong>
			<input id="tag_list_days" class="i" type="text" value="" size="5" />
		</label>
		<label>
			<strong>{-:@OFFSET-}</strong>
			<input id="tag_list_offset" class="i" type="text" value="" size="5" />
		</label>
		<label>
			<strong>{-:@ROW-}</strong>
			<input id="tag_list_row" class="i" type="text" value="10" size="5" />
		</label>
		<span class="btn_b" onclick="build_tag_tag_list();">{-:@BUILD-}</span>
<script>
function build_tag_tag_list() {
	var orderby = $("#tag_list_orderby option:selected").val(),
		order = $("#tag_list_order option:selected").val(),
		days = $("#tag_list_days").val(),
		offset = $("#tag_list_offset").val(),
		row = $("#tag_list_row").val(),
		code = '{-php:echo '<';-}uwa:tag_list';

	if('' != orderby) {
		code += ' orderby="' + orderby + '"';
	}
	if('' != order) {
		code += ' order="' + order + '"';
	}
	if('' != days) {
		code += ' days="' + days + '"';
	}
	if('' != offset) {
		code += ' offset="' + offset + '"';
	}
	if('' != row) {
		code += ' row="' + row + '"';
	}

	code += '>\r\n';
	code += '\t<a href="{-php:echo '{';-}-:$item[\'t_url\']-}">{-php:echo '{';-}-:$item[\'t_name\']-}</a>\r\n';
	code += '{-php:echo '<';-}/uwa:tag_list>';
	$('#code').val(code);
}
</script>
	</td>
</tr>

