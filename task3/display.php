<?php
header('Content-Type: application/json');
$connect = new mysqli("localhost","root","",'information');
if(!$connect){    
    $data=[
        "errcode"=>33,
        "username"=>'',
        "time"=>'',       
        "message"=>'数据库连接失败'
    ];
}
else{
    /*$rowsPage = 10;
    $row = mysqli_fetch_array(mysql_query("SELECT count(*) as c from message"));
    $rows = $row['c'];
    $pages = ceil($rows / $rowsPerPage);
    $nowPage = 1;
    if(isset($_POST['nowPage']))
        $nowPage = $_POST['nowPage'];
    $sql = "SELECT * from message order by time DESC";
    $result = mysqli_array(mysqli_query($sql));*/
    $sql = "select * from message order by time desc";
    $query=$connect->query($sql);
    while($row=mysqli_fetch_array($query))
        $data[]=array(
            "errcode"=>0,
            "username"=>htmlspecialchars($row['username']),
            "time"=>$row['time'],       
            "message"=>htmlspecialchars($row['message']));
}
echo json_encode($data);

