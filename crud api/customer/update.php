<?php

error_reporting(0);
header('Access-control-Allow-origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: PUT');
header('Access-Control-Allow-Headers: Content-type,Access-Control-Allow-Header,Authorization,X-Request-With');
include("function.php");

$requestmethod = $_SERVER['REQUEST_METHOD'];

if($requestmethod == 'PUT'){

    $input = json_decode(file_get_contents("php://input"),true);
    if(empty($input)){

        
        $updatecustomer = updatecustomer($_POST,$_GET);
        
    }else{
        
        $updatecustomer = updatecustomer($input,$_GET);
    }
    echo $updatecustomer;

}else{
    $data = [
        'status' => 405,
        'message' => $requestmethod. 'method not allowed',
    ];
    header("HTTP/1.0 405 method not allowed");
    echo json_encode($data);
}

?>