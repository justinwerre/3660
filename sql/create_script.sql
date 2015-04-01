DROP TABLE IF EXISTS SHOPPINGCART;
DROP TABLE IF EXISTS ORDERED;
DROP TABLE IF EXISTS PURCHASES;
DROP TABLE IF EXISTS CUSTOMERS;
DROP TABLE IF EXISTS VIDEOGAMES;

CREATE TABLE CUSTOMERS (
  `cID` int(11) NOT NULL AUTO_INCREMENT,
  `cEmail` varchar(30) NOT NULL DEFAULT '',
  `cPassword` varchar(15) NOT NULL DEFAULT '',
  `cAddress` varchar(40) NOT NULL DEFAULT '',
  `cfName` varchar(15) NOT NULL DEFAULT '',
  `clName` varchar(20) NOT NULL DEFAULT '',
  `cUserType` tinyint(1) NOT NULL,
  `cActive` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`cID`),
  UNIQUE KEY `cEmail` (`cEmail`)
);

INSERT INTO `CUSTOMERS` (`cID`, `cEmail`, `cPassword`, `cAddress`, `cfName`, `clName`, `cUserType`)
VALUES
	(1,'kevin@kkobay.com','hi','12','Kevin','Kobayashi',1),
	(2, 'justin@werre.com', 'bye', '12', 'Justin', 'Werre', 1),
	(3,'ryan.kellet@uleth.ca','12','','Rylor','Kellort',0);

CREATE TABLE `VIDEOGAMES` (
  `serial_number` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `ESRB_rating` varchar(10) NOT NULL,
  `release_date` date NOT NULL,
  `cover_art` varchar(45) NOT NULL,
  `description` varchar(150) NOT NULL,
  `developer` varchar(50) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`serial_number`),
  UNIQUE KEY `serial_number_UNIQUE` (`serial_number`)
);

INSERT INTO `VIDEOGAMES` (`serial_number`, `title`, `price`, `ESRB_rating`, `release_date`, `cover_art`, `description`, `developer`)
VALUES
	(1,'Hotline Miami',19.99,'Mature','2015-03-10','hotline2.jpg','You\'re crazy and you kill people','Devolver Games'),
	(2,'Counter Strike Global Offensive',19.99,'Teen','2013-02-11','csgo.jpg','I don\'t know disarm bomb and kill baddies','Valve'),
	(3,'Dark Souls II',29.99,'Teen','2012-09-16','ds2.jpg','Prepare to get Die edition','From Software'),
	(4,'Borderlands: The Presequel',59.99,'Teen','2014-02-13','bl3.jpg','Same game for the third time now. Whoo!','Gearbox Software');

CREATE TABLE `SHOPPINGCART` (
	`serial_number` int(11) NOT NULL,
	`cID` int(11) NOT NULL,
	PRIMARY KEY (`serial_number`, `cID`),
	FOREIGN KEY (`serial_number`) REFERENCES VIDEOGAMES(`serial_number`) ON DELETE CASCADE,
	FOREIGN KEY (`cID`) REFERENCES CUSTOMERS(`cID`) ON DELETE CASCADE
);

INSERT INTO `SHOPPINGCART` (`cID`, `serial_number`)
VALUES
	(1, 4),
	(2, 4),
	(2, 2),
	(3, 3);

CREATE TABLE `PURCHASES` (
	`pID` int(11) NOT NULL AUTO_INCREMENT,
	`cID` int(11) NOT NULL,
	`pDate` DATE NOT NULL,
	PRIMARY KEY (`pID`),
	FOREIGN KEY (`cID`) REFERENCES CUSTOMERS(`cID`) ON DELETE CASCADE
);

INSERT INTO `PURCHASES` (`pID`, `cID`, `pDate`)
VALUES 
(1, 1, '2014-09-08'),
(2, 2, '2014-09-09');

CREATE TABLE `ORDERED` (
	`serial_number` int(11) NOT NULL,
	`pID` int(11) NOT NULL,
	`price` decimal(7,2) NOT NULL,
	PRIMARY KEY (`serial_number`, `pID`),
	FOREIGN KEY (`pID`) REFERENCES PURCHASES(`pID`) ON DELETE CASCADE,
	FOREIGN KEY (`serial_number`) REFERENCES VIDEOGAMES(`serial_number`) ON DELETE CASCADE
);

INSERT INTO `ORDERED` (`serial_number`, `pID`, `price`)VALUES 
(1, 1, 19.99),
(2, 2, 19.99);
