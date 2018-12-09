<?php
session_start();
header('Content-Type: application/json');
$connect = mysqli_connect("localhost","root","",'information');
error_reporting(0);
if(!$connect){    
    $data[]=array(
        "errcode"=>55,
        "time"=>'',       
        "message"=>'数据库连接失败'
    );
}
elseif(!isset($_SESSION['username'])){
    $data[]=array(
        "errcode"=>66,
        "time"=>'',
        "message"=>'请返回登陆'
    );
}
else{
    $username=$_SESSION['username'];
    $sql = "select time, message from message where username='$username' order by time desc";
    $query=mysqli_query($connect,$sql);
    $data=array();
    while($row=mysqli_fetch_array($query))
        $data[]=array(
            "errcode"=>0,          
            "time"=>$row['time'],       
            "message"=>htmlspecialchars($row['message'])
        );
        
    
}

echo json_encode($data);