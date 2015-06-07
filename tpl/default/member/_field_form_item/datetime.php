{-php:
if(!is_null($_fi['data']) and isset($_fi['data'][$_fi['tag']])) {
	$_fi['params']['f_default'] = $_fi['data'][$_fi['tag']];
}
if(empty($_fi['params']['f_default'])) {
	$_fi['params']['f_default'] = time();
}
if(!isset($_fi['params']['f_datetime_format']) or empty($_fi['params']['f_datetime_format'])) {
	$_fi['params']['f_datetime_format'] = C('APP.TIME_FORMAT');
}
-}

<tr><td colspan="2" class="inputTitle">{-:$_fi['params']['f_item_name']-}</td></tr>
<tr><td colspan="2" class="inputArea">
	<input size="20" id="{-:$_fi['tag']-}" class="i calendar" name="{-:$_fi['tag']-}" format="{-:$_fi['params']['f_datetime_format']-}" value="{-:$_fi['params']['f_default']|date~$_fi['params']['f_datetime_format'],@me-}" />
</td></tr>
