<?php
	// Import the "Grab Bag"
    require("../common.php");

	// Open an (OO) MySQL Connection
	$conn = new mysqli($GLOBALS["dbhost"], $GLOBALS["dbuser"], $GLOBALS["dbpass"], $GLOBALS["dbname"]);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	// Get all of the "Parameters"
	$building = $_GET["building"];
	$number = $_GET["number"];
	$capacity = $_GET["capacity"];
	$handicap_accessible = json_decode($_GET["handicapAccessible"]);

	// Check to make sure the required information is present
	if (!($building && $number && $capacity)) {
		die("{\"response\": \"You must specify the building, number and capacity!\"}");
	}

	// Check to see if the Room already exists in the database
	$result = $conn->query("SELECT *
							FROM `Room`
							WHERE `Building`='$building' AND `Number`='$number'");
	if ($result->num_rows > 0) {
		die("{\"response\": \"Room already exists in database\"}");
	}
	$result->close();

	// Everything seems ok at this point, so just add the room
	$result = $conn->query("INSERT INTO `Room`(`Building`, `Number`, `Capacity`, `HandicapAccessible`)
							VALUES('$building', '$number', '$capacity', '$handicap_accessible')");
	if (!$result) {
		die("{\"response\": \"Could not insert Room!\"}");
	}

	// Give a success response
	echo "{\"response\": \"Success\"}";

	// Finally, close the connection
	$conn->close();
?>
