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

<div class="form-group">
	<label class="control-label">{-:$_fi['params']['f_item_name']-}</label>
	<input id="{-:$_fi['tag']-}" required="required" type="text" name="{-:$_fi['tag']-}" format="{-:$_fi['params']['f_datetime_format']-}" value="{-:$_fi['params']['f_default']|date~$_fi['params']['f_datetime_format'],@me-}" class="calendar control-input" maxlength="40" size="20">
</div>
