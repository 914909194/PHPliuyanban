<style>
	*{
		/*margin:0;
		padding:0;*/
	}
	li{
		list-style: none;

	}
	a{
		text-decoration: none;
		color:#fff;
	}
	.page a{
		text-decoration: none;
		color:skyblue;
	}
	body{
		color: #fff;
		background:url(./2.jpg);
		background-size: cover;
		/*background-color: skyblue;*/
	}
	.page .page<?php echo $_GET['p']?$_GET['p']:1 ?>{
		color: red;
	}
</style>
<a href="add.php">添加文章</a>

<span style="float:right">
	<?php 
		if($_COOKIE['id']){
			echo $_COOKIE['uname']."已登录";
			echo "&nbsp<a href='ulogin.php'>注销登录<a/>";
		}else{
			echo "<a href='login.php'>未登录</a>";
		}

	 ?>
</span>
<form action="">
	<input type="text" name='search' placeholder="请输入搜索内容">
	<input type="submit" name="sub"  value='justSOSO' style="background: red" >
</form>

<?php
	include "conn.php";
	$page=$_GET['p']<1?1:$_GET['p'];
	$pagenum=4;
	//加载页码代表的数据 每一页加载3条数据

	if(isset($_GET['search'])){
		$se=$_GET['search'];
		$w="title like '%$se%'";
	}else{
		$w=1;
	}
	$sql="select * from chen where $w order by bid desc limit ".(($page-1)*$pagenum).",$pagenum ";
	
	$query=mysqli_query($link,$sql);
	while($arr=mysqli_fetch_array($query)){
?>
<h3>
	<a href="all.php?bid=<?php echo $arr['bid'];?>"><?php echo $arr['title']?></a> | 
	<a href="del.php?bid=<?php echo $arr['bid']?>">删除</a> |
	<a href="edit.php?p=<?php echo $page; ?>&bid=<?php echo $arr['bid']?>">修改</a>
	<!-- ?p=<?php echo $page; ?> -->
</h3>
<li><?php echo $arr['time']?></li>
<p><?php echo iconv_substr($arr['content'],0,4);?>...</p>
<hr />
<?php
	
	}







	//显示分页栏
	$showpage=3;//分页栏显示5个
	$pageoffset=($showpage-1)/2;
	$str="";
	$spage=$page-1;
	$xpage=$page+1;
	$sql="select count(*) from chen";
	$query=mysqli_query($link,$sql);
	$arr=mysqli_fetch_array($query);
	// var_dump($arr);
	$all=$arr[0];
	$page_all=ceil($all/$pagenum);
	$str.="<a href='".$_SERVER['PHPSELF']."?p=1'>首页</a>";
	if($page>1){
		$str.="<a href='".$_SERVER['PHPSELF']."?p=$spage'>上一页</a>";
	}else{
		$str.="<a href='javascript:void(0)' disabled='true' style='opacity:0.2'>上一页</a>";
	}
	$start=1;
	$end=$page_all;

	if($page_all>$showpage){
		if($page>$pageoffset+1){
			$str.="...";
		}
		if($page>$pageoffset){
			$start=$page-$pageoffset;
			$end=$page_all>$page+$pageoffset?$page+$pageoffset:$page_all;
		}else{
			$start=1;
			$end=$page_all>$showpage?$showpage:$page_all;
		}
		if($page+$pageoffset>$page_all){
			$start=$page_all-$showpage+1;
			$end=$page_all;
		}

	}


	for($i=$start;$i<=$end;$i++){
		$str.="<a href='".$_SERVER['PHPSELF']."?p=$i' class='page".$i."'>$i&nbsp</a>";
	}
	if($page_all>$showpage&&$page_all>$page+$pageoffset){
		$str.="...";
	}



	if($page<$page_all){
		$str.="<a href='".$_SERVER['PHPSELF']."?p=$xpage'>下一页</a>";
	}else{
		$str.="<a href='javascript:void(0)' disabled='true' style='opacity:0.2'>下一页</a>";
	}

	$str.="<a href='".$_SERVER['PHPSELF']."?p=$page_all'>末页</a>";
	echo "<p style='text-align: center' class='page'>".$str."</p>";
?>

<!-- 每页的内容
1:通过$_GET['p'] 获取到页数  页数<=0   页数 大于 总页数

2:当前页的第一个索引是几  ($page-1)*$pagenum

3:select * from fenye limit (($page-1)*$pagenum),$pagenum

----------------------------------------------------------
分页A标签条码
1：总条数  count(*)  
2:总页数 ceil(总条数/$pagenum)
3:显示的标签数 $pageshow
4:显示偏移量 $pageoffset=($pageshow-1)/2
5:判断条件  $page大于$pageoffset+1  $page大于$pageoffset 
         $page小于$pageoffset  $page+$pageoffset大于count(*)
         //$page_all>$showpage && $page_all>$page+$pageoffset -->