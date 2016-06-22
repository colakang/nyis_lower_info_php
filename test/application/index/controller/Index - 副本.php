<?php
namespace app\index\controller;

//use app\index\event\Mongodb;
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
		//连接mongodb数据库
		$mongo = new \MongoClient("mongodb://nyis:Nyis2016!%user@23.239.12.49:27017");
		//选择需要操作的数据库
		$db = $mongo->avvo_lawyer_info;
		//选择需要操作的集合
		$collection = $db->lawyers;
		if(!empty($search)){
			if($cond == 1){
				$query = array("name" => new \MongoRegex("/$search.*/i"));
				//$findone = $collection->findOne(array("name" => "/$search.*/i"));
				$findone = $collection->find($query)->limit(1);
			}else if($cond == 2){
				$findone = $collection->find(array("contact.address.city" => "$search"))->limit(1);
			}else{
				$findone = $collection->find(array("contact.address.zipcode" => "$search"))->limit(1);
			}
			//统计集合中数据总数
			$count = $collection->count();
			foreach($findone as $key => $val){
				//获取用户信息
				$user = $val['name'];
				$city = $val['contact']['address']['city'];
				$origin = $val['licenses']['0']['origin'];
				$practice = implode($val['practice areas'],',');
			}
			//分配到前台
			$this->assign('user',$user);
			$this->assign('city',$city);
			$this->assign('origin',$origin);
			$this->assign('practice',$practice);
		}else{
			$findone = $collection->findOne();
			//统计集合中数据总数
			$count = $collection->count();
			//获取用户信息
			$user = $findone['name'];
			$city = $findone['contact']['address']['city'];
			$origin = $findone['licenses']['0']['origin'];
			$practice = implode($findone['practice areas'],',');
			//分配到前台
			$this->assign('user',$user);
			$this->assign('city',$city);
			$this->assign('origin',$origin);
			$this->assign('practice',$practice);
		}
		//输出
		return $this->fetch();
	}
}
