<?php
require_once '../include/conn.php';
require_once '../include/webConfig.php';
require_once 'chkLogged.php';
//如果post数据非空 说明是ajax请求
if(!empty($_POST['ajax'])){
	$start_time = strval($_POST['start_time']);
	$end_time   = strval($_POST['end_time']);
	$num = intval($_POST['n']);
	$num = empty($num)? 10:$num;
	if(empty($start_time)){
		$start_time = '2017-01-01';
	}

	if(empty($end_time)){
		$end_time = '2059-01-01';
	}
	$end_time .= ' 23:59:59';

	$sql = "select h_parentUserName as phone,count(distinct h_userName) as recommend_nums from h_member where h_regTime >= '{$start_time}' and h_regTime <= '{$end_time}'  group by h_parentUserName order by count(distinct h_userName) desc limit {$num};";
	$result = $db->query($sql);
	$aRet = array();
	while($row = $db->fetch_array($result, MYSQL_ASSOC)){
		$aRet[] = $row;
	}
	exit(json_encode($aRet));
}