CREATE DATABASE iskalnik_izdelkov;
USE iskalnik_izdelkov;

SET SQL_MODE='ALLOW_INVALID_DATES';

CREATE TABLE user_types(
    id_user_type INT NOT NULL AUTO_INCREMENT,
    type VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_user_type)
);

CREATE TABLE stores (
    id_store INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    location VARCHAR(255) NOT NULL,
    site_link_url VARCHAR(255),
    online_store_link_url VARCHAR(255),
    PRIMARY KEY (id_store)
);

CREATE TABLE users (
    id_user INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    surname VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    pass VARCHAR(255) NOT NULL,
    verified TINYINT(1) NOT NULL,
    user_type_id INT NOT NULL,
    store_id INT,
    PRIMARY KEY (id_user),
    FOREIGN KEY (user_type_id) REFERENCES user_types(id_user_type)
    ON DELETE RESTRICT ON UPDATE RESTRICT,
    FOREIGN KEY (store_id) REFERENCES stores(id_store)
    ON DELETE RESTRICT ON UPDATE RESTRICT
);

CREATE TABLE products (
    id_product INT NOT NULL AUTO_INCREMENT,
    product_title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(13,2) NOT NULL,
    store_id INT NOT NULL,
    user_id INT NOT NULL,
    online_store_product_url VARCHAR(255),
    date_add Timestamp NOT NULL,
    date_modify Timestamp NOT NULL,
    PRIMARY KEY (id_product),
    FOREIGN KEY (user_id) REFERENCES users(id_user)
    ON DELETE RESTRICT ON UPDATE RESTRICT,
    FOREIGN KEY (store_id) REFERENCES stores(id_store)
    ON DELETE RESTRICT ON UPDATE RESTRICT
);

/*Insert default types*/
INSERT INTO user_types (type) VALUES ("Administrator");
INSERT INTO user_types (type) VALUES ("Store owner");
INSERT INTO user_types (type) VALUES ("users");

/*Insert admin & test users*/
INSERT INTO users (name, surname, email, pass, verified, user_type_id) VALUES ("Vito","Abeln","vito.abeln@gmail.com", "$2y$10$UwNEMiZ7c.Q40TgCIGnUuu4yE8lC0OjQm8h2fwT8gr1Wq7vSJ/8cm",1,1); /* pass = admin */
INSERT INTO users (name, surname, email, pass, verified, user_type_id) VALUES ("test","user","test.user@gmail.com", "$2y$10$vkivFcUlweRu/n60R7L80u2M1RDGrddmAu5f28SO/Dm9nC4L2TOpG",1,3); /* pass = testuser */

/*Insert test stores owner with stores*/
INSERT INTO stores (title, description, location, site_link_url, online_store_link_url) VALUES ("Moja testna trgovina", "To je moj testni opis trgovine", "https://www.google.si/maps/place/Grad+Eken%C5%A1tajn/@46.3535777,15.1210847,15z/data=!4m5!3m4!1s0x476566cbc8a38747:0xbc5920292a7618cb!8m2!3d46.3595701!4d15.1301265","https://www.enduro.si/","https://www.ebay.com/");
INSERT INTO users (name, surname, email, pass, verified, user_type_id, store_id) VALUES ("test","store owner","store.owner@gmail.com", "$2y$10$QzeRbV2u8B8stZDFtlUkte0OCltOmCKpkjnATulHY4YyRzixNdm3a",1,2,1); /* pass = storeowner
/*INSERT INTO products (title, description, price, store_id, user_id, date_add, date_modify) VALUES ();*/