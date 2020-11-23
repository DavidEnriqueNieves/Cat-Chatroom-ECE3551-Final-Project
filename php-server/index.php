<?php
require __DIR__ . '/vendor/autoload.php';
// https://getcomposer.org/doc/01-basic-usage.md#autoloading
echo '<script src="public/chat.js"></script>';
if(isset($_COOKIE['user'])){
    $user = $_COOKIE['user'];
    echo '<script language="javascript"> alert("Cookie user is ' . $_COOKIE['user'] . ' "); </script>';
}
else
{
echo '<script language="javascript"> var user= prompt("Enter username"); document.cookie="user=" + user </script>';

}


$host = (string)getenv("INFLUX_HOST");
$port = intval(getenv("INFLUX_PORT"));
$user = (string)getenv("INFLUX_USER");
$pass = (string)getenv("INFLUX_PSSWD");
$client = new \crodas\InfluxPHP\Client(
    $host, // host
    $port,        // port
    $pass,      // user
    $pass       // password
);
//$db->query('INSERT INTO message,user="' + $_COOKIE['user'] + '" political-leaning=';


$db = $client->polichat;

foreach ($db->query('SELECT * FROM message;') as $row) {

    print($row->message);
}

// echo '<script language="javascript"> alert("message is' . $_POST['message'] . '"); </script>';

//echo '<script language="javascript"> alert("message is"',  $_POST['message'], '"); </script>';
//$result = $database->query('INSERT message,user="mongolian_basket_waver" political_leaning="democratic democratist",message="help me",length=7');
//echo $host;
//echo $port;

?>

<!DOCTYPE html>
<html>
  <head>
    <title>BotChat</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="public/style.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://unpkg.com/socket.io-client@2/dist/socket.io.slim.js"></script>
    <script src="https://unpkg.com/cookie_js@1.2.2/cookie.min.js"></script>  </head>
    <main>
      <table>
        <tr>
          <th><img src="public/cat.gif" alt="Keyboard Warrior"></th>
          <th>
            <section class="chat" id="chat">
            </section>

              <input id='chatInput' type="text" placeholder="Send a message!" name="message" />
              <input type="submit" onclick="sendMessage(document.getElementById('chatInput').value)">Send</button>
          </th>
        </tr>
      </table>
    </main>
  </body>
</html>



