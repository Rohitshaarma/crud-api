<?php
header('Access-control-Allow-origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers: Content-type,Access-Control-Allow-Header,Authorization,X-Request-With');
include("function.php");

$requestmethod = $_SERVER['REQUEST_METHOD'];

if($requestmethod == "GET"){
    if(isset($_GET['id'])){

        $customer = getcustomer($_GET);
        echo $customer;

    }else{

        $customerlist = getcustomerlist();
        echo $customerlist;
    }

}else{
    $data = [
        'status' => 405,
        'message' => $requestmethod.  ' method not allowed',
    ];
    header("HTTP/1.0 405 method not allowed");
    echo json_encode($data);
}


?>