<tr>
	<td align="right" valign="top" width="20%"><strong>{-:@GUESTBOOK-}</strong></td>
	<td>
		<label>
			<strong>{-:@OFFSET-}</strong>
			<input id="gb_list_offset" class="i" type="text" value="" size="5" />
		</label>
		<label>
			<strong>{-:@ROW-}</strong>
			<input id="gb_list_row" class="i" type="text" value="10" size="5" />
		</label>
		<span class="btn_b" onclick="build_tag_gb_list();">{-:@BUILD-}</span>
<script>
function build_tag_gb_list() {
	var offset = $("#gb_list_offset").val(),
		row = $("#gb_list_row").val(),
		code = '{-php:echo '<';-}uwa:gb_list';
	if('' != offset) {
		code += ' offset="' + offset + '"';
	}
	if('' != row) {
		code += ' row="' + row + '"';
	}

	code += '>\r\n';
	code += '\t{-php:echo '{';-}-:$item[\'g_author\']-}: {-php:echo '{';-}-:$item[\'g_content\']-} [{-php:echo '{';-}-:$item[\'g_add_time\']|date~\'Y-m-d H:i:s\',@me-}]\r\n';
	code += '{-php:echo '<';-}/uwa:gb_list>';
	$('#code').val(code);
}
</script>
	</td>
</tr>

