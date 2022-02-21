<?php
//----------------- GET File form module-----------------------------------
$file = 'admin_' . $_GET['mn'] . '/' . $_GET['file'] . '.php';
if (file_exists($file) && isset($_GET['mn']) && isset($_GET['file'])) {
	require "../manage_app/$file";
} elseif (file_exists($file) or !$_GET['mn'] or !$_GET['file']) {
	require 'admin_dashboard/dashboard_list.php';
} else {
	//echo'<center><h4>ขออภัยครับ ไม่มีหน้านี้อยู่ในระบบ กรุณาตรวจสอบ URL ของท่าน</h4></center>';
	require '404.html';
}
// แสดง Error debug file.
error_reporting(E_ALL); // เพราะตรงนี้
ini_set("display_errors", 1); // และตรงนี้ทำงานแล้ว
