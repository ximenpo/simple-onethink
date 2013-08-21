<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2012 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: yangweijie <yangweijiester@gmail.com> <code-tech.diandian.com>
// +----------------------------------------------------------------------

/**
 * 插件模型
 * @author yangweijie <yangweijiester@gmail.com>
 * @date    2013-08-14 11:31:21
 */

class HooksModel extends Model {

	/**
	 * 查找后置操作
	 */
	protected function _after_find(&$result,$options) {
		$result['type_text_arr'] = array( 1=>'widget', 2=>'controller');
		$result['type_text'] = $result['type_text_arr'][$result['type']];
	}

	protected function _after_select(&$result,$options){
		foreach($result as &$record){
			$this->_after_find($record,$options);
		}
	}
    /**
	 * 文件模型自动完成
	 * @var array
	 */
    protected $_auto = array(
    	array('update_time', NOW_TIME, self::MODEL_BOTH),
    	);

    /**
     * 更新插件里的所有钩子对应的插件
     */
    public function updateHooks($addons_name){
    	$addons_class = addons($addons_name, 1);//获取插件名
    	$methods = get_class_methods("{$addons_name}Addons");
        $methods = array_map('parse_name', $methods);
        $hooks = $this->getField('name', TRUE);
        $common = array_intersect($hooks, $methods);
    	if($common){
    		foreach ($common as $hook) {
    			$flag = $this->updateAddons($hook, array($addons_name));
    			if($flag === FALSE){
    				return FALSE;
    			}
    		}
    	}
    	return TRUE;
    }

    /**
     * 更新单个钩子处的插件
     */
    public function updateAddons($hook_name, $addons_name){
    	$o_addons = $this->where("name='{$hook_name}'")->getField('addons');
    	if($o_addons)
            $o_addons = str2arr($o_addons);
    	if($o_addons){
    		$addons = array_merge($o_addons, $addons_name);
    		$addons = array_unique($addons);
    	}else{
    		$addons = $addons_name;
    	}
    	$flag = D('Hooks')->where("name='{$hook_name}'")
    	->setField('addons',arr2str($addons));
    	if($falg === FALSE)
    		D('Hooks')->where("name='{$hook_name}'")
    	->setField('addons',arr2str($o_addons));
    	return $flag;
    }

    /**
     * 去除插件所有钩子里对应的插件数据
     */
    public function removeHooks($addons_name){
    	$methods = get_class_methods("{$addons_name}Addons");
        $methods = array_map('parse_name', $methods);
        $hooks = $this->getField('name', TRUE);
        $common = array_intersect($hooks, $methods);
    	if($common){
    		foreach ($common as $hook) {
    			$flag = $this->removeAddons($hook, array($addons_name));
    			if($flag === FALSE){
    				return FALSE;
    			}
    		}
    	}
    	return TRUE;
    }

    /**
     * 去除单个钩子里对应的插件数据
     */
    public function removeAddons($hook_name, $addons_name){
    	$o_addons = $this->where("name='{$hook_name}'")->getField('addons');
    	$o_addons = str2arr($o_addons);
    	if($o_addons){
    		$addons = array_diff($o_addons, $addons_name);
    	}else{
    		return TRUE;
    	}
    	$flag = D('Hooks')->where("name='{$hook_name}'")
    					  ->setField('addons',arr2str($addons));
		if($falg === FALSE)
    		D('Hooks')->where("name='{$hook_name}'")
    				  ->setField('addons',arr2str($o_addons));
    	return $flag;
    }
}