--
-- MySQL 5.6.12
-- Sun, 10 Nov 2013 13:26:22 +0000
--

CREATE TABLE `groups` (
   `id` mediumint(8) unsigned not null auto_increment,
   `name` varchar(20) not null,
   `description` varchar(100) not null,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=3;

INSERT INTO `groups` (`id`, `name`, `description`) VALUES 
('1', 'admin', 'Administrator'),
('2', 'members', 'General User');

CREATE TABLE `login_attempts` (
   `id` int(11) unsigned not null auto_increment,
   `ip_address` varbinary(16) not null,
   `login` varchar(100) not null,
   `time` int(11) unsigned,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- [Table `login_attempts` is empty]

CREATE TABLE `users` (
   `id` int(11) unsigned not null auto_increment,
   `ip_address` varbinary(16) not null,
   `username` varchar(100) not null,
   `password` varchar(80) not null,
   `salt` varchar(40),
   `email` varchar(100) not null,
   `activation_code` varchar(40),
   `forgotten_password_code` varchar(40),
   `forgotten_password_time` int(11) unsigned,
   `remember_code` varchar(40),
   `created_on` int(11) unsigned not null,
   `last_login` int(11) unsigned,
   `active` tinyint(1) unsigned,
   `first_name` varchar(50),
   `last_name` varchar(50),
   `company` varchar(100),
   `phone` varchar(20),
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES 
('1', '\0\0', 'administrator', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', 0x39343632653865656530, 'admin@admin.com', '', '', '', '', '1268889823', '1268889823', '1', 'Admin', 'istrator', 'ADMIN', '0');

CREATE TABLE `users_groups` (
   `id` int(11) unsigned not null auto_increment,
   `user_id` int(11) unsigned not null,
   `group_id` mediumint(8) unsigned not null,
   PRIMARY KEY (`id`),
   UNIQUE KEY (`user_id`,`group_id`),
   KEY `fk_users_groups_users1_idx` (`user_id`),
   KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=3;

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES 
('1', '1', '1'),
('2', '1', '2');