<?php
	include "conn.php";
	function digui($pid,&$result=array(),$spac=0){
		global $link;
		$sql="select * from content where pid='$pid'";
		$query=mysqli_query($link,$sql);
		//$result=array();
		
		while($arr=mysqli_fetch_array($query)){
			//var_dump($arr);
			$spac=$spac+4;
			$arr['catename']=str_repeat('&nbsp;',$spac)."|--".$arr['name'];
			$result[]=$arr;
			digui($arr['id'],$result,$spac);
			
			
		}
		
		return $result;
		
	}
	
	$result=digui(0);
	for($i=0;$i<count($result);$i++){
		echo $result[$i]['catename']."<br />";
	}
	


?>