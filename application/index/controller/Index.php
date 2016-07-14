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
	
	public function profile()
	{
		if(empty($_GET['nyis_id']))	//Set Default id 
			$avvo_id = 234;
		else
			$avvo_id = (int)$_GET['nyis_id'];

		$mongo  = new Mongodb('avvo_lawyer_info','lawyers');
		$query = array('avvo_id' =>$avvo_id);
		$lists = $mongo->collection->find($query);
		$education = array();
		$associations = array();
		$awards = array();
		$work_experience = array();
		$legal_cases = array();
		$publications = array();
		foreach($lists as $key => $val){
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
			if(!empty($val['contact']['address']['state'])){
				$state = $val['contact']['address']['state'];
			}else{
				$state = "";
			}
			if(!empty($val['licenses'])){
				foreach($val['licenses'] as $k => $v){
					$licenses[$k]['status']    = $v['status'];
					$licenses[$k]['origin']    = $v['origin'];
					$licenses[$k]['state']     = $v['state'];
					$licenses[$k]['updated']   = (array)$v['updated'];
				}
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
					$legal_cases[$k]['outcome']   = $v['outcome'];
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
			if(!empty($val['practice areas'])){
				$practice = $val['practice areas'];
			}else{
				$practice = "";
			}
		}
		$this->assign('user',$user);
		$this->assign('city',$city);
		$this->assign('name',$name);
		$this->assign('phone',$phone);
		$this->assign('fax',$fax);
		$this->assign('street',$street);
		$this->assign('zipcode',$zipcode);
		$this->assign('state',$state);
		$this->assign('practice',$practice);
		if(!empty($licenses)){
			$this->assign('licenses',$licenses);
		}
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
		return $this->fetch();

	}
	
	
	public function search_result()
	{
		$param1 = isset($_GET['param1'])?$_GET['param1']:"name";
		$param2 = isset($_GET['param2'])?$_GET['param2']:"";
		$param3 = isset($_GET['param3'])?$_GET['param3']:"";
		$page = isset($_GET['page'])?$_GET['page']:"1";		//Current page number;
		$views = isset($_GET['views'])?$_GET['views']:"20";	//Deafult views = 10
		$param2 = str_replace("+",".*",$param2);
		$param2 = str_replace(" ",".*",$param2);
		$param2 = str_replace("%20",".*",$param2);
		$mongo  = new Mongodb('avvo_lawyer_info','lawyers');
		switch($page)
		{
			case "1":
//				$query = array("{$param1}" => new \MongoRegex("/{$param2}.*/i"),"contact.address.state" =>new \MongoRegex("/{$param3}.*/i"));
				$query = array(
						'$and'=>array(
								array(
									'$or'=>array(
										array("name" => new \MongoRegex("/{$param2}.*/i")),
										array("practice areas" => new \MongoRegex("/{$param2}.*/i"))
									)
								),
								array(
									'$or'=>array(
										array("contact.address.state" => new \MongoRegex("/{$param3}.*/i")),
										array("contact.address.city" => new \MongoRegex("/{$param3}.*/i"))
									),
								),
						)
					);

				$lists = $mongo->collection->find($query)->sort(array('avvo_id'=>1))->limit($views);
				//$count = $mongo->collection->find($query)->count();
				$count = 100;
				break;
			default:
				$skip = ($page-1)*$views+1;
//				$query = array("{$param1}" => new \MongoRegex("/{$param2}.*/i"),"contact.address.state" =>new \MongoRegex("/{$param3}.*/i"));
				$query = array(
						'$and'=>array(
								array(
									'$or'=>array(
										array("name" => new \MongoRegex("/{$param2}.*/i")),
										array("practice areas" => new \MongoRegex("/{$param2}.*/i"))
									)
								),
								array(
									'$or'=>array(
										array("contact.address.state" => new \MongoRegex("/{$param3}.*/i")),
										array("contact.address.city" => new \MongoRegex("/{$param3}.*/i"))
									),
								),
						)
					);

				$lists = $mongo->collection->find($query)->sort(array('avvo_id'=>1))->limit($views)->skip($skip);
//				$count = $mongo->collection->find($query)->count();
				$count = 100;
				break;
		}
		$start = (int)floor($page/10)*10;
		$end = $start + 10;
		if ($start==0)
			$start =1;
		foreach($lists as $k => $v){
			$list[$k]['nyis_id'] = $v['avvo_id'];
			$list[$k]['name']    = $v['name'];
			if(!empty($v['contact']['phone'])){
				$list[$k]['phone']   = $v['contact']['phone'];
			}else{
				$list[$k]['phone'] = "";
			}
			if(!empty($v['contact']['address']['city'])){
				$list[$k]['city'] = $v['contact']['address']['city'];
			}else{
				$list[$k]['city'] = "";
			}
			if(!empty($v['contact']['address']['state'])){
				$list[$k]['state'] = $v['contact']['address']['state'];
			}else{
				$list[$k]['state'] = "";
			}
			if(!empty($v['contact']['address']['zipcode'])){
				$list[$k]['zipcode'] = $v['contact']['address']['zipcode'];
			}else{
				$list[$k]['zipcode'] = "";
			}
			if(!empty($v['practice areas'])){
				$list[$k]['practice'] = $v['practice areas'];
			}else{
				$list[$k]['practice'] = "";
			}
		}
		if(!empty($list)){
			arsort($list);
			$this->assign('list',$list);
			$this->assign('param2',$param2);
			$this->assign('param3',$param3);
			$this->assign('param1',$param1);
			if(!empty($count)){
				$this->assign('count',$count);
			}
			if(!empty($page)){
				$this->assign('page',$page);
			}
			$this->assign('debug',0);	//Show Debug Info 1=true,0=false;
			$this->assign('pages',ceil($count/$views));	//Total pages;
			$this->assign('views',$views);	//;
			$this->assign('start',$start);	//;
			$this->assign('end',$end);	//;
		}else{
			return $this->error("未查询到相关律师信息！");
		}
		return $this->fetch();
	}

	public function test()
	{
		$param1 = isset($_GET['param1'])?$_GET['param1']:"name";
		$param2 = isset($_GET['param2'])?$_GET['param2']:"";
		$param3 = isset($_GET['param3'])?$_GET['param3']:"";
		$page = isset($_GET['page'])?$_GET['page']:"1";		//Current page number;
		$views = isset($_GET['views'])?$_GET['views']:"10";	//Deafult views = 10
		$mongo  = new Mongodb('avvo_lawyer_info','lawyers');
		$param2 = str_replace("+",".*",$param2);
		$param2 = str_replace(" ",".*",$param2);
		$param2 = str_replace("%20",".*",$param2);
		switch($page)
		{
			case "1":
			//	$query = array("{$param1}" => new \MongoRegex("/{$param2}.*/i"),"contact.address.state" =>new \MongoRegex("/{$param3}.*/i"));

				$query = array(
						'$and'=>array(
								array(
									'$or'=>array(
										array("name" => new \MongoRegex("/{$param2}.*/i")),
										array("practice areas" => new \MongoRegex("/{$param2}.*/i"))
									)
								),
								array(
									'$or'=>array(
										array("contact.address.state" => new \MongoRegex("/{$param3}.*/i")),
										array("contact.address.city" => new \MongoRegex("/{$param3}.*/i"))
									),
								),
						)
					);

				$lists = $mongo->collection->find($query)->sort(array('avvo_id'=>1))->limit($views);
				//$count = $mongo->collection->find($query)->count();
				break;
			default:
				$skip = ($page-1)*$views+1;
				$query = array(
						'$and'=>array(
								array(
									'$or'=>array(
										array("name" => new \MongoRegex("/{$param2}.*/i")),
										array("practice areas" => new \MongoRegex("/{$param2}.*/i"))
									)
								),
								array(
									'$or'=>array(
										array("contact.address.state" => new \MongoRegex("/{$param3}.*/i")),
										array("contact.address.city" => new \MongoRegex("/{$param3}.*/i"))
									),
								),
						)
					);
				$lists = $mongo->collection->find($query)->sort(array('avvo_id'=>1))->limit($views)->skip($skip);
				//$count = $mongo->collection->find($query)->count();
				break;
		}
		$start = (int)floor($page/10)*10;
		$end = $start + 10;
		if ($start==0)
			$start =1;
		$i = 0;
		while(true)
		{
			$skip = $end*$views+1;
			$count = $mongo->collection->find($query)->sort(array('avvo_id'=>1))->limit(1)->skip($skip);
			foreach ($count as $k=>$v)
			{
				$i++;
			}
			if ($i>0)
				break;
			$end--;
		}
		var_dump ($skip);
		var_dump($start);
		var_dump($end);
		return false;
		foreach($lists as $k => $v){
			$list[$k]['nyis_id'] = $v['avvo_id'];
			$list[$k]['name']    = $v['name'];
			if(!empty($v['contact']['phone'])){
				$list[$k]['phone']   = $v['contact']['phone'];
			}else{
				$list[$k]['phone'] = "";
			}
			if(!empty($v['contact']['address']['city'])){
				$list[$k]['city'] = $v['contact']['address']['city'];
			}else{
				$list[$k]['city'] = "";
			}
			if(!empty($v['contact']['address']['state'])){
				$list[$k]['state'] = $v['contact']['address']['state'];
			}else{
				$list[$k]['state'] = "";
			}
			if(!empty($v['contact']['address']['zipcode'])){
				$list[$k]['zipcode'] = $v['contact']['address']['zipcode'];
			}else{
				$list[$k]['zipcode'] = "";
			}
			if(!empty($v['practice areas'])){
				$list[$k]['practice'] = $v['practice areas'];
			}else{
				$list[$k]['practice'] = "";
			}
		}
		if(!empty($list)){
			arsort($list);
			$this->assign('list',$list);
			$this->assign('param2',$param2);
			$this->assign('param3',$param3);
			$this->assign('param1',$param1);
			if(!empty($count)){
				$this->assign('count',$count);
			}
			if(!empty($page)){
				$this->assign('page',$page);
			}
			$this->assign('debug',0);	//Show Debug Info 1=true,0=false;
			$this->assign('pages',ceil($count/$views));	//Total pages;
			$this->assign('views',$views);	//;
		}else{
			return $this->error("未查询到用户信息！");
		}
		//return $this->fetch();
		var_dump ($count);
		var_dump(count($list));
		return json_encode($list);
	}


}
