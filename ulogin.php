<?php
	if($_COOKIE['id']){
		setcookie('id','');
		setcookie('uname','');
		echo "<script>location='index.php'</script>";
	}
	

?>