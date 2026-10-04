################################################################################
#                     Create Testing Database for PHPUnit                      #
################################################################################

CREATE SCHEMA IF NOT EXISTS `application_test`;
GRANT ALL PRIVILEGES ON `application_test`.* TO `dbUser`@'%';
FLUSH PRIVILEGES;


