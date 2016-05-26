<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"D:\NYIS\wamp64\www\test\public/../application/index\view\user\read.html";i:1464152376;}*/ ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>用户信息</title>
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
<h2>用户详细信息</h2>
<FORM method="post" class="form" action="<?php echo url('index/user/update'); ?>">
姓 名：<?php echo $name; ?><p/>
邮 箱：<?php echo $email; ?><p/>
身 份：<?php echo $status; ?><p/>
</FORM>
<a onclick="create()">点击修改用户信息...</a>
</div>
<div id="create" style="display:none">
<h2>修改用户信息</h2>
<FORM method="post" class="form" action="<?php echo url('index/user/update'); ?>">
<INPUT type="hidden" class="text" name="id" value="<?php echo $id; ?>"><p/>
姓 名：<INPUT type="text" class="text" name="username" value="<?php echo $name; ?>"><p/>
密 码：<INPUT type="password" class="text" name="password" value="<?php echo $pass; ?>"><p/>
邮 箱：<INPUT type="text" class="text" name="useremail" value="<?php echo $email; ?>"><p/>
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