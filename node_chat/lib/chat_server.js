//这是一个HTTP服务端，可与server.js共享一个ip
//下面几个声明，可以让我们使用SOCKET.IO
//监听server.js,而server监听3000port
//socket.io由两部分组成
//一个是服务端用于集成或挂载到node js http服务器
//一个加载到浏览器的客户端：socket.io-client
var socketio = require('socket.io');
var io;
var guestNumber = 1;
var nickNames = {};
var namesUsed = [];
var currentRoom = {};
// console.log("im am here!");

//设置新用户的昵称
function assignGuestName(socket,guestNumber,nikename,namesUsed){
	var name = 'Guest'+guestNumber;
	nickNames[socket.id] = name;
	socket.emit('nameResult',{
		success:true,
		name:name
	});
	namesUsed.push(name);
	return guestNumber+1;
}
//进入聊天室
function joinRoom(socket,room){
	socket.join(room);
	console.log("you have joined room");
	currentRoom[socket.id]=room;
	socket.emit('joinResult',{room:room});
	socket.broadcast.to(room).emit('message',{
		text:nickNames[socket.id]+'hasn joined'+room+'.'
	});
	// var usersInRoom=io.sockets.clients(room);
	// 这里需要替换版本，否则无法成功
	var usersInRoom=io.of('/').in(room).clients;
	// io.of('/').in(room).clients(function(error,clients){
 //        var numClients=clients.length;
 //    });
	if(usersInRoom.length>1){
		var usersInRoomSummary='User currently in'+room+':';
		for (var index in usersInRoom){
			var userSocketId=usersInRoom[index].id;
			if(userSocketId!=socket.id){
				if(index>0){
					usersInRoomSummary+=', ';
				}
				usersInRoomSummary+=nickNames[userSocketId];
			}
		}
		usersInRoomSummary+='.';
		socket.emit('message',{text:usersInRoomSummary});
	}
}
//处理昵称变更请求
function handleNameChangeAttempts(socket,nickNames,namesUsed){
	socket.on('nameAttempt',function(name){
		if(name.indexOf('Guest')==0){
			socket.emit('nameResult',{
				success:true,
				message:'Names cannot begin with "Guest".'
			});
		}else {
			if(namesUsed.indexOf(name)==-1){
				var previouseName = nickNames[socket.id];
				var previouseNameIndex = namesUsed.indexOf(previouseName);
				namesUsed.push(name);
				nickNames[socket.id]=name;
				delete namesUsed[previouseNameIndex];
				socket.emit('nameResult',{
					success:true,
					name:name
				});
				socket.broadcast.to(currentRoom[socket.id]).emit('message',{
					text:previouseName+'is now know as'+name+'.'
				})
			}else {
				socket.emit('nameResult',{
					success:false,
					message:'that name is already in use.'
				});
			}
		}
	});
}
//发送聊天信息
function handleMessageBroadcasting(socket){
	socket.on('message',function(message){
		socket.broadcast.to(message.ronm).emit('message',{
			text:nickNames[socket.id]+':'+message.text
		});
	});
}
//创建房间，让新用户加入已有的房间
function handleRoomJoining(socket){
	socket.on('join',function(room){
		socket.leave(currentRoom[socket.id]);
		joinRoom(socket,room.newRoom);
	});
}
//用户断开连接
function handleClientDisconnection(socket){
	socket.on('disconnect',function(){
		var nameIndex = namesUsed.indexOf(nickNames[socket.id]);
		delete namesUsed[nameIndex];
		delete nickNames[socket.id];
	});
}


exports.listen = function(server){
	io=socketio.listen(server);
	io.set('.log level',1);
	io.sockets.on('connection',function(socket){
		console.log("server connect sucess!");
		guestNumber = assignGuestName(socket,guestNumber,nickNames,namesUsed);
		joinRoom(socket,'Lobby');
		handleMessageBroadcasting(socket,nickNames);
		handleNameChangeAttempts(socket,nickNames,namesUsed);
		handleRoomJoining(socket);
		socket.on('rooms',function(){
			// socket.emit('rooms',io.sockets.manager.rooms);
			socket.emit('rooms', io.of('/').adapter.rooms);
		});
		handleClientDisconnection(socket,nickNames,namesUsed);
	});
};








