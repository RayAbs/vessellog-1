<?php
require "connect.php";
if($_SERVER['REQUEST_METHOD']=="POST"){
    $response = array();
  
    $ornum = $_POST['ornum'];
    $payment = $_POST['payment'];
    $passengerout = $_POST['passengerout'];
    $id = $_POST['id'];

        $insert = "UPDATE vessel_transaction SET ornum = '$ornum',payment = '$payment',passengerout ='$passengerout' WHERE id ='$id'";
        if (mysqli_query($con,$insert)) {
            $response['value'] = 1;
            $response['message'] = "Successfully Updated";
            echo json_encode($response);
    
        }
        else{
            $response['value'] = 0;
            $response['message'] = "Failed to Update";
            echo json_encode($response);
        }

}

?>