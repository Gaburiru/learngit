<?php
session_start();
header('Content-Type: application/json');
error_reporting(0);


$message=$_POST["message"];
//判断用户登陆状态
if(isset($_SESSION['username'])){ 
   
    $connect = mysqli_connect("localhost","root","",'information');
    if(!$connect){    
        $result = [
        "errcode" => 333,
        "errmsg" => "数据库连接失败",
        "sucmsg" => ''
        ];
        echo json_encode($result);
        exit;
    }
    
    if(mb_strlen($message,'utf-8')<6){
        $result=[
            "errcode"=>233,
            "errmsg"=>"留言信息须超过6个字",
            "sucmsg"=>""
        ];
        echo json_encode($result);
        exit;
    }
    if(mb_strlen($message,'utf-8')>140){
        $result = [
            "errcode" => 222,
            "errmsg" => "留言信息不能超过140字",
            "sucmsg"=>''
        ];
        echo json_encode($result);
    }
    else{
        $sql1="insert into message (username, message, time) values (?,?,now())";
        $stmt = mysqli_prepare($connect,$sql1);
        $stmt->bind_param('ss',$_SESSION["username"],$_POST["message"]);
        $stmt->execute();   
        $result=[
            "errcode" => 0,
            "errmsg" => '',
            "sucmsg" => "留言成功"
        ];
        echo json_encode($result);
        $stmt->close(); 
    } 
}else{
   $result=[
        "errcode" => 555,
        "errmsg" => "请登录后再留言",
        "sucmsg" => ''
    ];
    echo json_encode($result);
}
