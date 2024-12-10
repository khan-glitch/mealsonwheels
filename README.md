1. Here's the full GitHub file - "https://github.com/khan-glitch/mealsonwheels"

2. git.ignore file includes - 
"/node_modules
/vendor
.env
/storage/*.key
/storage/logs/*.log" 

3. Please reinstall composer by 'composer install' and npm modules by "npm install" in the terminal. After that, please reconfigure the database in env file and change the appname to "Merry Meals" in APPNAME. After that, a few reconfiguration will be need to done in the terminal one being "php artisan key:generate" as an example case. After that, configuration of API key in .env file will be needed, here is the api key - "GOOGLE_MAPS_API_KEY=AIzaSyCKFuBXU6h5HXfiLHmeWEhg6xLBABXsGVg"

4. Cammands to run in the terminal before starting the project
composer install
npm install
npm run build  
Remove-Item -Path public\storage
php artisan storage:link
php artisan key:generate
add .env file to the project (configure the database)
php artisan serve 



6. Here are the APIs used -
 "Directions API
Distance Matrix API
Geocoding API
Geolocation API
Google Cloud APIs
Maps JavaScript API" 

4. Migration will not work for every machines and thus running the following sql script will manually setup the database in MySQL workbench. 

Here is the MySQL script 
"-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema test1
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema test1
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `test1` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `test1` ;

-- -----------------------------------------------------
-- Table `test1`.`cache`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `test1`.`cache` (
  `key` VARCHAR(255) NOT NULL,
  `value` MEDIUMTEXT NOT NULL,
  `expiration` INT NOT NULL,
  PRIMARY KEY (`key`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `test1`.`cache_locks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `test1`.`cache_locks` (
  `key` VARCHAR(255) NOT NULL,
  `owner` VARCHAR(255) NOT NULL,
  `expiration` INT NOT NULL,
  PRIMARY KEY (`key`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `test1`.`donations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `test1`.`donations` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `amount` DECIMAL(10,2) NOT NULL,
  `donated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `test1`.`failed_jobs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `test1`.`failed_jobs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` VARCHAR(255) NOT NULL,
  `connection` TEXT NOT NULL,
  `queue` TEXT NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `exception` LONGTEXT NOT NULL,
  `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `failed_jobs_uuid_unique` (`uuid` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `test1`.`job_batches`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `test1`.`job_batches` (
  `id` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `total_jobs` INT NOT NULL,
  `pending_jobs` INT NOT NULL,
  `failed_jobs` INT NOT NULL,
  `failed_job_ids` LONGTEXT NOT NULL,
  `options` MEDIUMTEXT NULL DEFAULT NULL,
  `cancelled_at` INT NULL DEFAULT NULL,
  `created_at` INT NOT NULL,
  `finished_at` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `test1`.`jobs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `test1`.`jobs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` VARCHAR(255) NOT NULL,
  `payload` LONGTEXT NOT NULL,
  `attempts` TINYINT UNSIGNED NOT NULL,
  `reserved_at` INT UNSIGNED NULL DEFAULT NULL,
  `available_at` INT UNSIGNED NOT NULL,
  `created_at` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `jobs_queue_index` (`queue` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `test2`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `test1`.`users` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone_number` VARCHAR(255) NULL DEFAULT NULL,
  `location` VARCHAR(255) NULL DEFAULT NULL,
  `age` INT NULL DEFAULT NULL,
  `disability` VARCHAR(255) NULL DEFAULT NULL,
  `role` ENUM('member', 'caregiver', 'volunteer', 'partner', 'admin') NOT NULL DEFAULT 'member',
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `password` VARCHAR(255) NOT NULL,
  `remember_token` VARCHAR(100) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `users_email_unique` (`email` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 23
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `test1`.`meals`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `test1`.`meals` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `partner_id` BIGINT UNSIGNED NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `type` ENUM('hot', 'frozen') NOT NULL,
  `description` TEXT NOT NULL,
  `quantity` INT NOT NULL,
  `available_from` TIMESTAMP NOT NULL,
  `available_until` TIMESTAMP NOT NULL,
  `price` DECIMAL(8,2) NOT NULL,
  `image` VARCHAR(255) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `meals_partner_id_foreign` (`partner_id` ASC) VISIBLE,
  CONSTRAINT `meals_partner_id_foreign`
    FOREIGN KEY (`partner_id`)
    REFERENCES `test1`.`users` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 21
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `test1`.`migrations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `test1`.`migrations` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(255) NOT NULL,
  `batch` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 22
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `test1`.`orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `test1`.`orders` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `meal_id` BIGINT UNSIGNED NOT NULL,
  `user_id` BIGINT UNSIGNED NOT NULL,
  `quantity` INT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `status` VARCHAR(255) NOT NULL DEFAULT 'Pending',
  `partner_id` BIGINT UNSIGNED NULL DEFAULT NULL,
  `volunteer_id` BIGINT UNSIGNED NULL DEFAULT NULL,
  `pickup_location` VARCHAR(255) NULL DEFAULT NULL,
  `delivery_location` VARCHAR(255) NULL DEFAULT NULL,
  `user_phone` VARCHAR(255) NULL DEFAULT NULL,
  `partner_phone` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `orders_meal_id_foreign` (`meal_id` ASC) VISIBLE,
  INDEX `orders_user_id_foreign` (`user_id` ASC) VISIBLE,
  INDEX `orders_partner_id_foreign` (`partner_id` ASC) VISIBLE,
  INDEX `orders_volunteer_id_foreign` (`volunteer_id` ASC) VISIBLE,
  CONSTRAINT `orders_meal_id_foreign`
    FOREIGN KEY (`meal_id`)
    REFERENCES `test1`.`meals` (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `orders_partner_id_foreign`
    FOREIGN KEY (`partner_id`)
    REFERENCES `test1`.`users` (`id`)
    ON DELETE SET NULL,
  CONSTRAINT `orders_user_id_foreign`
    FOREIGN KEY (`user_id`)
    REFERENCES `test1`.`users` (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `orders_volunteer_id_foreign`
    FOREIGN KEY (`volunteer_id`)
    REFERENCES `test1`.`users` (`id`)
    ON DELETE SET NULL)
ENGINE = InnoDB
AUTO_INCREMENT = 66
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `test1`.`password_reset_tokens`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `test1`.`password_reset_tokens` (
  `email` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`email`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `test1`.`sessions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `test1`.`sessions` (
  `id` VARCHAR(255) NOT NULL,
  `user_id` BIGINT UNSIGNED NULL DEFAULT NULL,
  `ip_address` VARCHAR(45) NULL DEFAULT NULL,
  `user_agent` TEXT NULL DEFAULT NULL,
  `payload` LONGTEXT NOT NULL,
  `last_activity` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `sessions_user_id_index` (`user_id` ASC) VISIBLE,
  INDEX `sessions_last_activity_index` (`last_activity` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;"

