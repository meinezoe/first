<?php
$memberLogged_userName = $_COOKIE['m_username'];
$memberLogged_passWord = $_COOKIE['m_password'];
$memberLogged_fullName = $_COOKIE['m_fullname'];
$memberLogged_level = $_COOKIE['m_level'];
$memberLogged_isPass = $_COOKIE['m_isPass'];

$sql = "SELECT * FROM `h_member` WHERE `h_userName` ='$memberLogged_userName'";
$result = $db->fetch_array($db->query_direct($sql));

$memberLogged = false;
if(isset($result['h_passWord'])&&$memberLogged_passWord==$result['h_passWord']){
	$memberLogged = true;
	
	if(!$memberLogged_fullName)
		$memberLogged_fullName = $memberLogged_userName;
}