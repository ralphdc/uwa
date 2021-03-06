<?php
return array (
  'index-<p:\\w+>' => 'index/index',
  'index' => 'index/index',
  'list-<archive_channel_id:\\d+>-<p:\\w+>' => 'home@archive/show_channel',
  'list-<archive_channel_id:\\d+>' => 'home@archive/show_channel',
  'item-<archive_id:\\d+>-<p:\\w+>' => 'home@archive/show_archive',
  'item-<archive_id:\\d+>' => 'home@archive/show_archive',
  'review-list-<archive_id:\\d+>-<p:\\w+>' => 'home@archive_review/list_review',
  'review-list-<archive_id:\\d+>' => 'home@archive_review/list_review',
  'search-k-<keyword:\\S+>' => 'home@search/search_do',
  'search' => 'home@search/search',
  'report-<r_item_type:\\w+>-<r_item_id:\\d+>' => 'home@report/add_report',
  'tag/<t_name:\\S+>-<p:\\w+>' => 'home@tag/show_tag',
  'tag/<t_name:\\S+>' => 'home@tag/show_tag',
  'tag' => 'home@tag/index',
  'custom_list-<custom_list_id:\\d+>-<p:\\w+>' => 'home@custom_list/show_custom_list',
  'custom_listlist-<custom_list_id:\\d+>' => 'home@custom_list/show_custom_list',
  'xlist-<custom_model_id:\\d+>-<p:\\w+>' => 'home@custom_model/list_content',
  'xlist-<custom_model_id:\\d+>' => 'home@custom_model/list_content',
  'xitem-<custom_model_id:\\d+>-<id:\\d+>-<p:\\w+>' => 'home@custom_model/show_content',
  'xitem-<custom_model_id:\\d+>-<id:\\d+>' => 'home@custom_model/show_content',
  'vote/post' => 'home@vote/post_vote_do',
  'vote/item-<vote_id:\\d+>' => 'home@vote/show_vote_result',
  'member/index' => 'member@member/index',
  'member/register' => 'member@member/register',
  'member/email-verify-<member_id:\\d+>-<mevc:\\w+>' => 'member@common/member_email_verify',
  'member/login' => 'member@member/login',
  'member/logout' => 'member@member/logout_do',
  'member/edit-info-base' => 'member@member/edit_info_base',
  'member/edit-info-addon' => 'member@member/edit_info_addon',
  'member/list-archive-<archive_model_id:\\d+>-<p:\\w+>' => 'member@archive/list_archive',
  'member/list-archive-<archive_model_id:\\d+>' => 'member@archive/list_archive',
  'member/add-archive-<archive_model_id:\\d+>' => 'member@archive/add_archive',
  'member/edit-archive-<archive_id:\\d+>' => 'member@archive/edit_archive',
  'member/list-cmc-<custom_model_id:\\d+>-<p:\\w+>' => 'member@custom_model/list_content',
  'member/list-cmc-<custom_model_id:\\d+>' => 'member@custom_model/list_content',
  'member/add-cmc-<custom_model_id:\\d+>' => 'member@custom_model/add_content',
  'member/edit-cmc-<custom_model_id:\\d+>-<id:\\d+>' => 'member@custom_model/edit_content',
  'member/list-notify--<mn_status:\\w>-<p:\\w+>' => 'member@member_notify/list_notify',
  'member/list-notify--<mn_status:\\w>' => 'member@member_notify/list_notify',
  'member/list-notify-<p:\\w+>' => 'member@member_notify/list_notify',
  'member/list-notify' => 'member@member_notify/list_notify',
  'member/credit-exchange' => 'member@member_credit/credit_exchange',
  'member/list-credit-order--<mco_status:\\w>-<p:\\w+>' => 'member@member_credit_order/list_credit_order',
  'member/list-credit-order--<mco_status:\\w>' => 'member@member_credit_order/list_credit_order',
  'member/list-credit-order-<p:\\w+>' => 'member@member_credit_order/list_credit_order',
  'member/list-credit-order' => 'member@member_credit_order/list_credit_order',
  'member/list-favorite-<p:\\w+>' => 'member@member_favorite/list_favorite',
  'member/list-favorite' => 'member@member_favorite/list_favorite',
  'member/add-favorite-<archive_id:\\d+>' => 'member@member_favorite/add_favorite_do',
  'member/upload-<p:\\w+>' => 'member@upload/list_upload',
  'member/upload' => 'member@upload/list_upload',
  'guestbook-<p:\\w+>' => 'home@guestbook/list_guestbook',
  'guestbook' => 'home@guestbook/list_guestbook',
  'flink-list-<p:\\w+>' => 'home@flink/list_flink',
  'flink-list' => 'home@flink/list_flink',
  'flink-apply' => 'home@flink/apply_flink',
  'page-<single_page_id:\\d+>' => 'home@single_page/show_single_page',
);
?>