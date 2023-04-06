drop database if exists restaurantDB;
create database restaurantDB;

CREATE TABLE Restaurant(
Name			VARCHAR(40) NOT NULL,
URL		        VARCHAR(40) NOT NULL,
Street          VARCHAR(40) NOT NULL,
city            VARCHAR(20) NOT NULL,
zip             CHAR(7)    NOT NULL,
PRIMARY KEY(Name)
);

CREATE TABLE Food(
Foodname 	      VARCHAR(40) NOT NULL,
PRIMARY KEY(Foodname)
);

CREATE TABLE OffersOnMenu(
RName			VARCHAR(40) NOT NULL,
Foodname		VARCHAR(40) NOT NULL,
Fprice          DECIMAL(5,2),
PRIMARY KEY(RName,Foodname),
FOREIGN KEY(RName) REFERENCES Restaurant(Name) ON DELETE CASCADE,
FOREIGN KEY(Foodname) REFERENCES Food(Foodname) ON DELETE CASCADE
);

CREATE TABLE Employee(
EmployeeID	    INTEGER     NOT NULL,
Fname			VARCHAR(20),
Lname			VARCHAR(20),
EmailAddress    VARCHAR(100),
RName			VARCHAR(40) NOT NULL,
PRIMARY KEY(EmployeeID),
FOREIGN KEY(RName) REFERENCES Restaurant(Name) ON DELETE RESTRICT
);

CREATE TABLE OnlineOrder(
OrderId INTEGER	NOT NULL,
TotalPrice DECIMAL(5,2) NOT NULL,
Tip DECIMAL(5,2),
PRIMARY KEY(OrderId)
);

CREATE TABLE CustomerAcct(
EmailAddress	VARCHAR(100) NOT NULL,
Fname			VARCHAR(20),
Lname			VARCHAR(20),
CellNum			BIGINT     NOT NULL,
Street          VARCHAR(30) NOT NULL,
city            VARCHAR(10) NOT NULL,
PC				CHAR(7)	    NOT NULL,
CreditAmount	INTEGER		NOT NULL,
Timeplaced		TIME,
OrderId			INTEGER,
PRIMARY KEY(EmailAddress),
FOREIGN KEY(OrderId) REFERENCES OnlineOrder(OrderId) ON DELETE SET NULL
);

CREATE TABLE Contain(
Foodname VARCHAR(40)		NOT NULL,
OrderId INTEGER 			NOT NULL,
PRIMARY KEY(Foodname,OrderId),
FOREIGN KEY(Foodname) REFERENCES Food(Foodname) ON DELETE CASCADE,
FOREIGN KEY(OrderId) REFERENCES OnlineOrder(OrderId) ON DELETE CASCADE
);

CREATE TABLE RelatedTo(
EmployeeID	INTEGER 		NOT NULL,
EmailAddress VARCHAR(40) 	NOT NULL,
RelationType 	VARCHAR(20) NOT NULL,
PRIMARY KEY(EmployeeID,EmailAddress),
FOREIGN KEY(EmployeeID) REFERENCES Employee(EmployeeID) ON DELETE CASCADE,
FOREIGN KEY(EmailAddress) REFERENCES CustomerAcct(EmailAddress) ON DELETE CASCADE
);

CREATE TABLE Shift(
Day Date 					NOT NULL,
EmployeeID INTEGER 			NOT NULL,
Starttime TIME,
Sndtime TIME,
primary key(EmployeeID, Day),
FOREIGN KEY(EmployeeID) REFERENCES Employee(EmployeeID) ON DELETE CASCADE
);

CREATE TABLE Payment(
Day Date,
PaymentAmount DECIMAL(10,2),
CustomerE VARCHAR(40),
PRIMARY KEY(Day,CustomerE),
FOREIGN KEY(CustomerE) REFERENCES CustomerAcct(EmailAddress) ON DELETE CASCADE
);

CREATE TABLE Manager(
ID INTEGER					NOT NULL,
PRIMARY KEY(ID),
FOREIGN KEY(ID) REFERENCES Employee(EmployeeID)ON DELETE CASCADE
);

CREATE TABLE Servers(
ID INTEGER					NOT NULL,
PRIMARY KEY(ID),
FOREIGN KEY(ID) REFERENCES Employee(EmployeeID) ON DELETE CASCADE
);

CREATE TABLE Chef(
ID INTEGER					NOT NULL, 
PRIMARY KEY(ID),
FOREIGN KEY(ID) REFERENCES Employee(EmployeeID)ON DELETE CASCADE
);

CREATE TABLE Credentials(
ID INTEGER					NOT NULL, 
Credentials VARCHAR(20)     NOT NULL,
PRIMARY KEY(ID,Credentials),
FOREIGN KEY(ID) REFERENCES Chef(ID) ON DELETE CASCADE
);

CREATE TABLE DeliveryEmployee(
ID INTEGER					NOT NULL,
OrderId INTEGER,
TimeDelivered Time,
PRIMARY KEY(ID),
FOREIGN KEY(ID) REFERENCES Employee(EmployeeID) ON DELETE CASCADE,
FOREIGN KEY(OrderId) REFERENCES OnlineOrder(OrderId) ON DELETE SET NULL
);

insert into Restaurant values
('KFC','WWW.KFC.CA','16 Princess','Kingston','K7L 4W7'),
('Tim Hortons','WWW.TimHortons.CA','945 Gardiners Rd','Kingston','K7L 8w8'),
('Booster Juice','WWW.BoosterJuice.CA','68 Princess st','Kingston','K7L 4W7'),
('Chez Piggy','WWW.ChezPiggy.CA','16 Princess st','Kingston','K7L 1A5'),
('Jack Astor','WWW.JackAstor.CA','330 King St E','Kingston','K7L 3B6'),
('The Keg','WWW.Keg.CA','300 King St','Kingston','K7L 3B4');

insert into Food values
('Fried Chicken'),
('Double Double'),
('Apple Mango Mix'),
('Do Ewe Believe in Magic'),
('Bee Burger'),
('Prime Rib');

insert into OffersOnMenu values
('KFC','Fried Chicken', 5.5),
('Tim Hortons','Double Double', 4.0),
('Booster Juice','Apple Mango Mix', 15.2),
('Chez Piggy','Do Ewe Believe in Magic', 32.5),
('Jack Astor', 'Bee Burger', 12.5),
('The Keg','Prime Rib',40.0);

insert into Employee values
(123456,'Steven','Wen','steven@gmail.com','Chez Piggy'),
(937482,'Jimmy','Lv','jimmy@gmail.com','The Keg'),
(759394,'Ben','Geermen','ben@gmail.com','KFC'),
(647930,'Even','Kilburn','even@gmail.com','Jack Astor'),
(536480,'Joann','Zhou','JZ@gmail.com','Tim Hortons'),
(476254,'Hans','Hazz','HH@gmail.com','Booster Juice'),
(438947,'Jeff','Kilburn','jeff@gmail.com','Chez Piggy'),
(874839,'Dan','L','Dan@gmail.com','The Keg'),
(748938,'Ben','Lee','benL@gmail.com','KFC'),
(093874,'Stephine','Mark','Steph@gmail.com','Jack Astor'),
(758493,'Jo','Zh','Jo@gmail.com','Tim Hortons'),
(783082,'Han','Her','Han@gmail.com','Booster Juice'),
(893728,'Je','King','je@gmail.com','Chez Piggy'),
(787493,'Kwe','Bru','Kwe@gmail.com','The Keg'),
(782083,'Bui','Le','buiL@gmail.com','KFC'),
(875201,'Steph','Who','Ste@gmail.com','Jack Astor'),
(847392,'JJ','UI','JJ@gmail.com','Tim Hortons'),
(784329,'Hui','Fusd','Hui@gmail.com','Booster Juice'),
(657832,'Judb','Ji','Judb@gmail.com','Chez Piggy'),
(784938,'Sui','Lu','Sui@gmail.com','The Keg'),
(857364,'Who','Lan','Who@gmail.com','KFC'),
(875832,'Sur','Liang','Sur@gmail.com','Jack Astor'),
(198453,'Jane','Queb','Jane@gmail.com','Tim Hortons'),
(782357,'LL','Dang','LL@gmail.com','Booster Juice');

insert into OnlineOrder values
(1234, 5.5, 2.5),
(3245, 15.2, 1.2),
(5429, 4.0, 1.0),
(9475, 32.5, 0.0),
(8475, 40.0, 20.0),
(7580, 12.5, 2.4);

insert into CustomerAcct values
('will@gmail.com','Will','Harris',7789345789,'184 nelson st','Kingston','k7l 3w2',20,'12:20',1234),
('Kevin@gmail.com','Kevin','Hoern',3437682356,'123 Barrie st','Kingston','k7l 1A3',0,'14:30',3245),
('Chiara@gmail.com','Chiara','Cheng',7788747729,'31 King st E','Kingston','k7l 1BC',100,'5:15',5429),
('Sophia@gmail.com','Sophia','Chong',7782520938,'10 Princess st','Kingston','k7l 5D3',43,'6:13',9475),
('Harry@gmail.com','Harry',NULL,3437284772,'134 Ontario st','Kingston','k7l 6E6',532,'19:00',8475),
('Hansuwan@gmail.com','Hansuwan','Namo',7785647839,'663 Johnson st','Kingston','k7l 8Y8',24,'12:20',7580);

insert into Contain values
('Fried Chicken',1234),
('Apple Mango Mix',3245),
('Double Double', 5429),
('Do Ewe Believe in Magic', 9475),
('Prime Rib', 8475),
('Bee Burger',7580);

insert into RelatedTo values
(123456,'will@gmail.com','roommate'),
(123456,'Kevin@gmail.com','friends'),
(438947,'Chiara@gmail.com','friends'),
(937482,'will@gmail.com','roommate'),
(759394,'Sophia@gmail.com','sister'),
(647930,'Harry@gmail.com','brother');

insert into Shift values
('2023-01-23',759394,'12:20','13:20'),
('2023-01-24',476254,'14:30','16:20'),
('2023-02-23',536480,'5:15','7:20'),
('2023-02-23',123456,'6:13','13:20'),
('2023-01-10',937482,'19:00','20:20'),
('2023-01-23',647930,'12:20','13:20'),
('2023-01-23',748938,'12:20','13:20'),
('2023-01-23',874839,'12:20','13:20'),
('2023-04-01',123456,'12:20','13:20');

insert into Payment values
('2023-01-23',8.0,'will@gmail.com'),
('2023-01-24',16.4,'Kevin@gmail.com'),
('2023-02-23',5.0,'Chiara@gmail.com'),
('2023-02-23',32.5,'Sophia@gmail.com'),
('2023-01-10',60.0,'Harry@gmail.com'),
('2023-01-23',14.9,'Hansuwan@gmail.com');

insert into Manager values
(438947),
(874839),
(748938),
(093874),
(758493),
(783082);

insert into Servers values
(893728),
(787493),
(782083),
(875201),
(847392),
(784329);

insert into Chef values
(657832),
(784938),
(857364),
(875832),
(198453),
(782357);

insert into Credentials values
(657832,'CCE'),
(657832,'CSC'),
(784938,'CCE'),
(784938,'CFPS'),
(857364,'CCE'),
(198453,'CCE');

insert into DeliveryEmployee values
(759394,1234,'13:30'),
(476254,3245,'14:40'),
(536480,5429,'5:30'),
(123456,9475,'6:15'),
(937482,8475,'19:30'),
(647930,7580,'12:30');