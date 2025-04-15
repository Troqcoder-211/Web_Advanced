

DROP DATABASE IF EXISTS `COFFESHOP`;

CREATE DATABASE IF NOT EXISTS `COFFESHOP`;

USE `COFFESHOP`;

DROP TABLE IF EXISTS `ACCOUNTS`;

CREATE TABLE IF NOT EXISTS `ACCOUNTS` (
    ID          INT             NOT NULL AUTO_INCREMENT,
    USERNAME    VARCHAR(50)     NOT NULL,
    PASSWORD    VARCHAR(255)    NOT NULL,
    ROLE        VARCHAR(50)     NOT NULL DEFAULT 'user',
    PRIMARY KEY (ID)
);
DROP TABLE IF EXISTS `USERS`;

CREATE TABLE IF NOT EXISTS `USERS` (
    ID                          INT             NOT NULL           AUTO_INCREMENT              ,
    ACCOUNTID                   INT             NOT NULL                                       ,
    FULLNAME                    VARCHAR(50)     NOT NULL                                       ,
    ADDRESS                     VARCHAR(50)     NOT NULL                                       ,
    PHONE                       VARCHAR(50)     NOT NULL                                       ,
    EMAIL                       VARCHAR(50)     NOT NULL                                       ,
    DATEOFBIRTH                 DATE            NOT NULL                                       ,
    PRIMARY KEY (ID)
);



DROP TABLE IF EXISTS `PRODUCTS`;

CREATE TABLE IF NOT EXISTS  `PRODUCTS` (

    `ID`                          INT             NOT NULL           AUTO_INCREMENT            ,
    RECIPEID                    INT             NOT NULL                                       ,
    PRODUCTNAME                 VARCHAR(50)     NOT NULL                                       ,
    PRICE                       DOUBLE          NOT NULL                                       ,
    LINKIMAGE                   VARCHAR(255)    NOT NULL                                      ,
    UNITID                      INT                                                    ,

    PRIMARY KEY (`ID`)
);

DROP TABLE IF EXISTS `RECIPES`;
CREATE TABLE IF NOT EXISTS `RECIPES` (
    `ID`                        INT             NOT NULL           AUTO_INCREMENT              ,
    RECIPENAME                  VARCHAR(50)     NOT NULL                                       ,

    PRIMARY KEY (`ID`)
);

DROP TABLE IF EXISTS `RECIPEDETAILS`;

CREATE TABLE IF NOT EXISTS `RECIPEDETAILS` (
    RECIPEID                    INT             NOT NULL                                       ,
    INGREDIENTID                INT             NOT NULL                                       ,
    QUANTITY                    DOUBLE          NOT NULL                                       ,
    UNITID                      INT                                                   
);


DROP TABLE IF EXISTS `INGREDIENTS`;
CREATE TABLE IF NOT EXISTS `INGREDIENTS` (
    ID                          INT             NOT NULL           AUTO_INCREMENT              ,
    PRODUCERID                  INT             NOT NULL                                       ,
    INGREDIENTNAME              VARCHAR(50)     NOT NULL                                       ,
    QUANTITY                    DOUBLE          NOT NULL                                       ,
    UNITID                      INT                                                    ,
    PRIMARY KEY (ID)
);


DROP TABLE IF EXISTS `UNITS`;
CREATE TABLE IF NOT EXISTS `UNITS` (
    ID                          INT             NOT NULL           AUTO_INCREMENT              ,
    TYPE                        VARCHAR(50)     NOT NULL                                       ,
    DESCRIPTION                 VARCHAR(255)     NOT NULL                                      ,
    PRIMARY KEY (ID)
);



DROP TABLE IF EXISTS `PRODUCERS`;

CREATE TABLE IF NOT EXISTS `PRODUCERS` (
    `ID`                          INT             NOT NULL           AUTO_INCREMENT              ,
    PRODUCERNAME                VARCHAR(50)     NOT NULL                                       ,
    ADDRESS                     VARCHAR(50)     NOT NULL                                       ,
    PHONE                       VARCHAR(50)     NOT NULL                                       ,
    PRIMARY KEY (`ID`)
);


DROP TABLE IF EXISTS `IMPORTS`;
CREATE TABLE IF NOT EXISTS `IMPORTS` (
    ID                          INT             NOT NULL           AUTO_INCREMENT              ,
    PRODUCERID                  INT             NOT NULL                                       ,
    DATE                        DATE            NOT NULL                                       ,
    TOTAL                       DOUBLE          NOT NULL                                       ,
    PRIMARY KEY (ID)
);


DROP TABLE IF EXISTS `IMPORTDETAILS`;
CREATE TABLE IF NOT EXISTS `IMPORTDETAILS` (
    ID                          INT             NOT NULL           AUTO_INCREMENT              ,
    IMPORTID                    INT             NOT NULL                                       ,
    INGREDIENTID                INT             NOT NULL                                       ,
    QUANTITY                    DOUBLE          NOT NULL                                       ,
    PRICE                       DOUBLE          NOT NULL                                       ,
    TOTAL                       DOUBLE          NOT NULL                                       ,
    UNITID                      INT                                                    ,
    PRIMARY KEY (ID)
);


DROP TABLE IF EXISTS `ORDERS`; 
CREATE TABLE IF NOT EXISTS `ORDERS` (
    ID                          INT             NOT NULL           AUTO_INCREMENT                        ,
    USERID                      INT             NOT NULL                                                 ,
    TOTAL                       DOUBLE          NOT NULL                                                 ,
    DATEOFORDER                 DATE            NOT NULL                                                 ,
    ORDERSTATUS                 ENUM('PENDING', 'COMPLETED', 'CANCELLED') NOT NULL DEFAULT 'PENDING'     ,

    DISCOUNTID                  INT                                                              ,

    PRICEBEFOREDISCOUNT         DOUBLE          NOT NULL                                                 ,
    PRIMARY KEY (ID)
);


DROP TABLE IF EXISTS `DISCOUNTS`;
CREATE TABLE IF NOT EXISTS `DISCOUNTS` (
    ID                          INT             NOT NULL           AUTO_INCREMENT              ,
    DISCOUNTNAME                VARCHAR(50)     NOT NULL                                       ,
    DISCOUNTPERCENT             DOUBLE          NOT NULL                                       ,
    REQUIREMENT                 DOUBLE          NOT NULL                                       ,
    STARTDATE                   DATE            NOT NULL                                       ,
    ENDDATE                     DATE            NOT NULL                                       ,
    PRIMARY KEY (ID)
);


DROP TABLE IF EXISTS `ORDERDETAILS`; 
CREATE TABLE IF NOT EXISTS `ORDERDETAILS` (
    ID                          INT             NOT NULL           AUTO_INCREMENT              ,
    ORDERID                     INT             NOT NULL                                       ,
    PRODUCTID                   INT             NOT NULL                                       ,
    QUANTITY                    DOUBLE          NOT NULL                                       ,
    PRICE                       DOUBLE          NOT NULL                                       ,
    TOTAL                       DOUBLE          NOT NULL                                       ,
    PRIMARY KEY (ID)
);


DROP TABLE IF EXISTS `CARTS`;
CREATE TABLE IF NOT EXISTS `CARTS` (
    ID                          INT             NOT NULL           AUTO_INCREMENT              ,
    USERID                      INT             NOT NULL                                       ,
    QUANTITY                    DOUBLE          NOT NULL                                       ,
    PRIMARY KEY (ID)
);

DROP TABLE IF EXISTS `CARTDETAILS`;
CREATE TABLE IF NOT EXISTS `CARTDETAILS` (
    CARTID                      INT             NOT NULL                                       ,
    PRODUCTID                   INT             NOT NULL                                       ,
    QUANTITY                    DOUBLE          NOT NULL                                       
);

DROP TABLE IF EXISTS `PRODUCTREVIEWS`;

CREATE TABLE IF NOT EXISTS `PRODUCTREVIEWS` (
    ID                          INT             NOT NULL           AUTO_INCREMENT              ,
    USERID                      INT             NOT NULL                                       ,
    PRODUCTID                   INT             NOT NULL                                       ,
    RATING                      DOUBLE          NOT NULL                                       ,
    DATE                        DATE            NOT NULL                                       ,
    COMMENT                     TEXT     NOT NULL                                              ,
    PRIMARY KEY (ID)
);



ALTER TABLE `PRODUCTS` 
ADD CONSTRAINT `FK_RECIPES` FOREIGN KEY (RECIPEID) REFERENCES RECIPES(ID),
ADD CONSTRAINT `FK_UNITS_PRODUCTS` FOREIGN KEY (UNITID) REFERENCES UNITS(ID);

ALTER TABLE `RECIPEDETAILS`
 ADD CONSTRAINT `FK_RECIPES_RECIPEDETAILS` FOREIGN KEY (RECIPEID) REFERENCES RECIPES(ID),
 ADD CONSTRAINT `FK_INGREDIENTS_RECIPEDETAILS` FOREIGN KEY (INGREDIENTID) REFERENCES INGREDIENTS(ID);
 
ALTER TABLE `INGREDIENTS`
 ADD CONSTRAINT `FK_PRODUCERS` FOREIGN KEY (PRODUCERID) REFERENCES PRODUCERS(ID),
 ADD CONSTRAINT `FK_UNITS_INGREDIENTS` FOREIGN KEY (UNITID) REFERENCES UNITS(ID);
 
ALTER TABLE `IMPORTDETAILS`
 ADD CONSTRAINT `FK_IMPORTS` FOREIGN KEY (IMPORTID) REFERENCES IMPORTS(ID),
 ADD CONSTRAINT `FK_INGREDIENTS_IMPORTDETAILS` FOREIGN KEY (INGREDIENTID) REFERENCES INGREDIENTS(ID),
 ADD CONSTRAINT `FK_UNITS_IMPORTDETAILS` FOREIGN KEY (UNITID) REFERENCES UNITS(ID);

ALTER TABLE `ORDERDETAILS`
 ADD CONSTRAINT `FK_ORDERS_ORDERDETAILS` FOREIGN KEY (ORDERID) REFERENCES ORDERS(ID),
 ADD CONSTRAINT `FK_PRODUCTS_ORDERDETAILS` FOREIGN KEY (PRODUCTID) REFERENCES PRODUCTS(ID);
 
 ALTER TABLE `ORDERS` 
 ADD CONSTRAINT `FK_USERS_ORDERS` FOREIGN KEY (USERID) REFERENCES USERS(ID),
 ADD CONSTRAINT `FK_DISCOUNTS_ORDERS` FOREIGN KEY (DISCOUNTID) REFERENCES DISCOUNTS(ID);

 ALTER TABLE `CARTS`
 ADD CONSTRAINT `FK_USERS_CARTS` FOREIGN KEY (USERID) REFERENCES USERS(ID);


 ALTER TABLE `CARTDETAILS`
 ADD CONSTRAINT `FK_CARTS` FOREIGN KEY (CARTID) REFERENCES CARTS(ID),
 ADD CONSTRAINT `FK_PRODUCTS_CARTDETAILS` FOREIGN KEY (PRODUCTID) REFERENCES PRODUCTS(ID);

 ALTER TABLE `USERS` 
 ADD CONSTRAINT `FK_ACCOUNTS` FOREIGN KEY (ACCOUNTID) REFERENCES ACCOUNTS(ID);


ALTER TABLE `PRODUCTREVIEWS`
 ADD CONSTRAINT `FK_USERS` FOREIGN KEY (USERID) REFERENCES USERS(ID),
 ADD CONSTRAINT `FK_PRODUCTS` FOREIGN KEY (PRODUCTID) REFERENCES PRODUCTS(ID);
