<?php

include "connect.php";

if($_SERVER['REQUEST_METHOD']=="GET"){
    $vname = $_GET['vesselname'];
    $vnumber = $_GET['voyagenumber'];
 
   //$queryResult = $con->query("SELECT * FROM vessel_details WHERE vesselname='$vname' AND voyageno='$vnumber'");
	$queryResult = $con->query("SELECT * FROM vessel_details WHERE vesselname='$vname' AND voyageno='$vnumber'");
    
	$result = array ();

	while($fetchData = $queryResult->fetch_assoc()){
	    $result[] = $fetchData;
	};
	echo json_encode($result);
   
}


?>