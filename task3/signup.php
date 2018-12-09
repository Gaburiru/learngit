<?php
header('Content-Type: application/json');

$data = file_get_contents("php://input");
$data = json_decode($data, true);

$username = $data["username"];
$password = $data["password"];
$checkpwd = $data["checkpwd"];

if($username==''||$password==''||$checkpwd==''){
    $result= [
        "errcode" => 456,
        "errmsg" => '请确认输入信息的完整性！',
        "data" => ''
    ];
}
if($password!=$checkpwd){
    $result= [
        "errcode" => 2333,
        "errmsg" => '两次输入的密码不一致！',
        "data" => ''       
    ];
}
else{
    error_reporting(0);
    $connect = mysqli_connect("localhost","root","",'information');
    mysqli_set_charset($connect, "utf8mb4");
    if(!$connect){
        $result = [
            "errcode" => 4396,
            "errmsg" => '数据库连接失败',
            "data" => ''
        ];
    }
    else{
        $sql = "select username from login where username =?";
        $stmt=mysqli_prepare($connect,$sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $compare = $stmt->get_result();
        //var_dump($compare);
        if($compare->num_rows != 0){
            
            $result=[
                    "errcode"=>45,
                    "errmsg"=>'用户名已存在!',
                    "data"=>''
            ];
        }
        else{
            $sql2="select max(id) from login";
            $id=mysqli_fetch_array(mysqli_query($connect, $sql2));
            $id[0]+=1;
            $sql1="insert into login (id, username, password, times, last) values ('$id[0]', ? , ? , '0', now())";     
               
            $stmt = mysqli_prepare($connect,$sql1);
            $stmt->bind_param("ss", $username,$password);
            $stmt->execute();
           
            
            $result = [
                "errcode" => 0,
                "errmsg" => "",
                "data" => []
            ];
            $stmt->close();   
        }
        
    }

}







// 以下代码用于测试，仅作为结构和部分写法的参考
/*if (rand() % 3) {
    $result = [
        'errcode' => 233,
        'errmsg' => '吔屎啦你！',
        'data' => ''
    ];
} else {
    $result = [
        "errcode" => 0,
        "errmsg" => "",
        "data" => []
    ];
}*/

echo json_encode($result);
?>
