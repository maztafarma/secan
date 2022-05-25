ALTER TABLE `news` 
ADD COLUMN `publish_by` VARCHAR(45) NULL DEFAULT NULL AFTER `updated_at`;

CREATE TABLE `secan`.`news_comment` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `news_id` INT(10) NOT NULL,
  `fullname` VARCHAR(50) NOT NULL,
  `phone_number` VARCHAR(15) NOT NULL,
  `website_url` VARCHAR(255) NULL DEFAULT NULL,
  `comment` TEXT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`));

ALTER TABLE `secan`.`news_comment` 
ADD COLUMN `updated_at` TIMESTAMP NULL DEFAULT NULL AFTER `created_at`;
