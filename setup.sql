CREATE TABLE `User`(
	`ID` int(11) NOT NULL, 
	`firstname` varchar(45) NOT NULL, 
	`lastname` varchar(45) NOT NULL, 
	`password` varchar(32) NOT NULL, 
	`email` varchar (45) NOT NULL, 
	PRIMARY KEY('ID')
)

CREATE TABLE `SuperAdmin`(
	`userID` NOT NULL REFERENCES `User`(`ID`),
	PRIMARY KEY('userID')
)

CREATE TABLE `Admin`(
	`userID` NOT NULL REFERENCES `User`(`ID`),
	PRIMARY KEY('userID')
)

CREATE TABLE `Student`(
	`userID` NOT NULL REFERENCES `User`(`ID`),
	PRIMARY KEY('userID')
)

CREATE TABLE `Event`(
	`Name` varchar(80) NOT NULL, 
	`Description` varchar(500), 
	`DateTime` datetime NOT NULL, 
	`category` int(1) NOT NULL DEFAULT '0', 
	`contact_phone` varchar(20) NOT NULL,
	`contact_email` varchar(45) NOT NULL,  
	`approved_by_admin` tinyInt(1) NOT NUll DEFAULT '0', 
	`approved_by_superAdmin` tinyInt(1) NOT NULL DEFAULT '0', 

	PRIMARY KEY('Name')	
)

CREATE TABLE `COMMENTS`(
	`commentID` int(11) NOT NULL, 
	`userID` NOT NULL REFERENCES `Student`(`userID`),
	`text` varchar(500) NOT NULL, 
	`timeStamp` timeStamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

	PRIMARY KEY('commentID')
)

CREATE TABLE `Rso`(
	`Name` varchar(80) NOT NULL, 
	`Description` varchar(500) NOT NULL,

	PRIMARY KEY('Name') 
)

CREATE TABLE `University`(

	`Name` varchar(80) NOT NULL, 
	`Description` varchar(500) NOT NULL, 
	`numStudents` int(11) NOT NULL, 
	`University_ID` int(11) NOT NULL, 

	PRIMARY KEY(University_ID)

	)

CREATE TABLE `Location`(
	`Name` varchar(100) NOT NULL, 
	`Latitude` float NOT NULL, 
	`Longitude` float NOT NULL, 

	PRIMARY KEY('Name')
)