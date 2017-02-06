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
		$this->mongo = new \MongoClient("");
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
			switch($cond)
			{
				case 1:
					$query = array("name" => new \MongoRegex("/$search.*/i"));
					return $this->collection->find($query)->limit(1);
				break;
				case 2:
					return $this->collection->find(array("contact.address.city" => "$search"))->limit(1);
				break;
				case 3:
					return $this->collection->find(array("contact.address.zipcode" => "$search"))->limit(1);
				break;
				default:
					return $this->collection->find(array("avvo_id" => (int)$search));
			}
		}else{
			return $this->collection->find()->limit(1);
		}
		
	}
}
