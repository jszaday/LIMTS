<?php
	// Import the "Grab Bag"
	require("common.php");
	
	// Open an (OO) MySQL Connection
	$conn = new mysqli($GLOBALS["dbhost"], $GLOBALS["dbuser"], $GLOBALS["dbpass"], $GLOBALS["dbname"]);
	
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$result = $conn->query("SELECT *
			                FROM  `Building`;");
	$buildings = array();
	while ($row = $result->fetch_row()) {
		array_push($buildings, array("id" => $row[BUILDING_ID], "abbr" => $row[BUILDING_ABRV]));
	}
    $result->close();

	// Echo all of the classes as JSON
	echo json_encode($buildings);

	// Finally, close the connection
	$conn->close();
?>