<?php
namespace app\admin\controller;
use think\Controller;
use think\Cache;
use app\news\model\Column as mColumn;
/*
func:getColumns
*/
class Column extends Controller{
	//init class
	public function _initization(){
		parent::_initization();
	}

	public function setColumns(){
		$columns = $this->getColums();
		$columns = serialize($columns);
		cache("news/columns",$columns);
	}
	/*
	菜单栏array数据
	array(
		"0"=>array(
			"cname"=>"",
			"chref"=>"",
			"sub_col"= array(
				"0"=>array(
					"cname"=>"",
					"chref"=>""
				),
				...
			)		
		),
		...
	);
	 */
	protected function getColums(){
		$col = model('news/Column');
		$data = $col->where('show',1)->select();
		$columns = array();
		foreach ($data as $key => $value) {
			if($value->step==0){
				$columns[$value->cnum]['cname'] = $value->cname;
				$columns[$value->cnum]['chraf'] = $value->chref;
			}else if($value->step==1){
				$arr = array(
					"cname"=>$value->cname,
					"chref"=>$value->chref
				);
				if(!isset($columns[$value->cnum]['sub_col'])){
					$columns[$value->cnum]['sub_col'][0] = $arr;
				}else{
					$lg = count($columns[$value->cnum]['sub_col']);
					$columns[$value->cnum]['sub_col'][$lg] = $arr;
				}
			}	
		}
		return json_encode($columns);
	}

}
