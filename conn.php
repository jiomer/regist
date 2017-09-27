<?php
    //header("Content-Type: text/html; charset=utf-8");
    // $servicename = "localhost";
    // $mysqlname = "easy";
    // $mysqlpw = "root";
    // $dbname = "easy";
    // $conn = mysqli_connect($servicename,$mysqlname,$mysqlpw,$dbname);
    //连接数据库
    $conn = mysqli_connect('localhost','easy','root','easy');
    
    if($conn){
       // echo "连接成功！";
    }else {
       exit("mysqli_connect 失败!!".mysqli_connect_errno());
    }
    //mysqli_close($conn);
?>