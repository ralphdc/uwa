{-php:
if(!is_null($_fi['data']) and isset($_fi['data'][$_fi['tag']])) {
	$_fi['params']['f_default'] = $_fi['data'][$_fi['tag']];
}
if(!isset($_fi['params']['f_length']) or empty($_fi['params']['f_length'])) {
	$_fi['params']['f_length'] = '10,2';
}
$pfl = explode(',', $_fi['params']['f_length']);
-}

<tr><td colspan="2" class="inputTitle">{-:$_fi['params']['f_item_name']-}</td></tr>
<tr><td colspan="2" class="inputArea">
	<input class="i" type="text" value="{-:$_fi['params']['f_default']|number_format~@me,$pfl[1],'.',''-}" name="{-:$_fi['tag']-}" maxlength="{-:$pfl[0] + 1-}" size="{-:$pfl[0] + 1-}" />
</td></tr>