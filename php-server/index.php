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


if(isset($_POST['updateTime']) && isset($_POST['to']))
{
$queryString = 'SELECT * FROM message WHERE  "to"=\'' . $to  .  '\' AND time  >  ' . strval($_POST['updateTime']);

//echo  $queryString;

	// Return all records after most recent update
	foreach ($database->query($queryString )->getPoints() as $row) {
	    echo json_encode($row);
	    echo '|';
	}

}

$username = $_POST['new_username'];
$password = $_POST['new_password'];
$database = $client->selectDB('login');

// Check for existing user (no password should be set yet!)
if(isset($_POST['new_username']) && !isset($_POST['new_password']))
{
	// Check username
	$queryString = 'SELECT * FROM username WHERE'
}

// Login to existing user (check password on file)
if(isset($_POST['new_username']) && isset($_POST['new_password'] && !isset($_POST['register']))
{
	// Check password
	$queryString = 'SELECT * FROM username WHERE'
}

// Register new account
if(isset($_POST['new_username']) && isset($_POST['new_password']) && isset($_POST['register']))
{
	$points = array(
		new InfluxDB\Point(
			'username', // name of the measurement
			$username, 
			['username' => $username, 'password' => $password], // optional tags
			floor(time()) // Is this necessary?
		)
	);
	$result = $database->writePoints($points, InfluxDB\Database::PRECISION_SECONDS);
}
?>


