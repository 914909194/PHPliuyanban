<?php 
	if(isset($_COOKIE['id'])){
		$uid=$_COOKIE['id'];
	}else{
		$str=$_SERVER['PHP_SELF'];
		$arr=explode('/',$str);
		$temp=count($arr)-1;
		$tempstr=$arr[$temp];
		echo "<script>location='login.php?p=$tempstr'</script>";
	}
	//点击添加文章时判断是否已经登录 如果没有登录跳转到登录界面 并且get 传输一个字符串（当前页面的名字 方便到时候登录界面登陆成功后 跳转回来）
?>



<?php 
	include "conn.php";
	if(isset($_POST['sub'])){
		$title=$_POST['title'];
		$con=$_POST['con'];
		$catalogid=$_POST['catalog'];
		$sql="insert into chen(bid,title,content,time,wt,catalog_id) values(null,'$title','$con',now(),'$uid','$catalogid')";
		$query=mysqli_query($link,$sql);
		if($query){
			echo "<script>location='index.php?p=1'</script>";
		}else{
			echo "<script>alert('插入失败')</script>";
			echo "<script>location='add.php'</script>";
		}

	}



 ?>
<meta charset="utf-8">
<form action="add.php" method="post">
	标题：<input type="text" name="title"><br>
	分类：<select name="catalog" >
	<?php 
		$sql="select * from catalog";
		$query=mysqli_query($link,$sql);
		while($arr=mysqli_fetch_array($query)){
	 ?>
			<option value="<?php echo $arr['catalog_id'];?>"><?php echo $arr['catalog_name'];?></option>
	<?php 
		}
	 ?>
		  </select>
	<br>
	内容：<textarea type="textarea" rows="10" cols="20" name="con"></textarea> <br>
	<input type="submit" name="sub" value="添加文章">



</form>