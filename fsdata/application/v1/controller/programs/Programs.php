<?php
namespace app\v1\controller\programs;
use think\Controller;
use think\Request;
use YF\verificate\Verificate;
use app\v1\model\Programs as modelPrograms;

class Programs extends Controller{
	public function _initialize(){
		parent::_initialize();
		if(Verificate::verLogin()!='1111'){
			echo false;exit();
		}
	}
	/*
	获取项目列表
	*/
	public function getPrograms(){
		$model = new modelPrograms();
		$data = $model->getProgramsList();
		return json_encode($data);
	}

}