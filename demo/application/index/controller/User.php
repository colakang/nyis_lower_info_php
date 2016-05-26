<?php
namespace app\index\controller;

use app\index\model\User as UserModel;
use think\Controller;
use think\Db;

class User extends Controller
{
	//登陆用户信息
    public function login()
    {
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$user = UserModel::where('username',$username)->find();
		if(!empty($user)){
			if($password == $user['password']){
				return $this->success('登录成功','lists');
			}else{
				return $this->error("您输入的密码不正确！");
			}
		}else{
			return $this->error("该用户不存在！");
		}
    }
	//查询用户列表
	public function lists()
	{
		$list = UserModel::all();
		$this->assign('list',$list);
		$this->assign('count',count($list));
		return $this->fetch();
	}
	//查询指定用户详细信息
	public function read($id = '')
	{
		$list = UserModel::get($id);
		$this->assign('id',$list['id']);
		$this->assign('name',$list['username']);
		$this->assign('email',$list['useremail']);
		$this->assign('pass',$list['password']);
		$this->assign('status',$list['status']);
		return $this->fetch();
	}
	//删除用户信息
	public function delete($id)
	{
		$user = UserModel::get($id);
		if($user){
			$user->delete();
			return $this->success('删除成功！','lists');
		}else{
			return $this->error('删除失败！');
		}
	}
	//添加注册用户
	public function add()
	{
		$name = $_POST['username'];
		$email = $_POST['useremail'];
		$user = new UserModel;
		$username = db('user')
				->where('username',$name)
				->find();
		$useremail = db('user')
				->where('useremail',$email)
				->find();
		if($username){
			return $this->error('用户名已存在！');
		}else if($useremail){
			return $this->error('邮箱已占用！');
		}else{
			$user->save(input('post.'));
			return $this->success('注册成功！','lists');
		}
	}
	//更新用户信息
	public function update()
	{
		
		$user = UserModel::get($_POST['id']);
		$user->username = $_POST['username'];
		$user->password = $_POST['password'];
		$user->useremail= $_POST['useremail'];
		if(false !== $user->save()){
			return $this->success('更新成功!','lists');
		}else{
			return $this->error('更新失败！');
		}
	}
	
}
