<style>
	li{
		list-style: none;
	}
	a{
		text-decoration: none;
		color:#fff;
	}
	.page a{
		text-decoration: none;
		color:#000;
	}
	body{
		color: #000;
		/*background:url(./1.jpg);*/
		/*background-size: cover;*/
		background-color: skyblue;
	}
	#div1{
		padding:50px;
	}
	#div2{
		padding-left:50px;
	}
	#div2 li{
		float:right;
		margin-right:15px;
	
	}
	#div2 li a{
		color: red;
		font-size: 20px;
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
<form action="index.php" method="get">
	<input type="text" name='search' placeholder="请输入搜索内容">
	<input type="submit" name="sub"  value='justSOSO' style="background: #999" >
</form>
<!-- 文章分类列表 -->
<div id='div2'>
	<?php 
		include "conn.php";
		$sql="select * from catalog";
		$query=mysqli_query($link,$sql);
		while($arr=mysqli_fetch_array($query)){

 	?>
	
		<li><a href="index.php?cid=<?php echo $arr['catalog_id'];?>"><?php echo $arr['catalog_name'];?></a></li>
	<?php 
		}
	 ?>
</div>
<div id="div1">
<?php
	
	$page=$_GET['p']<1?1:$_GET['p'];
	$pagenum=4;
	//加载页码代表的数据 每一页加载3条数据

	if(isset($_GET['search'])&&$_GET['search']!=null){
		$se=$_GET['search'];
		$w="chen,user,catalog where chen.wt=user.id and chen.title like '%$se%' and chen.catalog_id=catalog.catalog_id";
	}else if(isset($_GET['cid'])&&$_GET['cid']!=null){
		$cid=$_GET['cid'];
		$w="chen,user,catalog where chen.wt=user.id and catalog.catalog_id=chen.catalog_id and chen.catalog_id='$cid'";
	}else{
		$w="chen,user,catalog where chen.wt=user.id and chen.catalog_id=catalog.catalog_id";
	}
	$sql="select * from $w order by bid desc limit ".(($page-1)*$pagenum).",$pagenum ";
	// select count(*) from chen,user,catalog where chen.wt=user.id and chen.catalog_id=catalog.catalog_id string(2)
	// select count(*) from chen,user,catalog where chen.wt=user.id and catalog.catalog_id=chen.catalog_id and chen.catalog_id='' string(1) "0"
	
	$query=mysqli_query($link,$sql);
	while($arr=mysqli_fetch_array($query)){
?>

	<h3>
		<a href="all.php?bid=<?php echo $arr['bid'];?>"><?php echo $arr['title']?></a> 
		<?php 
			if($_COOKIE['qx']&&$_COOKIE['qx']==1){

		 ?>
		
			<a href="del.php?bid=<?php echo $arr['bid']?>">删除</a> 
			<a href="edit.php?p=<?php echo $page; ?>&bid=<?php echo $arr['bid']?>">修改</a>
		<?php 
			}
		 ?>
	</h3>
	<li><?php echo $arr['time']?></li>
	<li>作者：<?php echo $arr['uname']?></li>
	<li>分类：<?php echo $arr['catalog_name']?></li>
	<p><?php echo iconv_substr($arr['content'],0,10);?>...</p>
	<hr />

<?php
	
	}
?>

</div>




<?php






	//显示分页栏
	$showpage=3;//分页栏显示3个
	$pageoffset=($showpage-1)/2;
	$str="";
	$spage=$page-1;
	$xpage=$page+1;
	$sql="select count(*) from $w  ";
	echo $sql; 
	$query=mysqli_query($link,$sql);
	$arr=mysqli_fetch_array($query);
	$all=$arr[0];
	var_dump($all);
	$page_all=ceil($all/$pagenum);
	$str.="<a href='".$_SERVER['PHPSELF']."?p=1&cid=$cid&search=$se'>首页</a>";
	if($page>1){
		$str.="<a href='".$_SERVER['PHPSELF']."?p=$spage&cid=$cid&search=$se'>上一页</a>";
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
		$str.="<a href='index.php?p=$i&cid=$cid&search=$se' class='page".$i."'>$i&nbsp</a>";
	
	}
	if($page_all>$showpage&&$page_all>$page+$pageoffset){
		$str.="...";
	}



	if($page<$page_all){
		$str.="<a href='".$_SERVER['PHPSELF']."?p=$xpage&cid=$cid&search=$se'>下一页</a>";
	}else{
		$str.="<a href='javascript:void(0)' disabled='true' style='opacity:0.2'>下一页</a>";

	}

	$str.="<a href='".$_SERVER['PHPSELF']."?p=$page_all&cid=$cid&search=$se'>末页</a>";
	echo "<p style='text-align: center' class='page'>".$str."</p>";
?>
