//this is client
//向服务端发送连接请求，并在连接成功后发送hello
function divEscapedContentElement(message){
	return $('<div></div>').text(message);
}function divSystemContentElement(message){
	return $('<div></div>').html('<i>'+message+'</i>');
}
//以上是创建授信内容，防止一些脚本语言混入

//处理用户输入的函数
function processUserInput(chatApp,socket){
	var message = $('#send-message').val();
	var systemMessage;
	if(message.chatAt(0)== '/'){
		systemMessage = chatAPP.processCommand(message);
		if(systemMessage){
			$('#messages').append(divSystemContentElement(systemMessage));
		}
	}else {
		chatApp.sendMessage($('#room').text(),message);
		$('#messages').append(divEscapedContentElement(message));
		$('#messages').scrollTop($('#messages').prop('scrollHeight'));
	}
	$('#send-message').val();
}
//对客户端的Socket.io事件处理进行初始化
//并向服务器端发起连接请求。
//connect()可以接受一个url参数，可以
//是http完整地址，也可以是相对路径，如果
//省略则默认连接当前路径。
//当客户端成功加载socket.io客户端文件后
//会获取一个全局对象Io，我们将通过io.connect函数
//来向服务器端发送连接请求。
var socket = io.connect();
console.log("this is io_connect of chat_ui.js");

$(document).ready(function(){
	var chatApp = new Chat(socket);
	//显示更名尝试的结果
	socket.on('connect',function(){
		socket.send("hello,connect sucess!");
	});
	socket.on('nameResult',function(result){
		var message;
		if(result.success){
			message = 'you are now know as'+result.name+'.';
		}else {
			message = result.message;
		}
		$('#messages').append(divSystemContentElement(message));
	});
	socket.on('joinResult',function(result){
		$('#room').text(result.room);
		$('#messages').append(divSystemContentElement('Room changed.'));
	});
	socket.on('message',function(message){
		var newElement = $('<div></div>').text(message.text);
		$('#room').text(result.room);
		$('#messages').append(newElement);
	});
	socket.on('rooms',function(rooms){
		$('#room-list').empty();
		for(var room in rooms){
			room = room.substring(1,room.length);
			if(room!=''){
				$('#room-list').append(divEscapedContentElement(room));
			}
		}

		$('#room-list div').click(function(){
			chatApp.processCommand('/join'+$(this).text());
			$('#send-message').focus();
		});
	});

	setInterval(function(){
		socket.emit('rooms');
	},1000);
	$('#send-message').focus();
	$('#send-form').submit(function(){
		processUserInput(chatApp,socket);
		return false;
	});
});





