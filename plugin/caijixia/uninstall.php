<?php

/**
 * @version    $Id uninstall.php 1001 2011-7-1 qjp $
 * @copyright  Copyright (c) 2010-2011,qjp
 * @license    This is NOT a freeware, use is subject to license terms
 * @link       http://www.qjp.name
 */

defined('IN_PHPCMS') or exit('No permission resources.');

$sql = <<<EOF
DELETE FROM `phpcms_menu` WHERE `name` like 'caijixia%';
DROP TABLE IF EXISTS `phpcms_cjx_keyword`;
DROP TABLE IF EXISTS `phpcms_cjx_cache`;
DROP TABLE IF EXISTS `phpcms_cjx_hash`;
EOF;
$info = $this->_sql_execute($sql);

//刷新应用菜单
echo '<script type="text/javascript">window.parent._M(9,"?m=admin&c=plugin&a=init")</script>';

$op_status = TRUE;

?>