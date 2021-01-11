<?php
require "connect.php";

if($_SERVER['REQUEST_METHOD']=="POST"){
    $data = json_decode(file_get_contents('php://input'), true);
    // echo var_dump($data);
    $response = array();
    $typeofport = $data['typeofport'];
    $vesselid = $data['vesselid'];
    $client_signature = $data['client_signature'];
    $transaction_id = $data['transaction_id'];
    $anchor_ata = $data['anchor_ata'];
    $anchor_atd = $data['anchor_atd'];
    $berth_ata = $data['berth_ata'];
    $berth_etd = $data['berth_etd'];
    $berth_atd = $data['berth_atd'];
    $berth_assignment = $data['berth_assignment'];
    $lastport = $data['lastport'];
    $nextport = $data['nextport'];
    $passengerin = $data['passengerin'];
    $check = "SELECT * FROM vessel_transaction WHERE vesselid='$vesselid'";
    $result = mysqli_fetch_array(mysqli_query($con,$check));

    if(isset($result)){
        $response['value'] = 2;
        $response['message'] = "Record Already Exist";
        echo json_encode($response);
    }

   else{
    $insert = "INSERT INTO vessel_transaction(status,typeofport,vesselid,transaction_id,anchor_ata,anchor_atd,berth_ata,berth_etd,berth_atd,berth_assignment,lastport,nextport,passengerin,ornum,payment,ornum_addstay,payment_addstay,client_signature) VALUE ('pending','$typeofport','$vesselid','$transaction_id',NULLIF('$anchor_ata','null'),NULLIF('$anchor_atd','null'),NULLIF('$berth_ata','null'),NULLIF('$berth_etd','null'),NULLIF('$berth_atd','null'),'$berth_assignment','$lastport','$nextport','$passengerin',NULL,NULL,NULL,NULL,'$client_signature')";
    // echo json_encode($insert);
    if (mysqli_query($con,$insert)) {
        $last_id = mysqli_insert_id($con);
        // echo $last_id;
        $queryResult = $con->query("SELECT transaction_id from vessel_transaction where id = $last_id");
            $result = array ();
            while($fetchData = $queryResult->fetch_assoc()){
                $result = $fetchData;
            }
        $response['value'] = 1;
        $response['message'] = $result;
        echo json_encode($response);   
    }
    else{
        $response['value'] = 0;
        $response['message'] = "Failed to Add";
        echo json_encode($response);
    }

   }
    
   
}

?>