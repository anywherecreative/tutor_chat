<?php
require('connect.php');
$result = $mysql->query("SELECT `PRO_ID` as 'id', `PRO_NAME` as 'name', `PRO_DESC` AS 'description', `PRO_PRICE` as 'price' FROM `products`");
/**
	Check if there were any results in the database
	NOTE: we always put the shortest block of code we can in the if, therefore the if is structured to check for an error
	this isn't necessarily mandatory but lends to code readability.
**/
if($result->num_rows < 1) {
	//output a friendly error message if not
	echo json_encode(array('status'=>'ERROR', 'message'=>'No products found'));
	exit; //instead of a large else statement we can use exit to terminate execution at this point
}
$products = array(); //initialize products array
while($row = $result->fetch_assoc()) {
	//for each row returned from the database assign it to the next entry in the product array
	//this gives us a numeric list of products. 
	$products[] = $row;
}
echo json_encode(array('status'=>'SUCCESS', 'products'=>$products)); //return the success message with the list of products
?>