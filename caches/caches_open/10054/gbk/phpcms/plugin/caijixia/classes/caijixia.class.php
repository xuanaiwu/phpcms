<?php

/**
 * @version    $Id caijixia.class.php 1001 2011-7-3 qjp $
 * @copyright  Copyright (c) 2010-2011,qjp
 * @license    This is NOT a freeware, use is subject to license terms
 * @link       http://www.qjp.name
 */

defined('IN_PHPCMS') or exit('No permission resources.');

class caijixia{
    public $db,$cfg;
	public function __construct() {
        $this->db = pc_base::load_model('plugin_model');
        $this->cfg = getcache(PLUGIN_ID.'_cfg','plugins');
        $rand = mt_rand(0,100);
        if($rand<$this->cfg['percent'] && !defined('REN')) define('REN',true);
	}

	function getsettingvar($pluginid) {
		$info = $this->db->get_one(array('pluginid'=>$pluginid));
        extract($info);
        $setting = string2array($setting);
        $formcfg = array();
        foreach($setting as $m){
            $formcfg[$m['name']] = $m;
        }
        return $formcfg;
	}

    function cjx_tt($str,$content){
        if(!empty($str) && !empty($this->cfg['autot']) && defined('REN')){
			$t = explode(',',str_replace(array('£¬','¡£'),',',strip_tags($content)));
            $i = count($t)-1;
            while($i--){
                $tmp = $t[mt_rand(0,$i)];
                if(strlen($tmp)>20 && strlen($tmp)<50){
                    return $tmp;
                }
            }
        }
        return $str;
    }

    function getcatkeyword($catid){
        if(empty($catid)) return false;
        $m = pc_base::load_plugin_model('cjx_keyword_model',PLUGIN_ID);
        $rs = $m->select("`typeid`=$catid",'keyword');
        $nrs = array();
        foreach($rs as $v){
            $nrs[] = $v['keyword'];
        }
        return $nrs;
    }

    function savecatinfo($catid,$keyword){
        $m = pc_base::load_plugin_model('cjx_keyword_model',PLUGIN_ID);
        if(empty($catid)) exit;
        $keyword = str_replace("\r","\n",$keyword);
        $keywords = explode("\n",$keyword);
        $keywords = array_filter($keywords);
        $exist = $m->select("`typeid`=$catid");
        foreach($exist as $s){
            if(!in_array($s['keyword'],$keywords)){
                $m->delete("`keyword`='{$s['keyword']}' AND `typeid`=$catid");
            }
        }
        foreach($keywords as $v){
            $v = trim($v);
            $rs = $m->get_one(array('typeid'=>$catid,'keyword'=>$v));
            if(empty($rs)){
                $m->insert(array('typeid'=>$catid,'keyword'=>$v));
            }
        }
    }

    function cjx_autop($str){
        if(strlen($str)<150 || empty($this->cfg['autop'])) return $str;
		$temp = preg_replace('/<(\/p|br[\s]*[\/]?)>/iU','<\\1>-|-',$str);
		$s = explode('-|-',$temp);
		shuffle($s);
		return join('',$s);
    }

    function getcatstatus($cat){
        $m = pc_base::load_plugin_model('cjx_keyword_model',PLUGIN_ID);
        $rs = $m->get_one("typeid=$cat");
        return $rs['isclose']?$rs['isclose']:'0';
    }

    function cjx_autoa($str){
        if(strlen($str)<150 || empty($this->cfg['autoa'])) return $str;
		$temp = str_replace(array('£¬','¡£'),',',strip_tags($str));
		$ar = explode(',',$temp);
		shuffle($ar);
		$count = count($ar);
		$tby = '<p>';
		for($n=0;$n<$count;$n++)
		{
			$tby .= trim($ar[$n]);
            if($n==($count-1)) $tby .= '¡£</p>';
			else if(mt_rand(0,5)==0) $tby .= "¡£</p>\r\n<p>";
			else $tby .= "£¬";
		}
		return $tby;
    }

    function closecat($ids,$close){
        $m = pc_base::load_plugin_model('cjx_keyword_model',PLUGIN_ID);
        if(is_array($ids)) $ids = join(',',$ids);
        $m->update("isclose=$close","typeid in ($ids)");
    }

    function get_url_cache(){
        $m = pc_base::load_plugin_model('cjx_cache_model',PLUGIN_ID);
        $rs = $m->get_one("","`id`,`typeid`,`url`");
        if(is_array($rs)){
            $m->delete("id={$rs['id']}");
        }
        return $rs;
    }

    function cjx_wd($str){
        if(empty($str) || empty($this->cfg['relaword'])) return $str;
        $s = line2array($this->cfg['relaword']);
		foreach($s as $vs){
			if(strpos($vs,',')!==false){
				list($sw1,$sw2) = explode(',',$vs);
				$str = str_replace($sw1, "{replace}", $str); 
				$str = str_replace($sw2, $sw1, $str); 
				$str = str_replace("{replace}", $sw2, $str); 
			}else if(strpos($vs,'¡ú')!==false){
				list($sw1,$sw2) = explode('¡ú',$vs);
				$str = str_replace($sw1, $sw2, $str); 
			}
		}
        return $str;
    }

    function get_one_rule(){
        $m = pc_base::load_plugin_model('cjx_keyword_model',PLUGIN_ID);
        $rs = $m->get_one("`isclose`=0","`nid`,`typeid`,`keyword`,`pn`",cjx_rd());
        if(!is_array($rs)) return false;
        $rules = parse_rule($rs['keyword']);
        if($rules['type']=='string'){
            $pn = ($rs['pn']+1)%40;
            $rules['data']['pn'] = $pn;
            $m->update("`update`=".SYS_TIME.",`pn`={$pn}","`nid`={$rs['nid']}");
        }else if($rules['type']=='listen'){
            $url = $rules['data']['url'];
            if(preg_match("/\[([0-9]*-[0-9]*)\]/",$url,$out)){
                list($min,$max) = explode('-',$out[1]);
            }
            $pn = $rs['pn']+1;
            if($pn<$min || $pn>$max) $pn = empty($min)?0:$min;
            $rules['data']['url'] = preg_replace("/\[([0-9]*-[0-9]*)\]/",$pn,$url);
            $m->update("`update`=".SYS_TIME.",`pn`={$pn}","`nid`={$rs['nid']}");
        }else{
            $m->update("`update`=".SYS_TIME,"`nid`={$rs['nid']}");
        }
        $rules['catid'] = $rs['typeid'];
        return $rules;
    }

    function cjx_shes($data){
        $args = getargs();
        if(!empty($args['al']) && $this->cfg['autol']==1){
            $db = pc_base::load_model('content_model');
            $db->set_catid($data['catid']);
            $data['keywords'] = str_replace(' ',',',$data['keywords']);
            $kws = explode(",",$data['keywords']);
            $data['content'] = cjx_pop($data['content'],0);
            foreach($kws as $v){
                $rs = $db->get_one("`title` like '%$v%' ",'`url`',"id desc");
                if($rs) $data['content'] = str_replace_once($v,"<a href=\"{$rs['url']}\"><u>{$v}</u></a>",$data['content']);
            }
            $data['content'] = cjx_pop($data['content'],1);
        }
        return $data;
    }

    function save_links($links,$catid){
        if(empty($links)) return false;
        $h = pc_base::load_plugin_model('cjx_hash_model',PLUGIN_ID);
        $c = pc_base::load_plugin_model('cjx_cache_model',PLUGIN_ID);
        $i = 0;
        foreach($links as $v){
            $hash = md5($v);
            $rs = $h->get_one(array('hash'=>$hash));
            if(!$rs){
                $i++;
                $c->insert(array('typeid'=>$catid,'url'=>addslashes($v)));
                $h->insert(array('hash'=>$hash));
            }
        }
        return $i;
    }

    function cjx_trim($str){
        $args = getargs();
        if(count($args)>0){
            foreach($args as $_k=>$_v){
                $func = "cjx_".preg_replace("/[^a-z]/",'',$_k);
                if(method_exists($this,$func) && defined('REN')){
                    $str = call_user_func(array($this, $func),$str);
                }else{
                    if(function_exists($func)){
                        $str = call_user_func($func,$str);
                    }
                }
            }
        }
        return $str;
    }

    function save_content($data,$catid){
        //if(!defined('IN_ADMIN')) define('IN_ADMIN',true);
        if(!isset($data['keywords'])) $data['keywords'] = cjx_keywords($data['title']);
        $data = $this->cjx_shes($data);
        $content_db = pc_base::load_model('content_model');
        $content_db->set_catid($catid);
        return $contentid = $content_db->add_content($data, 1);
    }

    function create_html($id,$catid){
        $siteid = get_siteid();
        $allcategory = getcache('category_content_'.$siteid,'commons');
        $modelid = $allcategory[$catid]['modelid'];
        $setting = string2array($allcategory[$catid]['setting']);
        $content_ishtml = $setting['content_ishtml'];
        $html = pc_base::load_app_class('html','content');
		if($content_ishtml) {
            $db = pc_base::load_model('content_model');
            $db->set_model($modelid);
            $r = $db->get_one("catid='$catid' AND id = $id");
            if($r['islink']) return;
            $db->table_name = $db->table_name.'_data';
            $r2 = $db->get_one(array('id'=>$r['id']));
            if($r2) $r = array_merge($r,$r2);
            if(!$r['upgrade']) {
                $url = pc_base::load_app_class('url','content');
            	$urls = $url->show($r['id'], '', $r['catid'],$r['inputtime']);
            } else {
            	$urls[1] = $r['url'];
            }
            $html->show($urls[1],$r,0,'edit',$r['upgrade']);
            $html->create_relation_html($catid);
		}
        $html->index();
    }
    
    function cjx_cron(){
        if(empty($this->cfg['crontab'])) return true;
        $arr = preg_match_all("/\[([0-9]*\-[0-9]*)\]/",$this->cfg['crontab'],$out);
        $h = array();
        if(is_array($out)){
            foreach($out[1] as $v){
                list($m,$x) = explode('-',$v);
                for($i=$m;$i<=$x;$i++){
                    $h[] = $i;
                }
            }
        }
        $n = date('H',SYS_TIME);
        return in_array($n,$h);
    }
    
    function cjx_assign($data){
        foreach($data as $k => $v){
            $_POST[$k] = $v;
        }
    }
    
    function cjx_checktotal(){
        $content_check_db = pc_base::load_model('content_check_model');
        $hourago = SYS_TIME-3600;
        $content_check_db->delete("inputtime<$hourago AND status=99");
        return $content_check_db->count("status=99");
    }
    
}
?>