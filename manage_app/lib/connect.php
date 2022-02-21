<?php
error_reporting(E_ALL ^ E_NOTICE); // ปิด warning php ตัวแปรที่ประกาศลอยๆ
$show = 1;
switch ($show) {
    case 1:
        // root
        $hostname = 'localhost'; //ชื่อโฮสต์
        $user = 'root'; //ชื่อผู้ใช้
        $password = ''; //รหัสผ่าน
        $dbname = 'db_project_question'; //ชื่อฐานข้อมูล
        break;
    case 2:
        // Hosting
        $hostname = 'localhost'; //ชื่อโฮสต์
        $user = 'root'; //ชื่อผู้ใช้
        $password = ''; //รหัสผ่าน
        $dbname = 'db_project_question'; //ชื่อฐานข้อมูล
        break;
}
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
        . $mysqli->connect_error);
}
$conn = mysqli_connect($hostname, $user, $password, $dbname);
mysqli_query($conn, 'set NAMES utf8');
mysqli_query($conn, 'SET character_set_results=utf8');
mysqli_query($conn, 'SET character_set_client=utf8');
mysqli_query($conn, 'SET character_set_connection=utf8');
date_default_timezone_set('Asia/Bangkok');
