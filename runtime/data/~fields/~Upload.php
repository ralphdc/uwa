<?php
return array (
  0 => 'upload_id',
  1 => 'u_filename',
  2 => 'u_src',
  3 => 'u_type',
  4 => 'u_size',
  5 => 'u_add_time',
  6 => 'u_item_type',
  7 => 'u_item_id',
  8 => 'member_id',
  '_autoinc' => true,
  '_pk' => 'upload_id',
  '_type' => 
  array (
    'upload_id' => 'int(10) unsigned',
    'u_filename' => 'varchar(255)',
    'u_src' => 'varchar(255)',
    'u_type' => 'varchar(32)',
    'u_size' => 'int(10) unsigned',
    'u_add_time' => 'int(10) unsigned',
    'u_item_type' => 'varchar(96)',
    'u_item_id' => 'int(11)',
    'member_id' => 'int(10) unsigned',
  ),
);
?>