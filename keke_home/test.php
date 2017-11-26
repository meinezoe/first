<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title>Bootstrap 实例 - 堆叠的水平</title>
   <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
   <link href="/ui/css/css.css" rel="stylesheet">
   <script src="https://cdn.bootcss.com/jquery/2.0.0/jquery.min.js"></script>
   <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="main clearfix">
<!--LEFT -->
    <div class="left pull-left">
        <div class="btn-group-vertical">
            <ul>
                <li>
                    <a class="btn btn-long" href="/member/index.php" id="mlindex"><span class="glyphicon glyphicon-home llong0" aria-hidden="true"></span><span class="llong2">玩家首页</span></a>
                </li>    
                <li>
                    <a class="btn btn-long" href="#" role="button"><span class="glyphicon glyphicon-piggy-bank llong0" aria-hidden="true"></span><span class="llong2">庄园管理</span><span class="glyphicon glyphicon-menu-left llong1"></span></a>
                    <ul class="sub-menu">
                        <li><a class="btn btn-long8" href="/member/my_farm.php" id="m11">我的庄园</a></li>
                        <li><a class="btn btn-long8" href="/member/com_list.php" id="m22">好友庄园(一级)</a></li>
                        <li><a class="btn btn-long8" href="/member/com_list_second.php" id="m24">好友庄园(二级)</a></li>
                        <li><a class="btn btn-long8" href="/member/act_mer.php" id="m23">开发新庄园</a></li>
                    </ul>
                </li>
                <li>
                    <a class="btn btn-long" href="#" role="button"><span class="glyphicon glyphicon-user llong0" aria-hidden="true"></span><span class="llong2">账户管理</span><span class="glyphicon glyphicon-menu-left llong1"></span></a>
                    <ul class="sub-menu">
                        <li><a class="btn btn-long8" href="/member/rr.php" id="m21">推荐结构</a></li>
                        <li><a class="btn btn-long8" href="/member/act_mer_log.php" id="m26">激活记录</a></li>
                    </ul>    
                </li> 
                <li>
                    <a class="btn btn-long" href="#" role="button"><span class="glyphicon glyphicon-usd llong0" aria-hidden="true"></span><span class="llong2">收支明细</span><span class="glyphicon glyphicon-menu-left llong1"></span></a>
                    <ul class="sub-menu">
                        <li><a class="btn btn-long8" href="/member/point1_log_in.php" id="m33">种子奖励记录</a></li>
                        <li><a class="btn btn-long8" href="/member/wizard.php" id="m34">丘比特奖励记录</a></li>
                        <li><a class="btn btn-long8" href="/member/flowerfairy.php" id="m35">花仙子奖励记录</a></li>
                         <li><a class="btn btn-long8" href="/member/fertilizelogs.php" id="m37">施肥记录</a></li>
                        <li><a class="btn btn-long8" href="/member/seedlogs.php" id="m38">播种记录</a></li>
                        <li><a class="btn btn-long8" href="/member/shuohuolog.php" id="m39">收获记录</a></li>
                    </ul>
                </li>    
                <li>
                    <a class="btn btn-long" href="#" role="button"><span class="glyphicon glyphicon-retweet llong0" aria-hidden="true"></span><span class="llong2">交易系统</span><span class="glyphicon glyphicon-menu-left llong1"></span></a>
                    <ul class="sub-menu">  
                        <li><a class="btn btn-long8" href="/member/point2_transfer.php" id="m46">KK转账</a></li>  
                         <li><a class="btn btn-long8" href="/member/point2_sell_list.php" id="m41">委托交易</a></li>
                        <li><a class="btn btn-long8" href="/member/point2_buy_log.php" id="m42">委托购买记录</a></li>
                        <li><a class="btn btn-long8" href="/member/point2_sell_log.php" id="m43">委托出售记录</a></li>
                        <li><a class="btn btn-long8" href="/member/point1_to_flower.php" id="m44">种子转KK</a></li>
                        <li><a class="btn btn-long8" href="/member/point1_flower_list.php" id="m45">种子转换记录</a></li>
						<li><a class="btn btn-long8" href="/member/UseBeeLogs.php" id="m49">采蜜记录</a>
                    </ul>
                </li>
                 <li>
                    <a class="btn btn-long" href="#" role="button"><span class="glyphicon glyphicon-shopping-cart llong0" aria-hidden="true"></span><span class="llong2">资料修改</span><span class="glyphicon glyphicon-menu-left llong1"></span></a>
                    <ul class="sub-menu">
                        <li><a class="btn btn-long8" href="/member/pi.php" id="m51"> 修改资料</a></li>
                        <li><a class="btn btn-long8" href="/member/pa.php" id="m52">密码保护</a></li>
                        <li><a class="btn btn-long8" href="/member/log_login.php" id="m53">登录日志</a></li>
                    </ul>
                </li>      
            </ul> 
        </div>
    </div>
	<script>
    //$(selector).toggle(speed,callback);
 $(function(){
	$(".remain").css('height',($(window).height()-70)+'px');
	leftmu();
	})
 function leftmu(){
	$(".left [class='sub-menu']").each(function(){	
		$(this).prev().click(function(e) {
			var zicd=$(this).next(".sub-menu");
			//$(this).next(".sub-menu").toggle(500);
			$(".sub-menu").not(zicd).prev().each(function(){
      			$(this).next(".sub-menu").hide(400);   
				$(this).find(".llong1").removeClass("glyphicon-menu-down");
				$(this).find(".llong1").addClass("glyphicon-menu-left")	;
				})
			if($(zicd).is(":hidden")){
				$(this).find(".llong1").removeClass("glyphicon-menu-left");
				$(this).find(".llong1").addClass("glyphicon-menu-down");
       			$(zicd).show(400);    
			}else{
      			$(zicd).hide(400);   
				$(this).find(".llong1").removeClass("glyphicon-menu-down");
				$(this).find(".llong1").addClass("glyphicon-menu-left");
			}	
        });	
		});
	
	}	
	
function mgo(x){
	var zcd=$("#m"+x.toString());
	var zcc=$(zcd).parent("li").parent(".sub-menu").prev();
	$(zcd).addClass("btn-long32");
	$(zcc).addClass("btn-long16");
	$(zcc).find(".llong1").removeClass("glyphicon-menu-left");
	$(zcc).find(".llong1").addClass("glyphicon-menu-down");
	$(zcd).parent("li").parent(".sub-menu").show();
	//alert($(zcd).parent("li").parent(".sub-menu").prev().html())
	}	
    </script>

</body>
</html>


<?php
$arr=range('a', 'z');
foreach($arr as $value){
	$$value=$value;
}
?>