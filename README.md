## 🔥CRUD App using PHP and My SQL.
It is CRUD app using PHP and My SQL involves database operations Create, Read, Update, Delete.
## 🤔What is a CRUD App?

 - It is a web application can also be called as note taking App or TODO
   App. It involves different database operations like **Create, Read,
   Update, Delete.**
 - You can create new tasks which will be added in your database and will be displayed on the screen.
 - You can edit your task according to you anytime you want.
 - You can also delete any task you want.
 
 ## Run locally on your machine
 
 - Install **XAMPP** in your system and setup XAMPP on your system.
 - Clone this repository in the htdocs directory inside xampp directory.
 - Start **Apache** and **mysql** and run localhost/phpmyadmin and in sql panel run these 2 commands one by one 
	1. CREATE DATABASE IF NOT EXISTS crud;
	2. CREATE TABLE IF NOT EXISTS `crud`.`crud` (`Sno` INT NOT NULL AUTO_INCREMENT , `Title` VARCHAR(255) NOT NULL , `Description` VARCHAR(255) NOT NULL , `Date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`Sno`)) ENGINE = InnoDB;
 - After running these 2 commands run localhost/"directory name" and enjoy this app.
## 😊Thankyou 
 
