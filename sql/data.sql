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

INSERT INTO `user` (`id`, `nick_name`, `first_name`, `last_name`, `email_address`, `salt`, `password`, `is_admin`, `last_login`, `created_at`)
VALUES
	(1, 'johndoe', 'John', 'Doe', 'johndoe@example.com', '47f44fdce2da3dd72f33f7abc8bb9abf', '1e98928d2def658ff8dd3d5277672b48e06ae836', 0, '2014-02-02 13:42:12', '2014-02-02 13:41:12'),
	(2, 'janedoe', 'Jane', 'Doe', 'janedoe@example.com', '0100e73fc3855fbe95bf53882046e6e1', 'd132d5dcea48ae7177b351eadc00086710942f6c', 0, '2014-01-12 05:01:52', '2014-01-12 03:41:12'),
	(3, 'janesmith', 'Jane', 'Smith', 'janesmith@example.com1', '63a23afd2d4a9c1871a586305e398ef3', '9f0cdfb426c733a6f9398d51df46978a91483284', 0, '2014-01-11 15:01:52', '2014-01-11 13:41:12'),
	(4, 'admin', 'admin', 'admin', 'aa@aa.aa', '864cec83dc73522833b416161b91e144', '3c50839cc1ae7e06e93143a2a2cf0e86894661e7', 1, NULL, '2014-01-11 13:41:12');
