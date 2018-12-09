<?php
session_start();
header('Content-Type: application/json');
error_reporting(0);
$data = file_get_contents("php://input");
$data = json_decode($data, true);
$message=$data["message"];
$time=$data["time"];
$username=$_SESSION["username"];
//var_dump($message);
$connect = mysqli_connect("localhost","root","",'information');
    if(!$connect){    
        $result = [
        "errcode" => 333,
        "msg" => "数据库连接失败"
        
        ];
        echo json_encode($result);
       exit;
    }
    if(mb_strlen($message,'utf-8')<6){
        $result=[
            "errcode"=>233,
            "msg"=>"留言信息须超过6个字"
            
        ];
        echo json_encode($result);
    }
    else{
        $sql="update message set message=? where username=? and time=?";
        $stmt = mysqli_prepare($connect,$sql);
        $stmt->bind_param('sss',$message,$username,$time);
        $stmt->execute();   
        
        $result = [
            "errcode" =>0,
            "msg" => "update finish"
        ];
        
        $stmt->close();  
        echo json_encode($result);
    }