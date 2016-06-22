<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"D:\NYIS\wamp64\www\test\public/../application/index\view\index\index.html";i:1466569277;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" type="text/css" href="http://localhost/test/public/static/css/style.css"/>
<script src="http://localhost/test/public/static//js/jquery.1.10.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="http://localhost/test/public/static/js/jquery.lib.min.js"></script>
<script type="text/javascript" src="http://localhost/test/public/static/js/search.min.js"></script>
</head>
<body>
<div id="search_box" style="margin: 0 auto;position:absolute; top:40%; left:25%;">

	<form id="search" name="search" action="http://localhost/test/public/index.php/index/index/find" method="post">
        <ul id="searchType">
        	<li data-searchtype="1" class="type_selected">Name<input type="hidden" name="name" value="1" /></li>
        	<li data-searchtype="2">City<input type="hidden" name="add" value="2" /></li>
        	<li data-searchtype="3">Code<input type="hidden" name="code" value="3" /></li>
        </ul>
            <input type="text" id="search_input" name = "rea"  tabindex="1" />
            <input type="submit" id="search_button" value="Search" />
				
    </form>
</div>

</body>
</html>	