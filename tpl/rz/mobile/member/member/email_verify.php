<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@MEMBER_EMAIL_VERIFY-} - {-:$_SITE['name']-}</title>
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

<div class="grid margin-lg">
{-if:1==$_VR['status']-}
	<div class="panel panel-success">
		<div class="panel-heading">{-:@VERIFY_SUCCESS-}</div>
		<div class="panel-body">
			{-:$_VR['info']-}
		</div>
		<div class="panel-footer text-right"><a href="{-url:member/login-}" class="btn">{-:@LOGIN-}</a></div>
	</div>
{-else:-}
	<div class="panel panel-danger">
		<div class="panel-heading">{-:@VERIFY_FAILED-}</div>
		<div class="panel-body">
			{-:$_VR['info']-}
		</div>
		<div class="panel-footer text-right"><a href="{-url:member/register-}" class="btn">{-:@REGISTER-}</a></div>
	</div>
{-:/if-}
</div>

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
