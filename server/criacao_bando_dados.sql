CREATE TABLE products (
    product_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100) NOT NULL,
    product_category VARCHAR(100) NOT NULL,
    product_description VARCHAR(250),
    product_image VARCHAR(250),
    product_image2 VARCHAR(250),
    product_image3 VARCHAR(250),
    product_image4 VARCHAR(250),
    product_price DECIMAL(6,2) NOT NULL,
    product_special_offer INT(2),
    product_color VARCHAR(100)
);
CREATE TABLE users (
    user_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(100) NOT NULL,
    user_email VARCHAR(100) NOT NULL,
    user_password VARCHAR(100) NOT NULL
);
CREATE TABLE orders (
    order_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    order_cost DECIMAL(6,2),
    order_status VARCHAR(100),
    user_id INT(11),
    shipping_city VARCHAR(255),
    shipping_uf VARCHAR(2),
    shipping_address VARCHAR(255),
    order_date DATETIME,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
CREATE TABLE order_items (
    item_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    order_id INT(11),
    product_id INT(11),
    user_id INT(11),
    qnt INT(11),
    order_date DATETIME,
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
CREATE TABLE payments (
    payment_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    order_id INT(11),
    user_id INT(11),
    transaction_id VARCHAR(255),
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
CREATE TABLE admins (
    admin_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    admin_email VARCHAR(255),
    admin_name VARCHAR(255),
    admin_password VARCHAR(100)
);
INSERT into admins VALUES(null,"admin", "admin@shop.com.br", "e10adc3949ba59abbe56e057f20f883e") ;

INSERT INTO products (product_name, product_category, product_description, product_image, product_image2, product_image3, product_image4, product_price, product_special_offer, product_color) VALUES
('Product 1', 'Category 1', 'Description for product 1', 'https://via.placeholder.com/150/0000FF', 'https://via.placeholder.com/150/FF0000', 'https://via.placeholder.com/150/00FF00', 'https://via.placeholder.com/150/FFFF00', 10.99, 0, 'Red'),
('Product 2', 'Category 2', 'Description for product 2', 'https://via.placeholder.com/150/FF00FF', 'https://via.placeholder.com/150/00FFFF', 'https://via.placeholder.com/150/000000', 'https://via.placeholder.com/150/FFFFFF', 20.99, 1, 'Blue'),
('Product 3', 'Category 3', 'Description for product 3', 'https://via.placeholder.com/150/123456', 'https://via.placeholder.com/150/654321', 'https://via.placeholder.com/150/ABCDEF', 'https://via.placeholder.com/150/FEDCBA', 30.99, 0, 'Green'),
('Product 4', 'Category 4', 'Description for product 4', 'https://via.placeholder.com/150/112233', 'https://via.placeholder.com/150/332211', 'https://via.placeholder.com/150/445566', 'https://via.placeholder.com/150/665544', 40.99, 1, 'Yellow'),
('Product 5', 'Category 5', 'Description for product 5', 'https://via.placeholder.com/150/778899', 'https://via.placeholder.com/150/998877', 'https://via.placeholder.com/150/AABBCC', 'https://via.placeholder.com/150/CCAABB', 50.99, 0, 'Black'),
('Product 6', 'Category 1', 'Description for product 6', 'https://via.placeholder.com/150/123123', 'https://via.placeholder.com/150/321321', 'https://via.placeholder.com/150/456456', 'https://via.placeholder.com/150/654654', 60.99, 1, 'White'),
('Product 7', 'Category 2', 'Description for product 7', 'https://via.placeholder.com/150/789789', 'https://via.placeholder.com/150/987987', 'https://via.placeholder.com/150/ABC123', 'https://via.placeholder.com/150/321CBA', 70.99, 0, 'Red'),
('Product 8', 'Category 3', 'Description for product 8', 'https://via.placeholder.com/150/456789', 'https://via.placeholder.com/150/987654', 'https://via.placeholder.com/150/654321', 'https://via.placeholder.com/150/123456', 80.99, 1, 'Blue'),
('Product 9', 'Category 4', 'Description for product 9', 'https://via.placeholder.com/150/ABCDEF', 'https://via.placeholder.com/150/FEDCBA', 'https://via.placeholder.com/150/112233', 'https://via.placeholder.com/150/332211', 90.99, 0, 'Green'),
('Product 10', 'Category 5', 'Description for product 10', 'https://via.placeholder.com/150/445566', 'https://via.placeholder.com/150/665544', 'https://via.placeholder.com/150/778899', 'https://via.placeholder.com/150/998877', 100.99, 1, 'Yellow'),
('Product 11', 'Category 1', 'Description for product 11', 'https://via.placeholder.com/150/0000FF', 'https://via.placeholder.com/150/FF0000', 'https://via.placeholder.com/150/00FF00', 'https://via.placeholder.com/150/FFFF00', 110.99, 0, 'Black'),
('Product 12', 'Category 2', 'Description for product 12', 'https://via.placeholder.com/150/FF00FF', 'https://via.placeholder.com/150/00FFFF', 'https://via.placeholder.com/150/000000', 'https://via.placeholder.com/150/FFFFFF', 120.99, 1, 'White'),
('Product 13', 'Category 3', 'Description for product 13', 'https://via.placeholder.com/150/123456', 'https://via.placeholder.com/150/654321', 'https://via.placeholder.com/150/ABCDEF', 'https://via.placeholder.com/150/FEDCBA', 130.99, 0, 'Red'),
('Product 14', 'Category 4', 'Description for product 14', 'https://via.placeholder.com/150/112233', 'https://via.placeholder.com/150/332211', 'https://via.placeholder.com/150/445566', 'https://via.placeholder.com/150/665544', 140.99, 1, 'Blue'),
('Product 15', 'Category 5', 'Description for product 15', 'https://via.placeholder.com/150/778899', 'https://via.placeholder.com/150/998877', 'https://via.placeholder.com/150/AABBCC', 'https://via.placeholder.com/150/CCAABB', 150.99, 0, 'Green'),
('Product 16', 'Category 1', 'Description for product 16', 'https://via.placeholder.com/150/123123', 'https://via.placeholder.com/150/321321', 'https://via.placeholder.com/150/456456', 'https://via.placeholder.com/150/654654', 160.99, 1, 'Yellow'),
('Product 17', 'Category 2', 'Description for product 17', 'https://via.placeholder.com/150/789789', 'https://via.placeholder.com/150/987987', 'https://via.placeholder.com/150/ABC123', 'https://via.placeholder.com/150/321CBA', 170.99, 0, 'Black'),
('Product 18', 'Category 3', 'Description for product 18', 'https://via.placeholder.com/150/456789', 'https://via.placeholder.com/150/987654', 'https://via.placeholder.com/150/654321', 'https://via.placeholder.com/150/123456', 180.99, 1, 'White'),
('Product 19', 'Category 4', 'Description for product 19', 'https://via.placeholder.com/150/ABCDEF', 'https://via.placeholder.com/150/FEDCBA', 'https://via.placeholder.com/150/112233', 'https://via.placeholder.com/150/332211', 190.99, 0, 'Red'),
('Product 20', 'Category 5', 'Description for product 20', 'https://via.placeholder.com/150/445566', 'https://via.placeholder.com/150/665544', 'https://via.placeholder.com/150/778899', 'https://via.placeholder.com/150/998877', 200.99, 1, 'Blue'),
('Product 21', 'Category 1', 'Description for product 21', 'https://via.placeholder.com/150/0000FF', 'https://via.placeholder.com/150/FF0000', 'https://via.placeholder.com/150/00FF00', 'https://via.placeholder.com/150/FFFF00', 210.99, 0, 'Green'),
('Product 22', 'Category 2', 'Description for product 22', 'https://via.placeholder.com/150/FF00FF', 'https://via.placeholder.com/150/00FFFF', 'https://via.placeholder.com/150/000000', 'https://via.placeholder.com/150/FFFFFF', 220.99, 1, 'Yellow'),
('Product 23', 'Category 3', 'Description for product 23', 'https://via.placeholder.com/150/123456', 'https://via.placeholder.com/150/654321', 'https://via.placeholder.com/150/ABCDEF', 'https://via.placeholder.com/150/FEDCBA', 230.99, 0, 'Black'),
('Product 24', 'Category 4', 'Description for product 24', 'https://via.placeholder.com/150/112233', 'https://via.placeholder.com/150/332211', 'https://via.placeholder.com/150/445566', 'https://via.placeholder.com/150/665544', 240.99, 1, 'White'),
('Product 25', 'Category 5', 'Description for product 25', 'https://via.placeholder.com/150/778899', 'https://via.placeholder.com/150/998877', 'https://via.placeholder.com/150/AABBCC', 'https://via.placeholder.com/150/CCAABB', 250.99, 0, 'Red'),
('Product 26', 'Category 1', 'Description for product 26', 'https://via.placeholder.com/150/123123', 'https://via.placeholder.com/150/321321', 'https://via.placeholder.com/150/456456', 'https://via.placeholder.com/150/654654', 260.99, 1, 'Blue'),
('Product 27', 'Category 2', 'Description for product 27', 'https://via.placeholder.com/150/789789', 'https://via.placeholder.com/150/987987', 'https://via.placeholder.com/150/ABC123', 'https://via.placeholder.com/150/321CBA', 270.99, 0, 'Green'),
('Product 28', 'Category 3', 'Description for product 28', 'https://via.placeholder.com/150/456789', 'https://via.placeholder.com/150/987654', 'https://via.placeholder.com/150/654321', 'https://via.placeholder.com/150/123456', 280.99, 1, 'Yellow'),
('Product 29', 'Category 4', 'Description for product 29', 'https://via.placeholder.com/150/ABCDEF', 'https://via.placeholder.com/150/FEDCBA', 'https://via.placeholder.com/150/112233', 'https://via.placeholder.com/150/332211', 290.99, 0, 'Black'),
('Product 30', 'Category 5', 'Description for product 30', 'https://via.placeholder.com/150/445566', 'https://via.placeholder.com/150/665544', 'https://via.placeholder.com/150/778899', 'https://via.placeholder.com/150/998877', 300.99, 1, 'White'),
('Product 31', 'Category 1', 'Description for product 31', 'https://via.placeholder.com/150/0000FF', 'https://via.placeholder.com/150/FF0000', 'https://via.placeholder.com/150/00FF00', 'https://via.placeholder.com/150/FFFF00', 310.99, 0, 'Red'),
('Product 32', 'Category 2', 'Description for product 32', 'https://via.placeholder.com/150/FF00FF', 'https://via.placeholder.com/150/00FFFF', 'https://via.placeholder.com/150/000000', 'https://via.placeholder.com/150/FFFFFF', 320.99, 1, 'Blue'),
('Product 33', 'Category 3', 'Description for product 33', 'https://via.placeholder.com/150/123456', 'https://via.placeholder.com/150/654321', 'https://via.placeholder.com/150/ABCDEF', 'https://via.placeholder.com/150/FEDCBA', 330.99, 0, 'Green'),
('Product 34', 'Category 4', 'Description for product 34', 'https://via.placeholder.com/150/112233', 'https://via.placeholder.com/150/332211', 'https://via.placeholder.com/150/445566', 'https://via.placeholder.com/150/665544', 340.99, 1, 'Yellow'),
('Product 35', 'Category 5', 'Description for product 35', 'https://via.placeholder.com/150/778899', 'https://via.placeholder.com/150/998877', 'https://via.placeholder.com/150/AABBCC', 'https://via.placeholder.com/150/CCAABB', 350.99, 0, 'Black'),
('Product 36', 'Category 1', 'Description for product 36', 'https://via.placeholder.com/150/123123', 'https://via.placeholder.com/150/321321', 'https://via.placeholder.com/150/456456', 'https://via.placeholder.com/150/654654', 360.99, 1, 'White'),
('Product 37', 'Category 2', 'Description for product 37', 'https://via.placeholder.com/150/789789', 'https://via.placeholder.com/150/987987', 'https://via.placeholder.com/150/ABC123', 'https://via.placeholder.com/150/321CBA', 370.99, 0, 'Red'),
('Product 38', 'Category 3', 'Description for product 38', 'https://via.placeholder.com/150/456789', 'https://via.placeholder.com/150/987654', 'https://via.placeholder.com/150/654321', 'https://via.placeholder.com/150/123456', 380.99, 1, 'Blue'),
('Product 39', 'Category 4', 'Description for product 39', 'https://via.placeholder.com/150/ABCDEF', 'https://via.placeholder.com/150/FEDCBA', 'https://via.placeholder.com/150/112233', 'https://via.placeholder.com/150/332211', 390.99, 0, 'Green'),
('Product 40', 'Category 5', 'Description for product 40', 'https://via.placeholder.com/150/445566', 'https://via.placeholder.com/150/665544', 'https://via.placeholder.com/150/778899', 'https://via.placeholder.com/150/998877', 400.99, 1, 'Yellow'),
('Product 41', 'Category 1', 'Description for product 41', 'https://via.placeholder.com/150/0000FF', 'https://via.placeholder.com/150/FF0000', 'https://via.placeholder.com/150/00FF00', 'https://via.placeholder.com/150/FFFF00', 410.99, 0, 'Black'),
('Product 42', 'Category 2', 'Description for product 42', 'https://via.placeholder.com/150/FF00FF', 'https://via.placeholder.com/150/00FFFF', 'https://via.placeholder.com/150/000000', 'https://via.placeholder.com/150/FFFFFF', 420.99, 1, 'White'),
('Product 43', 'Category 3', 'Description for product 43', 'https://via.placeholder.com/150/123456', 'https://via.placeholder.com/150/654321', 'https://via.placeholder.com/150/ABCDEF', 'https://via.placeholder.com/150/FEDCBA', 430.99, 0, 'Red'),
('Product 44', 'Category 4', 'Description for product 44', 'https://via.placeholder.com/150/112233', 'https://via.placeholder.com/150/332211', 'https://via.placeholder.com/150/445566', 'https://via.placeholder.com/150/665544', 440.99, 1, 'Blue'),
('Product 45', 'Category 5', 'Description for product 45', 'https://via.placeholder.com/150/778899', 'https://via.placeholder.com/150/998877', 'https://via.placeholder.com/150/AABBCC', 'https://via.placeholder.com/150/CCAABB', 450.99, 0, 'Green'),
('Product 46', 'Category 1', 'Description for product 46', 'https://via.placeholder.com/150/123123', 'https://via.placeholder.com/150/321321', 'https://via.placeholder.com/150/456456', 'https://via.placeholder.com/150/654654', 460.99, 1, 'Yellow'),
('Product 47', 'Category 2', 'Description for product 47', 'https://via.placeholder.com/150/789789', 'https://via.placeholder.com/150/987987', 'https://via.placeholder.com/150/ABC123', 'https://via.placeholder.com/150/321CBA', 470.99, 0, 'Black'),
('Product 48', 'Category 3', 'Description for product 48', 'https://via.placeholder.com/150/456789', 'https://via.placeholder.com/150/987654', 'https://via.placeholder.com/150/654321', 'https://via.placeholder.com/150/123456', 480.99, 1, 'White'),
('Product 49', 'Category 4', 'Description for product 49', 'https://via.placeholder.com/150/ABCDEF', 'https://via.placeholder.com/150/FEDCBA', 'https://via.placeholder.com/150/112233', 'https://via.placeholder.com/150/332211', 490.99, 0, 'Red'),
('Product 50', 'Category 5', 'Description for product 50', 'https://via.placeholder.com/150/445566', 'https://via.placeholder.com/150/665544', 'https://via.placeholder.com/150/778899', 'https://via.placeholder.com/150/998877', 500.99, 1, 'Blue');
