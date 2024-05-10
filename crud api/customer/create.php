<?php

error_reporting(0);
header('Access-control-Allow-origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Content-type,Access-Control-Allow-Header,Authorization,X-Request-With');
include("function.php");

$requestmethod = $_SERVER['REQUEST_METHOD'];

if($requestmethod == 'POST'){

    $input = json_decode(file_get_contents("php://input"),true);
    if(empty($input)){

        echo $_POST['name'];
        $storecustomer = storecustomer($_POST);
        
    }else{
        
        $storecustomer = storecustomer($_POST);
    }
    echo $storecustomer;

}else{
    $data = [
        'status' => 405,
        'message' => $requestmethod. 'method not allowed',
    ];
    header("HTTP/1.0 405 method not allowed");
    echo json_encode($data);
}

?>