<?php
return array (
  0 => 'guestbook_id',
  1 => 'member_id',
  2 => 'g_author',
  3 => 'g_content',
  4 => 'g_reply',
  5 => 'g_status',
  6 => 'g_add_time',
  7 => 'g_add_ip',
  '_autoinc' => true,
  '_pk' => 'guestbook_id',
  '_type' => 
  array (
    'guestbook_id' => 'int(10) unsigned',
    'member_id' => 'int(10) unsigned',
    'g_author' => 'varchar(255)',
    'g_content' => 'text',
    'g_reply' => 'text',
    'g_status' => 'tinyint(1) unsigned',
    'g_add_time' => 'int(10) unsigned',
    'g_add_ip' => 'varchar(15)',
  ),
);
?>