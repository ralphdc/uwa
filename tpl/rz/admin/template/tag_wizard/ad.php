<tr>
	<td align="right" width="20%" valign="top"><strong>{-:@AD-}</strong></td>
	<td>
		<label>
			<select id="ad_id">
			{-php:$_ASL = M('AdSpace')->get_spaceList(false);-}
			{-foreach:$_ASL,$as-}
				<option value="{-:$as['ad_space_id']-}">{-:$as['as_name']-}</option>
			{-:/foreach-}
			</select>
		</label>
		<label>
			<strong>{-:@TEMPLATE-}</strong>
			<input id="ad_tpl" class="i" type="text" value="" size="20" /> <span class="btn_l choose_template" base_dir="home" to_id="ad_tpl">{-:@CHOOSE-}</span>
		</label>
		<span class="btn_b" onclick="build_tag_ad();">{-:@BUILD-}</span>
		<span class="fc_gry">{-:@TAG_AD_TPL_TIP-}</span>
<script>
function build_tag_ad() {
	var id = $("#ad_id option:selected").val(),
		ad_tpl = $("#ad_tpl").val(),
		code = '{-php:echo '<';-}uwa:ad';
	if('' != id) {
		code += ' id="' + id + '"';
	}
	else {
		return false;
	}
	if('' != ad_tpl) {
		code += ' tpl="' + ad_tpl + '"';
	}
	code += '>';
	$('#code').val(code);
}
</script>
	</td>
</tr>

