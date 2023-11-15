CREATE TABLE annonce (
                id INT PRIMARY KEY AUTO_INCREMENT NOT NULL, 
                brand VARCHAR(20) NOT NULL, 
                model VARCHAR(30) NOT NULL, 
                description LONGTEXT DEFAULT NULL, 
                year INT NOT NULL, 
                mileage INT NOT NULL, 
                fuel_type VARCHAR(20) NOT NULL, 
                transmission VARCHAR(20) NOT NULL, 
                price VARCHAR(255) NOT NULL, 
                img_path1 VARCHAR(255) DEFAULT NULL, 
                img_path2 VARCHAR(255) DEFAULT NULL, 
                img_path3 VARCHAR(255) DEFAULT NULL, 
                img_path4 VARCHAR(255) DEFAULT NULL, 
                img_path5 VARCHAR(255) DEFAULT NULL
);

CREATE TABLE contact_info (
                id INT PRIMARY KEY AUTO_INCREMENT NOT NULL, 
                phone_number VARCHAR(80) DEFAULT NULL, 
                e_mail VARCHAR(80) DEFAULT NULL
);

CREATE TABLE contact_requests (
                id INT PRIMARY KEY  AUTO_INCREMENT NOT NULL, 
                user_first_name VARCHAR(255) DEFAULT NULL, 
                user_last_name VARCHAR(255) DEFAULT NULL, 
                user_e_mail VARCHAR(255) NOT NULL, 
                user_phone_number VARCHAR(255) DEFAULT NULL, 
                subject VARCHAR(255) DEFAULT NULL, 
                user_message VARCHAR(255) DEFAULT NULL
);

CREATE TABLE user (
                id INT PRIMARY KEY  AUTO_INCREMENT NOT NULL, 
                email VARCHAR(180) NOT NULL, 
                roles JSON NOT NULL, 
                password VARCHAR(255) NOT NULL, 
                is_verified TINYINT(1) NOT NULL
);

CREATE TABLE reviews (
                id INT PRIMARY KEY  AUTO_INCREMENT NOT NULL, 
                user_mail_id INT DEFAULT NULL, 
                grade INT NOT NULL, 
                review VARCHAR(100) DEFAULT NULL, 
                was_moderated TINYINT(1) NOT NULL,
                FOREIGN KEY (user_mail_id) REFERENCES user (id) ON DELETE SET NULL
);

CREATE TABLE services (
                id INT PRIMARY KEY  AUTO_INCREMENT NOT NULL, 
                title VARCHAR(255) DEFAULT NULL, 
                description VARCHAR(255) DEFAULT NULL, 
                price INT DEFAULT NULL, 
                img_path VARCHAR(255) DEFAULT NULL
);
  
CREATE TABLE working_hours (
                id INT PRIMARY KEY  AUTO_INCREMENT NOT NULL, 
                monday VARCHAR(30) DEFAULT NULL, 
                tuesday VARCHAR(30) DEFAULT NULL, 
                wednesday VARCHAR(30) DEFAULT NULL, 
                thursday VARCHAR(30) DEFAULT NULL, 
                friday VARCHAR(30) DEFAULT NULL, 
                saturday VARCHAR(30) DEFAULT NULL, 
                sunday VARCHAR(30) DEFAULT NULL
);
