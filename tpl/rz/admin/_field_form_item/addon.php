{-php:
if(!is_null($_fi['data']) and isset($_fi['data'][$_fi['tag']])) {
	$_fi['params']['f_default'] = $_fi['data'][$_fi['tag']];
}
-}

<tr><td colspan="2" class="inputTitle">{-:$_fi['params']['f_item_name']-}</td></tr>
<tr><td colspan="2" class="inputArea">
{-if:is_array($_fi['params']['f_default'])-}
	{-foreach:$_fi['params']['f_default'],$k,$_pfd-}<p>
		<input id="{-:$_fi['tag']-}_{-:$k-}" class="i" type="text" value="{-:$_pfd-}" name="{-:$_fi['tag'][$k]-}" maxlength="{-:$_fi['params']['f_length']-}" size="70" />
		<input id="{-:$_fi['tag']-}_{-:$k-}_uploader' to="#{-:$_fi['tag']-}_{-:$k-}" btntext="{-:@UPLOAD-}" class="uploader" typeset="all" type="file" />
		{-if:1 == $_fi['params']['f_browse_server']-}
			<span id="{-:$_fi['tag']-}_{-:$k-}_finder" to="#{-:$_fi['tag']-}_{-:$k-}" typeset="all" class="btn_l finder">{-:@BROWSE_SERVER-}</span>
		{-:/if-}
	</p>{-:/foreach-}
{-else:-}
	{-if:1 == $_fi['params']['f_multi_upload']-}
		<textarea id="{-:$_fi['tag']-}" class="i" name="{-:$_fi['tag']-}" style="width:480px;height:60px;">{-:$_fi['params']['f_default']-}</textarea>
		<input id="{-:$_fi['tag']-}_uploader" to="#{-:$_fi['tag']-}" multi_upload="yes" btntext="{-:@UPLOAD-}" class="uploader" typeset="all" type="file" />
		{-if:1 == $_fi['params']['f_browse_server']-}
			<span id="{-:$_fi['tag']-}_finder" to="#{-:$_fi['tag']-}" multi_upload="yes" typeset="all" class="btn_l finder">{-:@BROWSE_SERVER-}</span>
		{-:/if-}
	{-else:-}
		<input id="{-:$_fi['tag']-}" class="i" type="text" value="{-:$_fi['params']['f_default']-}" name="{-:$_fi['tag']-}" maxlength="{-:$_fi['params']['f_length']-}" size="70" />
		<input id="{-:$_fi['tag']-}_uploader" to="#{-:$_fi['tag']-}" btntext="{-:@UPLOAD-}" class="uploader" typeset="all" type="file" />
		{-if:1 == $_fi['params']['f_browse_server']-}
			<span id="{-:$_fi['tag']-}_finder" to="#{-:$_fi['tag']-}" typeset="all" class="btn_l finder">{-:@BROWSE_SERVER-}</span>
		{-:/if-}
	{-:/if-}
{-:/if-}

</td></tr>
