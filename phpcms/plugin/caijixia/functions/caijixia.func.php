<?php

/**
 * @version    $Id caijixia.func.php 1001 2011-7-22 qjp $
 * @copyright  Copyright (c) 2010-2011,qjp
 * @license    This is NOT a freeware, use is subject to license terms
 * @link       http://www.qjp.name
 */

defined('IN_PHPCMS') or exit('No permission resources.');

function cjx_http_down($url){
    return file_get_contents($url);
}

function cjx_get($str){
    return isset($_GET[$str])?$_GET[$str]:false;
}

function cjx_cp($str){
	$cfg = getcache(PLUGIN_ID.'_cfg','plugins');
	if(!empty($cfg['textfb'])){
		$out = line2array($cfg['textfb']);
		foreach($out as $v){
			if(preg_match('/^{(.*?)}$/',$v,$mt)){
				$str = str_replace($mt[1],'',$str);
			}else if($v[0]=='/'){
			     $str = preg_replace($v,'',$str);
			}else{
				if(strpos($str,$v)!==false)
					cjx_msg(pluginlang('gjcb',array('v'=>$v),'caijixia'),0);
			}
		}
	}
    return $str;
}

function get_charset($str)
{
    preg_match("#<meta[^>]*?content-type[^>]*?>#is",$str,$mt);
    if(strpos(strtolower($mt[0]),'utf-8')!==false){
        return 'utf-8';
    }else if(strpos(strtolower($mt[0]),'gbk')!==false || strpos(strtolower($mt[0]),'gb2312')!==false){
        return 'gbk';
    }else{
        return false;
    }
}

function cjx_link_filter($str){
    $cfg = getcache(PLUGIN_ID.'_cfg','plugins');
    if(!empty($cfg['urlfb'])){
        $urr = line2array($cfg['urlfb']);
        foreach($urr as $v){
            if(strpos($str,$v)){
                cjx_msg(pluginlang('ljbh',array('link'=>$str,'v'=>$v),'caijixia'),0);
                return false;
            }
        }
    }
    return true;
}

function cjx_se($str){
    if(strlen($str)<150) return $str;
    $cfg = getcache(PLUGIN_ID.'_cfg','plugins');
    if($cfg['sec']>0 && !empty($cfg['sel'])){
        $sels = line2array($cfg['sel']);
        $total = count($sels);
        $cfg['sec'] = $cfg['sec']>$total?$total:$cfg['sec'];
        if(strpos($str,'，')!==false){$sp = '，';}else if(strpos($str,',')!==false){$sp = ',';}
        $arr = explode($sp,$str);
        for($i=0;$i<$cfg['sec'];$i++){
            $rand = mt_rand(0,count($arr)-1);
            $arr[$rand] = $arr[$rand].$sels[mt_rand(0,$total-1)];
        }
        $str = join($sp,$arr);
    }
    return $str;
}

function parse_rule($string){
    $hash = md5($string);
    if(isset($GLOBALS[$hash])) return $GLOBALS[$hash];
    $xml = pc_base::load_sys_class('xml');
    $str = $xml->xml_unserialize($string);
    $data = array();
    if(empty($str)){
        $data['type'] = 'string';
        $data['data']['keyword'] = $string;
    }else if(isset($str['rss'])){
        $data['type'] = 'rss';
        $data['data'] = $str['rss'];
    }else if(isset($str['listen'])){
        $data['type'] = 'listen';
        $data['data'] = $str['listen'];
    }
    $GLOBALS[$hash] = $data;
    return $data;
}

function get_keyword_links($r){
    $cfg = getcache(PLUGIN_ID.'_cfg','plugins');
    if(CHARSET!='gbk'){
        $r['keyword'] = iconv(CHARSET,'gbk//IGNORE',$r['keyword']);
    }
    if($cfg['sitetype']=='baidu') $cjport = "http://www.baidu.com/s?wd=";
    else $cjport = "http://news.baidu.com/ns?tn=news&from=news&cl=2&rn=10&word=";
    $pn = 10*$r['pn'];
    $api = $cjport.urlencode($r['keyword']).'&pn='.$pn;
    $html = cjx_http_down($api);
    $charset = get_charset($html);
    if($charset!=CHARSET) $html = iconv($charset,CHARSET.'//IGNORE',$html);
    preg_match_all('/(?<=href=")(http:\/\/)((?!baidu|").)*[^\/](?=")/iU',$html,$out);
    return count($out[0])>0?array_unique($out[0]):false;
}

function get_rss_links($r){
    $html = cjx_http_down($r['url']);
    if(empty($html)) return false;
    $data = array();
    //xml.class.php has some bug
    preg_match_all("/<item(.*)<link>(.*)<\/link>/isU",$html,$links);
    if(!isset($links[2])) return false;
    foreach($links[2] as $link){
        $data[] = preg_replace('/<\!\[CDATA\[(.*)\]\]>/iU','\\1',$link);
    }
    return count($data)>0?array_unique($data):false;
}

function cjx_ra($str){
    if(strlen($str)<150) return $str;
	$cfg = getcache(PLUGIN_ID.'_cfg','plugins');
	if(empty($cfg['lc']) || empty($cfg['keyl'])) return $str;
	$kv = line2array($cfg['keyl']);
    $str = cjx_pop($str,0);
	foreach($kv as $v){
        if(preg_match('/\|/',$v)){
			list($l,$r) = explode('|',$v);
			$str = preg_replace("#".preg_quote($l)."#", "<a href=\"$r\">$l</a>", $str, $cfg['lc']);
        }
	}
    return cjx_pop($str,1);
}

function cjx_pop($t,$type=0)
{
    if($type==1){
        foreach($GLOBALS['pop'] as $vs)
            $t = str_replace($vs['key'],$vs['val'],$t);
        return $t;
    }
    preg_match_all('/<a.*\/a>|<img.*>/isU',$t,$pop);
    $poptemp = array();
    foreach($pop[0] as $k => $v){
        $poptemp[$k]['key'] = '#'.md5($v).'#';
        $poptemp[$k]['val'] = $v;
        $t = str_replace($poptemp[$k]['val'],$poptemp[$k]['key'],$t);
    }
    $GLOBALS['pop'] = $poptemp;
    return $t;
}

function get_listen_links($r){
    $html = cjx_http_down($r['url']);
    if(empty($html)) return false;
    if($r['charset']!=CHARSET){
        $html = iconv($r['charset'], CHARSET.'//IGNORE', $html);
    }
    preg_match_all('#href[\s]?\=[\s]?["\'](http:\/\/[^"\']+)["\']#iU', $html, $out);
    $out[1] = array_unique($out[1]);
    $r['regex'] = str_replace('(*)','###',$r['regex']);
    $r['regex'] = preg_quote($r['regex'],'/');
    $r['regex'] = str_replace('###','[0-9a-zA-Z\-_]*',$r['regex']);
    foreach($out[1] as $k => $v){
        if(!preg_match("/^{$r['regex']}$/iU",$v)){
            unset($out[1][$k]);
        }
    }
    return count($out[1])>0?$out[1]:false;
}

function cjx_bef(&$str)
{
    $len = strlen($str);
    for($i=0;$i<$len;$i++){
        if($str[$i]!=='<') continue;
    	$ntag = strtolower($str[$i+1].$str[$i+2].$str[$i+3]);
    	if($ntag=='div'){
            $sp1 = $i;
        }else if($ntag=='/di'){
            $tmp = substr($str,$sp1,$i-$sp1+6);
            $tmp2 = preg_replace("#<(a|li|ul).*?\\1>#si",'',$tmp);
            if(strlen($tmp2)/strlen($tmp)<0.5){
                $str = str_replace($tmp,'',$str);
                cjx_bef($str);
                break;
            }
        }
     }
}

function cjx_rd(){
    $cfg = getcache(PLUGIN_ID.'_cfg','plugins');
    $args = getargs();
    if(!empty($args['sort'])){
        if($cfg['sort']==1){
            return "rand()";
        }
    }
    return "`update` asc";
}

function cjx_sp($str){
    $len = strlen($str);
    $divarr = array();
    for($i=0;$i<$len-100;$i++){
        if($str[$i]!=='<') continue;
    	$ntag = strtolower($str[$i+1].$str[$i+2].$str[$i+3]);
    	if($ntag=='div'){
    		for($j=$i,$fw=0;$j<$len-10;$j++){
                if($str[$j]!=='<') continue;
    			if($ntag == strtolower($str[$j+1].$str[$j+2].$str[$j+3])){
                    $fw++;
                    if($fw>5) break;
                    continue;
                }else if($ntag == strtolower($str[$j+2].$str[$j+3].$str[$j+4])){
                    $fw--;
                }
    			if($fw==0){
                    $temp = substr($str,$i+5,$j-$i-5);
                    if(check($temp)!==false)
                        $divarr[] = $temp;
    				break;
    			}}}}
    return count($divarr)>0?$divarr:false;
}

function check($str)
{
    $str = str_replace(array('，','。','!','?'),',',$str);
    $strarr = explode(',',$str);
    if(count($strarr)<5) return false;
    $len = strlen($str);
    $strtext = preg_replace('/<.*?>/s','',$str);
    $textlen = strlen($strtext);
    if($textlen<200) return false;
    if(($textlen/$len)<0.3) return false;
    return true;
}

function cjx_gettt($str)
{
	if(preg_match("/<title>(.*)<\/title>/isU", $str, $t)){
        if(preg_match_all("/<h([1-3])>(.*)<\/h\\1>/isU", $str, $ts))
            foreach($ts[2] as $vt)
                if(strpos($t[1],$vt)!==false) return $vt;
        $t[1] = str_replace(array('-','—','|'),'_',$t[1]);
		$splits = explode('_', $t[1]);
		$l = 0;
		foreach ($splits as $tp){
			$len = strlen($tp);
			if ($l < $len){$l = $len;$tt = $tp;}
		}
        $tt = trim(htmlspecialchars($tt));
        if(strlen($tt)>20) return $tt;
	}
	return false;
}

function cjx_keywords($data) {
	$http = pc_base::load_sys_class('http');
	if(CHARSET == 'utf-8') {
		$data = iconv('utf-8', 'gbk', $data);
	}
	$http->post('http://tool.phpcms.cn/api/get_keywords.php', array('siteurl'=>APP_PATH, 'charset'=>CHARSET, 'data'=>$data, 'number'=>5));
	if($http->is_ok()) {
		if(CHARSET != 'utf-8') {
			return $http->get_data();
		} else {
			return iconv('gbk', 'utf-8', $http->get_data());
		}
	} else {
		return $data;
	}
}

function cjx_msg($msg,$status=1,$exit=1){
    if(CHARSET!='utf8') $msg = iconv(CHARSET,'utf-8',$msg);
    $data = array();
    $data['msg'] = $msg;
    $data['status'] = $status;
    echo json_encode($data);
    if($exit) exit;
}

function line2array($str){
    $str = str_replace("\r","\n",$str);
    $strs = explode("\n",$str);
    $strs = array_filter($strs);
    sort($strs);
    return $strs;
}

function str_replace_once($needle, $replace, $haystack) {
    $pos = strpos($haystack, $needle);
    if($pos === false) return $haystack;
    return substr_replace($haystack, $replace, $pos, strlen($needle));
}
?>