<?php 
	include "conn.php";

	if(isset($_GET['p'])){
		$p=$_GET['p'];
	}



	if(isset($_POST['reg'])){
		// header("location:reg.php");
		echo "<script>location='reg.php'</script>";	
	}
	if(isset($_POST['sub'])){
		$uname=$_POST['uname'];
		$pass=$_POST['pass'];
		$p=$_POST['$str'];
		$sql="select * from user where uname ='$uname' and pass='$pass'";
		$query=mysqli_query($link,$sql);
		$result=mysqli_fetch_array($query);
		if($result){
			setcookie('id',$result['id'],time()+180);
			setcookie('qx',$result['qx'],time()+180);
			setcookie('uname',$result['uname'],time()+180);
			if(!empty($p)){
				echo "<script>location='$p'</script>";
			}else{
				echo "<script>location='index.php?p=1'</script>";
			}



				/*
			cookie  存储在本地缓存文件中 不能跨域 session_id
			session 存储在服务器上
			本地要向服务器提交你的私匙*/
		}else{
			echo "<script>location='login.php'</script>";
		}
	}

	if(isset($_POST['change'])){
		echo "<script>location='change.php'</script>";
	}


 ?>
 <meta charset="utf-8">
 <form action="login.php" method='post'>
	 <input type="hidden" name="str" value="<?php echo $p;?>">
 	用户名：<input type="text" name='uname'><br>
 	密码&nbsp：<input type="password" name='pass'><br>
 	<input type="submit" name="sub" value="登陆">
 	<input type="submit" name="reg" value='注册'>
 	<input type="submit" name="change" value="修改密码">


 </form>