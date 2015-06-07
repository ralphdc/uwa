{-php:
if(!is_null($_fi['data']) and isset($_fi['data'][$_fi['tag']])) {
	$_fi['params']['f_default'] = $_fi['data'][$_fi['tag']];
}
if(!isset($_fi['params']['f_length']) or empty($_fi['params']['f_length'])) {
	$_fi['params']['f_length'] = '10,2';
}
$pfl = explode(',', $_fi['params']['f_length']);
-}

<div class="form-group">
	<label class="control-label">{-:$_fi['params']['f_item_name']-}</label>
	<input id="{-:$_fi['tag']-}" required="required" type="text" name="{-:$_fi['tag']-}" value="{-:$_fi['params']['f_default']|number_format~@me,$pfl[1],'.',''-}" class="control-input" maxlength="{-:$pfl[0] + 1-}" size="{-:$pfl[0] + 1-}"  >
</div>
