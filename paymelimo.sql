
/* create merchant */

CREATE TABLE `paymelimo`.`mechants` (`id` INT NOT NULL AUTO_INCREMENT , `firstname` VARCHAR(50) NOT NULL , `lastname` VARCHAR(50) NOT NULL , `title` VARCHAR(100) NOT NULL , `dba` VARCHAR(100) NOT NULL , `phone_number` VARCHAR(50) NOT NULL , `email` VARCHAR(50) NOT NULL , `corporate_name` VARCHAR(100) NOT NULL , `website` VARCHAR(50) NOT NULL , `street_address` VARCHAR(200) NOT NULL , `city` VARCHAR(50) NOT NULL , `state` VARCHAR(50) NOT NULL , `zip` VARCHAR(10) NOT NULL , `country` VARCHAR(50) NOT NULL , `fax` VARCHAR(50) NOT NULL , `add_contact_name` VARCHAR(50) NOT NULL , `add_contact_title` VARCHAR(100) NOT NULL , `add_contact_phonenumber` VARCHAR(50) NOT NULL , `status` INT NOT NULL COMMENT '0-lead' , `created_datetime` TIMESTAMP NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;


ALTER TABLE `mechants` CHANGE `firstname` `firstname` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL, CHANGE `lastname` `lastname` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL, CHANGE `title` `title` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL, CHANGE `dba` `dba` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL, CHANGE `phone_number` `phone_number` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL, CHANGE `email` `email` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL, CHANGE `corporate_name` `corporate_name` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL, CHANGE `website` `website` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL, CHANGE `street_address` `street_address` VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL, CHANGE `city` `city` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL, CHANGE `state` `state` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL, CHANGE `zip` `zip` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL, CHANGE `country` `country` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL, CHANGE `fax` `fax` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL, CHANGE `add_contact_name` `add_contact_name` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL, CHANGE `add_contact_title` `add_contact_title` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL, CHANGE `add_contact_phonenumber` `add_contact_phonenumber` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL, CHANGE `created_datetime` `created_datetime` TIMESTAMP NULL;

ALTER TABLE `mechants` ADD `token` LONGTEXT NULL AFTER `status`;

/* create merchant */

/* Create Application table */
CREATE TABLE `paymelimo`.`application` (`id` INT NOT NULL AUTO_INCREMENT , `appId` INT NOT NULL , `pendingPaymentSiteUrl` VARCHAR(255) NOT NULL , `refnum` INT NOT NULL , `created_at` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
/* Create Application table */

ALTER TABLE paymelimo.application
ADD COLUMN signature_token LONGTEXT NULL AFTER created_at;

/* Create Application table */
CREATE TABLE `paymelimo`.`application` (`id` INT NOT NULL AUTO_INCREMENT , `appId` INT NOT NULL , `pendingPaymentSiteUrl` VARCHAR(255) NOT NULL , `refnum` INT NOT NULL , `created_at` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
/* Create Application table */

ALTER TABLE paymelimo.application
ADD COLUMN signature_token LONGTEXT NULL AFTER created_at;

ALTER TABLE `paymelimo`.`mechants` 
ADD COLUMN `mpa_form_email` INT NULL DEFAULT 0 AFTER `updated_at`;


ALTER TABLE `paymelimo`.`application` 
ADD COLUMN `dba_name` VARCHAR(200) NULL DEFAULT NULL AFTER `signature_token`;


ALTER TABLE paymelimo.mechants
ADD COLUMN appId INT NULL DEFAULT 0 AFTER mpa_form_email,
ADD COLUMN pendingPaymentSiteUrl VARCHAR(100) NULL DEFAULT NULL AFTER appId;
--
ALTER TABLE paymelimo.mechants
ADD COLUMN signature_token LONGTEXT NULL AFTER pendingPaymentSiteUrl;

CREATE TABLE merchant_customer (
id int NOT NULL AUTO_INCREMENT,
customer_id varchar(255) NOT NULL,
merchant_user_id int NOT NULL,
created_at datetime DEFAULT NULL,
updated_at datetime DEFAULT NULL,
PRIMARY KEY (id),
UNIQUE KEY id_UNIQUE (id)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
SELECT * FROM paymelimo.merchant_customer;

ALTER TABLE paymelimo.mechants
ADD COLUMN mpa_form_email INT NULL DEFAULT 0 AFTER updated_at;