//初始化可传入一个socket.io的参数socket
var Chat=function(socket){
	this.socket=socket;
};
//发送聊天信息的函数
Chat.prototype.sendMessage = function(room,text) {
	var message = {
		room:room,
		text:text
	};
	this.socket.emit('message',message);
};

Chat.prototype.changeRoom = function(room){
	this.socket.emit('join',{
		newRoom:room
	});
};
//处理聊天命令，能识别JOIN创建房间 和 NICK修改昵称
Chat.prototype.processCommand = function(command){
	var words = command.split(' ');
	var command = words[0].substring(1,words[0].length).toLowerCase();
	var message = false;
	switch(command){
		case 'join':
			words.shift();
			var room = words.join(' ');
			this.changeRoom(room);
			break;
		case 'nick':
			words.shift();
			var name = words.join(' ');
			this.socket.emit('nameAttempt',name);
			break;
		default:
			message = 'Unrecognized command';
			break;
	}
	return message;
};



