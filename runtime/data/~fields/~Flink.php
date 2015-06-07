<?php
return array (
  0 => 'flink_id',
  1 => 'f_site_name',
  2 => 'f_site_url',
  3 => 'f_site_logo',
  4 => 'f_site_description',
  5 => 'f_webmaster_email',
  6 => 'f_show_type',
  7 => 'f_display_order',
  8 => 'f_status',
  9 => 'flink_category_id',
  '_autoinc' => true,
  '_pk' => 'flink_id',
  '_type' => 
  array (
    'flink_id' => 'int(10) unsigned',
    'f_site_name' => 'varchar(255)',
    'f_site_url' => 'varchar(255)',
    'f_site_logo' => 'varchar(255)',
    'f_site_description' => 'text',
    'f_webmaster_email' => 'varchar(255)',
    'f_show_type' => 'tinyint(1) unsigned',
    'f_display_order' => 'smallint(5) unsigned',
    'f_status' => 'tinyint(1) unsigned',
    'flink_category_id' => 'smallint(5) unsigned',
  ),
);
?>