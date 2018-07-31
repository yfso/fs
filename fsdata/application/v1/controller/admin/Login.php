<?php
namespace app\v1\controller\admin;
use think\Controller;
use think\Request;
use YF\verificate\Verificate;


class Login extends Controller{
	protected function _initialize(){
		parent::_initialize();
	}
	/*
		内部登录
 	*/
	public function login(){
		$request = Request::instance();
		$dataall = $request->post();
		$data = $dataall['logininfo'];
		$username = $data['username'];
		$password = $data['password'];
		$vercode = $data['vercode'];
		//内部码验证
		// if($vercode!=cache('vercode')){
		// 	return json_encode(array("status"=>"0002"));
		// }
		$login = model('login');
		$user = $login::get(["username"=>$username]);
		if($user==''){
			//不存在用户名
			return json_encode(array("status"=>"0000"));
		}elseif($password!=$user['password']){
			//用户名或密码错误
			return json_encode(array("status"=>"0001"));
		}elseif($password==$user['password']){
			//用户名密码验证成功
			//设置登录信息
			$ip = $request->ip();
			$user->loginlasttime = date('Y/m/d h:i:s');
			$user->ip = $ip;
			$result = $user->save();
			if($result){
			//设置登录信息成功
			//生成token
				$token = Verificate::getToken($user['id'],$user['username'],7200,config('mysecret.salt'));
				$user = array(
					"status"=>"1111",
					"token"=>$token
				);
				return json_encode($user);
			}else{
				//设置登录信息失败
				return json_encode(array("status"=>"0010"));
			}
		}else{
			//未知错误
			return json_encode(array("status"=>"5555"));
		}
	}
}