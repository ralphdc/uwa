<?php
return array (
  0 => 'admin_log_id',
  1 => 'm_userid',
  2 => 'al_operation',
  3 => 'al_status',
  4 => 'al_time',
  5 => 'al_ip',
  '_autoinc' => true,
  '_pk' => 'admin_log_id',
  '_type' => 
  array (
    'admin_log_id' => 'int(10) unsigned',
    'm_userid' => 'varchar(96)',
    'al_operation' => 'varchar(255)',
    'al_status' => 'tinyint(1) unsigned',
    'al_time' => 'int(10) unsigned',
    'al_ip' => 'varchar(15)',
  ),
);
?>