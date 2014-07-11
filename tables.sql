CREATE TABLE `products` (
	`PRO_ID` int PRIMARY KEY AUTO_INCREMENT,
	`PRO_NAME` varchar(300),
	`PRO_DESC` varchar(600),
	`PRO_PRICE` decimal(10,2)
);

CREATE TABLE `comments` (
	`COM_ID` int PRIMARY KEY AUTO_INCREMENT, 
	`COM_NAME` varchar(200),
	`COM_CONTENT` text,
	`COM_ITEM` int
);