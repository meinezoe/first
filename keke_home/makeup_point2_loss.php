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

		$fKeep = $farm_money - $fLandMoney;
		/*总生长*/
		$growth_total = 0;
		$query = "select sum(abs(h_price)) as total from h_log_point2 where h_userName = '{$sPhone}' and h_type_id in (3,4)";
		$result3 = mysql_query($query);
		$rs = mysql_fetch_array($result3);
		if($rs){
			if(!empty($rs['total'])){
				$growth_total = $rs['total'];
			}	
		}

		/*总收获KK数*/
		$total_kk = 0;
		$query = "select sum(abs(h_price)) as total from h_log_point2 where h_userName = '{$sPhone}' and h_type_id in (5)";
		$result4 = mysql_query($query);
		$rs = mysql_fetch_array($result4);
		if($rs){
			if(!empty($rs['total'])){
				$total_kk = $rs['total'];
			}	
		}

		$fNeedMakeup = $growth_total - $total_kk - $fKeep;
		if($fNeedMakeup > 1e-4){
			//需要给用户补上
			$sql = "update `h_member` set h_point2 = h_point2 + {$fNeedMakeup} where h_userName = '{$sPhone}'";
			mysql_query($sql);
		}

		/*采蜜*/
		$query2 = "select sum(h_price) as total from h_usebee where h_userName = '{$sPhone}' ";
		$result4 = mysql_query($query2);
		$rs2 = mysql_fetch_array($result4);
		if($rs2){
			if(!empty($rs2['total'])){
				$growth_total =  $growth_total  + $rs2['total'];
			}
		}

		$fShouldSum = $fLandMoney + $growth_total;
/*		if($fShouldSum > $fTotalNum){
			$fDiff = $fShouldSum - $fTotalNum;
			if($fDiff > 1e-6 && $fDiff < 3){
				$iUpdate = 1;
				if($iUpdate){
					$sql = "update h_member set h_point2 = h_point2 + {$fDiff} where h_userName = '{$sPhone}'";
					mysql_query($sql);
				}else{
					echo $fShouldSum . '|' . $fTotalNum . PHP_EOL;
					echo $fDiff . PHP_EOL;
				}
			}
		} */
		//判断$fTotalNum与$growth_total的个位数字到小数位置是否相等
		
	}//end of while

	$iStart++; 
}//end of while true

exit('makeup_point2_loss run end time:' . date('Y-m-d H:i:s'));