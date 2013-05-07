<?php

/**
 * @version    $Id cjx.class.php 1001 2011-7-3 qjp $
 * @copyright  Copyright (c) 2010-2011,qjp
 * @license    This is NOT a freeware, use is subject to license terms
 * @link       http://www.qjp.name
 */

defined('IN_PHPCMS') or exit('No permission resources.');
@set_time_limit(30);
@ignore_user_abort(true);

class cjx{
    private $cjx,$app,$cfg,
    $pattern = array(
        '#<!DOCTYPE.*?>#si' => '',
        '#<!--.*?-->#s' => '',
        '#<(script|noscript|style|object|form|iframe).*?>.*?<\/\\1>#si' => '',
        '/&.{1,5};|&#.{1,5};/' => '',
        '#<([^a|i][^>|\s]*)\s[^>]*>#si' => '<$1>',
        '#<([a-z0-9]{1,6})>\s*<\/\\1>#si' => '',
        '#<([\/]?)table>#i' => '<$1div>',
        '#<([\/]?)(tr|tbody)>#i' => '<$1p>',
        '#<([\/]?)(meta|link|th|td|embed|b|font).*>#i' => '',
    );
    
	public function __construct(){
        pc_base::load_plugin_func('caijixia',PLUGIN_ID);
        $this->cjx = pc_base::load_plugin_class('caijixia',PLUGIN_ID,1);
        $this->app = getcache(PLUGIN_ID.'_app_cfg','plugins');
        $this->cfg = $cfg_cache = getcache(PLUGIN_ID.'_cfg','plugins');
	}

    public function init() {
        if(!$this->cjx->cjx_cron()) cjx_msg(pluginlang('ncjt','','caijixia'),-1);
        // phpcms! setcache timeout => bug
        if( !cjx_get('do') ){
            if($this->cfg['enable']==0) cjx_msg(pluginlang('cjgb','','caijixia'),-1);
            $cachetime = getcache(PLUGIN_ID.'_lock','plugins');
            if($cachetime+10>SYS_TIME){
                cjx_msg(pluginlang('ljgd','','caijixia'),-1);
            }
            setcache(PLUGIN_ID.'_lock',SYS_TIME,'plugins');
        }
        $total = $this->cjx->cjx_checktotal();
        if($total>=$this->cfg['maxcount']) cjx_msg(pluginlang('rwwc','','caijixia'),-1);
        $this->cjx_st();
    }

    public function cjx_app()
    {
        cjx_msg($this->app,!empty($this->app));
    }

    public function cjx_st()
    {
        $cache = $this->cjx->get_url_cache();
        if($cache){
            $str = file_get_contents($cache['url']);
            $this->cjx_ct($str);
            cjx_bef($str);
            $str = $this->cjx_cl($str);
            $arr = cjx_sp($str);
            $content = $this->cjx_by($arr);
            if($content==false || strlen($content)<200) cjx_msg(pluginlang('bfyq','','caijixia'),0);
            $content = preg_replace('/<img[^>]*src=[\'"]?([^>\'"\s]*)[\'"]?[^>]*>/ie', "self::cjx_ig('$0', '$1', '{$cache['url']}')", $content);
            $this->cjx_sa($cache,$str,$this->cjx->cjx_trim($content));
        }else{
            $this->cjx_rl();
        }
    }

    public function cjx_ct(&$str){
        $ch = get_charset($str);
        if($ch!=CHARSET)
        {
            $str = iconv($ch,CHARSET.'//IGNORE',$str);
        }
    }

    public function cjx_rl()
    {
        $rules = $this->cjx->get_one_rule();
        if(!is_array($rules)) cjx_msg(pluginlang('tjgj','','caijixia'),-1);
        switch($rules['type']){
            case 'string':
                $links = get_keyword_links($rules['data']);
                break;
            case 'rss':
                $links = get_rss_links($rules['data']);
                break;
            case 'listen':
                $links = get_listen_links($rules['data']);
                break;
            default:
        }
        if(is_array($links)){
            $links = array_filter($links,"cjx_link_filter");
            $su = $this->cjx->save_links($links,$rules['catid']);
            cjx_msg(pluginlang('cglj',array('n'=>$su),'caijixia'),1);
        }else{
            cjx_msg(pluginlang('wfdq','','caijixia'),0);
        }
    }
    
    private function cjx_cl($str){
        $strlen = 0;
        while(strlen($str)<$strlen || $strlen==0)
        {
            $strlen = strlen($str);
            $str = preg_replace(array_keys($this->pattern),$this->pattern,$str);
        }
        return $str;
    }
    
    private function cjx_by($arr){
        if($arr!==false){
            $w=0;
            foreach($arr as $k => $v){
                $v = str_replace(array('£¬','¡£','!','?'),',',$v);
            	$wgt = strlen($v);
                $ps  =explode("\n",$v);
                $ds  =explode('<',$v);
                $fs = explode(',',$v);
                $as = explode('<a',$v);
                $ls = explode('<li',$v);
                $wgt = $wgt + (count($fs)-count($ds)-count($ps))*15 - (count($as)+count($ls))*150;
            	if($w<$wgt){
            		$w = $wgt;$bk = $k;
                }
            }
            if(isset($bk)){
                return strip_tags($arr[$bk],"<img>,<p>,<div>,<br>");
            }
        }
        return false;
    }
    
    private function cjx_sa($cache,$str,$content){
        $data['title'] = $this->cjx->cjx_trim(cjx_gettt($str));
        $data['title'] = $this->cjx->cjx_tt($data['title'],$content);
        if($data['title']==false) cjx_msg(pluginlang('btbf','','caijixia'),0);
        $data['content'] = $content;
        $data['catid'] = $cache['typeid'];
        $data['status'] = 99;
        $data['username'] = 'caijixia';
        if($this->cfg['cofy']==1){
            $this->cjx->cjx_assign(array('paginationtype'=>1,'maxcharperpage'=>$this->cfg['spsize']));
        }
        $this->cjx->cjx_assign(array('add_introduce'=>1,'introcude_length'=>200,'auto_thumb'=>1));
        $id = $this->cjx->save_content($data,$cache['typeid']);
        if($id>0){
            $this->cjx->create_html($id,$cache['typeid']);
            cjx_msg(pluginlang('cgcj',array('title'=>$data['title']),'caijixia'),1);
        }else{
            cjx_msg(pluginlang('wzbf','','caijixia'),0);
        }
    }
    
	protected static function cjx_ig($old, $out, $url) {
        $old = "<div style=\"text-align:center\">".str_replace('\"', '"', $old)."</div>";
		if (!empty($old) && !empty($out) && strpos($out, '://') === false) {
			return str_replace($out, self::cjx_ck($out, $url), $old);
		} else {
			return $old;
		}
	}
    
	protected static function cjx_ck($url, $baseurl) {
		$urlinfo = parse_url($baseurl);
		$baseurl = $urlinfo['scheme'].'://'.$urlinfo['host'].(substr($urlinfo['path'], -1, 1) === '/' ? substr($urlinfo['path'], 0, -1) : str_replace('\\', '/', dirname($urlinfo['path']))).'/';
		if ($url[0] == '/') {
			$url = $urlinfo['scheme'].'://'.$urlinfo['host'].$url;
		} else {
            $url = $baseurl.$url;
		}
		return $url;
	}
}
?>