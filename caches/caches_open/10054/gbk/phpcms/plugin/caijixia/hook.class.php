<?php

/**
 * @version    $Id hook.class.php 1001 2011-7-3 qjp $
 * @copyright  Copyright (c) 2010-2011,qjp
 * @license    This is NOT a freeware, use is subject to license terms
 * @link       http://www.qjp.name
 */

defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_sys_class('hook','','0');

class caijixia_hook extends hook{
    Final static function glogal_footer() {
        return '<script language="javascript" type="text/javascript" src="'.PLUGIN_STATICS_PATH.'caijixia/cjx.js"></script>';
    }
}
?>