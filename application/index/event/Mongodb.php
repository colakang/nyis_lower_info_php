<?php
namespace app\index\event;

class Mongodb
{
	/**
     * 初始化Mongodb类
     * @access public
     * @param string $dbname
     * @param string $sheet
     */
	public function __construct($dbname,$sheet){
		$this->mongo = new \MongoClient("mongodb://nyis:Nyis2016!%user@23.239.12.49:27017");
		$this->db = $this->mongo->$dbname;
		$this->collection = $this->db->$sheet;
	}
	/**
     * find方法
     * @access public
     * @param string $search 
     * @param int 	 $sheet
     */
	public function find($search,$cond){
		if(!empty($search)){
			if($cond == 1){
				$query = array("name" => new \MongoRegex("/$search.*/i"));
				return $this->collection->find($query)->limit(1);
			}else if($cond == 2){
				return $this->collection->find(array("contact.address.city" => "$search"))->limit(1);
			}else if($cond == 3){
				return $this->collection->find(array("contact.address.zipcode" => "$search"))->limit(1);
			}else{
				return $this->collection->find(array("avvo_id" => (int)$search));
			}
		}else{
			return $this->collection->find()->limit(1);
		}
		
	}
}