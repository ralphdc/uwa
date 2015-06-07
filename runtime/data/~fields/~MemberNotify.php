<?php
return array (
  0 => 'member_notify_id',
  1 => 'mn_admin_userid',
  2 => 'mn_m_id',
  3 => 'mn_status',
  4 => 'mn_send_time',
  5 => 'mn_title',
  6 => 'mn_content',
  '_autoinc' => true,
  '_pk' => 'member_notify_id',
  '_type' => 
  array (
    'member_notify_id' => 'int(11) unsigned',
    'mn_admin_userid' => 'varchar(96)',
    'mn_m_id' => 'int(11)',
    'mn_status' => 'tinyint(1) unsigned',
    'mn_send_time' => 'int(10) unsigned',
    'mn_title' => 'varchar(255)',
    'mn_content' => 'text',
  ),
);
?>