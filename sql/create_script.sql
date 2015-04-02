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
	(1, 'kevin@kkobay.com','hi','123 Fake Street','Kevin','Kobayashi',1),
	(2, 'justin@werre.com', 'bye', '321 Fake Ave', 'Justin', 'Werre', 1),
	(3, 'ryan.kellet@uleth.ca','12','163 Fake Blvd','Rylor','Kellort',0),
	(4, 'u@k.com','hi','143 Fake Crescent','Test','User',0);

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

INSERT INTO `VIDEOGAMES` (`serial_number`, `title`, `price`, `ESRB_rating`, `release_date`, `cover_art`, `description`, `developer`, `enabled`)
VALUES
	(1,'Hotline Miami',19.99,'Mature','2015-03-10','hotline2.jpg','You\'re crazy and you kill people, drugs are bad.','Devolver Games',1),
	(2,'Counter Strike Global Offensive',19.99,'Teen','2013-02-11','csgo.jpg','Counter-Terrorists Win!','Valve',1),
	(3,'Dark Souls II',29.99,'Teen','2012-09-16','ds2.jpg','Just die already edition','From Software',1),
	(4,'Borderlands: The Presequel',59.99,'Teen','2014-02-13','bl3.jpg','Same game for the third time now. Whoo!','Gearbox Software',1),
	(5,'Grand Theft Auto V',69.99,'Mature','2015-04-15','gtav.jpg','Delayed Again. ','Rockstar Games',0),
	(6,'GRID Autosport',19.99,'Everyone','2014-06-26','GRID.jpg','Car game with Cars.','Codemasters',1),
	(7,'The Elder Scrolls V: Skyrim',19.99,'Mature','2011-11-10','skyrim.jpg','Fight dragons!','Bethesda',1),
	(8,'Farcry 4',69.99,'Mature','2014-11-01','farcry4.jpg','Befriend Pagan Min and Honeybadgers.','Ubisoft',1),
	(9,'Call of Duty: Advanced Warfare',64.99,'Mature','2014-11-03','codAW.jpg','Every pre-teen\'s favorite game','Activision',1),
	(10,'Assassin\'s Creed Unity',69.99,'Mature','2014-11-11','acreedUnity.jpg','Still not fixed','Ubisoft',1),
	(11,'Cities: Skylines',29.99,'Children','2015-03-10','cities.jpg','\"What Simcity should have been\"-Everyone','Colossal Order Ltd.',1);

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
