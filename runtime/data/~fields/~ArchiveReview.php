<?php
return array (
  0 => 'archive_review_id',
  1 => 'member_id',
  2 => 'ar_author',
  3 => 'ar_content',
  4 => 'ar_status',
  5 => 'ar_add_time',
  6 => 'ar_add_ip',
  7 => 'ar_support_count',
  8 => 'ar_oppose_count',
  9 => 'ar_reply',
  10 => 'archive_id',
  11 => 'archive_channel_id',
  '_autoinc' => true,
  '_pk' => 'archive_review_id',
  '_type' => 
  array (
    'archive_review_id' => 'int(10) unsigned',
    'member_id' => 'int(10) unsigned',
    'ar_author' => 'varchar(255)',
    'ar_content' => 'text',
    'ar_status' => 'tinyint(3) unsigned',
    'ar_add_time' => 'int(10) unsigned',
    'ar_add_ip' => 'varchar(15)',
    'ar_support_count' => 'int(10) unsigned',
    'ar_oppose_count' => 'int(10) unsigned',
    'ar_reply' => 'text',
    'archive_id' => 'int(10) unsigned',
    'archive_channel_id' => 'smallint(5) unsigned',
  ),
);
?>