<?php
namespace app\v1\model;
use think\Model;

class Login extends Model{
	protected function _initialize(){
		parent::initialize();
	}
	protected $pk = "id";
	protected $table = "yf_user_login";
}