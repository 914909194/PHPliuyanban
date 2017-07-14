<?php 
	include "conn.php";
	if(isset($_GET['bid'])){

		$bid=$_GET['bid'];
		$sql="update chen set hits=hits+1 where bid='$bid'";
		$query=mysqli_query($link,$sql);
		if($query){
			
			$sql="select * from chen where bid='$bid'";
			$query=mysqli_query($link,$sql);
			$arr=mysqli_fetch_array($query);
		}
	}


 ?>
 <h3>标题:<?php echo $arr['title'] ?></h3> 
 <!-- <h3>标题:<?php echo $arr['time'] ?></h3> -->
 <li>时间：<?php echo $arr['time'] ?></li>
 <span>访问率:<?php echo $arr['hits']?></span>
 <hr />
 <p>内容:<?php echo $arr['content']?></p>
 <hr />