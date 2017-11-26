<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/conn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/webConfig.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/member/logged_data.php';
$webInfo = $db->get_one("SELECT * FROM `h_config`");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<style type="text/css">
		#land_info{
			background: url(http://127.0.0.1/member/imsges/bg.png);
			width: 920px;
			height: 664px;
			position: relative;
		}

		.common_land{
			background: url(imsges/dibg01.png);
			width:188px;
			height: 82px;
			position: absolute;
		}

		#didiv{
			position: relative;
			left:30%;
			top:40%;
		}

		#land1{

		}

		#land2{
			top:35px;
			left:85px;
		}

		#land3{
			top:70px;
			left:170px;
		}

		#land4{
			top:105px;
			left:255px;
		}

		#land5{
			top:140px;
			left:340px;
		}

		#land6{
			top:42px;
			left:-97px;
		}

		/*less sass 加入变量的css*/
		#land7{
			top:77px;
			left:-12px;
		}

		#land8{
			top:112px;
			left:73px;
		}

		#land9{
			top:147px;
			left:158px;
		}

		#land10{
			top:183px;
			left:243px;
		}

		#tool_bar{
			width: 460px;
			height: 60px;
			background:  url(http://127.0.0.1/member/imsges/toolsbg.png);
			position: absolute;
			bottom: 20px;
		}

		#tool_bar div{
			/*inline inline-block block none flex*/
			display: inline-block;
		}

		#info{
			background: url(http://127.0.0.1/member/imsges/infobg.png) no-repeat;
			width: 860px;
			height: 35px;
			position: absolute;
			left:40px;
			top:38px;
			line-height: 35px;
		}

		#info span{
			color:#666;
			font-size: 12px;
			position: relative;
			left:10px;
		}

		.common_land img{
			transition: .5s ease-in;
		}

		#shifei{
			position: absolute;
			width: 80px;
			height: 80px; 
			top:-40px;
			left:45px;
			opacity: 0;
		}
	</style>
	<script type="text/javascript" src="jquery.js"></script>
</head>
<body>
<div id="land_info">
	<div id="info">

		<span id="unumber">用户：<?php
	$user=123;
	echo $user;
	?></span>
		<span id="zong">总量:<?php
	$zong=10000;
	echo $zong;
	?></span>
	</div>
	<div id="didiv">
		<!--land 1 -->
		<div id="land1" class="common_land">
			<img id="tree1" src="http://127.0.0.1/member/imsges/shu1.png" style="position: relative; left:50px; top:-30px;opacity: 0;">
			<img id="shifei" src="http://127.0.0.1/member/imsges/huafei.png">
		</div>
		<!--land 2 -->
		<div id="land2" class="common_land">
			<img id="tree2" src="http://127.0.0.1/member/imsges/shu1.png" style="position: relative; left:50px; top:-30px;opacity: 0;">
		</div>
		<!--land 3 -->
		<div id="land3" class="common_land">
			<img id="tree3" src="http://127.0.0.1/member/imsges/shu1.png" style="position: relative; left:50px; top:-30px;opacity: 0;">
		</div>
		<!--land 4 -->
		<div id="land4" class="common_land">
			<img id="tree4" src="http://127.0.0.1/member/imsges/shu1.png" style="position: relative; left:50px; top:-30px;opacity: 0;">
		</div>
		<!--land 5 -->
		<div id="land5" class="common_land">
			<img id="tree5" src="http://127.0.0.1/member/imsges/shu1.png" style="position: relative; left:50px; top:-30px;opacity: 0;">
		</div>
		<!--land 6 -->
		<div id="land6" class="common_land">
			<img id="tree6" src="http://127.0.0.1/member/imsges/shu1.png" style="position: relative; left:50px; top:-30px;opacity: 0;">
		</div>
		<!--land 7 -->
		<div id="land7" class="common_land">
			<img id="tree7" src="http://127.0.0.1/member/imsges/shu1.png" style="position: relative; left:50px; top:-30px;opacity: 0;">
		</div>
		<!--land 8 -->
		<div id="land8" class="common_land">
			<img id="tree8" src="http://127.0.0.1/member/imsges/shu1.png" style="position: relative; left:50px; top:-30px;opacity: 0;">
		</div>
		<!--land 9 -->
		<div id="land9" class="common_land">
			<img id="tree9" src="http://127.0.0.1/member/imsges/shu1.png" style="position: relative; left:50px; top:-30px;opacity: 0;">
		</div>
		<!--land 10 -->
		<div id="land10" class="common_land">
			<img id="tree10" src="http://127.0.0.1/member/imsges/shu1.png" style="position: relative; left:50px; top:-30px;opacity: 0;">
		</div>
	</div>

	<!-- div + css  header aside footer-->
	<div id="tool_bar">
		<div id="kai">
			<img src="imsges/kaiico.png" onclick="action('plant')" alt="开垦新地" style="position: relative;left:30px;">
		</div>
		<div id="add">
			<img src="imsges/jiaico.png" onclick="action('add')" alt="增加播种" style="position: relative;left:60px;">
		</div>
		<div id="fertilizer">
			<img src="member/imsges/hfico2.png" style="position: relative;left:90px;">
		</div>
		<div id="harvest">
			<img src="imsges/caiico.png" onclick="action('harvest')" alt="采摘KK" style="position: relative;left:120px;">
		</div>

		<div id="bee">
			<img src="member/imsges/mf2.png" alt="采蜜" style="position: relative;left:150px;">
		</div>

		<div id="refresh">
			<img src="imsges/shuaxin.png" onclick="location.reload();" alt="刷新" style="position: relative;left:170px;">
		</div>
	</div>
</div>


<script type="text/javascript">
	//localStorage setItem getItem plant
	$(function(){
		var storage = JSON.parse(localStorage.getItem('plant'));
		for(var i in storage){
			if(storage[i] == 1){
				$("#tree" + (parseInt(i)+1)).css({opacity: 0.8});
			}
		}
	});

	function action(flag){
		switch(flag){
			case "plant":
				$("body").css({"cursor":"url(imsges/kaiico.ico),auto"});
				$(".common_land").click(function(){

					$.ajax({
						//Markdown 接口文档 300kk

						//h_member h_log_point2
						//h_member_farm 存的是种树的种树信息
						//调用后台的一个接口 
						//1.看看自己的钱能不能种下这棵树
						//2.如果不能 返回false 如果能 后台扣钱 把种树的信息记录到数据库里 同时返回true

					});

					$("body").css({"cursor":""});
					//种一颗大树
					//$("#tree1").css({"opacity": 0.8}, 2000);
					$(this).children().css({"opacity": 0.8});
					$(".common_land").off("click");

					//[0 0 0 0 0 0 0 0 0 0]
					var storage = localStorage.getItem("plant");
					if(storage == null){
						storage = [0,0,0,0,0,0,0,0,0,0];	
					}else{
						storage = JSON.parse(storage);
					}
					var str = $(this).children().attr("id");

					var res = /^.*?(\d*)$/.exec(str);
					var land_id = parseInt(res[1]);


					storage[land_id-1] = 1;
					localStorage.setItem("plant", JSON.stringify(storage));
				});
			 	break;
			case "add":
				break;
			case "harvest":
				break;
			default:
				break;
		}
	}

	$("body").click(function(){
		$("#shifei").fadeTo(200, 0.8);
		$("#shifei").animate({
			height:"89px",
			width:"98px"
		},400,function(){
			$("#shifei").animate({top:"0px"},200);
		});
		$("#shifei").fadeTo(1000, 0);
		
		// $("#shifei").css({
		// 	height:"80px"
		// });
	});
	document.onmousewheel = function(event){
		console.log(event);
	}

</script>
</body>
</html>
<?php
?>