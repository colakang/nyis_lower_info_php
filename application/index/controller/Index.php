<?php
namespace app\index\controller;

use app\index\event\Mongodb;
use think\Controller;
class Index extends Controller
{
	public function index()
	{
		return view();
	}
	
	public function find()
	{
		$array = $_POST;
		$arr = "";
		foreach($array as $k => $v){
			$arr[] = $v;
		}
		$search = $arr[3];
		$cond = $arr[0];
		$mongo = new Mongodb('avvo_lawyer_info','lawyers');
		$findone = $mongo -> find($search,$cond);
		foreach($findone as $key => $val){
			$user = $val['name'];
			$city = $val['contact']['address']['city'];
			$origin = $val['licenses']['0']['origin'];
			$practice = implode($val['practice areas'],',');
		}
		if(!empty($user)){
			$this->assign('user',$user);
			$this->assign('city',$city);
			$this->assign('origin',$origin);
			$this->assign('practice',$practice);
			return $this->fetch();
		}else{
			return $this->error("未查询到用户信息！");
		}
	}
}
