LOAD DATA LOCAL INFILE "User.dat"
INTO TABLE User
FIELDS TERMINATED BY "<>";

LOAD DATA LOCAL INFILE "Normal.dat"
INTO TABLE Normal
FIELDS TERMINATED BY "<>";

LOAD DATA LOCAL INFILE "Product.dat"
INTO TABLE Product
FIELDS TERMINATED BY "<>";

LOAD DATA LOCAL INFILE "Order.dat"
INTO TABLE Orders
FIELDS TERMINATED BY "<>";

LOAD DATA LOCAL INFILE "Rating.dat"
INTO TABLE Rating
FIELDS TERMINATED BY "<>";

LOAD DATA LOCAL INFILE "Cart.dat"
INTO TABLE Cart
FIELDS TERMINATED BY "<>";

LOAD DATA LOCAL INFILE "Order_detail.dat"
INTO TABLE Order_detail
FIELDS TERMINATED BY "<>";