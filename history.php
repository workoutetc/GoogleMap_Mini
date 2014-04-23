<?php
setcookie("usetime", "1hr", time()+3600);
header("Content-Type: text/html; charset=tis-620");
require_once('resources/class/ez_sql.php');
require_once('resources/class/authen_user.php');
include('resources/class/tools.php');



if(isset($_POST["BtnSearch"])){
	 print_r($_POST);
		$namePlace=$_POST["namePlace"];
		$sql_market  = "INSERT INTO `markers` (`id`,`name`,`address`,`lat`,`lng`,`type`,timestampStart) VALUES (NULL,'$namePlace','address','','3232323','market',now()) ";
		
		if($db->query($sql_market)==""):
			//	header("Location:$_SERVER[HTTP_REFERER]");
		endif;
}

if(isset($_POST["findhistory"])){

		
		$sql_history  = "SELECT markers.id, markers.name, markers.address, markers.lat, markers.lng, markers.`type` FROM markers ";
		$sql_history  .=" WHERE  timestampStart >= date_sub(NOW(), interval 1 hour)  ORDER BY markers.id DESC LIMIT 0, 4";
	
		// print  $sql_history ;
		 if($keyword =$db->get_results($sql_history)):
		 
				 foreach ($keyword as $data): 
				 
						 echo "<li>".$data->name."</li>";
				 
				 endforeach;
		 
		 endif;
}

?>

