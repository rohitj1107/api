<?php
header("Content-Type: application/json");
header("Acess-Control-Allow-Origin: *");
header("Acess-Control-Allow-Methods: POST");
header("Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Acess-Control-Allow-Methods, Authorization");

$data = json_decode(file_get_contents("php://input"), true);

$book_author = $data["author"];
$book_title = $data["title"];
$book_isbn = $data["isbn"];
$book_releasedate = $data["releasedate"];

require_once "dbconfig.php";
$num = 0;
$error = null;

if(empty($book_author)){
	$error .= "Author is required ";
} else {
	$num += 1;
}

if(empty($book_title)){
	$error .= "title is required ";
} else {
	$num += 1;
}

if(empty($book_isbn)){
	$error .= "isbn is required ";
} else {
	$num += 1;
}

if($num == 3){
	$query = "INSERT INTO tbl_book(book_author, book_title, book_isbn, book_releasedate) VALUES ('".$book_author."', '".$book_title."', '".$book_isbn."', '".$book_releasedate."')";
	if(mysqli_query($conn, $query) or die("Insert Query Failed")){
		http_response_code(201);
		echo json_encode(array("message" => "Books Inserted Successfully", "status" => true));	
	}
} else {
	http_response_code(405);
	echo json_encode(array("message" => "$error", "status" => false));	
}
?>