<?php header('Access-Control-Allow-Origin: http://localhost:3000'); ?>

<?php
require __DIR__ . '/vendor/autoload.php';
// https://getcomposer.org/doc/01-basic-usage.md#autoloading

$host = (string)getenv("INFLUX_HOST");
$port = (string)getenv("INFLUX_PORT");
$user = (string)getenv("INFLUX_USER");
$pass = (string)getenv("INFLUX_PSSWD");
$dbname = 'polichat';
$database = InfluxDB\Client::fromDSN(sprintf('influxdb://%s:%s@%s:%s/%s', $user, $pass, $host, $port, $dbname));
//$client = new \crodas\InfluxPHP\Client(
//    $host, // host
//    $port,        // port
//    $pass,      // user
//    $pass       // password
//);
//
$message = $_POST['message'];
$from = $_POST['from'];
$to = $_POST['to'];
$length = $_POST['length'];

$client = $database->getClient();
//$result = $db->query('INSERT message,user="mongolian_basket_waver" political_leaning="democratic democratist",message="help me",length=7');
//$db->insert("polichat",[['tags' => ['type' => 'one'], 'fields' => ['value' => 10]]]);

//$db->insert("foobar", array(
//            array('name' => 'lala',   'fields' => array('type' => 'foobar', 'karma' => 25)),
 //           array(   'fields' => array('type' => 'foobar', 'karma' => 45)),
  //          ));
//$db->insert("message",['fields' => ['length' => $length], 'tags' => [ 'from' => $from, 'to' => $to, 'message' => $message]]);

//$db->query('INSERT message,user="' + $_COOKIE['user']  + +'",message="' + $_POST['message'] +'" from="' + $_POST['from']+ '",length=' +$_POST['length'] + ';');


$database = $client->selectDB('polichat');
if(True)
{
	$points = array(
		new InfluxDB\Point(
			'message', // name of the measurement
			$message, 
			['from' => $from, 'to' => $to, 'message' => $message], // optional tags
			['length' => strlen($message)], // optional additional fields
			time() // Time precision has to be set to seconds!
		)
	);
	$result = $database->writePoints($points, InfluxDB\Database::PRECISION_SECONDS);
	
	foreach ($database->query('SELECT * FROM message;')->getPoints() as $row) {
	    echo json_encode($row);
	    echo '|';
	}
}



// echo '<script language="javascript"> alert("message is' . $_POST['message'] . '"); </script>';

//echo '<script language="javascript"> alert("message is"',  $_POST['message'], '"); </script>';
//$result = $database->query('INSERT message,user="mongolian_basket_waver" political_leaning="democratic democratist",message="help me",length=7');
//echo $host;
//echo $port;

?>


