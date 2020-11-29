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

$database = $client->selectDB('login');

// Check for existing user (no password should be set yet!)
if(isset($_POST['new_username']))
{
	// Check username
	$queryString = 'SELECT "value" FROM "username" WHERE "name"=\'' . (string)($_POST['new_username']) . '\'';
foreach ($database->query($queryString )->getPoints() as $row) {
    echo json_encode($row);
    echo '|';
}
if(isset($_POST['register']) && isset($_POST['new_password']))
	{
	
	$username = (string)($_POST['new_username']);
	$password = (string)($_POST['new_password']);
	$time = (string)(floor(time()));
		$points = array(
			new InfluxDB\Point(
				'username', // name of the measurement
				$username,
				['name' => $username, 'password' => $password], // optional tags
				['time' => $time],
				floor(time()) // Time precision has to be set to seconds!
			)
		);
		$result = $database->writePoints($points, InfluxDB\Database::PRECISION_SECONDS);
		echo "success";
	}
}


// Login to existing user (check password on file)
if(isset($_POST['verify-username']) && isset($_POST['verify-password']))
{
	$username = (string)($_POST['verify-username']);
	$password = (string)($_POST['verify-password']);
	// Check password
	$queryString = 'SELECT * FROM "username" WHERE "name"=\'' .  $username . '\'';
	foreach ($database->query($queryString )->getPoints() as $row) {
	    $jsonThing = (object)$row;
	    $actual_password  = (string)($jsonThing->password); 
	    if($actual_password == $password)
		{
			echo "success";		
		}
	}

}

// Register new account


?>


