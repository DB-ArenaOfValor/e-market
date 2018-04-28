DROP TABLE IF EXISTS Order_detail;
DROP TABLE IF EXISTS Cart;
DROP TABLE IF EXISTS Rating;
DROP TABLE IF EXISTS Orders;
DROP TABLE IF EXISTS Product;
DROP TABLE IF EXISTS Normal;
DROP TABLE IF EXISTS User;


CREATE TABLE User (
	userID INT NOT NULL AUTO_INCREMENT,
	userName VARCHAR(30) NOT NULL,
	password VARCHAR(30) NOT NULL,
	PRIMARY KEY (userID)
)engine innodb;

CREATE TABLE Normal (
	userID INT NOT NULL,
	sex INT,
	phone VARCHAR(30),
	email VARCHAR(30) NOT NULL,
	PRIMARY KEY (userID),
	FOREIGN KEY (userID) REFERENCES User (userID)
	ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Product (
	PID INT NOT NULL AUTO_INCREMENT,
	brand VARCHAR(30) NOT NULL,
	model VARCHAR(30) NOT NULL,
	year DATE NOT NULL,
	color VARCHAR(30) NOT NULL,
	use_time  DECIMAL(2,1) NOT NULL,
	price DECIMAL(20,2) NOT NULL,
	state INT DEFAULT 0,
	image INT NOT NULL,
	sell_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	sellerID INT,
	PRIMARY KEY (PID),
	FOREIGN KEY (sellerID) REFERENCES User (userID)
	ON DELETE SET NULL
);

CREATE TABLE Orders (
	orderID INT NOT NULL AUTO_INCREMENT,
	buyerID INT NOT NULL,
	order_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	ship_address VARCHAR(50) NOT NULL,
	PRIMARY KEY (orderID),
	FOREIGN KEY (buyerID) REFERENCES User (userID)
	ON DELETE NO ACTION
);

CREATE TABLE Rating (
	ratingID INT NOT NULL AUTO_INCREMENT,
	rating DECIMAL(2, 1) NOT NULL,
	buyerID INT NOT NULL,
	PR_PID INT NOT NULL,
	rating_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (ratingID),
	FOREIGN KEY (buyerID) REFERENCES User (userID)
	ON DELETE NO ACTION,
	FOREIGN KEY (PR_PID) REFERENCES Product (PID)
	ON DELETE NO ACTION
);

CREATE TABLE Cart (
	user_cartID INT NOT NULL,
	cart_PID INT NOT NULL,
	PRIMARY KEY (user_cartID, cart_PID),
	FOREIGN KEY (user_cartID) REFERENCES User (userID)
	ON DELETE CASCADE,
	FOREIGN KEY (cart_PID) REFERENCES Product (PID)
);

CREATE TABLE Order_detail (
	orderID INT NOT NULL,
	PID INT NOT NULL,
	PRIMARY KEY (orderID, PID),
	FOREIGN KEY (orderID) REFERENCES Orders (orderID)
	ON DELETE CASCADE,
	FOREIGN KEY (PID) REFERENCES Product (PID)
);
