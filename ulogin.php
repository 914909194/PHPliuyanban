<?php
	if($_COOKIE['id']){
		setcookie('id','');
		setcookie('uname','');
		setcookie('qx','');
		echo "<script>location='index.php'</script>";
	}
	

?>