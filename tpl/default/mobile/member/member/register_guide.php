<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@REGISTER-} - {-:$_SITE['name']-}</title>
<meta name="keywords" content="{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_SITE['description']-}" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="HandheldFriendly" content="true">
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}mua/css/mua.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/c.css" />
</head>

<body>
{-include:header_login-}

<dl class="adl margin-top-sm">
	<dt><h5><i class="icon icon-plus-circle"></i> {-:@REGISTER-}</h5><span class="float-right"><a class="btn_l" href="{-url:member/login-}"><i class="icon icon-sign-in"></i> {-:@LOGIN-}</a></span></dt>
	<dd>
		<form id="loginForm" class="form" action="" method="post">
			<fieldset>
				<legend>{-:@CHOOSE_MEMBER_TYPE-}</legend>
				<div class="form-group">
					<label class="control-label">{-:@MEMBER_TYPE-}</label>
					<div>
					{-foreach:$_L,$k,$item-}
						<label><input type="radio" name="member_model_id" value="{-:$item['member_model_id']-}"{-if:0==$k-} checked="checked"{-:/if-} /> {-:$item['mm_name']-}</label>
					{-:/foreach-}
					</div>
				</div>
				<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
				<input name="token" type="hidden" value="{-:$_TK['token']-}">
				<input type="submit" class="btn" value="{-:@STEP_NEXT-}" />
			</fieldset>
		</form>
	</dd>
</dl>

<uwa:ad id="5">
{-include:../footer-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}mua/js/mua.js"></script>
<script>
document.write('<script src="{-url:member@common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:home@common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}member/js/c.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>
