<?php
return array (
  'site' => 
  array (
    'name' => 'UWA 通用建站 - Universal Website AsThis',
    'host' => 'http://asthis.net',
    'logo' => 'u/site/logo.png',
    'logo_mobile' => 'u/site/logo_mobile.png',
    'language' => 'zh-cn',
    'lang_detect' => '0',
    'theme' => 'default',
    'mobile_version' => '0',
    'tpl_protection' => '0',
    'timezone' => '8',
    'time_format' => 'Y-m-d H:i:s',
    'keywords' => 'uwa,通用建站如斯',
    'description' => '一个uwa通用建站如斯网站',
    'copyright' => '<p>&copy;2014 <a href="http://asthis.net" target="_blank"><strong>asthis.net</strong></a></p>
',
    'stat_code' => '',
  ),
  'core' => 
  array (
    'host_prefix_switch' => '0',
    'rewrite_switch' => '0',
    'html_switch' => '0',
    'forced_html' => '0',
    'gzip_switch' => '0',
    'cache_expire' => '3600',
    'html_expire_index' => '7200',
    'html_expire_list' => '14400',
    'html_expire_archive' => '604800',
    'html_path' => 'a',
    'cookie_prefix' => 'uwa_',
    'cookie_expire' => '3600',
    'cookie_key' => '8gQvnSOF7OOuSiSR',
    'debug_switch' => '1',
    'debug_stat' => '0',
    'debug_page_trace' => '0',
  ),
  'index' => 
  array (
    'html_switch' => '0',
    'paging_switch' => '0',
    'page_size' => '20',
    'tpl' => 'index',
    'tpl_paging' => 'index_paging',
    'html_naming' => 'index',
    'html_naming_paging' => 'index_{page}',
    'html_path_paging' => '{uwa_path}a',
  ),
  'performance' => 
  array (
    'cache_type' => 'File',
    'memcache_host' => '127.0.0.1',
    'memcache_port' => '11211',
    'sphinx_switch' => '0',
    'sphinx_host' => '127.0.0.1',
    'sphinx_port' => '9312',
  ),
  'member' => 
  array (
    'switch' => '1',
    'register' => '1',
    'name_ban' => 'www,bbs,ftp,mail,user,users,admin,administrator',
    'userid_min_length' => '5',
    'password_min_length' => '5',
    'pass_type' => '1',
    'verify_email_validity' => '7200',
    'login_credit' => 
    array (
      'm_experience' => '2',
      'm_points' => '0',
      'mc_credit' => '0',
      'mc_copper' => '2',
      'mc_silver' => '0',
    ),
    'publish_credit' => 
    array (
      'm_experience' => '2',
      'm_points' => '0',
      'mc_credit' => '0',
      'mc_copper' => '2',
      'mc_silver' => '0',
    ),
    'review_credit' => 
    array (
      'm_experience' => '1',
      'm_points' => '0',
      'mc_credit' => '0',
      'mc_copper' => '1',
      'mc_silver' => '0',
    ),
  ),
  'upload' => 
  array (
    'switch' => '0',
    'imgtype' => 'jpg,jpeg,gif,png',
    'filetype' => 'zip,7z,rar',
    'dir' => 'u',
    'sub_dir' => 'Ym/d',
    'space' => '102400',
    'maxsize' => '512',
  ),
  'image' => 
  array (
    'thumb_prefix' => 'thumb_',
    'thumb_width' => '300',
    'thumb_height' => '180',
    'thumb_proportional' => '1',
    'watermark' => '0',
    'watermark_type' => '0',
    'watermark_image' => '/u/site/watermark.png',
    'watermark_text' => 'asthis.net',
    'watermark_text_font' => 'font.ttf',
    'watermark_text_size' => '12',
    'watermark_text_color' => '000000',
    'watermark_position' => '9',
  ),
  'interaction' => 
  array (
    'review_switch' => '1',
    'search_switch' => '1',
    'feedback_check' => '0',
    'feedback_interval' => '9',
    'search_interval' => '3',
    'captcha' => '1',
    'manage_captcha' => '1',
    'report_switch' => '1',
    'auto_report' => '1',
    'filter_words' => '胡锦涛|江泽民',
    'filter_replace' => '*',
    'allow_tags' => 'table|tbody|tfoot|th|tr|td|div|p|ul|ol|li|dl|dt|dd|strong|em|b|i|u|a|span|img|br|object|param|embed|sup|sub|h1|h2|h3|h4|h5|h6|h7|blockquote|hr',
  ),
  'contact_company_name' => 'AsThis, Inc.',
);
?>