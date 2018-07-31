<?php
namespace app\v1\model;
use think\Model;
use think\Db;

class Programs extends Model{
	protected function _initialize(){
		parent::initialize();
	}
	public function getProgramsList(){
		$data =Db::query('select n.id,n.name,t.name as category,DATE_FORMAT(n.createdate,"%Y-%m-%d") createdate,n.status from yf_program n left join yf_program_category t on n.category=t.category order by createdate desc,id desc;');
		return $data;
	}
	
}