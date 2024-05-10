<?php
require_once '../inc/dbconn.php';


function getcustomerlist() {

    global $conn;

    $query = "SELECT * FROM customers";

    $result = mysqli_query($conn,$query);

    if($result){

        if(mysqli_num_rows($result) > 0){

            $res = mysqli_fetch_all($result,MYSQLI_ASSOC);
            $data = [
                'status' => 200,
                'message' => 'customer list fetched successfully',
                'data' => $res
            ];
            header("HTTP/1.0 200 customer list fetched successfully");
            return json_encode($data);


        }else{

            $data = [
                'status' => 404,
                'message' =>  'no customer found',
            ];
            header("HTTP/1.0 404 no customer found");
            return json_encode($data);
        }



    }else{

        $data = [
            'status' => 500,
            'message' => $requestmethod. ' internal server error',
        ];
        header("HTTP/1.0 500 internal server error");
        return json_encode($data);

    }


}

function error422($message){

    $data = [
        'status' => 422,
        'message' => $message,
    ];
    header("HTTP/1.0 422 unprcessable entity");
    echo json_encode($data);
    exit();
}

function storecustomer($coustmerinput){
    global $conn;

    $name = mysqli_real_escape_string($conn,$coustmerinput['name']);
    $email = mysqli_real_escape_string($conn,$coustmerinput['email']);
    $phone = mysqli_real_escape_string($conn,$coustmerinput['phone']);

    if(empty(trim($name))){

        return error422('enter your name');

    }elseif(empty(trim($email))){

        return error422('enter your name');

    }elseif(empty(trim($phone))){

        return error422('enter your name');

    }else{
        $query =  "INSERT INTO customer (name,email,phone) VALUES('$name','$email','$phone')";
        $result = mysqli_query($conn,$query);

        if($result){

            $data = [
                'status' => 201,
                'message' => 'customer created successfully',
            ];
            header("HTTP/1.0 201 customer created successfully");
            echo json_encode($data);

        }else{

            $data = [
                'status' => 500,
                'message' =>'internal server error',
            ];
            header("HTTP/1.0 500 internal server error");
            echo json_encode($data);
        }
    }
}
 function getcustomer($costomerparams){

    global $conn;

    if($costomerparams['id'] == null){

        return error422('enter your customer id');

    }

    $customerid = mysqli_real_escape_string($conn,$costomerparams['id']);

    $query = "SELECT * FROM customer WHERE id = '$customerid' LIMIT 1";

    $result = mysqli_query($conn,$query);

    if($result){

        if(mysqli_num_rows() == 1){
                $res = mysqli_fetch_assoc($result);

                $data = [
                    'status' => 200,
                    'message' =>'no coustomer fetched successfully',
                    'data' => $res
                ];
                header("HTTP/1.0 200 no coustomer fetched successfully");
                echo json_encode($data);


        }else{
            $data = [
                'status' => 404,
                'message' =>'no coustomer found',
            ];
            header("HTTP/1.0 404 no coustomer found");
            echo json_encode($data);
        }

    }else{

        $data = [
            'status' => 500,
            'message' =>'internal server error',
        ];
        header("HTTP/1.0 500 internal server error");
        echo json_encode($data);

    }



 }

 function updatecustomer($coustmerinput,$costomerparams){

    global $conn;

    if(!isset($costomerparams['id'])){
        return error422("coustomer id not found");
    }elseif(($costomerparams['id']== null)){

        return error422("enter coustomer id");


    }

    $customerid = mysqli_real_escape_string($conn,$costomerparams['id']);
    $name = mysqli_real_escape_string($conn,$coustmerinput['name']);
    $email = mysqli_real_escape_string($conn,$coustmerinput['email']);
    $phone = mysqli_real_escape_string($conn,$coustmerinput['phone']);

    if(empty(trim($name))){

        return error422('enter your name');

    }elseif(empty(trim($email))){

        return error422('enter your name');

    }elseif(empty(trim($phone))){

        return error422('enter your name');

    }else{
        $query =  "UPDATE customer SET name='$name',email='$email',phone='$phone' WHERE id = '$customerid' LIMIT 1";
        $result = mysqli_query($conn,$query);

        if($result){

            $data = [
                'status' => 200,
                'message' => 'customer updated successfully',
            ];
            header("HTTP/1.0 200 customer updated successfully");
            echo json_encode($data);

        }else{

            $data = [
                'status' => 500,
                'message' =>'internal server error',
            ];
            header("HTTP/1.0 500 internal server error");
            echo json_encode($data);
        }
    }

 }
    function deletecustomer($costomerparams){

        global $conn;

        global $conn;

        if(!isset($costomerparams['id'])){
            return error422("coustomer id not found");
        }elseif(($costomerparams['id']== null )){
    
            return error422("enter coustomer id");
    
    
        }
    
        $customerid = mysqli_real_escape_string($conn,$costomerparams['id']);

        $query = "DELETE FROM customer WHERE id = '$customerid'";
        $result = mysqli_query($conn,$query);

        if($result){

            $data = [
                'status' => 200,
                'message' => 'customer deleted successfully',
            ];
            header("HTTP/1.0 200 customer deleted successfully");
            echo json_encode($data);

        }else{

            $data = [
                'status' => 404,
                'message' =>'customer not found',
            ];
            header("HTTP/1.0 404 customer not found");
            echo json_encode($data);


        }


    }
?>