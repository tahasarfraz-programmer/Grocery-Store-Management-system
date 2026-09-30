CREATE DATABASE IF NOT EXISTS grocery_db CHARACTER SET utf8mb4;
USE grocery_db;
CREATE TABLE users(id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(80),email VARCHAR(120) UNIQUE,password VARCHAR(255),role ENUM('admin','cashier') DEFAULT 'cashier');
CREATE TABLE categories(id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(60));
CREATE TABLE products(id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(120),category_id INT,price DECIMAL(10,2),stock INT DEFAULT 0,min_stock INT DEFAULT 10,FOREIGN KEY(category_id) REFERENCES categories(id));
CREATE TABLE sales(id INT AUTO_INCREMENT PRIMARY KEY,user_id INT,customer VARCHAR(80),total DECIMAL(10,2),created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE sale_items(id INT AUTO_INCREMENT PRIMARY KEY,sale_id INT,product_id INT,qty INT,price DECIMAL(10,2),FOREIGN KEY(sale_id) REFERENCES sales(id),FOREIGN KEY(product_id) REFERENCES products(id));
INSERT INTO categories(name) VALUES('Fruits'),('Vegetables'),('Dairy'),('Bakery'),('Beverages'),('Snacks');
INSERT INTO products(name,category_id,price,stock,min_stock) VALUES
('Bananas 1kg',1,1.20,80,20),('Red Apples 1kg',1,2.80,55,20),('Tomatoes 1kg',2,2.10,12,15),('Spinach Bunch',2,1.10,30,10),
('Whole Milk 1L',3,1.35,60,20),('Cheddar 200g',3,3.40,8,10),('Sourdough Loaf',4,3.90,18,8),('Croissant',4,1.60,40,12),
('Orange Juice 1L',5,2.75,35,15),('Sparkling Water',5,0.95,120,30),('Salted Crisps',6,1.85,9,15),('Dark Chocolate',6,2.50,45,10);
