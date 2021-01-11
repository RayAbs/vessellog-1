<?php

include "connect.php";

if($_SERVER['REQUEST_METHOD']=="GET"){
    $id = $_GET['client_signature'];
    $cid = $_GET['company_name'];

	$queryResult = $con->query("SELECT vessel_transaction.*,vessel_details.vesselname,vessel_details.scn,vessel_details.voyageno FROM vessel_transaction,vessel_details where client_signature in (select userid from users where company_name='$cid') AND vessel_details.vesselid = vessel_transaction.vesselid AND addnumstay IS NOT NULL AND ornum_addstay IS NULL AND payment_addstay IS NULL");
	// echo "SELECT * FROM vessel_details where client_signature=$id";
	$result = array ();
	while($fetchData = $queryResult->fetch_assoc()){
	    $result[] = $fetchData;
	}
	echo json_encode($result);
   
}


?>