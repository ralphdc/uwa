<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@MEMBER_EMAIL_VERIFY-} - {-:$_SITE['name']-}</title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/m.css" />
<meta name="keywords" content="{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_SITE['description']-}" />
</head>

<body>
{-include:../header-}
<div class="m w_500 adiv p_20">
	<h2>
	{-if:0==$_VR['status']-}
		<span class="fc_r">{-:@VERIFY_FAILED-}</span>
	{-elseif:1==$_VR['status']-}
		<span class="fc_g">{-:@VERIFY_SUCCESS-}</span>
	{-:/if-}
	</h2>
	<div class="p_20">{-:$_VR['info']-}</div>
</div>
{-include:../footer-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script>
document.write('<script src="{-url:common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}member/js/c.js"></script>
<script src="{-:*__THEME__-}member/js/m.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>