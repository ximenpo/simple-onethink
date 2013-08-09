<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2012 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi.cn@gmail.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

/**
 * 扩展控制器
 * 用于调度各个扩展的URL访问需求
 */
class AddonsController extends Action{

	protected $addons = null;

	public function __construct(){
		parent::__construct();
		$class = get_class($this);
		if(substr($class, -10) == 'Controller'){ 
			$this->addons = substr($class, 0, -10);
		} elseif(substr($class, -6) == 'Widget') {
			$this->addons = substr($class, 0, -6);
		}
	}

	public function start($addons = null, $controller = null, $action = null){
		if(C('URL_CASE_INSENSITIVE')){
			$addons = ucfirst(strtolower($addons));
			$controller = parse_name($controller,1);
		}

		if(!empty($addons) && !empty($controller) && !empty($action)){
			$Addons = A("Addons://{$addons}/{$controller}")->setName($addons)->$action();
		} else {
			$this->error('没有指定插件名称，控制器或操作！');
		}
	}

	protected function display($templateFile='',$charset='',$contentType='',$content='',$prefix='') {
		if(!is_file($templateFile)){
			$templateFile = T("Addons://{$this->addons}@{$templateFile}");
			if(!is_file($templateFile)){
				throw new Exception("模板不存在:$templateFile");
			}
		}

        $this->view->display($templateFile,$charset,$contentType,$content,$prefix);
    }

    /**
     * 设置当前插件名称
     * @param string $name 插件名称
     */
    private function setName($name){
    	$this->addons = $name;
    	return $this;
    }
}