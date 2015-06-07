<!doctype html>
<html class="full-height">
<head>
<meta charset="utf-8" />
{-if:!empty($jumpUrl)-}<meta http-equiv="refresh" content="2; url={-:$jumpUrl-}" />{-:/if-}
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="HandheldFriendly" content="true">
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}mua/css/mua.css" />
<title>{-:@_OPERATION_TIPS_-}</title>
{-if:!empty($jumpUrl)-}<script>
var t;
function time(){
	document.getElementById("time").innerHTML = parseInt(document.getElementById("time").innerHTML) - 1;
	if(0 == parseInt(document.getElementById("time").innerHTML)) {
		window.clearInterval(t);
	}
}
t = setInterval("time()", 1000);
</script>{-:/if-}
</head>

<body class="full-height">

<div class="align-center vertical-align full-height col-sm-9">
	<div class="vertical-align-middle">
		<div class="panel panel-{-:$status-} align-center">
			<div class="panel-heading">{-:@_OPERATION_TIPS_-} <span style="font-size:12px;color:#fff">{-if:!empty($jumpUrl)-}<span id='time'>3</span>{-:/if-}</span></div>
			<div class="panel-body">
			{-if:is_array($message)-}
				<ol>
				{-foreach:$message,$m-}
					<li>{-:$m-}</li>
				{-:/foreach-}
				</ol>
			{-else:-}
				{-:$message-}
			{-:/if-}
			</div>
			<div class="panel-footer text-right">
				<div class="btn-group">
					<a href="{-php:echo AServer::get_preUrl();-}" class="btn"><i class="icon icon-arrow-left"></i> {-:@_GO_BACK_-}</a>
					<a href="{-:*__APP__-}" class="btn"><i class="icon icon-home"></i> {-:@_GO_HOME_-}</a>
					{-if:!empty($jumpUrl)-}<a href="{-:$jumpUrl-}" class="btn"><i class="icon icon-arrow-right"></i> {-:@_GO_NEXT_-}</a>{-:/if-}
				</div>
			</div>
		</div>
	</div>
</div>

</body>
</html>