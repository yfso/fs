<?php
namespace app\v1\controller\commons;
use think\Controller;
use think\Request;
use YF\verificate\Verificate;

class ConfigsInfo extends Controller{
	protected function _initialize(){
		parent::_initialize();
		if(Verificate::verLogin()!='1111'){
			echo false;exit();
		}
	}
	/*
	获取系统设置
	 */
	public function getConfigs(){

		$data = array(
			"emailconfig" => config('emailconfig')
		);
		return json_encode($data);

	}

}