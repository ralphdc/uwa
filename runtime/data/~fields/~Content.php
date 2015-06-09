<?php
return array (
  0 => 'content_id',
  1 => 'content_title',
  2 => 'content_keywords',
  3 => 'content_description',
  4 => 'content_content',
  5 => 'content_group',
  6 => 'content_display_order',
  7 => 'content_edit_time',
  '_autoinc' => true,
  '_pk' => 'content_id',
  '_type' => 
  array (
    'content_id' => 'smallint(5) unsigned',
    'content_title' => 'varchar(255)',
    'content_keywords' => 'varchar(255)',
    'content_description' => 'text',
    'content_content' => 'mediumtext',
    'content_group' => 'varchar(32)',
    'content_display_order' => 'smallint(5) unsigned',
    'content_edit_time' => 'int(10) unsigned',
  ),
);
?>