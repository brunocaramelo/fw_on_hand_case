
CREATE DATABASE IF NOT EXISTS hand_admin;
USE hand_admin;



DROP TABLE IF EXISTS permission_role;
DROP TABLE IF EXISTS roles;
DROP TABLE IF EXISTS contacts;
DROP TABLE IF EXISTS permissions;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS messages;


CREATE TABLE `permission_role` ( 
	`id` Int( 255 ) AUTO_INCREMENT NOT NULL,
	`role_id` Int( 255 ) NOT NULL,
	`permission_id` Int( 255 ) NOT NULL,
	CONSTRAINT `role_permission_unique` UNIQUE( `role_id`, `permission_id` ),
	CONSTRAINT `unique_id` UNIQUE( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 18;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE TABLE "roles" ------------------------------------
-- CREATE TABLE "roles" ----------------------------------------
CREATE TABLE `roles` ( 
	`name` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`code` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`description` Text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 5;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE TABLE "contacts" ---------------------------------
-- CREATE TABLE "contacts" -------------------------------------
CREATE TABLE `contacts` ( 
  `code` int(11) NOT NULL,
  `uidcli` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `free1` varchar(255) DEFAULT NULL,
  `free2` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `list_cod` varchar(255) NOT NULL,
  `how_create` int(11) NOT NULL,
  `employee` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `branch_activity` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE TABLE "permissions" ------------------------------
-- CREATE TABLE "permissions" ----------------------------------
CREATE TABLE `permissions` ( 
	`id` Int( 255 ) AUTO_INCREMENT NOT NULL,
	`name` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`slug` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	CONSTRAINT `unique_id` UNIQUE( `id` ),
	CONSTRAINT `unique_slug` UNIQUE( `slug` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 7;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE TABLE "users" ------------------------------------
-- CREATE TABLE "users" ----------------------------------------
CREATE TABLE `users` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`name` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`email` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`password` Text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
	`created_at` DateTime NOT NULL,
	`updated_at` DateTime NOT NULL,
	`api_token` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`role_id` Int( 11 ) NOT NULL,
	CONSTRAINT `email_unique` UNIQUE( `email` ),
	CONSTRAINT `unique_id` UNIQUE( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 9;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- CREATE TABLE "messages" ---------------------------------
-- CREATE TABLE "messages" -------------------------------------
CREATE TABLE `messages` ( 
	`code` Int( 255 ) NOT NULL,
	`sender_name` VarChar( 255 )  NOT NULL,
	`sender_email` VarChar( 255 )  NOT NULL,
	`subject` VarChar( 255 )  NOT NULL,
	`body` VarChar( 255 )  NOT NULL,
	`folder` VarChar( 255 )  NOT NULL,
	`status` VarChar( 255 )  NOT NULL,
	`how_create` Int( 255 ) NOT NULL )
CHARACTER SET = latin1
COLLATE = latin1_swedish_ci
ENGINE = InnoDB;
-- -------------------------------------------------------------
-- ---------------------------------------------------------


-- Dump data of "permission_role" --------------------------
INSERT INTO `permission_role`(`id`,`role_id`,`permission_id`) VALUES ( '1', '1', '1' );
INSERT INTO `permission_role`(`id`,`role_id`,`permission_id`) VALUES ( '2', '1', '2' );
INSERT INTO `permission_role`(`id`,`role_id`,`permission_id`) VALUES ( '3', '1', '3' );
INSERT INTO `permission_role`(`id`,`role_id`,`permission_id`) VALUES ( '4', '1', '4' );
INSERT INTO `permission_role`(`id`,`role_id`,`permission_id`) VALUES ( '5', '1', '5' );
INSERT INTO `permission_role`(`id`,`role_id`,`permission_id`) VALUES ( '6', '2', '1' );
INSERT INTO `permission_role`(`id`,`role_id`,`permission_id`) VALUES ( '7', '2', '2' );
INSERT INTO `permission_role`(`id`,`role_id`,`permission_id`) VALUES ( '8', '2', '3' );
INSERT INTO `permission_role`(`id`,`role_id`,`permission_id`) VALUES ( '9', '3', '3' );
INSERT INTO `permission_role`(`id`,`role_id`,`permission_id`) VALUES ( '10', '3', '4' );
INSERT INTO `permission_role`(`id`,`role_id`,`permission_id`) VALUES ( '11', '3', '5' );
INSERT INTO `permission_role`(`id`,`role_id`,`permission_id`) VALUES ( '12', '3', '6' );
INSERT INTO `permission_role`(`id`,`role_id`,`permission_id`) VALUES ( '13', '4', '3' );
INSERT INTO `permission_role`(`id`,`role_id`,`permission_id`) VALUES ( '14', '4', '4' );
INSERT INTO `permission_role`(`id`,`role_id`,`permission_id`) VALUES ( '15', '5', '5' );
INSERT INTO `permission_role`(`id`,`role_id`,`permission_id`) VALUES ( '16', '5', '6' );
INSERT INTO `permission_role`(`id`,`role_id`,`permission_id`) VALUES ( '17', '1', '6' );
-- ---------------------------------------------------------


-- Dump data of "roles" ------------------------------------
INSERT INTO `roles`(`name`,`code`,`description`,`id`) VALUES ( 'Master', 'master', 'pode fazer: Listar usuarios;
Cadastrar usuario;
Cadastrar listas e contatos;
Cadastrar mensagem;
Enviar mensagem;
Exibir resultados do envio', '1' );
INSERT INTO `roles`(`name`,`code`,`description`,`id`) VALUES ( 'Sub Master', 'submaster', 'Listar usuarios;
Cadastrar usuaio;
Cadastrar listas e contatos;
Cadastrar mensagem;
', '2' );
INSERT INTO `roles`(`name`,`code`,`description`,`id`) VALUES ( 'Enviador Master', 'envitermaster', 'Cadastrar listas e contatos;
Cadastrar mensagem;
Enviar mensagem;
Exibir resultados do envio', '3' );
INSERT INTO `roles`(`name`,`code`,`description`,`id`) VALUES ( 'Criador de Mensagem', 'message-creator', 'Cadastrar listas e contatos;
Cadastrar mensagem;', '4' );
-- ---------------------------------------------------------


-- Dump data of "contacts" ---------------------------------
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '1', '', 'Bruno caramelo', '', '', 'bruno.caramelo5@gmail.com', '', '0', NULL, NULL, NULL, NULL, NULL );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '2', '', 'Comercial', '', '', 'comercial@mediapost.com.br', '1', '1', NULL, NULL, NULL, NULL, NULL );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '3', '', '', '', '', 'emaildois@exemplo.com', '4', '1', NULL, NULL, NULL, NULL, NULL );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '4', '', '', '', '', 'email@exemplo.com', '4', '1', NULL, NULL, NULL, NULL, NULL );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '5', '', '', '', '', 'emailtres@exemplo.com', '4', '1', NULL, NULL, NULL, NULL, NULL );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '20', '5c3424e7aed48', 'esse vai', 'esse foi', 'esse mesmo', 'esse@vai.com', '25', '99', NULL, NULL, NULL, NULL, NULL );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '21', '5c34254960bd3', 'esse vai ok', 'foi tranquilo', 'viu c', 'foi@ok.com.br', '25', '99', NULL, NULL, NULL, NULL, NULL );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '22', '5c3425822a7f1', 'agora aqui', 'viu mando', 'mamama', 'agora@aqui', '15', '99', NULL, NULL, NULL, NULL, NULL );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '23', '5c3425c18997c', 'Esse do mal', 'fo mal', 'msmsms', 'do@mail.com', '14', '99', NULL, NULL, NULL, NULL, NULL );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '24', '5c34263520492', 'Lista do SSS', 'smsmsmsm', 'msmsmsmsm', 'lista@ss.com.br', '21', '99', NULL, NULL, NULL, NULL, NULL );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '25', '5c342deda0bc5', 'contatoo novso', 'giugiug', 'iugigig', 'contatoo@novso.com', '26', '99', NULL, NULL, NULL, NULL, NULL );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '26', '5c342e270abe1', 'oooooooi', 'kgbgiugiugiugiu', 'igiigig', 'hiuhui.iiiii@gmail.com', '26', '99', NULL, NULL, NULL, NULL, NULL );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '27', '5c347755582ea', 'sdfsdfsdf contat', 'asdas', 'sssss', 'sdfsdfsdf@tao.com', '20', '99', NULL, NULL, NULL, NULL, NULL );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '28', '5c353307a7d82', 'maooooe contato', 'livre 1', 'livre 2', 'maoo@ooe.com', '27', '99', NULL, NULL, NULL, NULL, NULL );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '30', '5c353f472f114', 'foiii', 'dad', 'ada', 'foi@ok.com.brs', '6', '1', NULL, NULL, NULL, NULL, NULL );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '31', '5c3572c8764e4', 'adicionaeri', 'camo1', 'camp2', 'email@add.com', '28', '1', NULL, NULL, NULL, NULL, NULL );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '1', '5c3576f5e2fd1', 'Sou eu mesmo', 'maia mai', 'maiaauua', 'bruno.caramelo5@gmail.com', '28', '1', NULL, NULL, NULL, NULL, NULL );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '33', '5c36a36eadcf0', 'dfgdfgdf', 'dfgdf', 'fdgdg', 'dgdfgdg', '4', '1', NULL, NULL, NULL, NULL, NULL );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '34', '5c3a93b6b39b3', 'outro contato mal', 'livre', 'vrrr', 'contato@mau.com.br', '14', '1', NULL, NULL, NULL, NULL, NULL );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '37', '5c3ab182a5766', 'CONTATAO', 'ssss', 'sss', 'contatao@ytal.com', '34', '1', NULL, NULL, NULL, NULL, NULL );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '1', '5c3ab22db2d59', 'Bruno Caramelo Souza', 'coaoa', 'aiaiaiaia', 'bruno.caramelo5@gmail.com', '35', '1', NULL, NULL, NULL, NULL, NULL );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '38', '5c3ab28786f76', 'second', '2222', '12323', 'second@tal.com', '35', '1', 'completa empresa', 'endereco dele', 'ramo dele', 'observao', '21222222' );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '31', '5c3ab2d523f87', 'bla bla bla', 'qqqq', 'www', 'email@add.com', '36', '1', NULL, NULL, NULL, NULL, NULL );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '39', '5c3ab2eced03d', 'hwhwhwhwhw', 'sdsada', 'dasdadasd', 'agora@aqui.com', '36', '1', NULL, NULL, NULL, NULL, NULL );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '40', '5c3ab304cee2e', 'mamamama', 'wdqw', 'iwiwiwiiww', 'email@add.com.br', '36', '1', NULL, NULL, NULL, NULL, NULL );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '28', '5c3ab32799624', 'maooe', 'asas', 'asasa', 'maoo@ooe.com', '37', '1', NULL, NULL, NULL, NULL, NULL );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '27', '5c3ab341e420a', 'iesse aqui', 'eueueueueuueueue', 'eueueueueue', 'sdfsdfsdf@tao.com', '38', '1', NULL, NULL, NULL, NULL, NULL );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '41', '5c3ab35802f22', 'mais ummm', 'dasda', 'oijoij', 'maia@uo.com', '38', '1', NULL, NULL, NULL, NULL, NULL );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '42', '5c3ab373ba486', 'isso ai', 'sadasdasd', 'dsusuus', 'isso@ai.com', '38', '1', NULL, NULL, NULL, NULL, NULL );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '43', '5c3ab38cc2508', 'uuuuu@o', 'ksksksksks', 'aiaiaia', 'ol@uol.com', '38', '1', NULL, NULL, NULL, NULL, NULL );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '44', '5c3ab3a2cee25', 'mais correto.com', 'sdas', 'sadsad', 'maia@uo.com.cn', '39', '1', 'empresona', 'endereco dele', 'ramozao', 'wuwuw', '11111111' );
INSERT INTO `contacts`(`code`,`uidcli`,`name`,`free1`,`free2`,`email`,`list_cod`,`how_create`,`employee`,`address`,`branch_activity`,`note`,`phone`) VALUES ( '45', '5c3ab3b7a74f2', 'uuuuuuoi', 'sadasd', 'jnjinji', 'email@add.com.po', '39', '1', NULL, NULL, NULL, NULL, NULL );

-- ---------------------------------------------------------


-- Dump data of "permissions" ------------------------------
INSERT INTO `permissions`(`id`,`name`,`slug`) VALUES ( '1', 'Listar usuarios', 'list-users' );
INSERT INTO `permissions`(`id`,`name`,`slug`) VALUES ( '2', 'Cadastrar usuario', 'create-users' );
INSERT INTO `permissions`(`id`,`name`,`slug`) VALUES ( '3', 'Cadastrar listas e contatos', 'create-contact-list' );
INSERT INTO `permissions`(`id`,`name`,`slug`) VALUES ( '4', 'Cadastrar mensagem', 'create-message' );
INSERT INTO `permissions`(`id`,`name`,`slug`) VALUES ( '5', 'Enviar mensagem', 'invite-message' );
INSERT INTO `permissions`(`id`,`name`,`slug`) VALUES ( '6', 'Exibir resultados do envio', 'show-message-result' );
-- ---------------------------------------------------------


-- Dump data of "users" ------------------------------------
INSERT INTO `users`(`id`,`name`,`email`,`password`,`created_at`,`updated_at`,`api_token`,`role_id`) VALUES ( '1', 'admin', 'admin@admin.com', '$2y$10$Z7f8NQGrbqq/3F8RuO5r7utL/yAzzlz4uyv8MGin719in/DJwrSpi', '2018-12-23 14:00:00', '2018-12-23 14:00:00', '$2y$10$Z7f8NQGrbqq/3F8RuO5r7utL/yAzzlz4uyv8MGin719in/DJwrSpi', '1' );
INSERT INTO `users`(`id`,`name`,`email`,`password`,`created_at`,`updated_at`,`api_token`,`role_id`) VALUES ( '5', 'criador mensagem mudei', 'criador_mensagem@criador.com', '$2y$10$kN46aOqj.yMyg48ZB/.hsOcYz1fTXwwpUQNbysywihZJgFsbrYske', '2018-12-25 23:27:50', '2018-12-26 02:35:08', '$2y$10$7HGa7x12IXVHqkpzWogZK.8j2sZiRP2k9SzwavM00lqsX05xFVEc2', '4' );
INSERT INTO `users`(`id`,`name`,`email`,`password`,`created_at`,`updated_at`,`api_token`,`role_id`) VALUES ( '8', 'ewwerw', 'eeeee@eee.com', '$2y$10$1fsAwfX2syo74L0JiFYWTeJtgwVvVb4LeZOdw9A9aOObtPR4XSwUi', '2018-12-26 02:45:41', '2018-12-26 02:45:41', '$2y$10$vYeTM51M.juGd92av9CK.uKtq71kn2k6WFf3hMrzLYk6BCTcMi726', '4' );
INSERT INTO `users`(`id`,`name`,`email`,`password`,`created_at`,`updated_at`,`api_token`,`role_id`) VALUES ( '6', 'enviador master mudei', 'enviador@master.com', '$2y$10$DmV6EUgPbm1v0o7iUJJLiu4fEbuRoGzgXaQvl5QfaOIfxO5vqGIXS', '2018-12-26 02:35:37', '2018-12-26 02:36:28', '$2y$10$fXQfLdVHwss8ETY3sihg/uh2GKgzyJ2zWjXBMCiRaOk0c1vsfcMXq', '3' );
INSERT INTO `users`(`id`,`name`,`email`,`password`,`created_at`,`updated_at`,`api_token`,`role_id`) VALUES ( '4', 'testa mudei', 'testa@testa.com', '$2y$10$6nPGjWp.dgmlEc3tjHNGhutTkRGZ6A5CkstKMhuBszPcWSX7qWMMq', '2018-12-24 03:00:15', '2018-12-25 23:04:19', '$2y$10$tpxeN7V0k3MN.loD5h7q/up4bjXNkZzYFIjD4.8Ok1WYEZXtaQ52i', '2' );
INSERT INTO `users`(`id`,`name`,`email`,`password`,`created_at`,`updated_at`,`api_token`,`role_id`) VALUES ( '7', 'teste teste', 'teste@teste.com', '$2y$10$tPjZjHrDUrU5Vw1jYTBDXOzoldh8p0jdlwlkTcPvunz.318bdW7oC', '2018-12-26 02:38:17', '2018-12-26 02:44:46', '$2y$10$rykgmax3a4L5uxZc7//V3uElNLBmU8uyqi9V2ergMgaZ7KyQv3tB.', '2' );
-- ---------------------------------------------------------


-- Dump data of "messages" ---------------------------------
INSERT INTO `messages`(`code`,`sender_name`,`sender_email`,`subject`,`body`,`folder`,`status`,`how_create`) VALUES ( '26', 'Bruno Caramelo Souza', 'bruno.caramelo5@gmail.com', 'vai logo', '<p>Digite sua mensagem.</p><p>Que cuidamos do resto</p><p><br></p>', 'API', 'sended', '1' );
INSERT INTO `messages`(`code`,`sender_name`,`sender_email`,`subject`,`body`,`folder`,`status`,`how_create`) VALUES ( '27', 'Bruno Caramelo Souza', 'bruno.caramelo5@gmail.com', 'segunda mensagenm', '<p>dasdasdasda<strong>asdasdasdasd<u>asdasdas</u></strong></p>', 'API', 'pending', '1' );
INSERT INTO `messages`(`code`,`sender_name`,`sender_email`,`subject`,`body`,`folder`,`status`,`how_create`) VALUES ( '28', 'Bruno Caramelo Souza', 'bruno.caramelo5@gmail.com', 'rtttttttttttttttttt', '<p>Digite sua mensagem.</p><p>Que cuidamos do resto</p><p><br></p>', 'API', 'pending', '1' );
INSERT INTO `messages`(`code`,`sender_name`,`sender_email`,`subject`,`body`,`folder`,`status`,`how_create`) VALUES ( '29', 'Bruno Caramelo Souza', 'bruno.caramelo5@gmail.com', 'aaaaaaaaaaaaaaaaaaaa', '<p>Digite sua mensagem.</p><p>Que cuidamos do resto</p><p>sss</p>', 'API', 'pending', '1' );
INSERT INTO `messages`(`code`,`sender_name`,`sender_email`,`subject`,`body`,`folder`,`status`,`how_create`) VALUES ( '30', 'Bruno Caramelo Souza', 'bruno.caramelo5@gmail.com', 'Como confirmo', '<p>Digite sua mensagem.</p><p>Que cuidamos do resto</p><p><br></p>', 'API', 'sended', '1' );
-- ---------------------------------------------------------




