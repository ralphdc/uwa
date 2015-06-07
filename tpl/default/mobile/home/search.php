<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@SEARCH-} - {-:$_SITE['name']-}</title>
<meta name="keywords" content="{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_SITE['description']-}" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="HandheldFriendly" content="true">
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}mua/css/mua.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/css/c.css" />
</head>

<body>
{-include:header-}

<dl class="adl margin-top-sm">
	<dt><h5><i class="icon icon-search"></i> {-:@SEARCH-}</h5></dt>
	<dd>
		<form class="form form-horizontal" action="{-url:home@search/search_do-}" method="post">
			<fieldset>
				<div class="form-group">
					<label class="control-label">{-:@CHANNEL-}</label>
					<div class="control-content">
						<select name="archive_channel_id" class="control-input">
							<option value="0">{-:@NOT_LIMIT-}</option>
							{-:$_ACLStr-}
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">{-:@KEYWORDS-}</label>
					<div class="control-content">
						<input required="required" type="text" value="" name="keyword" class="control-input" maxlength="40">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label"></label>
					<div class="control-content">
						<ul class="list-inline margin-remove">
							<uwa:tag_list row="10">
								<li><a class="badge" href="{-:$item['t_url']-}" target="_blank">{-:$item['t_name']-}</a></li>
							</uwa:tag_list>
						</ul>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">{-:@KEYWORD_TYPE-}</label>
					<div class="control-content">
						<label><input type="radio" name="keyword_type" value="or" checked="checked"> {-:@OR-}</label>
						<label><input type="radio" name="keyword_type" value="and"> {-:@AND-}</label>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">{-:@SEARCH_TYPE-}</label>
					<div class="control-content">
						<select name="search_type" class="control-input">
							<option value="title">{-:@TITLE-}</option>
							<option value="content">{-:@CONTENT-}</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">{-:@PUBLISH_DATE-}</label>
					<div class="control-content">
						<select name="publish_date" class="control-input">
							<option value="0">{-:@NOT_LIMIT-}</option>
							<option value="7">{-:@IN_A_WEEK-}</option>
							<option value="30">{-:@IN_A_MONTH-}</option>
							<option value="90">{-:@IN_THREE_MONTHS-}</option>
							<option value="365">{-:@IN_A_YEAR-}</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">{-:@DISPLAY_ORDER-}</label>
					<div class="control-content">
						<select name="display_order" class="control-input">
							<option value="a_edit_time">{-:@PUBLISH_DATE-}</option>
							<option value="a_view_count">{-:@VIEW_COUNT-}</option>
							<option value="archive_id">{-:@ARCHIVE_ID-}</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">{-:@PAGE_SIZE-}</label>
					<div class="control-content">
						<select name="page_size" class="control-input">
							<option value="10">10</option>
							<option value="20">20</option>
							<option value="50">50</option>
						</select>
					</div>
				</div>
				<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
				<input name="token" type="hidden" value="{-:$_TK['token']-}">
				<input type="submit" class="btn btn-block" value="{-:@SEARCH-}" />
			</fieldset>
		</form>
	</dd>
</dl>

<uwa:ad id="5">

{-include:footer-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}mua/js/mua.js"></script>
<script src="{-:*__THEME__-}home/js/c.js"></script>
<script>
document.write('<script src="{-url:member@common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:home@common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
{-:$_SITE['stat_code']-}
</body>
</html>
