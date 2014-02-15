CREATE TABLE `hire` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary key',
  `movie_id` int(10) unsigned DEFAULT NULL COMMENT 'Hired movie',
  `user_id` int(10) unsigned DEFAULT NULL COMMENT 'User who hire',
  `take` datetime NOT NULL COMMENT 'Date of borrow',
  `return` datetime DEFAULT NULL COMMENT 'Date of return',
  PRIMARY KEY (`id`),
  KEY `movie_id` (`movie_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `hire_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  CONSTRAINT `hire_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- hire table is not good enough for statistics due to the following:
-- it is possible to delete movies, users or categories
-- it is possible to change the price of a movie
-- so if some change happened in the referenced record, the statistics would be inaccurate
-- so wee need to store all referenced data historically
