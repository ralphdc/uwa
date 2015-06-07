{-php:
$_data = '';
if(!is_null($_fi['data']) and isset($_fi['data'][$_fi['tag']])) {
	$_data = $_fi['data'][$_fi['tag']];
}
if(!empty($_fi['params']['f_default'])) {
	$_t = explode(',', $_fi['params']['f_default']);
}
-}

<tr><td colspan="2" class="inputTitle">{-:$_fi['params']['f_item_name']-}</td></tr>
<tr><td colspan="2" class="inputArea">
{-if:!empty($_fi['params']['f_default'])-}
<select name="{-:$_fi['tag']-}">
	{-foreach:$_t,$v-}
	{-php:$_t1 = explode('|', $v);-}
		{-if:$_data == $_t1[0]-}
			<option value="{-:$_t1[0]-}" selected="selected">{-:$_t1[1]-}</option>
		{-else:-}
			<option value="{-:$_t1[0]-}">{-:$_t1[1]-}</option>
		{-:/if-}
	{-:/foreach-}
</select>
{-:/if-}
</td></tr>
