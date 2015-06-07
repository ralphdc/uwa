<?php /* PFA Template Cache File. Create Time:2015-06-06 01:33:45 */ ?>
<!DOCTYPE html> <html> <head> <meta charset="utf-8" /> <title><?php echo($_V['a_title']); ?> <?php echo(L("REVIEW_LIST")); ?> - <?php echo($_SITE['name']); ?></title> <link rel="stylesheet" type="text/css" href="/tpl/rz/home/css/c.css" /> <link rel="stylesheet" type="text/css" href="/tpl/rz/home/css/r.css" /> </head> <body> <div id="uwa_review"> <dl class="adl"> <dt><strong><?php echo(L("REVIEW_LIST")); ?></strong><span><a href="<?php echo(Url::U("home@archive_review/list_review?archive_id={$_V['archive_id']}")); ?>" target="_parent"><?php echo(L("ALL_REVIEW")); ?></a></span></dt> <dd> <ul class="review_list"> <?php if(isset($_L) and is_array($_L)) : foreach($_L as $item) : ?> <li> <div class="review_main"> <p class="review_info"> <span class="fw_b"><?php echo($item['ar_author']); ?></span> <span class="fc_gry"><?php echo(date(C('APP.TIME_FORMAT'), $item['ar_add_time'])); ?></span> <span class="review_support a" archive_review_id="<?php echo($item['archive_review_id']); ?>"><i><?php echo(L("SUPPORT")); ?></i>[<b class="fc_g"><?php echo($item['ar_support_count']); ?></b>]</span> <span class="review_oppose a" archive_review_id="<?php echo($item['archive_review_id']); ?>"><i><?php echo(L("OPPOSE")); ?></i>[<b class="fc_r"><?php echo($item['ar_oppose_count']); ?></b>]</span> </p> <p class="review_content"> <?php echo($item['ar_content']); ?> </p> </div><!--/.review_main--> <?php if($item['ar_reply']) :  ?><div class="review_reply"> <p> <strong><?php echo(L("REPLY")); ?>:</strong> <?php echo($item['ar_reply']); ?> </p> </div><!--/.review_reply--><?php endif; ?> </li> <?php endforeach; endif; ?> </ul><!--/.review_list--> </dd> </dl> <div class="h_10 o_h"></div> <dl class="adl"> <dt><strong><?php echo(L("ADD_REVIEW")); ?></strong></dt> <dd> <?php if(!empty($_V['msg_err'])) :  ?> <div class="msg_err"> <?php echo($_V['msg_err']); ?> </div> <?php else : ?> <form id="review_add" action="<?php echo(Url::U("home@archive_review/add_review_do")); ?>" method="post"><ul class="aul_form"> <li> <strong><?php echo(L("CONTENT")); ?></strong> <label><textarea class="i required" style="width:400px;height:150px;" name="ar_content" placeholder="<?php echo(L("REVIEW_CONTENT_TIP")); ?>"></textarea></label> </li> <?php if($_G['interaction']['captcha']) :  ?><li> <strong><?php echo(L("CAPTCHA")); ?></strong> <label> <input type="text" name="vcode" autocomplete="off" value="" class="required i v_code_input" size="5" maxlength="5" /> <img src="<?php echo(Url::U("home@common/captcha_img?name=vcode")); ?>" onclick="this.src += '&' + Math.random();" style="cursor:pointer;" /> <span class="fc_gry"><?php echo(L("CAPTCHA_TIP")); ?></span> </label></li><?php endif; ?> <li> <strong></strong> <label> <input name="archive_id" type="hidden" value="<?php echo($_V['archive_id']); ?>"> <input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>"> <input name="token" type="hidden" value="<?php echo($_TK['token']); ?>"> <input type="submit" class="btn_b" value="<?php echo(L("SUBMIT")); ?>" /> </label> </li> </ul></form> <?php endif; ?> </dd> </dl> </div> <script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script> <script src="<?php echo(__PUBLIC__); ?>js/placeholder.js"></script> <script> /*s: review iframe height */
$(document).ready(function() {
	H();
	$('[placeholder]').placeholder({useNative: false, hideOnFocus: true});
});
function H() {
	$(window.parent.document).find('#uwa_review').height($("#uwa_review").height());
}
/*e: review iframe height */

/*s: support and oppose*/
$('.review_support').click(function() {
	var archive_review_id=$(this).attr('archive_review_id'),
		url_support = '<?php echo(Url::U("home@archive_review/get_count?type=do_support")); ?>';
	$.getJSON(url_support+'&'+Math.random(), {archive_review_id:archive_review_id}, function(data) {
		if(data.data == 1) {
			$('.review_support[archive_review_id='+archive_review_id+'] b').text(parseInt($('.review_support[archive_review_id='+archive_review_id+'] b').text()) + 1);
		}
		$('.review_support[archive_review_id='+archive_review_id+'], .review_oppose[archive_review_id='+archive_review_id+']').removeClass('a').unbind();
		$('.review_support[archive_review_id='+archive_review_id+'] i').text(data.info);
	});
});
$('.review_oppose').click(function() {
	var archive_review_id=$(this).attr('archive_review_id'),
		url_support = '<?php echo(Url::U("home@archive_review/get_count?type=do_oppose")); ?>';
	$.getJSON(url_support+'&'+Math.random(), {archive_review_id:archive_review_id}, function(data) {
		if(data.data == 1) {
			$('.review_oppose[archive_review_id='+archive_review_id+'] b').text(parseInt($('.review_oppose[archive_review_id='+archive_review_id+'] b').text()) + 1);
		}
		$('.review_support[archive_review_id='+archive_review_id+'], .review_oppose[archive_review_id='+archive_review_id+']').removeClass('a').unbind();
		$('.review_oppose[archive_review_id='+archive_review_id+'] i').text(data.info);
	});
});
/*e: support and oppose*/
</script> <script src="/tpl/rz/home/js/c.js"></script> <?php echo($_SITE['stat_code']); ?> </body> </html>