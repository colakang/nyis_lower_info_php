<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"D:\NYIS\wamp64\www\test\public/../application/index\view\user\lists.html";i:1464168922;}*/ ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>查看用户列表</title>
<link rel="stylesheet" href="__PUBLIC__/css/nyis.min.css">
<script type="text/javascript">
function altRows(id){
	if(document.getElementsByTagName){  
		
		var table = document.getElementById(id);  
		var rows = table.getElementsByTagName("tr"); 
		 
		for(i = 0; i < rows.length; i++){          
			if(i % 2 == 0){
				rows[i].className = "evenrowcolor";
			}else{
				rows[i].className = "oddrowcolor";
			}      
		}
	}
}

window.onload=function(){
	altRows('alternatecolor');
}
</script>
<style type="text/css">
table.altrowstable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #a9c6c9;
	border-collapse: collapse;
}
table.altrowstable th {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #a9c6c9;
}
table.altrowstable td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #a9c6c9;
}
.oddrowcolor{
	background-color:#d4e3e5;
}
.evenrowcolor{
	background-color:#c3dde0;
}
</style>
</head>
<body>
<h2>用户列表（<?php echo $count; ?>）</h2> 



<table class="altrowstable" id="alternatecolor">
<tr>
	<th>I D</th>
	<th>用 户 名</th>
	<th>邮 箱</th>
	<th>身 份</th>
	<th>密 码</th>
	<th>编 辑</th>
	<th>操 作</th>
</tr>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?>
<tr>
	<td><?php echo $user['id']; ?></td>
	<td><?php echo $user['username']; ?></td>
	<td><?php echo $user['useremail']; ?></td>
	<td><?php echo $user['status']; ?></td>
	<td><?php echo $user['password']; ?></td>
	<td><button><a href="read?id=<?php echo $user['id']; ?>">查看详情</a></button></td>
	<td><button><a href="delete?id=<?php echo $user['id']; ?>">删除</a></button></td>
</tr>
<?php endforeach; endif; else: echo "" ;endif; ?>
</table>


</body>
</html>