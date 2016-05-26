<?php
namespace app\index\model;

use think\Model;

class User extends Model
{
	protected $name = 'user';
	
	protected $insert = ['status' => 0];
	
	protected function getStatusAttr($value)
	{
		$status = [0 => '普通用户',1 => '管理员'];
		return $status[$value];
	}
}