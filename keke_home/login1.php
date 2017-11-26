<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title>Bootstrap 实例 - 堆叠的水平</title>
    <link href="mod/mlogin.css" rel="stylesheet" type="text/css">
       <link rel="shortcut icon" href="http://bo.pergame.vip/images/logo_icon.ico?id=2" type="image/x-icon">
    <script type="text/javascript" src="mod/jquery-1.8.2.min.js"></script>

</head>
<body>
<input readonly="true" style="background: url(/images/login/l_l_t.png) no-repeat; width: 700px; height: 100px; font-size: 30px; color: #ffffff; padding-left: 120px; padding-top: 5px;" value="可可家园，一款惊奇的游戏"/>

<div class="form-div" style="background: url(/images/login/l_login_b.png) no-repeat; width: 600px; height: 430px; margin-top: 50px; margin-left: 350px; position: relative;">
	<input type="text" id="username" value="123" class="btn-text text" placeholder="用户名" onclick="javascript:this.value='';" style="border-width:0px;margin-top: 140px">
	<input type="password" id="pwd" class="btn-text text" placeholder="密码" onclick="javascript:this.value='';" style="margin-top:25px;">
		<div style="margin-top: 25px; width: 320px; height: 40px; margin-left: 60px;">
			<input type="text" id="x3" class="text v-b-s" placeholder="验证码" style="height:40px;width:180px;">
			<img id="img" onclick="this.src=this.src+'?'+Math.random();" src="../include/getCode.php" style="position: absolute; width: 140px; height: 50px; padding-left: 35px; padding-top: 0px">
		</div>
		<div style=" margin-top: 40px;margin-left:60px;text-align: center;">
		<input type="submit" value="登录" id="btnSave" class="btn-login" style="height:65px;width:214px;">
		<input type="checkbox" style="display: none;" id="remember" value="1" checked="CHECKED">
		<a href="/member/getpwd.php" style="margin-left:10px;text-decoration: none;color:#000; font-size:14px;">忘记密码</a>
		</div>
</div>

<!-- <div class="backstretch" style="left: 0px; top: 0px; overflow: hidden; margin: 0px; padding: 0px; height: 655px; width: 684px; z-index: -999999; position: fixed;">
	<img src="/ui/images/dl.jpg" style="position: absolute; margin: 0px; padding: 0px; border: none; width: 1165.01px; height: 655px; max-width: none; z-index: -999999; left: -240.507px; top: 0px;">
</div> -->
  <script src="/ui/js/jquery.min.js"></script>
    <script src="/ui/js/bootstrap.min.js"></script>
    <script src="/ui/js/jquery.backstretch.min.js"></script>
    <script src="/ui/layer/layer.js"></script>
    <script src="/ui/js/long.js"></script>
<script>
    	$(".btn-login").click(function () {
			denglu_go();
			return false;
		});	
		function denglu_go(){
			
			var username=$("#username").val();
			var pwd=$("#pwd").val();
			var x3=$("#x3").val();
			var remember=$("#remember").prop('checked');
			if(username==""){
				tishi4('请输入您的玩家编号','#username')
				return false;
				}
			//if(!checkMobile(username)){
			//	tishi4('玩家编号应该是手机号码形式的11位数字','#username')
			//	return false;
			//	}
			
			if(pwd==""){
				tishi4('请输入您的密码','#pwd')
				return false;
				}
			if(x3==""){
				tishi4('请输入验证码','#x3')
				return false;
				}
				
			var url="/member/bin.php?act=login&username="+encodeURI(username)+"&pwd="+encodeURI(pwd)+"&verify="+encodeURI(x3)+"&remember="+encodeURI(remember.toString());
			tishi2();
			$.ajax({ type : "get", async:true,  url : url, dataType : "json",
				success: function(json){
					tishi2close();
					if(json.state == true){
						//layer.alert(json.msg,function(){
							//跳转
							window.location.href = '/member/';
						//});
						
					} else {
						layer.alert(json.msg);
					}
				},
				error:function(json){
					tishi2close();
					layer.alert('网络错误，请重新提交');
				}
			});
		}
		
		 $.backstretch(["/ui/images/dl.jpg"], {
		          fade: 100,
		          duration: 100
		      });
    </script>
</body>
</html>








