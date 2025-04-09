USE `COFFESHOP`;

INSERT INTO `ACCOUNTS` (`USENAME`, `PASSWORD`) VALUES
('john_doe', 'password123'),
('jane_smith', 'securepass'),
('peter_jones', 'mysecret'),
('alice_wonder', 'wonderland');

INSERT INTO `USERS` (`ACCOUNTID`, `FULLNAME`, `ADDRESS`, `PHONE`, `EMAIL`, `DATEOFBIRTH`) VALUES
(1, 'John Doe', '123 Main St', '123-456-7890', 'john.doe@example.com', '1990-01-15'),
(2, 'Jane Smith', '456 Oak Ave', '987-654-3210', 'jane.smith@example.com', '1985-05-20'),
(3, 'Peter Jones', '789 Pine Ln', '555-123-4567', 'peter.jones@example.com', '1992-11-08'),
(4, 'Alice Wonderland', '10 Downing St', '012-345-6789', 'alice.wonder@example.com', '2000-03-22');

INSERT INTO `UNITS` (`TYPE`) VALUES
('kg'),
('g'),
('ml'),
('pcs'),
('l');

INSERT INTO `PRODUCERS` (`PRODUCERNAME`, `ADDRESS`, `PHONE`) VALUES
('Local Farm', '12 Farm Rd', '111-222-3333'),
('Imported Goods', '45 Trade St', '444-555-6666'),
('Regional Supplier', '78 Supply Ln', '777-888-9999');

INSERT INTO `INGREDIENTS` (`PRODUCERID`, `INGREDIENTNAME`, `QUANTITY`, `UNITID`) VALUES
(1, 'Coffee Beans', 100, 1),
(1, 'Milk', 500, 3),
(2, 'Sugar', 50, 1),
(3, 'Chocolate Syrup', 200, 3);

-- Recipes: 4 Coffee + 4 Tea + 4 Snacks + 4 Related Items
INSERT INTO `RECIPES` (`RECIPENAME`) VALUES
('Espresso'),
('Latte'),
('Americano'),
('Mocha'),
('Trà Đào'),
('Trà Sữa Trân Châu'),
('Trà Xanh Mật Ong'),
('Trà Lài Nóng'),
('Bánh Mì Bơ Tỏi'),
('Bánh Quy Socola'),
('Khoai Tây Chiên'),
('Bánh Phô Mai'),
('Ly Sứ Cỡ Lớn'),
('Túi Vải Đựng Cà Phê'),
('Bình Giữ Nhiệt'),
('Hộp Quà Tặng Cà Phê');

INSERT INTO `RECIPEDETAILS` (`RECIPEID`, `INGREDIENTID`, `QUANTITY`, `UNITID`) VALUES
(1, 1, 100, 1),
(1, 2, 500, 3),
(2, 1, 200, 1),
(2, 2, 1000, 3),
(3, 1, 50, 1),
(3, 2, 250, 3),
(4, 1, 150, 1),
(4, 2, 750, 3),
(4, 3, 25, 1),
(4, 4, 125, 3);


INSERT INTO CATEGORIES (CATEGORYNAME) VALUES 
('Cafe'), 
('Trà'), 
('Ăn vặt'), 
('Khác');


INSERT INTO `PRODUCTS` (`ID`, `RECIPEID`, `PRODUCTNAME`, `PRICE`, `UNITID`, `CATEGORYID`) VALUES
-- Coffee
(1, 1, 'Espresso', 2.50, 1, 1),
(2, 2, 'Latte', 4.00, 1, 1),
(3, 3, 'Americano', 3.50, 1, 1),
(4, 4, 'Mocha', 5.00, 1, 1),

-- Tea
(5, 5, 'Trà Đào', 3.80, 1, 2),
(6, 6, 'Trà Sữa Trân Châu', 4.20, 1, 2),
(7, 7, 'Trà Xanh Mật Ong', 3.60, 1, 2),
(8, 8, 'Trà Lài Nóng', 3.00, 1, 2),

-- Snacks
(9, 9, 'Bánh Mì Bơ Tỏi', 2.00, 1, 3),
(10, 10, 'Bánh Quy Socola', 1.80, 1, 3),
(11, 11, 'Khoai Tây Chiên', 2.50, 1, 3),
(12, 12, 'Bánh Phô Mai', 3.00, 1, 3),

-- Other products
(13, 13, 'Ly Sứ Cỡ Lớn', 6.50, 1, 4),
(14, 14, 'Túi Vải Đựng Cà Phê', 5.00, 1, 4),
(15, 15, 'Bình Giữ Nhiệt', 10.00, 1, 4),
(16, 16, 'Hộp Quà Tặng Cà Phê', 12.00, 1, 4);


INSERT INTO `IMPORTS` (`PRODUCERID`, `DATE`, `TOTAL`) VALUES
(1, '2023-10-26', 5000),
(2, '2023-10-27', 10000),
(3, '2023-10-28', 7500);

INSERT INTO `IMPORTDETAILS` (`IMPORTID`, `INGREDIENTID`, `QUANTITY`, `PRICE`, `TOTAL`, `UNITID`) VALUES
(1, 1, 1000, 2.50, 2500, 1), 
(1, 2, 500, 1.50, 750, 3), 
(2, 1, 2000, 3.00, 6000, 1), 
(2, 2, 1000, 2.00, 2000, 3); 

INSERT INTO `DISCOUNTS` (`DISCOUNTNAME`, `DISCOUNTPERCENT`, `REQUIREMENT`, `STARTDATE`, `ENDDATE`) VALUES
('Summer Sale', 10, 20, '2023-06-01', '2023-08-31'),
('Winter Deal', 15, 30, '2023-12-01', '2023-12-31');

INSERT INTO `ORDERS` (`USERID`, `TOTAL`, `DATEOFORDER`, `ORDERSTATUS`, `DISCOUNTID`, `PRICEBEFOREDISCOUNT`) VALUES
(1, 7, '2023-01-01', 'PENDING', 1, 7),
(2, 13.50, '2023-02-01', 'PENDING', 2, 13.50),
(3, 3.50, '2023-03-01', 'PENDING', 1, 3.50),
(4, 9, '2023-04-01', 'PENDING', 2, 9);

INSERT INTO `ORDERDETAILS` (`ORDERID`, `PRODUCTID`, `QUANTITY`, `PRICE`, `TOTAL`) VALUES
(1, 1, 2, 3.50, 7),
(2, 2, 1, 4.50, 4.50),
(3, 3, 1, 3.00, 3.00),
(4, 4, 1, 5.00, 5.00);

INSERT INTO `CARTS` (`USERID`, `QUANTITY`) VALUES
(1, 3),
(2, 1),
(3, 3),
(4, 1);

INSERT INTO `CARTDETAILS` (`CARTID`, `PRODUCTID`, `QUANTITY`) VALUES
(1, 1, 2),
(1, 2, 1),
(3, 3, 3),
(4, 4, 1);

INSERT INTO `PRODUCTREVIEWS` (`USERID`, `PRODUCTID`, `RATING`, `DATE`, `COMMENT`) VALUES
(1, 1, 4.5, '2023-10-26', 'Great espresso!'),
(2, 2, 5.0, '2023-10-27', 'Perfect latte!'),
(3, 3, 4.0, '2023-10-28', 'Good Americano.'),
(4, 4, 4.8, '2023-10-29', 'Delicious Mocha.');
