<?php /* PFA Template Cache File. Create Time:2015-06-06 22:55:42 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/mf.css" />
</head>
<body>
<form id="formEdit" action="" method="post">
<dl class="abox">
	<dt><strong><?php echo(L("EDIT_AD_SPACE")); ?></strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle"><?php echo(L("NAME")); ?></td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_ASI['as_name']); ?>" name="as_name" maxlength="64" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("AS_NAME_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("SIZE")); ?></td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="<?php echo($_ASI['as_width']); ?>" name="as_width" maxlength="10" size="6"> &times; <input class="required i" type="text" value="<?php echo($_ASI['as_height']); ?>" name="as_height" maxlength="10" size="6">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("AS_SIZE_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("TYPE")); ?></td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" value="code" name="as_type" <?php if('code' == $_ASI['as_type']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("CODE")); ?></label>
					<label><input type="radio" value="text" name="as_type" <?php if('text' == $_ASI['as_type']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("TEXT")); ?></label>
					<label><input type="radio" value="image" name="as_type" <?php if('image' == $_ASI['as_type']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("IMAGE")); ?></label>
					<label><input type="radio" value="flash" name="as_type" <?php if('flash' == $_ASI['as_type']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("FLASH")); ?></label>
					<label><input type="radio" value="slide" name="as_type" <?php if('slide' == $_ASI['as_type']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("SLIDE")); ?></label>
					<label><input type="radio" value="banner" name="as_type" <?php if('banner' == $_ASI['as_type']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("BANNER")); ?></label>
					<label><input type="radio" value="rolls" name="as_type" <?php if('roll' == $_ASI['as_type']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ROLLS")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry"><?php echo(L("AS_TYPE_TIP")); ?></span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("STATUS")); ?></td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<label><input type="radio" name="as_status" value="1"<?php if(1==$_ASI['as_status']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("ON")); ?></label>
					<label><input type="radio" name="as_status" value="0"<?php if(0==$_ASI['as_status']) :  ?> checked="checked"<?php endif; ?>> <?php echo(L("OFF")); ?></label>
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <?php echo(L("AS_STATUS_TIP")); ?>
				</td>
			</tr>
			<tr>
				<td class="inputTitle"><?php echo(L("DEFAULT")); ?></td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="as_default" style="width:360px;height:80px;"><?php echo($_ASI['as_default']); ?></textarea>
				</td>
				<td class="inputTip">
					<?php echo(L("AS_DEFAULT_TIP")); ?>
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
	<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
	<input type="hidden" value="<?php echo($_ASI['ad_space_id']); ?>" name="ad_space_id">
	<span class="btn_b submit" action="<?php echo(Url::U("ad_space/edit_space_do")); ?>" to="#formEdit"><?php echo(L("SUBMIT")); ?></span>
	<input class="btn_l" type="reset" value="<?php echo(L("RESET")); ?>" />
	<a class="btn_l" href="<?php echo(Url::U("ad_space/list_space")); ?>"><?php echo(L("BACK")); ?></a>
</div>
</form>
<dl class="abox">
	<dt><strong><?php echo(L("CODE")); ?></strong></dt>
	<dd>
		<span>HTML<?php echo(L("CODE")); ?></span>
		<code style="font-family:'Courier New'; display:block" class="fs_14 bg_gry_d fc_wht p_10 br_5">
	&lt;uwa:ad id=&quot;<?php echo($_ASI['ad_space_id']); ?>&quot;&gt;
		</code>
		<span>JS<?php echo(L("CODE")); ?></span>
		<code style="font-family:'Courier New'; display:block" class="fs_14 bg_gry_d fc_wht p_10 br_5">
	&lt;script type=&quot;text/javascript&quot; src=&quot;<?php echo '{'; ?>-:*__APP__-}runtime/js/~ad<?php echo($_ASI['ad_space_id']); ?>.js&quot;&gt;&lt;/script&gt;
		</code>
	</dd>
</dl><!--/.abox-->
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="/tpl/rz/admin/js/c.js"></script>
</body>
</html>