CREATE TABLE `hire` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary key',
  `movie_id` int(10) unsigned DEFAULT NULL COMMENT 'Hired movie',
  `user_id` int(10) unsigned DEFAULT NULL COMMENT 'User who hire',
  `take` datetime NOT NULL COMMENT 'Date of borrow',
  PRIMARY KEY (`id`),
  KEY `movie_id` (`movie_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `hire_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  CONSTRAINT `hire_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- we need to store all referenced data historically
CREATE TABLE `hire_history` (
	`id` int(11) unsigned NOT NULL COMMENT 'Primary key',
	`category_id` smallint(6) unsigned NOT NULL COMMENT 'Category id',
	`category_title` varchar(128) DEFAULT NULL COMMENT 'Name of the category',
	`movie_id` int(10) unsigned NOT NULL COMMENT 'Hired movie',
	`movie_title` varchar(255) NOT NULL DEFAULT '' COMMENT 'Title of the movie',
	`price` decimal(5,2) unsigned NOT NULL COMMENT 'Price of the hire',
	`user_id` int(10) unsigned NOT NULL COMMENT 'User who hire',
	`nick_name` varchar(50) DEFAULT NULL COMMENT 'Nick name of the user',
	`take` datetime NOT NULL COMMENT 'Date of borrow',
	`return` datetime DEFAULT NULL COMMENT 'Date of return',
	PRIMARY KEY (`id`),
	KEY `category_id` (`category_id`),
	KEY `movie_id` (`movie_id`),
	KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- the history filled by the next trigger
DELIMITER //
CREATE TRIGGER tr_after_hire_insert AFTER INSERT ON hire
FOR EACH ROW BEGIN

	DECLARE categoryId INT;
	DECLARE categoryTitle VARCHAR(128);
	DECLARE movieTitle VARCHAR(255);
	DECLARE price DECIMAL(5, 2);
	DECLARE nickName VARCHAR(50);

	SELECT u.nick_name
	INTO nickName
	FROM user u
	WHERE u.id = NEW.user_id;

	SELECT c.id, c.title, m.title, m.price
	INTO categoryId, categoryTitle, movieTitle, price
	FROM movie m
	LEFT JOIN category c ON c.id = m.category_id
	WHERE m.id = NEW.movie_id;

	INSERT INTO hire_history
	(`id`, `category_id`, `category_title`, `movie_id`, `movie_title`, `price`, `user_id`, `nick_name`, `take`)
	VALUES
	(NEW.id, categoryId, categoryTitle, NEW.movie_id, movieTitle, price, NEW.user_id, nickName, NEW.take);
END //

-- when a movie has returned the next trigger deletes it from the hire table
DELIMITER //
CREATE TRIGGER tr_after_hire_history_update AFTER UPDATE ON hire_history
FOR EACH ROW BEGIN
	IF (OLD.return IS NULL AND NEW.return IS NOT NULL) THEN
		DELETE FROM hire WHERE id = OLD.id;
	END IF;
END //
