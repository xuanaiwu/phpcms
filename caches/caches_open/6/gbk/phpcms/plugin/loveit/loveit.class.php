<?php
	defined('IN_PHPCMS') or exit('No permission resources.');
	pc_base::load_app_class('foreground','member');
	class loveit extends foreground {
		function __construct() {
			parent::__construct();
			$this->siteurl = siteurl(1);
		}
		public function init() {
			$_username = param::get_cookie('_username');
			$_userid = param::get_cookie('_userid');
			$userid = $_userid;

			//��ʼ��phpsso
			$phpsso_api_url = $this->_init_phpsso();
			//��ȡͷ������
			$avatar = $this->client->ps_getavatar($this->memberinfo['phpssouid']);
			//$this->memberinfo;
			$content_json = file_get_contents('http://open.phpcms.cn/api.php?op=loveit&action=get_new_list');
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
			$tab = 1;
			include template('plugin/loveit','index');
		}
		//��ϲ����
		public function mylove() {
			$_username = param::get_cookie('_username');
			$_userid = param::get_cookie('_userid');
			$userid = $_userid;

			//��ʼ��phpsso
			$phpsso_api_url = $this->_init_phpsso();
			//��ȡͷ������
			$avatar = $this->client->ps_getavatar($this->memberinfo['phpssouid']);
			
			//$this->memberinfo;
			$api_url = 'http://open.phpcms.cn/api.php?op=loveit&action=mylove&username='.urlencode($_username).'&domain='.ltrim($this->siteurl,'http://');
			$content_json = file_get_contents($api_url);

			$datas = json_decode($content_json,true);
			$infos = array();
			foreach($datas as $data) {
				$data['username'] = iconv('utf-8','gbk',$data['username']);
				$data['title'] = iconv('utf-8','gbk',$data['data']);
				$data['filepath'] = iconv('utf-8','gbk',$data['filepath']);
				$infos[] = $data;
			}

			$homepage = $this->siteurl."/plugin.php?id=loveit-home-$_userid";
			$tab = 2;
			include template('plugin/loveit','index');
		}
		/**
		 * add_to_mylove
		 */
		public function add_to_mylove() {
			$http = pc_base::load_sys_class('http');
			$info = array();
			$info['siteurl'] = $this->siteurl;
			$info['username'] = $this->memberinfo['username'];
			$info['id'] = intval($_POST['id']);
			$http->post('http://open.phpcms.cn/api.php?op=loveit&action=add_to_mylove',$info);
			$return_data = $http->get_data();
			$return_data = json_decode($return_data,true);
			if($return_data['errno']==1) {
				echo '1';
			}
		}
		
		/**
		 * �ύ��ַ
		 */
		public function submit_url() {
			$http = pc_base::load_sys_class('http');
			$info = array();
			$info['siteurl'] = $this->siteurl;
			$info['username'] = $this->memberinfo['username'];
			$info['filepath'] = iconv('utf-8','gbk',$_POST['loveurl']);
			$meta_tags = get_meta_tags($info['filepath']);
			$title = $meta_tags['description'];
			if(trim($title) =='') {
				$content = file_get_contents($info['filepath'],FALSE,NULL,0,1024);
				preg_match('/<title>(.*)<\/title>/',$content,$_title);
				$title = $_title[1];
			}
			if(mb_check_encoding($title,'utf-8')) {
				$title = iconv('utf-8','gbk',$title);
			}
			$info['data'] = $title;
			//��ʼ��phpsso
			$phpsso_api_url = $this->_init_phpsso();
			//��ȡͷ������
			$avatar = $this->client->ps_getavatar($this->memberinfo['phpssouid']);
			$info['user_face'] = $avatar[90];

			$http->post('http://open.phpcms.cn/api.php?op=loveit&action=submit',$info);
			$return_data = $http->get_data();
			$return_data = json_decode($return_data,true);
			if($return_data['errno']==1) {
				$string = '<div class="feed cell_feed_shortword"><div class="txt">'.$title.' - '.$info['filepath'].'</div></div>';
				echo $string;
			} else {
				echo $return_data['msg'];
			}
		}
		/**
		 * �ύͼƬ
		 */
		public function submit_img() {
			$http = pc_base::load_sys_class('http');
			$info = array();
			$info['siteurl'] = $this->siteurl;
			$info['username'] = $this->memberinfo['username'];
			$info['filepath'] = $_POST['imgurl'];
			$info['type'] = 1;//ͼƬ����
			
			$info['data'] = $title = iconv('utf-8','gbk',$_POST['title']);
			//��ʼ��phpsso
			$phpsso_api_url = $this->_init_phpsso();
			//��ȡͷ������
			$avatar = $this->client->ps_getavatar($this->memberinfo['phpssouid']);
			$info['user_face'] = $avatar[90];
			$http->post('http://open.phpcms.cn/api.php?op=loveit&action=submit',$info);
			$return_data = $http->get_data();
			$return_data = json_decode($return_data,true);
			if($return_data['errno']==1 || 1) {
				$string = '<div class="feed cell_feed_shortword"><div class="txt">'.$title.' <img src="'.$info['filepath'].'" width="560"></div></div>';
				echo $string;
			} else {
				echo $return_data['msg'];
			}
		}

		/**
		 * �ύ�ļ�
		 */
		public function submit_file() {
			$http = pc_base::load_sys_class('http');
			$info = array();
			$info['siteurl'] = $this->siteurl;
			$info['username'] = $this->memberinfo['username'];
			$info['filepath'] = $_POST['fileurl'];
			$info['type'] = 2;//�ļ�����
			
			$info['data'] = $title = iconv('utf-8','gbk',$_POST['title']);
			//��ʼ��phpsso
			$phpsso_api_url = $this->_init_phpsso();
			//��ȡͷ������
			$avatar = $this->client->ps_getavatar($this->memberinfo['phpssouid']);
			$info['user_face'] = $avatar[90];
			$http->post('http://open.phpcms.cn/api.php?op=loveit&action=submit',$info);
			$return_data = $http->get_data();
			$return_data = json_decode($return_data,true);
			if($return_data['errno']==1 || 1) {
				$string = '<div class="feed cell_feed_shortword"><div class="txt">'.$title.' �����ĵ���<a href="'.$info['filepath'].'" target="_blank">�������</a></div></div>';
				echo $string;
			} else {
				echo $return_data['msg'];
			}
		}
		/**
		 * ajaxpage
		 */
		public function ajaxpage() {
			$_username = param::get_cookie('_username');
			$_userid = param::get_cookie('_userid');
			$userid = $_userid;

			//��ʼ��phpsso
			$phpsso_api_url = $this->_init_phpsso();
			//��ȡͷ������
			$avatar = $this->client->ps_getavatar($this->memberinfo['phpssouid']);
			$page = intval($_GET['page']);
			$content_json = file_get_contents('http://open.phpcms.cn/api.php?op=loveit&action=get_new_list&page='.$page);
			if($content_json!='null') {
				echo $content_json;
			} else {
				echo '-1';
			}
		}
	
		/**
		 * �ϴ�
		 */
		public function upload() {
			$http = pc_base::load_sys_class('http');
			$info = array();
			$info['type'] = $_GET['type'];
			pc_base::load_sys_class('attachment','',0);
			$attachment = new attachment('loveit',0,1,'loveit/');
			$_userid = param::get_cookie('_userid');
			$attachment->set_userid($_userid);

			if($info['type']=='file') {
				$a = $attachment->upload('upload_file','doc|ppt|xls|pdf|txt');
				if($a) {
					$filepath = $attachment->uploadedfiles[0]['filepath'];
				}
				if($filepath) $filepath = pc_base::load_config('system','upload_path').$filepath;
				$files = array('upload_file'=>$filepath);
			} else {
				$a = $attachment->upload('upimage','jpg|jpeg|gif|png');
				if($a) {
					$filepath = $attachment->uploadedfiles[0]['filepath'];
				}
				if($filepath) $filepath = pc_base::load_config('system','upload_path').$filepath;
				$files = array('upload_image'=>$filepath);
			}
			$http->upload('http://open.phpcms.cn/api.php?op=upload_img',$info,$files);
			echo $return_data = $http->get_data();
		}

		
		/**
		 * ��������
		 */
		public function push() {
			$http = pc_base::load_sys_class('http');
			$ids = $_POST['ids'];
			$this->content_db = pc_base::load_model('content_model');
			$catid = intval($_GET['catid']);
			$this->content_db->set_catid($catid);
			
			if(!empty($ids) && is_array($ids)) {
				//��ʼ��phpsso
				$phpsso_api_url = $this->_init_phpsso();
				//��ȡͷ������
				$avatar = $this->client->ps_getavatar($this->memberinfo['phpssouid']);

				foreach($ids AS $id) {
					$info = array();
					$info['siteurl'] = $this->siteurl;
					$info['username'] = $this->memberinfo['username'];
					$r = $this->content_db->get_one(array('id'=>$id));
					
					$info['filepath'] = $r['url'];
					$meta_tags = get_meta_tags($info['filepath']);
					$title = $meta_tags['description'];
					if(trim($title) =='') {
						$content = file_get_contents($info['filepath'],FALSE,NULL,0,1024);
						preg_match('/<title>(.*)<\/title>/',$content,$_title);
						$title = $_title[1];
					}
					if(!$title) showmessage('�����ˣ����������ύ�ġ����ӵ�ַ���ܱ��������ʣ�');
					if(mb_check_encoding($title,'utf-8')) {
						$title = iconv('utf-8','gbk',$title);
					}
					$info['data'] = $title;
					$info['user_face'] = $avatar[90];

					$http->post('http://open.phpcms.cn/api.php?op=loveit&action=submit',$info);
				}
				showmessage('�ɹ��ύ��ϲ������',HTTP_REFERER);
			} else {
				showmessage(L('you_do_not_check','','content'));
			}
		}
		/**
		 * ��ʼ��phpsso
		 * about phpsso, include client and client configure
		 * @return string phpsso_api_url phpsso��ַ
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