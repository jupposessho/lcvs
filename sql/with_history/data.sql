-- hire some movie
INSERT INTO `hire` (`id`, `movie_id`, `user_id`, `take`)
VALUES
	(1,3,2,'2014-01-01 12:12:12'),
	(2,4,2,'2014-02-02 12:12:12'),
	(3,5,2,'2014-01-15 12:12:12'),
	(4,9,2,'2014-01-18 12:12:12'),
	(5,13,2,'2014-01-21 12:12:12'),
	(6,3,3,'2014-02-11 12:12:12'),
	(7,5,3,'2014-02-01 12:12:12'),
	(8,13,3,'2014-01-01 12:12:12'),
	(9,2,1,'2014-01-01 12:12:12'),
	(10,3,1,'2014-01-01 12:12:12');

-- bring back some
UPDATE `hire_history`
SET `return` = '2014-01-02 12:12:12'
WHERE id = 1;

UPDATE `hire_history`
SET `return` = '2014-01-17 12:12:12'
WHERE id = 3;

UPDATE `hire_history`
SET `return` = '2014-01-20 12:12:12'
WHERE id = 4;

UPDATE `hire_history`
SET `return` = '2014-01-23 12:12:12'
WHERE id = 5;

UPDATE `hire_history`
SET `return` = '2014-02-02 12:12:12'
WHERE id = 7;

UPDATE `hire_history`
SET `return` = '2014-01-03 12:12:12'
WHERE id = 8;

UPDATE `hire_history`
SET `return` = '2014-01-03 12:12:12'
WHERE id = 9;

UPDATE `hire_history`
SET `return` = '2014-01-02 12:12:12'
WHERE id = 10;