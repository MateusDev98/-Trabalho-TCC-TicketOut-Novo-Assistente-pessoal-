-- -----------------------------------------------------
-- Table `site_admin`.`pages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pages` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(200) NOT NULL,
  `url` VARCHAR(200) NOT NULL,
  `body` TEXT NULL,
  `created` DATETIME NOT NULL,
  `updated` DATETIME NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `site_admin`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(200) NOT NULL,
  `pass` VARCHAR(200) NOT NULL,
  `name` VARCHAR(200) NOT NULL,
  `phone` VARCHAR(200) NOT NULL,
  `created` DATETIME NOT NULL,
  `updated` DATETIME NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `site_admin`.`admin`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `admin` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(200) NOT NULL,
  `pass` VARCHAR(200) NOT NULL,
  `created` DATETIME NOT NULL,
  `updated` DATETIME NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `site_admin`.`imap`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `imap` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `imap_email` VARCHAR(200) NOT NULL,
  `imap_pass` VARCHAR(200) NOT NULL,
  `phone` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;
