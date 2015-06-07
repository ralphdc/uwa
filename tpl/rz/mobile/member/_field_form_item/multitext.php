{-php:
if(!is_null($_fi['data']) and isset($_fi['data'][$_fi['tag']])) {
	$_fi['params']['f_default'] = $_fi['data'][$_fi['tag']];
}
-}

<div class="form-group">
	<label class="control-label">{-:$_fi['params']['f_item_name']-}</label>
{-if:is_array($_fi['params']['f_default'])-}
	{-foreach:$_fi['params']['f_default'],$k,$_pfd-}
		<input id="{-:$_fi['tag']-}_{-:$k-}" required="required" type="text" name="{-:$_fi['tag'][$k]-}" value="{-:$_pfd-}" class="control-input" maxlength="{-:$_fi['params']['f_length']-}">
	{-:/foreach-}
{-else:-}
	<textarea required="required" class="control-input required" style="height:150px;" name="{-:$_fi['tag']-}">{-:$_fi['params']['f_default']-}</textarea>
{-:/if-}
</div>
