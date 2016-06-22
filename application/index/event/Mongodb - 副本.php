<?php
namespace app\index\event;

class Mongodb
{
	/**
     * 初始化Mongodb类
     * @access public
     * @param string $dbname 数据库
     * @param string $sheet  集合
     */
	public function __construct($dbname,$sheet){
		//连接mongodb数据库
		$this->mongo = new \MongoClient("mongodb://nyis:Nyis2016!%user@23.239.12.49:27017");
		//选择数据库
		$this->db = $this->mongo->$dbname;
		//选择合集
		$this->collection = $this->db->$sheet;
	}
	
	public function find(){
		//$mongo = new \MongoClient();
		//$db = $this->mongo->$dbname;
		//$collection = $db->$sheet;
		return $this->collection->find();
		//return $this->mongo;
		
	}
}