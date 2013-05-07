<?php

/**
 * @version    $Id plugin_admin.class.php 1001 2011-7-1 qjp $
 * @copyright  Copyright (c) 2010-2011,qjp
 * @license    This is NOT a freeware, use is subject to license terms
 * @link       http://www.qjp.name
 */

defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_app_class('admin','admin',0);
pc_base::load_sys_class('form', '', 0);

class plugin_admin extends admin {
    private $op,$db,$siteid;
    public $pluginid;
    function __construct($pluginid) {
        $this->pluginid = $pluginid;
        $this->siteid = $this->get_siteid();
        $this->op = pc_base::load_app_class('plugin_op');
		$this->db = pc_base::load_model('plugin_model');
        $this->cjx = pc_base::load_plugin_class('caijixia',PLUGIN_ID,1);
        $this->app = getcache(PLUGIN_ID.'_app_cfg','plugins');
        //首次运行，修正、刷新菜单
        $this->setup();
    }

    /**
     * 修正、刷新菜单
     */
    
    private function setup()
    {
        $menu = pc_base::load_model('menu_model');
        if($rs = $menu->select(array('name'=>'caijixia','data'=>''))){
            $menu->update(array('data'=>"pluginid=$this->pluginid"),"name = 'caijixia' OR name = 'caijixia_setting'");
            $menu->update(array('data'=>"module=task&pluginid=$this->pluginid"),"name = 'caijixia_task'");
            $menu->update(array('data'=>"module=credits&pluginid=$this->pluginid"),"name = 'caijixia_credits'");
            echo '<script type="text/javascript">window.parent._M(9,"?m=admin&c=plugin&a=init")</script>';
        }
    }

    /**
     * 配置
     */
    
    public function setting_action($module)
    {
        $formcfg = $this->cjx->getsettingvar($this->pluginid);
        $cfg_cache = getcache(PLUGIN_ID.'_cfg','plugins');
        if(isset($_POST['caijixiasubmit']))
        {
            $fields = array();
            foreach($formcfg[$module]['setting_var'] as $r) {
                $fields[] = $r['fieldname'];
            }
            $cfg = empty($cfg_cache)?array():$cfg_cache;
            foreach ($_POST['info'] as $_k => $_v) {
                if(in_array($_k,$fields) && !preg_match('#^//#',$_v)){
                    $cfg[$_k] = stripslashes($_v);
                }
            }
            setcache(PLUGIN_ID.'_cfg', $cfg, 'plugins');
            showmessage(L('operation_success'),HTTP_REFERER);
        }else{
            foreach($formcfg[$module]['setting_var'] as $_k => $_r) {
                $fieldname = $formcfg[$module]['setting_var'][$_k]['fieldname'];
                if(isset($cfg_cache[$fieldname]) && $cfg_cache[$fieldname]!==''){
                    $formcfg[$module]['setting_var'][$_k]['value'] = $cfg_cache[$fieldname];
                }
            }
            $form = $this->creatconfigform($formcfg[$module]['setting_var']);
            include $this->op->plugin_tpl('caijixia_setting',PLUGIN_ID);
        }
    }

    /**
     * app配置
     */

    public function saveapp()
    {
        $k = $_GET['app'];
        if(setcache(PLUGIN_ID.'_app_cfg',$k,'plugins')){
            echo 'success';
        }
    }

    /**
     * 简介
     * 字段太短，ajax加载
     */
     
    public function description(){
        include $this->op->plugin_tpl('info',PLUGIN_ID);
    }

    /**
     * 采集任务
     */
     
    public function task()
    {
        $allcategory = getcache('category_content_'.$this->siteid,'commons');
        $category = array();
        if(!empty($allcategory)) {
            foreach($allcategory as $k => $r) {
                if(empty($r['type']) && empty($r['child'])) {
                    $category[$k] = $r;
                     $keywords = $this->cjx->getcatkeyword($category[$k]['catid']);
                     foreach($keywords as $_k => $_v){
                        if(strpos($_v,'<rss>')!==false) $keywords[$_k] = "<span style='background-color:#CCC'>{rss}</span>";
                        else if(strpos($_v,'<listen>')!==false) $keywords[$_k] = "<span style='background-color:#CCC'>{page}</span>";
                     }
                     $category[$k]['keyword'] = join('，',$keywords);
                     $category[$k]['isclose'] = $this->cjx->getcatstatus($category[$k]['catid']);
                }
            }
        }
        include $this->op->plugin_tpl('task',PLUGIN_ID);
    }

    /**
     * 获取栏目绑定的关键词
     */
    
    public function catinfo()
    {
        $catid = $_GET['catid'];
        $word = $this->cjx->getcatkeyword($catid);
        echo join("\r\n",$word);
    }

    /**
     * 保存栏目关键词
     */
    
    public function savecatinfo()
    {
        $this->cjx->savecatinfo($_POST['catid'],$_POST['keyword']);
        showmessage('<script type="text/javascript">window.top.art.dialog({id:\'call\'}).close();</script>'.
            L('operation_success'),$_POST['nurl']);
    }

    /**
     * 监控采集规则测试
     */
     
    public function testregx()
    {
        $listen = stripslashes($_GET['listen']);
        $rule = stripslashes($_GET['rule']);
        $char = stripslashes($_GET['char']);
        $html = file_get_contents($listen);
        if(empty($html)){
            showmessage("请检查输入的网址是否正确，或空间是否支持采集", 'javascript:void(0);');exit;
        }
        if($char!=CHARSET){
            $html = iconv($char, CHARSET.'//IGNORE', $html);
        }
        preg_match_all('#href[\s]?\=[\s]?["\'](http:\/\/[^"\']+)["\']#iU', $html, $out);
        $out[1] = array_unique($out[1]);
        $rule = str_replace('(*)','###',$rule);
        $rule = preg_quote($rule,'/');
        $rule = str_replace('###','[0-9a-zA-Z\-_]*',$rule);
        foreach($out[1] as $k => $v){
            if(preg_match("/^{$rule}$/iU",$v)){
                $out[1][$k] = "<li>{$v}</li>";
            }else{
                unset($out[1][$k]);
            }
        }
        $list = !empty($out[1])?join("",$out[1]):'无';
        $show_header = false;
        include $this->admin_tpl('header');
        echo "<fieldset><legend>列表第一页匹配到的文章地址</legend><ul>";
        echo $list;
        echo "</ul></fieldset></body></html>";
    }

    /**
     * 开关栏目采集
     */
     
    public function closetasks(){
        if(isset($_POST['ids'])){
            $ids = $_POST['ids'];
        }else if(isset($_GET['id'])){
            $ids = $_GET['id'];
        }
        if(empty($ids)) showmessage("请选择栏目", HTTP_REFERER);
        if(isset($_POST['closesubmit']) || $_GET['close']==1) $type = 1;else $type = 0;
        $this->cjx->closecat($ids,$type);
        showmessage(L('operation_success'),HTTP_REFERER);
    }

    /**
     * 合作推广
     */
     
    public function credits()
    {
        header("Location:http://www.dedeapps.com/?m=Credits&a=index&domain=".SITE_URL);
    }

    /**
     * 转发空方法
     */
    
    function __call($module,$arguments)
    {
        if(in_array($module,array('setting','adsetting','seosetting','adseosetting'))){
            $this->setting_action($module);
        }else{
            showmessage('action not exist!');
        }
    }
    
	/**
	 * 创建配置表单
	 * @param array $data
	 */
	private function creatconfigform($data) {
		if(!is_array($data) || empty($data)) return false;
		foreach ($data as $r) {
			$form .= '<tr><th width="120">'.$r['title'].'</th><td class="y-bg">'.$this->creatfield($r).'</td></tr>';			
		}
		return $form;		
	}
	
	/**
	 * 创建配置表单字段
	 * @param array $data
	 */
	private function creatfield($data) {
		extract($data);
		$fielda_array = array('text','radio','checkbox','select','datetime','textarea');
		if(in_array($fieldtype, $fielda_array)) {
			if($fieldtype == 'text') {
				return '<input type="text" name="info['.$fieldname.']" id="'.$fieldname.'" value="'.$value.'" class="input-text" '.$formattribute.' > '.' '.$description;
			} elseif($fieldtype == 'checkbox') {
				return form::checkbox($setting,$value,"name='info[$fieldname]' $formattribute",'',$fieldname).' '.$description;
			} elseif($fieldtype == 'radio') {
				return form::radio($setting,$value,"name='info[$fieldname]' $formattribute",'',$fieldname).' '.$description;
			}  elseif($fieldtype == 'select') {
				return form::select($setting,$value,"name='info[$fieldname]' $formattribute",'',$fieldname).' '.$description;
			} elseif($fieldtype == 'datetime') {
				return form::date("info[$fieldname]",$value,$isdatetime,1).' '.$description;
			} elseif($fieldtype == 'textarea') {
				return '<textarea name="info['.$fieldname.']" id="'.$fieldname.'" '.$formattribute.'>'.$value.'</textarea>'.' '.$description;
			}
		}
	}
}
?>