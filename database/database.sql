DROP DATABASE IF EXISTS `digital_magazine`;
CREATE DATABASE `digital_magazine`;

CREATE TABLE IF NOT EXISTS `digital_magazine`.`issues` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `date` DATE NOT NULL,
    `published` DATE,
    PRIMARY KEY (`id`)
) ENGINE=INNODB CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `digital_magazine`.`articles` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `slug` VARCHAR(60) NOT NULL,
    `headline` VARCHAR(255) NOT NULL,
    `issue_id` INT UNSIGNED NOT NULL,
    CONSTRAINT `articles_issue` 
        FOREIGN KEY (`issue_id`) REFERENCES issues(`id`),
    PRIMARY KEY (`id`),
    UNIQUE `slug_unique` (`slug`)
) ENGINE=INNODB CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `digital_magazine`.`people` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(60) NOT NULL,
    `last_name` VARCHAR(60) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `position` ENUM(
        'writer', 
        'editor', 
        'photographer', 
        'staff'
    ) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=INNODB CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `digital_magazine`.`articles_people` (
    `article_id` INT UNSIGNED NOT NULL,
    `person_id` INT UNSIGNED NOT NULL,
    CONSTRAINT `articles_people_article`
        FOREIGN KEY (`article_id`)
        REFERENCES articles(`id`),
    CONSTRAINT `articles_people_person`
        FOREIGN KEY (`person_id`)
        REFERENCES people(`id`)
) ENGINE=INNODB CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert testing records

INSERT INTO `digital_magazine`.`issues` (`name`, `date`, `published`) VALUES
    ('September - 2026', '2026-09-01', NULL)
    , ('October - 2026', '2026-10-01', NULL)
    , ('November - 2026', '2026-11-01', NULL)
    , ('December - 2026', '2026-12-01', NULL)
;

INSERT INTO `digital_magazine`.`articles` (`slug`, `headline`, `issue_id`) VALUES
      ('dog', 'Dog found making den in tree', 1)        
    , ('cat', 'Cat wakes owner by baking pie', 1)        
    , ('donkey', 'Award-winning donkey known best for excellent singing', 2)        
    , ('shanties', 'Sea Shanties - top picks for your weekend', 2)        
    , ('grass', '"Their grass was already cut!" - gardener puzzled by neighbourhood lawn', 3)        
    , ('php-tips', 'Five PHP tips your doctor will hate you for - number 4 is insane!', 3)        
    , ('sql-secrets', 'Secrets of SQL - how to write a query that will leave you puzzled in two years', 4)        
;

INSERT INTO `digital_magazine`.`people` (`first_name`, `last_name`, `email`, `position`) VALUES 
    ('Nick', 'Ireland', 'nireland@fanshawec.ca', 'writer')
    , ('Imaginary', 'Editor', 'nireland@fanshawec.ca', 'editor')
;

INSERT INTO `digital_magazine`.`articles_people` (`article_id`, `person_id`) VALUES
    (1, 1)
    , (2, 1)
    , (3, 1)
    , (3, 2)
    , (4, 1)
    , (5, 1)
    , (6, 1)
    , (6, 2)
    , (7, 1)
    , (7, 2)
;
