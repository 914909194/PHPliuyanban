<?php 
	include "conn.php";
	if(isset($_POST['change'])){
		$uname=$_POST['uname'];
		$pass=$_POST['pass'];
		$sql="select * from user where uname ='$uname' and pass='$pass'";
		$query=mysqli_query($link,$sql);
		$result=mysqli_fetch_array($query);
		if($result){
			$newpass=$_POST['newpass'];
			$renewpass=$_POST['renewpass'];
			// echo $newpass;
			// echo $renewpass;
			if($newpass==$renewpass){
				$sql="update user set pass='$newpass' where uname ='$uname' and pass='$pass'";
				$query=mysqli_query($link,$sql);
				echo "修改成功";
				header("location:login.php");
				
			}else{
				echo "修改失败";
			}
		}
	}

 ?>
  <meta charset="utf-8">
 <form action="change.php" method='post'>
 	用户名：&nbsp<input type="text" name='uname'><br>
 	&nbsp密码：&nbsp<input type="password" name='pass'><br>
 	新密码：&nbsp<input type="password" name="newpass"><br>
 	重复密码：<input type="password" name="renewpass"><br>
 	<input type="submit" name="change" value="确认修改">


 </form>