CREATE TABLE `category` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary key',
  `title` varchar(128) DEFAULT NULL COMMENT 'Name of the category',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `movie` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary key',
  `category_id` smallint(6) unsigned DEFAULT NULL COMMENT 'Category id',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT 'Title of the movie',
  `price` decimal(5,2) unsigned NOT NULL COMMENT 'Price of the movie',
  `amount` smallint(6) unsigned NOT NULL COMMENT 'Total number of pieces',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `movie_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary key',
  `nick_name` varchar(50) DEFAULT NULL COMMENT 'Nick name',
  `first_name` varchar(128) NOT NULL COMMENT 'First name',
  `last_name` varchar(128) DEFAULT NULL COMMENT 'Last name',
  `email_address` varchar(255) NOT NULL COMMENT 'Email address / login',
  `salt` varchar(128) NOT NULL COMMENT 'Salt for password',
  `password` varchar(128) NOT NULL COMMENT 'Salted password',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether active',
  `last_login` datetime DEFAULT NULL COMMENT 'Date of last login',
  `created_at` datetime NOT NULL COMMENT 'Date of registration',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;