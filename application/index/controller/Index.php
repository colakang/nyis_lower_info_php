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
		$education = array();
		$associations = array();
		$awards = array();
		$work_experience = array();
		$legal_cases = array();
		$publications = array();
		$speaking_engagements = array();
		$search = $arr[3];
		$cond = $arr[0];
		$mongo = new Mongodb('avvo_lawyer_info','lawyers');
		$findone = $mongo -> find($search,$cond);
		foreach($findone as $key => $val){
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
			if(!empty($val['contact']['fax'])){
				$fax = $val['contact']['fax'];
			}else{
				$fax = "";
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
			if(!empty($val['education'])){
				foreach($val['education'] as $k => $v){
					$education[$k]['graduated']  = $v['graduated'];
					$education[$k]['major']  	 = $v['major'];
					$education[$k]['school_name']= $v['school_name'];
					$education[$k]['degree']  	 = $v['degree'];
				}
			}
			if(!empty($val['associations'])){
				foreach($val['associations'] as $k => $v){
					$associations[$k]['position_name']    = $v['position_name'];
					$associations[$k]['association_name'] = $v['association_name'];
					$associations[$k]['duration'] 		  = $v['duration'];
				}
			}
			if(!empty($val['awards'])){
				foreach($val['awards'] as $k => $v){
					$awards[$k]['award_name']   = $v['award_name'];
					$awards[$k]['date_granted'] = $v['date_granted'];
					$awards[$k]['grantor'] 	    = $v['grantor'];
				}
			}
			if(!empty($val['work_experience'])){
				foreach($val['work_experience'] as $k => $v){
					$work_experience[$k]['duration']     = $v['duration'];
					$work_experience[$k]['company_name'] = $v['company_name'];
					$work_experience[$k]['title'] 	     = $v['title'];
				}
			}
			if(!empty($val['legal_cases'])){
				foreach($val['legal_cases'] as $k => $v){
					$legal_cases[$k]['outcome']     = $v['outcome'];
					$legal_cases[$k]['case_name'] = $v['case_name'];
				}
			}
			if(!empty($val['publications'])){
				foreach($val['publications'] as $k => $v){
					$publications[$k]['date']     		  = $v['date'];
					$publications[$k]['publication_name'] = $v['publication_name'];
					$publications[$k]['title'] 			  = $v['title'];
				}
			}
			if(!empty($val['speaking_engagements'])){
				foreach($val['speaking_engagements'] as $k => $v){
					$speaking_engagements[$k]['date']     		 = $v['date'];
					$speaking_engagements[$k]['conference_name'] = $v['conference_name'];
					$speaking_engagements[$k]['title'] 			 = $v['title'];
				}
			}
			$practice = implode($val['practice areas'],',');
			//var_dump($val);exit;
		}
		if(!empty($user)){
			$this->assign('user',$user);
			$this->assign('city',$city);
			$this->assign('name',$name);
			$this->assign('phone',$phone);
			$this->assign('fax',$fax);
			$this->assign('street',$street);
			$this->assign('zipcode',$zipcode);
			$this->assign('origin',$origin);
			$this->assign('status',$status);
			$this->assign('state',$state);
			$this->assign('practice',$practice);
			if(!empty($education)){
				$this->assign('education',$education);
			}
			if(!empty($associations)){
				$this->assign('associations',$associations);
			}
			if(!empty($awards)){
				$this->assign('awards',$awards);
			}
			if(!empty($work_experience)){
				$this->assign('work_experience',$work_experience);
			}
			if(!empty($legal_cases)){
				$this->assign('legal_cases',$legal_cases);
			}
			if(!empty($publications)){
				$this->assign('publications',$publications);
			}
			if(!empty($speaking_engagements)){
				$this->assign('speaking_engagements',$speaking_engagements);
			}
			return $this->fetch();
		}else{
			return $this->error("未查询到用户信息！");
		}
	}
	
	
	public function lists()
	{
		if(empty($_GET['page'])){
			$test = $_POST['test'];
			$mongo = new Mongodb('avvo_lawyer_info','lawyers');
			$query = array("name" => new \MongoRegex("/$test.*/i"));
			//$query = array("avvo_id" => array('$ne'=>5));
			$lists = $mongo->collection->find($query)->sort(array('avvo_id'=>1))->limit(15);
			foreach($lists as $k => $v){
				$list[$k]['avvo_id'] = $v['avvo_id'];
				$list[$k]['name'] = $v['name'];
				if(!empty($v['practice areas'])){
					$list[$k]['practice'] = implode($v['practice areas'],',');
				}else{
					$list[$k]['practice'] = "";
				}
			}
			arsort($list);
			$this->assign('list',$list);
			$this->assign('test',$test);
		}else{
			$page = (int)$_GET['page'];
			$test = $_GET['test'];
			$mongo = new Mongodb('avvo_lawyer_info','lawyers');
			$query = array("name" => new \MongoRegex("/$test.*/i"),'avvo_id' => array('$gt'=>$page));
			//$query = array("avvo_id" => array('$gt'=>$page));
			$lists = $mongo->collection->find($query)->sort(array('avvo_id'=>1))->limit(15);
			foreach($lists as $k => $v){
				$list[$k]['avvo_id'] = $v['avvo_id'];
				$list[$k]['name'] = $v['name'];
				if(!empty($v['practice areas'])){
					$list[$k]['practice'] = implode($v['practice areas'],',');
				}else{
					$list[$k]['practice'] = "";
				}
			}
			arsort($list);
			$this->assign('list',$list);
			$this->assign('test',$test);
		}
		return $this->fetch();
	}
}
