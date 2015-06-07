<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@REGISTER-} - {-:$_SITE['name']-}</title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/m.css" />
<meta name="keywords" content="{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_SITE['description']-}" />
</head>

<body>
{-include:../header-}
<div class="m w_500 adiv">
	<form id="member_register" action="" method="post">
	<table class="formTable p_20">
		<tr>
			<th colspan="2" scope="col" class="fc_b">{-:@CHOOSE_MEMBER_TYPE-}</th>
		</tr>
		<tr>
			<td class="inputTitle">{-:@MEMBER_TYPE-}</td>
			<td class="inputTitle"></td>
		</tr>
		<tr>
			<td colspan="2" class="inputArea">
				{-foreach:$_L,$k,$item-}
				<label><input type="radio" name="member_model_id" value="{-:$item['member_model_id']-}"{-if:0==$k-} checked="checked"{-:/if-} /> {-:$item['mm_name']-}</label>
				{-:/foreach-}
			</td>
		</tr>
		<tr>
			<td colspan="2" class="operation">
				<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
				<input name="token" type="hidden" value="{-:$_TK['token']-}">
				<input type="submit" class="btn_b" value="{-:@STEP_NEXT-}" />
			</td>
		</tr>
	</table>
	</form>
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