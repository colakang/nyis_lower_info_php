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
		//var_dump($val);exit;
			$user = $val['name'];
			if(!empty($val['contact']['address']['city'])){
				$city = $val['contact']['address']['city'];
			}else{
				$city = "";
			}
			if(!empty($val['contact']['address']['name'])){
				$name = $val['contact']['address']['name'];
			}else{
				$name = "";
			}
			if(!empty($val['contact']['phone'])){
				$phone = $val['contact']['phone'];
			}else{
				$phone = "";
			}
			if(!empty($val['contact']['address']['street_address'])){
				$street = $val['contact']['address']['street_address'];
			}else{
				$street = "";
			}
			if(!empty($val['contact']['address']['zipcode'])){
				$zipcode = $val['contact']['address']['zipcode'];
			}else{
				$zipcode = "";
			}
			if(!empty($val['licenses']['0']['origin'])){
				$origin = $val['licenses']['0']['origin'];
			}else{
				$origin = "";
			}
			if(!empty($val['licenses']['0']['status'])){
				$status = $val['licenses']['0']['status'];
			}else{
				$status = "";
			}
			if(!empty($val['licenses']['0']['state'])){
				$state = $val['licenses']['0']['state'];
			}else{
				$state = "";
			}
			$practice = implode($val['practice areas'],',');
		}
		if(!empty($user)){
			$this->assign('user',$user);
			$this->assign('city',$city);
			$this->assign('name',$name);
			$this->assign('phone',$phone);
			$this->assign('street',$street);
			$this->assign('zipcode',$zipcode);
			$this->assign('origin',$origin);
			$this->assign('status',$status);
			$this->assign('state',$state);
			$this->assign('practice',$practice);
			return $this->fetch();
		}else{
			return $this->error("未查询到用户信息！");
		}
	}
}
