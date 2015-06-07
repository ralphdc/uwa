
$(document).ready(function() {
	var thelink = encodeURIComponent(document.location), 
		thetitle = encodeURIComponent(document.title.substring(0,60)),
		param = getParamsOfShareWindow(600, 560),

		ss_tqq = 'http://v.t.qq.com/share/share.php?title=' + thetitle + '&url=' + thelink + '&site=',
		ss_qzone = 'http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=' + thelink + '&title=',
		ss_tsina = 'http://v.t.sina.com.cn/share/share.php?url=' + thelink + '&title=' + thetitle,
		ss_douban = 'http://www.douban.com/recommend/?url=' + thelink + '&title=' + thetitle,
		ss_renren = 'http://share.renren.com/share/buttonshare?link=' + thelink + '&title=' + thetitle,
		ss_kaixin = 'http://www.kaixin001.com/repaste/share.php?rurl=' + thelink + '&rcontent=' + thelink + '&rtitle=' + thetitle;

	$('.snsshare').each(function() {
		var windowName = $(this).attr('title');
		$(this).click(function() {
			$(this).removeClass('hover');
			var httpUrl = eval($(this).attr('ss_share'));
			window.open(httpUrl, windowName, param);
		});
	});

	function getParamsOfShareWindow(width, height) {
		return ['toolbar=0,status=0,resizable=1,width=' + width + ',height=' + height + ',left=',(screen.width-width)/2,',top=',(screen.height-height)/2].join('');
	}
});

