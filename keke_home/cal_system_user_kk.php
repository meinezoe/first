<?php
sleep(1);

if(php_sapi_name() != 'cli'){
	exit('wrong source!');
}

date_default_timezone_set('Asia/Shanghai');
$sIp = "127.0.0.1";
$sUserName   = "kkh";		 
$sPass = "qd645C146B3jNZtx4BtH";	 
$sDataName = "kekehome";	 

if(!$link = @mysql_connect($sIp, $sUserName, $sPass)) {
	exit('Can not connect to MySQL server');
}

@mysql_select_db($sDataName, $link);

mysql_query("SET NAMES UTF8");

$iPageSize = 100;
$iStart = 0;

$fSystemTotalKK = 0;
while(true){
	$iStartPos = $iStart*$iPageSize;
	$sql = "select h_userName from h_member order by id limit $iStartPos, $iPageSize";
	$result = mysql_query($sql, $link); //查询

	if(!mysql_num_rows($result)){
		break;
	}

	while($row = mysql_fetch_array($result)){
		$sPhone = strval($row['h_userName']);
		$query = "select * from h_member where h_userName = '{$sPhone}'";
		$result1 = mysql_query($query);
		$aUserInfo = mysql_fetch_array($result1);
		if(empty($aUserInfo)){
			continue;
		}

		$query = "select * from `h_member_farm` where h_userName = '{$sPhone}' and h_isEnd = 0";
		$result2 = mysql_query($query);
	
		$rs3 = array();
		while($list = mysql_fetch_array($result2))
		{
			$rs3[]=$list;
		}

		$land_now = 0;
		$fLandMoney = 0;
		if(count($rs3) > 0)
		{
			foreach ($rs3 as $key=>$val)
			{
			  if($val['h_pid'] == "112")
			  {
				$h_harvest = explode(",",$val['h_harvest']);
				$h_land = explode(",", $val['h_land']);
				  for($a = 0; $a < count($h_harvest); $a++)
				  {
				    $land_now = $land_now + $h_harvest[$a];
				    if(!empty($h_land[$a])){
				    	$fLandMoney +=300;
				    }
				  }
			  }
			  else
			  {
				$h_harvest = explode(",",$val['h_harvest']);
				$h_land = explode(",", $val['h_land']);
			    for($a = 0; $a < count($h_harvest); $a++)
				{
				    $land_now = $land_now + $h_harvest[$a];
				    if(!empty($h_land[$a])){
				    	$fLandMoney +=3000;
				    }
				}
			  }
			}
		}
	
		$farm_money = $land_now;
		$fTotalNum = floatval($aUserInfo['h_point2']+$farm_money);
		$fSystemTotalKK += $fTotalNum;
	}//end of while

	$iStart++; 
}//end of while true

//$fSystemTotalKK 现在为系统所有用户的总kk数 将此信息插入到h_system_total中
/*CREATE TABLE `h_system_total` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `record_time` date default '0000-00-00',
  `record_timestamp` int(11) default '0',
  `total_money` decimal(10,2) default '0',
  `day_money` decimal(10,2) default '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58231 DEFAULT CHARSET=utf8;
*/
$iNow = time();
$sNow = date('Y-m-d', $iNow);

//先去查询h_system_total是否存在今天的信息
$sSelectSql = "select * from `h_system_total` where record_time = '{$sNow}'";
$system_result = mysql_query($sSelectSql);
$aTodayInfo = mysql_fetch_array($system_result, MYSQL_ASSOC);
if(empty($aTodayInfo)){
	$sInsertSql = "insert into `h_system_total` set record_time = '{$sNow}', record_timestamp = {$iNow}, total_money={$fSystemTotalKK}, day_money = 0";
	mysql_query($sInsertSql);
}else{
	$fDiff = $fSystemTotalKK - floatval($aTodayInfo['total_money']);
	$sUpdateSql = "update `h_system_total` set `day_money` = {$fDiff} where record_time = '{$sNow}'";
	mysql_query($sUpdateSql);
}

exit('cal_system_user_kk run end time:' . date('Y-m-d H:i:s'));