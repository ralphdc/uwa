<?php
return array (
  0 => 'menu_id',
  1 => 'm_name',
  2 => 'm_tip',
  3 => 'm_parent_id',
  4 => 'm_type',
  5 => 'm_url',
  6 => 'm_target',
  7 => 'm_display_order',
  8 => 'ms_alias',
  '_autoinc' => true,
  '_pk' => 'menu_id',
  '_type' => 
  array (
    'menu_id' => 'smallint(5) unsigned',
    'm_name' => 'varchar(255)',
    'm_tip' => 'varchar(255)',
    'm_parent_id' => 'smallint(5) unsigned',
    'm_type' => 'tinyint(1) unsigned',
    'm_url' => 'varchar(255)',
    'm_target' => 'varchar(32)',
    'm_display_order' => 'tinyint(3) unsigned',
    'ms_alias' => 'varchar(96)',
  ),
);
?>