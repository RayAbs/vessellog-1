<?php
require "connect.php";
if($_SERVER['REQUEST_METHOD']=="POST"){
    $data = json_decode(file_get_contents('php://input'), true);
    $response = array();
    $client_addstaysign = $data['client_addstaysign'];
    $ornum_addstay = $data['ornum_addstay'];
    $payment_addstay = $data['payment_addstay'];
    $id = $data['id'];

        $insert = "UPDATE vessel_transaction SET ornum_addstay = '$ornum_addstay',payment_addstay = '$payment_addstay', client_addstaysign ='$client_addstaysign' WHERE id ='$id'";
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