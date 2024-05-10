<?php
header('Access-control-Allow-origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: DELETE');
header('Access-Control-Allow-Headers: Content-type,Access-Control-Allow-Header,Authorization,X-Request-With');
include("function.php");

$requestmethod = $_SERVER['REQUEST_METHOD'];

if($requestmethod == "DELETE"){
    

        $deletecustomer = deletecustomer($_GET);
        echo $deletecustomer;

   

}else{
    $data = [
        'status' => 405,
        'message' => $requestmethod.  ' method not allowed',
    ];
    header("HTTP/1.0 405 method not allowed");
    echo json_encode($data);
}


?>