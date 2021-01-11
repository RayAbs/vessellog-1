<?php

include "connect.php";

if($_SERVER['REQUEST_METHOD']=="GET"){
    
 

	$queryResult = $con->query("SELECT vesselname FROM vessel_details");
	
	$result = array ();
	while($fetchData = $queryResult->fetch_assoc()){
	    $result[]=$fetchData["vesselname"];
	}
	echo json_encode($result);
   
}


?>