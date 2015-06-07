<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
{-if:!empty($jumpUrl)-}<meta http-equiv="refresh" content="2; url={-:$jumpUrl-}" />{-:/if-}
<title>{-:@_OPERATION_TIPS_-}</title>
<style>
html, body, dl, dt, dd, span, ol, li{margin:0;padding:0;border:none}
html, body{font-size:14px;font-family:'Microsoft YaHei',Verdana,Tahoma,Arial;line-height:150%;background:#e5e5e5}
dl.box{margin:150px auto 0;width:600px;border:#aaa 1px solid;box-shadow:2px 2px 5px rgba(0, 0, 0, 0.2);background:#fff}
dl.box dt{background:#f2f2f2;padding:0 10px;height:30px;color:#333;font-size:14px;font-weight:bold;line-height:30px;text-shadow:0 0 2px rgba(255, 255, 255, 0.5);border-bottom:1px solid #d9d9d9}
dd.message{padding:20px;color:#666}
span.icon{display:block;margin:10px;width:16px;height:16px;border-radius:10px}
span.success{background:#8c0;border:#690 1px solid}
span.error{background:#c00;border:#900 1px solid}
ol.msgList li{list-style:decimal inside}
dd.direction{padding:10px 20px;text-align:right}
a.btn{display:inline-block;padding:0 5px;height:24px;margin:0 0 0 5px;text-align:center;vertical-align:middle;color:#666;font-size:12px;line-height:24px;text-decoration:none;background:#fff;border:#aaa 1px solid}
a.btn:hover{color:#333;border:#666 1px solid}
</style>
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
<body>
<dl class="box">
	<dt>
		{-:@_OPERATION_TIPS_-} <span style="font-size:12px;color:#999">{-if:!empty($jumpUrl)-}<span id='time'>3</span>{-:/if-}</span>
	</dt>
	<dd class="message">
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td valign="top" width="60">
				<span class="icon {-:$status-}"></span>
			</td>
			<td>
				<ol class="msgList">
{-if:is_array($message)-}
{-foreach:$message,$m-}
					<li>{-:$m-}</li>
{-:/foreach-}
{-else:-}
					{-:$message-}
{-:/if-}
				</ol>
			</td>
		</tr>
		</table>
	</dd>
	<dd class="direction">
		<a href="{-php:echo AServer::get_preUrl();-}" class="btn">{-:@_GO_BACK_-}</a>
		<a href="{-:*__APP__-}" class="btn">{-:@_GO_HOME_-}</a>
		{-if:!empty($jumpUrl)-}<a href="{-:$jumpUrl-}" class="btn">{-:@_GO_NEXT_-}</a>{-:/if-}
	</dd>
</dl>
</body>
</html>