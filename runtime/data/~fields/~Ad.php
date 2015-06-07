<?php
return array (
  0 => 'ad_id',
  1 => 'a_name',
  2 => 'ad_space_id',
  3 => 'a_file',
  4 => 'a_content',
  5 => 'a_link',
  6 => 'a_time_limit',
  7 => 'a_start_time',
  8 => 'a_end_time',
  9 => 'a_display_order',
  '_autoinc' => true,
  '_pk' => 'ad_id',
  '_type' => 
  array (
    'ad_id' => 'smallint(5) unsigned',
    'a_name' => 'varchar(255)',
    'ad_space_id' => 'tinyint(3) unsigned',
    'a_file' => 'varchar(255)',
    'a_content' => 'text',
    'a_link' => 'varchar(255)',
    'a_time_limit' => 'tinyint(1) unsigned',
    'a_start_time' => 'int(10) unsigned',
    'a_end_time' => 'int(10) unsigned',
    'a_display_order' => 'smallint(5) unsigned',
  ),
);
?>