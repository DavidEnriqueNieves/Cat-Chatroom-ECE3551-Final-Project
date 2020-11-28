// Get the current user
var current_user = cookie.get('user');

if(current_user != undefined){
   console.log("User is: ");
   console.log(current_user);

}

if (current_user == undefined) {
  console.log("Making a user");

  // NEW LOGIN SYSTEM
  var webaddress = 'http://localhost:8080/';
  var new_username = prompt('Username:');
  if (new_username == false) {
    alert('Error, try again!');
  } else {
    // If username exists in database
    $.post(webaddress,{'username' : new_username} , function(data) {                    // First DB call
      // Check if data is empty
      if(!data.replace(/\s/g, '')) {
        // No such user exists, make new account
        var new_password = prompt('Make a new account, type a password:');
        if (new_password == false) {
          alert('Password can\'t be empty!');
        } else {
          // push to database                                                              2nd DB call
          $.post(webaddress,
            {
              username: new_username,
              password: new_password,
              register: "yes"
            },
            function(data, status) {
              console.log(status);
              if(status != "success") {
                alert("Registration failed.");
              } else {
                console.log("successfully registered!");
              }
            });
            cookie.set('user', current_user);
        }

      } else {
        // Log in with password
        if (new_password == false) {
          alert('Password can\'t be empty!');
        } else {
          // If password matches records                                                 3rd DB call
          $.post(webaddress,
            {
              'username' : new_username,
              'password' : new_password
            }, 
            function(data, status) {
              // I don't know how to compare these values
              if (new_password == data) {
                // Set cookie with username, login successful!
                cookie.set('user', new_username);
              }
            });
          }
        }
      }
    }
  }
  // // If no user, make one | PRE-LOGIN SYSTEM
  // current_user = prompt('Choose a username:');
  // if (current_user == false) {
  //   alert('Error, try again!');
  // } else {
  //   cookie.set('user', current_user);
  // }
}


// var socket = io();

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
// 
//   // Clear text input
// });



