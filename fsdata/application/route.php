<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;
Route::post('login','v1/admin.login/login');
Route::post('programsList','v1/programs.Programs/getPrograms');

Route::get('upcodebymail','v1/exts.CodeByMail/sendmail');

Route::post('configsinfo','v1/commons.ConfigsInfo/getConfigs');