<?php
return array (
  0 => 'admin_id',
  1 => 'a_login_time',
  2 => 'a_login_ip',
  3 => 'a_ac_id',
  4 => 'member_id',
  5 => 'admin_role_id',
  '_autoinc' => true,
  '_pk' => 'admin_id',
  '_type' => 
  array (
    'admin_id' => 'mediumint(8) unsigned',
    'a_login_time' => 'int(10) unsigned',
    'a_login_ip' => 'varchar(15)',
    'a_ac_id' => 'text',
    'member_id' => 'int(10) unsigned',
    'admin_role_id' => 'tinyint(3) unsigned',
  ),
);
?>