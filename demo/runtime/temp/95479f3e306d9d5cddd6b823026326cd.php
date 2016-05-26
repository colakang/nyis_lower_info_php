<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"D:\NYIS\wamp64\www\test\public/../application/index\view\index\index.html";i:1464148082;}*/ ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>用户登陆</title>
<style>
body {
    font-family:"Microsoft Yahei","Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size:16px;
    padding:5px;
}
.form{
    padding: 15px;
    font-size: 16px;
}

.form .text {
    padding: 3px;
    margin:2px 10px;
    width: 240px;
    height: 24px;
    line-height: 28px;
    border: 1px solid #D4D4D4;
}
.form .btn{
    margin:6px;
    padding: 6px;
    width: 120px;

    font-size: 16px;
    border: 1px solid #D4D4D4;
    cursor: pointer;
    background:#eee;
}
a{
    color: #868686;
    cursor: pointer;
}
a:hover{
    text-decoration: underline;
}
h2{
    color: #4288ce;
    font-weight: 400;
    padding: 6px 0;
    margin: 6px 0 0;
    font-size: 28px;
    border-bottom: 1px solid #eee;
}
div{
    margin:8px;
}
.info{
    padding: 12px 0;
    border-bottom: 1px solid #eee;
}

.copyright{
    margin-top: 24px;
    padding: 12px 0;
  border-top: 1px solid #eee;
}
</style>
</head>
<body>
<div id="login" style="display:block">
<h2>欢迎登陆</h2>
<FORM method="post" class="form" action="<?php echo url('index/user/login'); ?>">
姓 名：<INPUT type="text" class="text" name="username"><p/>
密 码：<INPUT type="password" class="text" name="password"><p/>
<INPUT type="submit" class="btn" value=" 确 定" />
</FORM>
<a onclick="create()">如果您还不是本站会员，请点击这里注册...</a>
</div>
<div id="create" style="display:none">
<h2>注册成为会员</h2>
<FORM method="post" class="form" action="<?php echo url('index/user/add'); ?>">
姓 名：<INPUT type="text" class="text" name="username"><p/>
密 码：<INPUT type="password" class="text" name="password"><p/>
邮 箱：<INPUT type="text" class="text" name="useremail"><p/>
<INPUT type="submit" class="btn" value=" 提 交" />
</FORM>
</div>
</body>
<script>
	function create(id){ 
  
		var login=document.getElementById("login");  
		  
		var create=document.getElementById("create");
		  
		login.style.display='none';  
		  
		create.style.display='block';
	}
</script>
</html>