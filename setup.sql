	DROP DATABASE IF exists eventManager;

	CREATE DATABASE eventManager; 

	USE eventManager; 

	CREATE TABLE `User`(
		`ID` varchar (45) NOT NULL, 
		`firstname` varchar(45) NOT NULL, 
		`lastname` varchar(45) NOT NULL, 
		`password` varchar(32) NOT NULL, 
		`email` varchar (45) NOT NULL, 
	    `phone` varchar (45) NOT NULL, 
		PRIMARY KEY(ID)
	);

	CREATE TABLE `SuperAdmin`(
		`userID` varchar (45) NOT NULL REFERENCES `User`(`ID`),
		PRIMARY KEY(userID)
	);

	CREATE TABLE `Admin`(
		`userID` varchar (45) NOT NULL REFERENCES `User`(`ID`),
		`University` varchar(80) NOT NULL, 
		PRIMARY KEY(userID)
	);

	CREATE TABLE `Student`(
		`userID` varchar (45) NOT NULL REFERENCES `User`(`ID`),
		`University` varchar(80) NOT NULL,  
		PRIMARY KEY(userID)
	);

	CREATE TABLE `Event`(
		`Name` varchar(80) NOT NULL, 
		`Description` varchar(500), 
		`DateTime` datetime NOT NULL, 
		`category` varchar(20) NOT NULL DEFAULT 'public', 
		`contact_phone` varchar(20) NOT NULL,
		`contact_email` varchar(45) NOT NULL,  
		`approved_by_admin` tinyInt(1) NOT NUll DEFAULT '0', 
		`approved_by_superAdmin` tinyInt(1) NOT NULL DEFAULT '0', 
		`eventID` int (11) NOT NULL AUTO_INCREMENT, 
		`creatorID` varchar(40) NOT NULL, 
		`rso_name` varchar(80),
		`university` varchar(80) NOT NULL, 

		PRIMARY KEY(eventID, Name)	
	);

	CREATE TABLE `COMMENTS`(
		`commentID` int(11) NOT NULL AUTO_INCREMENT,
		`eName` varchar(40) NOT NULL, 
		`userName` varchar(40) NOT NULL REFERENCES `Student`(`userID`),
		`text` varchar(500) NOT NULL, 
		`timeposted` timeStamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

		PRIMARY KEY(commentID)
	);

	CREATE TABLE `Rso`(
		`Name` varchar(80) NOT NULL, 
		`Description` varchar(500) NOT NULL,
		`University_ID` varchar(50) NOT NULL, 
		`AdminID` varchar(50) NOT NULL, 

		PRIMARY KEY(Name) 
	);

	CREATE TABLE `University`(

		`Name` varchar(80) NOT NULL, 
		`Description` varchar(500) NOT NULL, 
		`numStudents` int(11) NOT NULL, 

		PRIMARY KEY(Name)
	);

	CREATE TABLE `Location`(
		`Name` varchar(100) NOT NULL, 
		`address` varchar(80) NOT NULL, 
		`lat` float(10,6) NOT NULL, 
		`lng` float(10,6) NOT NULL, 
		`uni` varchar (80) NOT NULL, 
		PRIMARY KEY(Name)
	);

	CREATE TABLE `RSO_Students`(
		`Student_Email` varchar(40) NOT NULL, 
		`RSO_NAME` varchar(40) NOT NULL, 
		`ID` int(11) NOT NULL AUTO_INCREMENT, 

		PRIMARY KEY(ID)
	);

	CREATE TABLE `event_ratings`(
		`id` int (11) NOT NULL AUTO_INCREMENT, 
		`rating` int(10) NOT NULL, 
		`user_id` varchar(40) NOT NULL, 
		`eName` varchar(40) NOT NULL, 

		PRIMARY KEY(id)
	);

	INSERT INTO `University` (name, Description, numStudents) VALUES ('UCF', 'UCF', 6500); 
	INSERT INTO `User` (ID, firstname, lastname, password, email, phone) VALUES ('1', 'DJ', 'Grayson', 'root', 'dtest@knights.ucf.edu', '5555555555'); 
	INSERT INTO `SuperAdmin` (userID) VALUES ('1'); 
	INSERT INTO `USER` (ID, firstname, lastname, password, email, phone) VALUES ('2', 'john', 'Grayson', 'root', 'jtest@knights.ucf.edu', '5555555555');
	INSERT INTO `Student` (userID, University) VALUES ('2', 'UCF'); 

	INSERT INTO `USER` (ID, firstname, lastname, password, email, phone) VALUES ('3', 'james', 'Grayson', 'root', 'atest@knights.ucf.edu', '5555555555');
	INSERT INTO `Student` (userID, University) VALUES ('3', 'UCF'); 
	INSERT INTO `USER` (ID, firstname, lastname, password, email, phone) VALUES ('4', 'jim', 'Grayson', 'root', 'btest@knights.ucf.edu', '5555555555');
	INSERT INTO `Student` (userID, University) VALUES ('4', 'UCF'); 
	INSERT INTO `USER` (ID, firstname, lastname, password, email, phone) VALUES ('5', 'joe', 'Grayson', 'root', 'ctest@knights.ucf.edu', '5555555555');
	INSERT INTO `Student` (userID, University) VALUES ('5', 'UCF'); 
	INSERT INTO `USER` (ID, firstname, lastname, password, email, phone) VALUES ('6', 'jam', 'Grayson', 'root', 'ftest@knights.ucf.edu', '5555555555');
	INSERT INTO `Student` (userID, University) VALUES ('6', 'UCF'); 
	INSERT INTO `USER` (ID, firstname, lastname, password, email, phone) VALUES ('7', 'jane', 'Grayson', 'root', 'etest@knights.ucf.edu', '5555555555');
	INSERT INTO `Student` (userID, University) VALUES ('7', 'UCF'); 