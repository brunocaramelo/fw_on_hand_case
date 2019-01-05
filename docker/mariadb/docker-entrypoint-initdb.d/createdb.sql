###
### Copy createdb.sql.example to createdb.sql
### then uncomment then set database name and username to create you need databases
#
# example: .env MYSQL_USER=appuser and need db name is myshop_db
#
CREATE DATABASE IF NOT EXISTS `hand_admin` ;
CREATE USER 'sandbox'@'%' IDENTIFIED BY 'sandbox';
CREATE USER 'root'@'%' IDENTIFIED BY 'testes';

GRANT ALL ON `hand_admin`.* TO 'root'@'%' ;
GRANT ALL ON `hand_admin`.* TO 'sandbox'@'%' ;

FLUSH PRIVILEGES ;
