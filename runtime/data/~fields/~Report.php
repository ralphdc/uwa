<?php
return array (
  0 => 'report_id',
  1 => 'r_item_type',
  2 => 'r_item_id',
  3 => 'r_info',
  4 => 'r_add_time',
  5 => 'r_add_ip',
  6 => 'r_status',
  '_autoinc' => true,
  '_pk' => 'report_id',
  '_type' => 
  array (
    'report_id' => 'int(10) unsigned',
    'r_item_type' => 'varchar(64)',
    'r_item_id' => 'int(10) unsigned',
    'r_info' => 'text',
    'r_add_time' => 'int(10) unsigned',
    'r_add_ip' => 'varchar(15)',
    'r_status' => 'tinyint(1) unsigned',
  ),
);
?>