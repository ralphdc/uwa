{-php:
if(!is_null($_fi['data']) and isset($_fi['data'][$_fi['tag']])) {
	$_fi['params']['f_default'] = $_fi['data'][$_fi['tag']];
}
$inputSize = ($_fi['params']['f_length'] / 2 < 90 ? $_fi['params']['f_length'] / 2 : 90);
$inputSize = ($inputSize < 2 ? 10 : $inputSize);
-}

<div class="form-group">
	<label class="control-label">{-:$_fi['params']['f_item_name']-}</label>
	<input id="{-:$_fi['tag']-}" required="required" type="text" name="{-:$_fi['tag']-}" value="{-:$_fi['params']['f_default']-}" class="control-input" maxlength="{-:$_fi['params']['f_length']-}" size="{-:$inputSize-}">
</div>
