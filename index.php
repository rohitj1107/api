<?php

header("Content-Type: application/json");
header("Acess-Control-Allow-Origin: *");

require_once "dbconfig.php";

$query = "SELECT * FROM tbl_book";

$result = mysqli_query($conn, $query) or die("Select Query Failed.");

$count = mysqli_num_rows($result);

if($count > 0)
{	
	$row = mysqli_fetch_all($result);
	http_response_code(200);
	echo json_encode($row);
}
else
{	
	http_response_code(404);
	echo json_encode(array("message" => "No Books Found.", "status" => false));
}

?>