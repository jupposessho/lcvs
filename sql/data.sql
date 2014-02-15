INSERT INTO `category` (`id`, `title`)
VALUES
	(1,'Comedy'),
	(2,'Crime'),
	(3,'Thriller'),
	(4,'Adventure'),
	(5,'Family'),
	(6,'Fantasy'),
	(7,'Action'),
	(8,'Horror'),
	(9,'Romance'),
	(10,'Drama');


INSERT INTO `movie` (`id`, `category_id`, `title`, `price`, `amount`)
VALUES
	(1,7,'Transformers: Age of Extinction',2.00,4),
	(2,7,'Captain America: The Winter Soldier',3.00,1),
	(3,7,'The Hunger Games: Catching Fire',1.00,3),
	(4,7,'RoboCop',2.99,2),
	(5,3,'Lone Survivor',1.99,3),
	(6,3,'Escape Plan',1.59,1),
	(7,3,'Homefront',1.89,2),
	(8,5,'Frozen',1.49,3),
	(9,5,'The Lego Movie',0.99,2),
	(10,8,'Warm Bodies',1.29,3),
	(11,8,'Zombieland',0.99,4),
	(12,8,'Dark Shadows',0.99,2),
	(13,9,'Silver Linings Playbook',1.69,5),
	(14,9,'Along Came Polly',1.89,3);

INSERT INTO `user` (`id`, `nick_name`, `first_name`, `last_name`, `email_address`, `salt`, `password`, `is_active`, `last_login`, `created_at`)
VALUES
	(1,'johndoe','John','Doe','johndoe@example.com','sjhcbwkcbwebvewjvbewjv','ifn349fgn283h4072fhf8',1,'2014-02-02 13:42:12','2014-02-02 13:41:12'),
	(2,'janedoe','Jane','Doe','janedoe@example.com','s234kdsf34sdfdsjvbewjv','ifwr24249fgn283h4072fhf8',1,'2014-01-12 05:01:52','2014-01-12 03:41:12'),
	(3,'janesmith','Jane','Smith','janesmith@example.com','s23jn34k53k53k5jvbewjv','kj435kj353k4j5h34k4072fhf8',0,'2014-01-11 15:01:52','2014-01-11 13:41:12');
