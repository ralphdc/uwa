<tr>
	<td align="right" width="20%" valign="top"><strong>{-:@VOTE-}</strong></td>
	<td>
		<label>
			<select id="vote_id">
			{-php:$_VL = M('Vote')->get_voteList(false);-}
			{-foreach:$_VL,$v-}
				<option value="{-:$v['vote_id']-}">{-:$v['v_name']-}</option>
			{-:/foreach-}
			</select>
		</label>
		<label>
			<strong>{-:@TEMPLATE-}</strong>
			<input id="vote_tpl" class="i" type="text" value="" size="20" /> <span class="btn_l choose_template" base_dir="home" to_id="vote_tpl">{-:@CHOOSE-}</span>
		</label>
		<span class="btn_b" onclick="build_tag_vote();">{-:@BUILD-}</span>
		<span class="fc_gry">{-:@TAG_VOTE_TPL_TIP-}</span>
<script>
function build_tag_vote() {
	var id = $("#vote_id option:selected").val(),
		vote_tpl = $("#vote_tpl").val(),
		code = '{-php:echo '<';-}uwa:vote';
	if('' != id) {
		code += ' id="' + id + '"';
	}
	else {
		return false;
	}
	if('' != vote_tpl) {
		code += ' tpl="' + vote_tpl + '"';
	}
	code += '>';
	$('#code').val(code);
}
</script>
	</td>
</tr>

