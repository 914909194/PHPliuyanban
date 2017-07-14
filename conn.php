<?php 
	@$link=mysqli_connect("localhost","root","") or die("数据库连接错误");
	//选择数据库
	@mysqli_select_db($link,'cj') or die("选择数据库错误");
	//设置传输编码
	@mysqli_set_charset($link,"UTF8");


 ?>