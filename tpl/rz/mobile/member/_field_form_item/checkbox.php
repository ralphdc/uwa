{-php:
$_data = array();
if(!is_null($_fi['data']) and isset($_fi['data'][$_fi['tag']])) {
	$_data = explode(',', $_fi['data'][$_fi['tag']]);
}
if(!empty($_fi['params']['f_default'])) {
	$_t = explode(',', $_fi['params']['f_default']);
}
-}

<div class="form-group">
	<label class="control-label">{-:$_fi['params']['f_item_name']-}</label>
	<div>
	{-if:!empty($_fi['params']['f_default'])-}
		{-foreach:$_t,$v-}
		{-php:$_t1 = explode('|', $v);-}
			{-if:in_array($_t1[0], $_data)-}
				<label><input type="checkbox" name="{-:$_fi['tag']-}[]" value="{-:$_t1[0]-}" checked="checked"> {-:$_t1[1]-}</label>
			{-else:-}
				<label><input type="checkbox" name="{-:$_fi['tag']-}[]" value="{-:$_t1[0]-}"> {-:$_t1[1]-}</label>
			{-:/if-}
		{-:/foreach-}
	{-:/if-}
	</div>
</div>
