<?php
return array (
  0 => 'task_id',
  1 => 't_name',
  2 => 't_description',
  3 => 't_file',
  4 => 't_addon_params',
  5 => 't_run_time',
  6 => 't_cycle_time',
  7 => 't_time_limit',
  8 => 't_start_time',
  9 => 't_end_time',
  10 => 't_last_run_time',
  11 => 't_status',
  '_autoinc' => true,
  '_pk' => 'task_id',
  '_type' => 
  array (
    'task_id' => 'tinyint(3) unsigned',
    't_name' => 'varchar(96)',
    't_description' => 'text',
    't_file' => 'varchar(96)',
    't_addon_params' => 'varchar(255)',
    't_run_time' => 'varchar(8)',
    't_cycle_time' => 'int(10) unsigned',
    't_time_limit' => 'tinyint(1) unsigned',
    't_start_time' => 'int(10) unsigned',
    't_end_time' => 'int(10) unsigned',
    't_last_run_time' => 'int(10) unsigned',
    't_status' => 'tinyint(1) unsigned',
  ),
);
?>