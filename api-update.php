<?php

header("Content-Type: application/json");
header("Acess-Control-Allow-Origin: *");
header("Acess-Control-Allow-Methods: PUT");
header("Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Acess-Control-Allow-Methods, Authorization");

$data = json_decode(file_get_contents("php://input"), true);

$pid = $data['id'];
$book_author = $data["author"];
$book_title = $data["title"];
$book_isbn = $data["isbn"];
$book_releasedate = $data["releasedate"];

require_once "dbconfig.php";

$num = 0;
$error = null;

if(empty($pid)){
	$error .= "Id is required ";
} else {
	$num += 1;
}

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

if($num == 4){
      $query = "UPDATE tbl_book SET book_author= '".$book_author."' , 
                                    book_title= '".$book_title."' ,
                                    book_isbn= '".$book_isbn."' ,
                                    book_releasedate= '".$book_releasedate."'
                              WHERE book_id='".$pid."' ";

      if(mysqli_query($conn, $query) or die("Update Query Failed")){	
            http_response_code(200);
            echo json_encode(array("message" => "Book Update Successfully", "status" => true));	
      }
} else {	
      http_response_code(205);
	echo json_encode(array("message" => "$error", "status" => false));	
}

?>