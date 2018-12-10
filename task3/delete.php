<?php
session_start();
header('Content-Type: application/json');
$data = file_get_contents("php://input");
$data = json_decode($data, true);
error_reporting(0);
$message=$data["message"];
$time=$data["time"];
$username=$_SESSION["username"];
//var_dump($time);
//var_dump($message);
//var_dump($username);
$connect = new mysqli("localhost","root","",'information');
if(!$connect){    
    $result = [
    "errcode" => 333,
    "msg" => "数据库连接失败"
    ];
}
else{
    $sql="delete from message where username=? and message='$message' and time='$time'";
    $stmt =$connect->prepare($sql);
    $stmt->bind_param('s',$username);
    $stmt->execute();   
    
    
    $result=[
        "errcode"=>0,
        "msg"=>"删除成功"
    ];       

}

echo json_encode($result);