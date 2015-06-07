{-php:
if(!is_null($_fi['data']) and isset($_fi['data'][$_fi['tag']])) {
	$_fi['params']['f_default'] = $_fi['data'][$_fi['tag']];
}
$inputSize = ($_fi['params']['f_length'] / 2 < 90 ? $_fi['params']['f_length'] / 2 : 90);
$inputSize = ($inputSize < 2 ? 10 : $inputSize);
-}

<tr><td colspan="2" class="inputTitle">{-:$_fi['params']['f_item_name']-}</td></tr>
<tr><td colspan="2" class="inputArea">
	<input class="i" type="text" value="{-:$_fi['params']['f_default']-}" name="{-:$_fi['tag']-}" maxlength="{-:$_fi['params']['f_length']-}" size="{-:$inputSize-}" />
</td></tr>
