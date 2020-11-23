// Get the current user
var current_user = cookie.get('user');

if(current_user != undefined){
   console.log("User is: ");
   console.log(current_user);

}

if (current_user == undefined) {
  console.log("Making a user");
  // If no user, make one
  current_user = prompt('Choose a username:');
  if (current_user == false) {
    alert('Error, try again!');
  } else {
    cookie.set('user', current_user);
  }
}

var socket = io();

// When message is recieved
socket.on('message', function (data) {
  $('.chat').append('<p><strong>' + String(data.user) + '</strong>: ' + String(data.message) + '</p>');
});
// When message is sent
$('form').submit(function (e) {
  // Prevent PHP! This caused problems.
  e.preventDefault();
  console.log("Sending chat message!");
   console.log("User is: ");
   console.log(String(current_user));
  // Extract and send
  var message = $(e.target).find('input').val();

  // Clear text input
  e.target.reset();
});



