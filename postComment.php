<?php
define('REQUIRE_NAME',false); //if true script will fail an empty name, otherwise it will use anonymous 
require('connect.php');
//get all the variables
$comment = $mysql->real_escape_string($_POST['comment']);
$name = $mysql->real_escape_string($_POST['name']);
$item = $mysql->real_escape_string($_POST['item']);
//check for empty strings 
if(trim ($comment) == "") {
	die(json_encode(array("status"=>"ERROR", "message"=>"You must enter a comment")));
}

//is the item we're commenting on in the database
$result = $mysql->query("SELECT * FROM `products` WHERE `PRO_ID` = '$item'");
if($result->num_rows < 1) {
	die(json_encode(array("status"=>"ERROR", "message"=>"The item you are trying to comment on doesn't exist.")));
}
//if the name is empty, and name is required fail
if(trim($name) == "" && REQUIRE_NAME) {
	die(json_encode(array("status"=>"ERROR", "message"=>"You must enter a name")));
}
//if name is empty, and not required then make it Anonymous
if(trim($name) == "" && !REQUIRE_NAME){
	$name = "Anonymous";
}
$mysql->query("INSERT INTO `comments` (`COM_NAME`,`COM_CONTENT`,`COM_ITEM`) VALUES('$name','$comment','$item')");
die(json_encode(array("status"=>"SUCCESS", "message"=>"Comment has been added")));