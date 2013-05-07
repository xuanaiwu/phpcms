<?php
	defined('IN_PHPCMS') or exit('No permission resources.');
	pc_base::load_app_class('foreground','member');
	class home extends foreground {
		function __construct() {
			parent::__construct();
			$this->siteurl = siteurl(1);
				$_username = param::get_cookie('_username');
				$_userid = param::get_cookie('_userid');
				$userid = intval(PLUGIN_ACTION);
				if($userid==0) $userid = $_userid;
				//初始化phpsso
				$phpsso_api_url = $this->_init_phpsso();
				//获取头像数组
				$avatar = $this->client->ps_getavatar($this->memberinfo['phpssouid']);
				if($r = $this->db->get_one("userid='$userid'",'username')) {
				$username = $r['username'];
				$api_url = 'http://open.phpcms.cn/api.php?op=loveit&action=homepage&username='.urlencode($username).'&domain='.ltrim($this->siteurl,'http://');
				$content_json = file_get_contents($api_url);

				$datas = json_decode($content_json,true);
				$infos = array();
				foreach($datas as $data) {
					$data['username'] = iconv('utf-8','gbk',$data['username']);
					$data['title'] = iconv('utf-8','gbk',$data['data']);
					$data['filepath'] = iconv('utf-8','gbk',$data['filepath']);
					$infos[] = $data;
				}
				$cache_var = getcache('loveit_var','plugins');
				$SEO = seo(1, '',$cache_var['title'],$cache_var['description'],$cache_var['title']);
				$homepage = $this->siteurl."/plugin.php?id=loveit-home-$_userid";
				$tab = $_userid== $userid ? 1 : 0;
				include template('plugin/loveit','index');
			} else {
				showmessage('访问地址有误，请核实');
			}
			exit;
		}
		/**
		 * 初始化phpsso
		 * about phpsso, include client and client configure
		 * @return string phpsso_api_url phpsso地址
		 */
		private function _init_phpsso() {
			pc_base::load_app_class('client', 'member', 0);
			define('APPID', pc_base::load_config('system', 'phpsso_appid'));
			$phpsso_api_url = pc_base::load_config('system', 'phpsso_api_url');
			$phpsso_auth_key = pc_base::load_config('system', 'phpsso_auth_key');
			$this->client = new client($phpsso_api_url, $phpsso_auth_key);
			return $phpsso_api_url;
		}


	}

?>