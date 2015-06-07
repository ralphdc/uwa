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
	{-foreach:$_t,$k,$v-}
	{-php:$_t1 = explode('|', $v);-}
		{-if:$_data == $_t1[0] or (empty($_data) and 0 == $k)-}
			<label><input type="radio" name="{-:$_fi['tag']-}" value="{-:$_t1[0]-}" checked="checked"> {-:$_t1[1]-}</label>
		{-else:-}
			<label><input type="radio" name="{-:$_fi['tag']-}" value="{-:$_t1[0]-}"> {-:$_t1[1]-}</label>
		{-:/if-}
	{-:/foreach-}
{-:/if-}
</td></tr>
