<?php 
	include "conn.php";
	$page=$_GET['p'];
	if(isset($_GET['bid'])){
		$bid=$_GET['bid'];
		$sql="select * from chen where bid='$bid'";
		$query=mysqli_query($link,$sql);
		$arr=mysqli_fetch_array($query);
	}
	if(isset($_POST['sub'])){
		$title=$_POST['title'];
		$con=$_POST['con'];
		$hid=$_POST['hid'];
		$page=$_GET['p'];
		// echo $page;
		$sql="update chen set title='$title',content='$con' where bid='$hid'";
		$query=mysqli_query($link,$sql);
		if($query){
			header("location:index.php?p=1");
			// echo "<script>location='index.php?p=".$page."'</script>";	
			 // echo "<script> history.go(-2);</script>"; 
		}



	}

 ?>
 <meta charset="utf-8">
<form action="edit.php" method="post">
	<input type="hidden" name="hid" value="<?php echo $bid;?>">
	标题:<input type="text" name="title" value="<?php echo $arr['title']?>"><br />
	内容:<textarea rows="10" cols="20" name="con"><?php echo $arr['content']?></textarea><br />
	<input type="submit" name="sub" value="修改文章">
</form>