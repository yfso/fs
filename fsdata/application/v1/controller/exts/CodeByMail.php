<?php
namespace app\v1\controller\exts;
use think\Controller;
use QQMailer\QQMailer;
use think\Request;

class CodeByMail extends Controller{

	public function sendmail(){
		$yfp = Request::instance()->get('yfp');
		if($yfp!=config('emailconfig.yfp')){
			echo 'something error';exit();
		}



		$mailer = new QQMailer(config('emailconfig.emailadmin'),config('emailconfig.emailcode'),config('emailconfig.emailname'),true);
		$date = date("Y.m.d");

		$newver = $this->randomkeys(6);
		if(cache('vercode',$newver,86400)){
			// 邮件标题
			$title = $date.'  系统内部码更新';
			// 邮件内容
			$content = '<p>您的内部登录码为：<span style="font-size:22px;color:#AD1E1E;font-weight:bold">'.$newver.'</span></p><p>每日 8:00am 定时更新内部码，此码过期作废。</p><p>请勿将此码告知他人，以免产生安全风险。</p>';
			// 发送QQ邮件
			echo $mailer->send(['2244124280@qq.com','469722592@qq.com'], $title, $content);
		}else{
			echo '设置内部码错误';
		}
		
	}
	protected function randomkeys($length)   
	{   
		$pattern = '1234567890abcdefghijklmnopqrstuvwxyz   
		               ABCDEFGHIJKLOMNOPQRSTUVWXYZ';
		$key = '';
		for($i=0;$i<$length;$i++)   
		{   
		    $key .= $pattern{mt_rand(0,35)};    //生成php随机数   
		}   
		return $key;   
	}  

}