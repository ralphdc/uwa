<?php
return array (
  'archive_model_id' => '2',
  'am_alias' => 'article',
  'am_name' => '文章',
  'am_addon_table' => 'archive_addon_article',
  'am_type' => '0',
  'am_status' => '1',
  'am_display_order' => '10',
  'am_tpl_list' => 'archive/list_archive_article',
  'am_tpl_add' => 'archive/add_archive_article',
  'am_tpl_edit' => 'archive/edit_archive_article',
  'am_tpl_list_member' => 'archive/list_archive_article',
  'am_tpl_add_member' => 'archive/add_archive_article',
  'am_tpl_edit_member' => 'archive/edit_archive_article',
  'ac_tpl_index_default' => 'index_channel_article',
  'ac_tpl_list_default' => 'list_archive_article',
  'ac_tpl_archive_default' => 'show_archive_article',
  'am_fieldset' => '<field:a_a_source f_item_name="文章来源" f_type="simpletext" f_length="32" f_default="" f_is_auto="0" f_is_list="1" f_is_filter="0" >
</field:a_a_source>
<field:a_a_author f_item_name="文章作者" f_type="simpletext" f_length="32" f_default="" f_is_auto="0" f_is_list="1" f_is_filter="0" >
</field:a_a_author>
<field:a_a_content f_item_name="文章内容" f_type="htmltext" f_length="" f_default="" f_is_auto="1" f_is_list="0" f_is_filter="1" f_save_remote="1" f_watermark_remote="1" f_get_thumb="1" f_get_abstract="1" f_is_paging="1" >
</field:a_a_content>',
  'am_field' => 
  array (
    'a_a_source' => 
    array (
      'f_item_name' => '文章来源',
      'f_type' => 'simpletext',
      'f_length' => '32',
      'f_default' => '',
      'f_is_auto' => '0',
      'f_is_list' => '1',
      'f_is_filter' => '0',
    ),
    'a_a_author' => 
    array (
      'f_item_name' => '文章作者',
      'f_type' => 'simpletext',
      'f_length' => '32',
      'f_default' => '',
      'f_is_auto' => '0',
      'f_is_list' => '1',
      'f_is_filter' => '0',
    ),
    'a_a_content' => 
    array (
      'f_item_name' => '文章内容',
      'f_type' => 'htmltext',
      'f_length' => '',
      'f_default' => '',
      'f_is_auto' => '1',
      'f_is_list' => '0',
      'f_is_filter' => '1',
      'f_save_remote' => '1',
      'f_watermark_remote' => '1',
      'f_get_thumb' => '1',
      'f_get_abstract' => '1',
      'f_is_paging' => '1',
    ),
  ),
);
?>