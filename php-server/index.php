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

// Collect variables
$message = $_POST['message'];
$from = $_POST['from'];
$to = $_POST['to'];
$length = $_POST['length'];

$client = $database->getClient();

$database = $client->selectDB('polichat');
if(isset($_POST['from']) && isset($_POST['to']) && isset($_POST['message']) && isset($_POST['length']) && $_POST['message'] != "")
{
	$points = array(
		new InfluxDB\Point(
			'message', // name of the measurement
			$message, 
			['from' => $from, 'to' => $to, 'message' => $message], // optional tags
			['length' => strlen($message)], // optional additional fields
			floor(time()) // Time precision has to be set to seconds!
		)
	);
	$result = $database->writePoints($points, InfluxDB\Database::PRECISION_SECONDS);
}


if(isset($_POST['updateTime']))
{
$queryString = 'SELECT * FROM message WHERE TIME >  ' . strval($_POST['updateTime']);
	// Return all records after most recent update
	foreach ($database->query($queryString )->getPoints() as $row) {
	    echo json_encode($row);
	    echo '|';
	}

}

?>


