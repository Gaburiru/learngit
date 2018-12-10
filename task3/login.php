<?php
session_start();
header('Content-Type: application/json');

$data = file_get_contents("php://input");
$data = json_decode($data, true);

//var_dump($data['username']);

$username = $data["username"];
$password = $data["password"];

if($username == ""||$password == ""){
    $result = [
        "errcode" => 98,
        "errmsg" => '请输入用户名或密码！',
        "data" => ''
    ];
    echo json_encode($result);
    exit;
}
error_reporting(0);
$connect = new mysqli("localhost","root","",'information');
if(!$connect){

    $result = [
    "errcode" => 4396,
    "errmsg" => '数据库连接失败',
    "data" => ''
    ];
    echo json_encode($result);
    exit;
}


$sql = "select username from login where username =?";
$stmt=$connect->prepare($sql);
$stmt->bind_param("i", $username);
$stmt->execute();
$compare = $stmt->get_result();

if($compare->num_rows==1){
    mysqli_stmt_close($stmt);
            $result=[
            "errcode"=>45,
            "errmsg"=>'用户名不存在',
            "data"=>''
        ];
    echo json_encode($result);
    exit;
}

$sql = "select password from login where username = ?";
$stmt=$connect->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$stmt->bind_result($compare1);
$stmt->fetch();


if($compare1!=$password){
    
    $result = [
        "errcode" =>666 ,
        "errmsg" => '密码错误',
        "data" => ''
    ];
}
else{
    $_SESSION['username']=$username;   

    $result = [
        "errcode" => 0,
        "errmsg" => '',
        "data" =>''
    ];
}

    
    



// 以下代码用于测试，仅作为结构和部分写法的参考
/*
if (rand() % 3) {
    $result = [
        'errcode' => 233,
        'errmsg' => '吔屎啦你！',
        'data' => ''
    ];
} else {
    $result = [
        "errcode" => 0,
        "errmsg" => "",
        "data" => [
            "number_of_times" => 11,
            "last_login_time" => "2018-09-21 09:17:21"
        ]
    ];
}
*/
echo json_encode($result);
