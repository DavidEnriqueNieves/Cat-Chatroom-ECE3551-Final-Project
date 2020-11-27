// // Get the current user
// var current_user = cookie.get('user');
// 
// if(current_user != undefined){
//    console.log("User is: ");
//    console.log(current_user);
// 
// }
// 
// if (current_user == undefined) {
//   console.log("Making a user");
//   // If no user, make one
//   current_user = prompt('Choose a username:');
//   if (current_user == false) {
//     alert('Error, try again!');
//   } else {
//     cookie.set('user', current_user);
//   }
// }
// 
// var socket = io();
// 
// // When message is recieved
// socket.on('message', function (data) {
//   $('.chat').append('<p><strong>' + String(data.user) + '</strong>: ' + String(data.message) + '</p>');
// });
// When message is sent
// $('form').submit(function (e) {
//   // Prevent PHP! This caused problems.
//   e.preventDefault();
//   console.log("Sending chat message!");
//    console.log("User is: ");
//    console.log(String(current_user));
//   // Extract and send
// var message = $(e.target).find('input').val();
// const Influx = require('influx');
// const influx = new Influx.InfluxDB({
//   host: 'localhost',
//   database: 'polichat',
//   schema: [
//     {
//       measurement: 'message',
//       fields: { length: Influx.FieldType.INTEGER },
//       tags: ['user', 'political-leaning']
//     }
// ]
// 
// 
// });
// 
//   // Clear text input
//   e.target.reset();
// });
// 
// 
// 
// function Chat () {
//     this.update = updateChat;
//     this.send = sendChat;
//     this.getState = getStateOfChat;
// }
// 
// function getStateOfChat() {
// 	if(!instanse){
// 		instanse = true;
// 		$.ajax({
// 			type: "POST",
// 			url: "http://localhost:8080/index.php",
// 			data: {'function': 'getState', 'file': file},
// 			dataType: "json",	
// 			success: function(data) {state = data.state;instanse = false;}
// 		});
// 	}	
// }
// 
// //Updates the chat
// function updateChat() {
// 	if(!instanse){
// 		instanse = true;
// 		$.ajax({
// 			type: "POST",
// 			url: "http://localhost:8080/index.php",
// 			data: {'function': 'update','state': state,'file': file},
// 			dataType: "json",
// 			success: function(data) {
// 				if(data.text){
// 					for (i = 0; i < data.text.length; i++) {
// 						$('#chat-area').append($("
// 						"+ data.text[i] +"
// 
// 						"));
// 					}	
// 				}
// 				document.getElementById('chat-area').scrollTop = document.getElementById('chat-area').scrollHeight;
// 				instanse = false;
// 				state = data.state;
// 			}
// 		});
// 	}
// 	else {
// 		setTimeout(updateChat, 1500);
// 	}
// }
// 
// 

//send the message
function sendMessage(message) {
    console.log("Message is ");
    console.log(message);
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "http://localhost:8080/index.php", true);
    xhttp.setRequestHeader("Content-Type", "application/json");

    xhttp.onreadystatechange = function() {
	console.log(this.status);
        if (this.readyState == 4 && this.status == 200) {
	    console.log("Response is ");
	    console.log(this.responseText);
       }
    };

    xhttp.send(JSON.stringify({"measurement" : 'message', "fields" :  { "length": message.length}, "tags" : { "user" : 'david', "political-leaning" : 'deemocratic democratist' }  }));
}


// function sendMessage(message)
// {
// alert("Sending POST with JS!");
// 	$.ajax(
// 	{
// 		type: "POST", 
// 		url: "http://localhost:8080/index.php",
// 		data: {
// 			'function': 'send',
// 			'message': message
// 			},
// 		dataType: "json",
// 		success: function(data)
// 			{
// 			 	updateChat();
// 		 	}
// 	});
// 
// }
// 
// 
// 
// function getStateOfChat() {
// 	if(!instanse){
// 		instanse = true;
// 		$.ajax({
// 			type: "POST",
// 		        url: "http://localhost:8080/index.php",  
// 			data: {'function': 'getState', 'file': file},
// 			dataType: "json",	
// 			success: function(data) {state = data.state;instanse = false;}
// 		});
// 	}	
// }
// 
// function updateChat() {
// 	if(!instanse){
// 		instanse = true;
// 		$.ajax({
// 			type: "POST",
// 		        url: "http://localhost:8080/index.php",  
// 			data: {'function': 'update','state': state,'file': file},
// 			dataType: "json",
// 			success: function(data) {
// 				if(data.text){
// 					for (var i = 0; i < data.text.length; i++) {
// 						$('#chat-area').append($("
// 
// 						"+ data.text[i] +"
// 					}	
// 				}
// 				document.getElementById('chat-area').scrollTop = document.getElementById('chat-area').scrollHeight;
// 				instanse = false;
// 				state = data.state;
// 			}
// 		});
// 	}
// 	else {
// 		setTimeout(updateChat, 1500);
// 	}
// }
// 
// 
// function sendChat(message, nickname) { 
// 	updateChat();
// 	$.ajax({
// 		type: "POST",
// 		url: "http://localhost:8080/index.php",
//   		data: {'function': 'send','message': message,'nickname': nickname,'file': file},
// 		dataType: "json",
// 		success: function(data){
// 			updateChat();
// 		}
// 	});
// }
// 
// 
// 
//   var chat =  new Chat();
// 
