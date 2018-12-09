<?php
session_start();
session_destroy();
$response=["msg"=>"注销成功"];
echo json_encode($response);