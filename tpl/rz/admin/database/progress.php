<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<style>
html, body, dl, dt, dd, span, ol, li{margin:0;padding:0;border:none}
html, body{font:14px 'Microsoft YaHei',Verdana,Tahoma,Arial;line-height:150%;background:#fff}
dl.box{margin-top:-180px;margin-left:-250px; position:absolute;top:50%;left:50%;width:500px;border:#aaa 1px solid;border-radius:5px;box-shadow:2px 2px 5px rgba(0, 0, 0, 0.2);background:#fff}
dl.box dt{background:#f2f2f2;padding:0 10px;height:30px;color:#333;font-size:14px;font-weight:bold;line-height:30px;border-radius:4px 4px 0 0;text-shadow:0 0 2px rgba(255, 255, 255, 0.5);border-bottom:1px solid #d9d9d9}
dd.message{padding:20px;color:#666}

.progressBarBox{margin:10px auto;padding:2px;height:20px;width:400px;background:#eee;border:1px solid #ccc;border-radius:5px;box-shadow:0 0 5px rgba(0,0,0,0.2) inset}
.progressBarBox .progressBar{width:20%;height:20px;background:#3d6dcc;background-position:0 0;border-radius:3px}
#progressInfo{margin:10px 0}

dd.direction{padding:10px 20px;text-align:right}
a.btn{display:inline-block;padding:0 5px;height:24px;margin:0 0 0 5px;text-align:center;vertical-align:middle;color:#666;font-size:12px;line-height:24px;text-decoration:none;background:#fff;border:#aaa 1px solid;border-radius:3px}
a.btn:hover{color:#333;border:#666 1px solid}
</style>
</head>
<body>
<dl class="box">
	<dt>{-:@PROGRESS-}</dt>
	<dd class="message">
		<div class="progressBarBox"><div id="progressBar" class="progressBar"></div></div>
		<div id="progressInfo">progressInfo</div>
	</dd>
</dl>
<script>
function show_progress(message, barLength) {
	$('#progressInfo').html(message);
	$('#progressBar').css({'width':barLength});
}
function show_direction(nextUrl) {
	$('.box').append('<dd class="direction"><a href="' + nextUrl + '" class="btn">{-:@_GO_NEXT_-}</a></dd>');
}
</script>
