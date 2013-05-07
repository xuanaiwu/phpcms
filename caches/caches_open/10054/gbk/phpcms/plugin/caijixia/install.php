<?php

/**
 * @version    $Id install.php 1001 2011-7-1 qjp $
 * @copyright  Copyright (c) 2010-2011,qjp
 * @license    This is NOT a freeware, use is subject to license terms
 * @link       http://www.qjp.name
 */

defined('IN_PHPCMS') or exit('No permission resources.');

//创建插件菜单
$sql = "INSERT INTO `phpcms_menu` (`name`, `parentid`, `m`, `c`, `a`, `data`, `listorder`, `display`) VALUES
('caijixia', 9, 'admin', 'plugin', 'config', '', 0, '1');";
$this->db->query($sql);
$main_menu_id = $this->db->insert_id();

$sql = <<<EOF
INSERT INTO `phpcms_menu` (`name`, `parentid`, `m`, `c`, `a`, `data`, `listorder`, `display`) VALUES
('caijixia_setting', {$main_menu_id}, 'admin', 'plugin', 'config', '', 1, '1');
INSERT INTO `phpcms_menu` (`name`, `parentid`, `m`, `c`, `a`, `data`, `listorder`, `display`) VALUES
('caijixia_task', {$main_menu_id}, 'admin', 'plugin', 'config', '', 2, '1');


DROP TABLE IF EXISTS `phpcms_cjx_keyword`;
CREATE TABLE `phpcms_cjx_keyword` (
  `nid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `typeid` smallint(5) unsigned NOT NULL,
  `keyword` text,
  `isclose` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pn` smallint(5) unsigned NOT NULL DEFAULT '0',
  `update` int(15) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`nid`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `phpcms_cjx_cache`;
CREATE TABLE `phpcms_cjx_cache` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `typeid` smallint(5) unsigned NOT NULL,
  `url` text,
  PRIMARY KEY (`id`)
) TYPE=MyISAM;

DROP TABLE IF EXISTS `phpcms_cjx_hash`;
CREATE TABLE `phpcms_cjx_hash` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `hash` varchar(32) NOT NULL default '',
  PRIMARY KEY (`id`)
) TYPE=MyISAM;
EOF;
$info = $this->_sql_execute($sql);

//创建插件语言
$langdata = array(
    'caijixia'=>'phpcms采集侠',
    'caijixia_setting'=>'配置插件',
    'caijixia_task'=>'采集任务',
    //'caijixia_credits'=>'合作推广',
);
$file = PC_PATH.'languages'.DIRECTORY_SEPARATOR.'zh-cn'.DIRECTORY_SEPARATOR.'system_menu.lang.php';
require_once $file;
$content = file_get_contents($file);
$content = substr($content,0,-2);
foreach($langdata as $k => $v){
    if(!isset($LANG[$k]))
    {
        $content .= "\$LANG['{$k}'] = '{$v}';\r\n";
    }
}
$content .= "?>";
file_put_contents($file,$content);

$op_status = TRUE;

?>