<?php

header("Content-Type: application/json");
header("Acess-Control-Allow-Origin: *");
header("Acess-Control-Allow-Methods: DELETE");
header("Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Acess-Control-Allow-Methods, Authorization");

$data = json_decode(file_get_contents("php://input"), true);

$pid = $data["id"];
$num = 0;
$error = null;

if(empty($pid)){
	$error .= "Id is required ";
} else {
	$num = 1;
}

require_once "dbconfig.php";
if($num == 1){
	$query = "DELETE FROM tbl_book WHERE book_id='".$pid."' ";

	if(mysqli_query($conn, $query) or die("Delete Query Failed"))
	{	
		http_response_code(204);
		echo json_encode(array("message" => "Book Delete Successfully", "status" => true));	
	}
} else {
	http_response_code(405);
	echo json_encode(array("message" => "$error", "status" => false));	
}

?>