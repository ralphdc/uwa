{-php:
if(!is_null($_fi['data']) and isset($_fi['data'][$_fi['tag']])) {
	$_fi['params']['f_default'] = $_fi['data'][$_fi['tag']];
}
-}

<tr><td colspan="2" class="inputTitle">{-:$_fi['params']['f_item_name']-}</td></tr>
<tr><td colspan="2" class="inputArea">
{-if:is_array($_fi['params']['f_default'])-}
	{-foreach:$_fi['params']['f_default'],$k,$_pfd-}
		<p>
			<input id="{-:$_fi['tag']-}_{-:$k-}" class="i" type="text" value="{-:$_pfd-}" name="{-:$_fi['tag'][$k]-}" maxlength="{-:$_fi['params']['f_length']-}" size="70" />
		</p>
	{-:/foreach-}
{-else:-}
	<textarea class="i" name="{-:$_fi['tag']-}" style="width:360px;height:60px;">{-:$_fi['params']['f_default']-}</textarea>
{-:/if-}
</td></tr>

