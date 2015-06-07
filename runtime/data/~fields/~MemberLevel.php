<?php
return array (
  0 => 'member_level_id',
  1 => 'ml_name',
  2 => 'ml_rank',
  3 => 'ml_min_experience',
  4 => 'ml_permission',
  5 => 'ml_type',
  6 => 'ml_upload_option',
  '_autoinc' => true,
  '_pk' => 'member_level_id',
  '_type' => 
  array (
    'member_level_id' => 'tinyint(3) unsigned',
    'ml_name' => 'varchar(96)',
    'ml_rank' => 'smallint(6)',
    'ml_min_experience' => 'int(10) unsigned',
    'ml_permission' => 'text',
    'ml_type' => 'tinyint(1) unsigned',
    'ml_upload_option' => 'text',
  ),
);
?>