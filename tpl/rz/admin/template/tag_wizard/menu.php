<tr>
	<td align="right" valign="top" width="20%"><strong>{-:@MENU-}</strong></td>
	<td>
		<label>
			<select id="menu_alias">
			{-php:$_MSL = M('MenuSpace')->get_spaceList();-}
			{-foreach:$_MSL,$ms-}
				<option value="{-:$ms['ms_alias']-}">{-:$ms['ms_name']-}</option>
			{-:/foreach-}
			</select>
		</label>
		<label>
			<input id="menu_mobile" type="checkbox" />
			<span class="fc_gry">{-:@MOBILE_VERSION-}</span>
		</label>
		<span class="btn_b" onclick="build_tag_menu();">{-:@BUILD-}</span>
<script>
function build_tag_menu() {
	var alias = $("#menu_alias option:selected").val(),
		code = '{-php:echo '<';-}uwa:menu';

	if('' == alias) {
		return false;
	} 

	if($('#menu_mobile').get(0).checked) {
		code += ' alias="' + alias + '">\r\n';
		code += '\t<a href="{-php:echo '{';-}-:$m[\'url_o\']-}" title="{-php:echo '{';-}-:$m[\'m_tip\']-}" target="{-php:echo '{';-}-:$m[\'m_target\']-}">{-php:echo '{';-}-:$m[\'m_name\']-}</a>\r\n';
		code += '\t{-php:echo '{';-}-if:!empty($m[\'m_sub_menu\'])-}<span>\r\n';
		code += '\t{-php:echo '{';-}-foreach:$m[\'m_sub_menu\'],$ms-}\r\n';
		code += '\t\t<a href="{-php:echo '{';-}-:$ms[\'url_o\']-}" title="{-php:echo '{';-}-:$ms[\'m_tip\']-}" target="{-php:echo '{';-}-:$ms[\'m_target\']-}">{-php:echo '{';-}-:$ms[\'m_name\']-}</a>\r\n';
		code += '\t{-php:echo '{';-}-:/foreach-}\r\n';
		code += '\t</span>{-php:echo '{';-}-:/if-}\r\n';
	}
	else {
		code += ' alias="' + alias + '">\r\n';
		code += '\t<a href="{-php:echo '{';-}-:$m[\'url\']-}" title="{-php:echo '{';-}-:$m[\'m_tip\']-}" target="{-php:echo '{';-}-:$m[\'m_target\']-}">{-php:echo '{';-}-:$m[\'m_name\']-}</a>\r\n';
		code += '\t{-php:echo '{';-}-if:!empty($m[\'m_sub_menu\'])-}<span>\r\n';
		code += '\t{-php:echo '{';-}-foreach:$m[\'m_sub_menu\'],$ms-}\r\n';
		code += '\t\t<a href="{-php:echo '{';-}-:$ms[\'url\']-}" title="{-php:echo '{';-}-:$ms[\'m_tip\']-}" target="{-php:echo '{';-}-:$ms[\'m_target\']-}">{-php:echo '{';-}-:$ms[\'m_name\']-}</a>\r\n';
		code += '\t{-php:echo '{';-}-:/foreach-}\r\n';
		code += '\t</span>{-php:echo '{';-}-:/if-}\r\n';
	}
	code += '{-php:echo '<';-}/uwa:menu>';
	$('#code').val(code);
}
</script>
	</td>
</tr>

