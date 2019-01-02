-- Valentina Studio --
-- MySQL dump --
-- ---------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- ---------------------------------------------------------

CREATE DATABASE IF NOT EXISTS hand_admin;
USE hand_admin;

-- CREATE TABLE "permission_role" --------------------------
-- CREATE TABLE "permission_role" ------------------------------
CREATE TABLE `permission_role` ( 
	`id` Int( 255 ) AUTO_INCREMENT NOT NULL,
	`role_id` Int( 255 ) NOT NULL,
	`permission_id` Int( 255 ) NOT NULL,
	CONSTRAINT `role_permission_unique` UNIQUE( `role_id`, `permission_id` ),
	CONSTRAINT `unique_id` UNIQUE( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 17;
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
CHARACTER SET =utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 5;
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
-- ---------------------------------------------------------


-- Dump data of "roles" ------------------------------------
INSERT INTO `roles`(`name`,`code`,`description`,`id`) VALUES ( 'Master', 'master', 'pode fazer: Listar usuários;
Cadastrar usuário;
Cadastrar listas e contatos;
Cadastrar mensagem;
Enviar mensagem;
Exibir resultados do envio', '1' );
INSERT INTO `roles`(`name`,`code`,`description`,`id`) VALUES ( 'Sub Master', 'submaster', 'Listar usuários;
Cadastrar usuário;
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


-- Dump data of "permissions" ------------------------------
INSERT INTO `permissions`(`id`,`name`,`slug`) VALUES ( '1', 'Listar usuários', 'list-users' );
INSERT INTO `permissions`(`id`,`name`,`slug`) VALUES ( '2', 'Cadastrar usuário', 'create-users' );
INSERT INTO `permissions`(`id`,`name`,`slug`) VALUES ( '3', 'Cadastrar listas e contatos', 'create-contact-list' );
INSERT INTO `permissions`(`id`,`name`,`slug`) VALUES ( '4', 'Cadastrar mensagem', 'create-message' );
INSERT INTO `permissions`(`id`,`name`,`slug`) VALUES ( '5', 'Enviar mensagem', 'invite-message' );
INSERT INTO `permissions`(`id`,`name`,`slug`) VALUES ( '6', 'Exibir resultados do envio', 'show-message-result' );
-- ---------------------------------------------------------


-- Dump data of "users" ------------------------------------
INSERT INTO `users`(`id`,`name`,`email`,`password`,`created_at`,`updated_at`,`api_token`,`role_id`) VALUES ( '1', 'admin', 'admin@admin.com', '$2y$10$Z7f8NQGrbqq/3F8RuO5r7utL/yAzzlz4uyv8MGin719in/DJwrSpi', '2018-12-23 14:00:00', '2018-12-23 14:00:00', '$2y$10$Z7f8NQGrbqq/3F8RuO5r7utL/yAzzlz4uyv8MGin719in/DJwrSpi', '1' );
INSERT INTO `users`(`id`,`name`,`email`,`password`,`created_at`,`updated_at`,`api_token`,`role_id`) VALUES ( '4', 'testa mudei', 'testa@testa.com', '$2y$10$6nPGjWp.dgmlEc3tjHNGhutTkRGZ6A5CkstKMhuBszPcWSX7qWMMq', '2018-12-24 03:00:15', '2018-12-25 23:04:19', '$2y$10$tpxeN7V0k3MN.loD5h7q/up4bjXNkZzYFIjD4.8Ok1WYEZXtaQ52i', '2' );
INSERT INTO `users`(`id`,`name`,`email`,`password`,`created_at`,`updated_at`,`api_token`,`role_id`) VALUES ( '5', 'criador mensagem mudei', 'criador_mensagem@criador.com', '$2y$10$kN46aOqj.yMyg48ZB/.hsOcYz1fTXwwpUQNbysywihZJgFsbrYske', '2018-12-25 23:27:50', '2018-12-26 02:35:08', '$2y$10$7HGa7x12IXVHqkpzWogZK.8j2sZiRP2k9SzwavM00lqsX05xFVEc2', '4' );
INSERT INTO `users`(`id`,`name`,`email`,`password`,`created_at`,`updated_at`,`api_token`,`role_id`) VALUES ( '6', 'enviador master mudei', 'enviador@master.com', '$2y$10$DmV6EUgPbm1v0o7iUJJLiu4fEbuRoGzgXaQvl5QfaOIfxO5vqGIXS', '2018-12-26 02:35:37', '2018-12-26 02:36:28', '$2y$10$fXQfLdVHwss8ETY3sihg/uh2GKgzyJ2zWjXBMCiRaOk0c1vsfcMXq', '3' );
INSERT INTO `users`(`id`,`name`,`email`,`password`,`created_at`,`updated_at`,`api_token`,`role_id`) VALUES ( '7', 'teste teste', 'teste@teste.com', '$2y$10$tPjZjHrDUrU5Vw1jYTBDXOzoldh8p0jdlwlkTcPvunz.318bdW7oC', '2018-12-26 02:38:17', '2018-12-26 02:44:46', '$2y$10$rykgmax3a4L5uxZc7//V3uElNLBmU8uyqi9V2ergMgaZ7KyQv3tB.', '2' );
INSERT INTO `users`(`id`,`name`,`email`,`password`,`created_at`,`updated_at`,`api_token`,`role_id`) VALUES ( '8', 'ewwerw', 'eeeee@eee.com', '$2y$10$1fsAwfX2syo74L0JiFYWTeJtgwVvVb4LeZOdw9A9aOObtPR4XSwUi', '2018-12-26 02:45:41', '2018-12-26 02:45:41', '$2y$10$vYeTM51M.juGd92av9CK.uKtq71kn2k6WFf3hMrzLYk6BCTcMi726', '4' );
-- ---------------------------------------------------------


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------


