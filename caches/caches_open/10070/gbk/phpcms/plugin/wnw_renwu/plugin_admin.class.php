<?php
	defined('IN_PHPCMS') or exit('No permission resources.');
	class plugin_admin {
		function __construct($pluginid) {
			$this->pluginid = $pluginid;
			$this->op = pc_base::load_app_class('plugin_op');
		}
		
		public function wnw_renwu() {		
				include $this->op->plugin_tpl('wnw_renwu_admin',PLUGIN_ID);
	
		}
		

		
	}
?>