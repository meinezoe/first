<?php
require_once 'header.php';
?>
<link rel="stylesheet" href="../css/calendar-blue.css" type="text/css">
<script type="text/javascript" charset="utf-8" src="../js/calendar.js"></script>
<style type="text/css">
	label{
		font-weight: 900;
	}
</style>
<div style="margin-left: 40px;margin-bottom: 10px;">
    <span style="display: block; color: blue; font-weight: 900; font-size: 20px;">请输入查询开始时间和结束时间(查询时间包括开始时间和结束时间这两天)</span>
    <br>
	<label>查询时间范围：</label><input type="text" name="start_time" id="posttime1" class="input-text posttime" readonly="readonly"> -  
	<input type="text" name="end_time" id="posttime2" class="input-text posttime" readonly="readonly">
	<br><br>
	<label>查询前N名：</label><input type="text" name="number" placeholder="输入整数 代表前N名 默认为10" style="width: 200px;" maxlength="3"><br><br>
	<button id="submit" style="background-color: #0f88eb;border-radius: 3px;color: white;width: 100px;height: 30px;">点击查询</button>
</div>
<hr style="color:gray;width: 95%;">
<div id="display" style="font-size: 16px;font-weight: 900;">
	
</div>
<script type="text/javascript">
    date = new Date();
    Calendar.setup({
        inputField     :    "posttime1",
        ifFormat       :    "%Y-%m-%d",
        showsTime      :    true,
        timeFormat     :    "24"
    });
    Calendar.setup({
        inputField     :    "posttime2",
        ifFormat       :    "%Y-%m-%d",
        showsTime      :    true,
        timeFormat     :    "24"
    });

    $("#submit").click(function(){
    	var start_time = $("[name=start_time]").val();
    	var end_time  = $("[name=end_time]").val();
    	var N = parseInt($("[name=number]").val());
    	N = isNaN(N)? 10 : N;
    	$.ajax({
    		type:"post",
    		url:"/admin/ajax_getTopN.php",
    		data:{start_time:start_time,end_time:end_time,n:N,ajax:1},
    		dataType:"json",
    		success:function(res){
    			console.log(res);
    			var strHtml = "<ol>";
    			for(var i=0; i<res.length; i++){
    				strHtml = strHtml +  "<li>手机号：" + res[i].phone + "|----推荐人数:" + res[i].recommend_nums + "</li>";
    			}
    			strHtml = strHtml + "</ol>"
    			if(strHtml != ""){
    				$("#display").html(strHtml);
    			}
    		},
    		error:function(res){
    			console.log(res);
    			alert("查询失败，请重试!");
    		}
    	});
    });
</script>
<?php
footer();
?>