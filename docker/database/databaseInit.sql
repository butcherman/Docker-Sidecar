################################################################################
#                Create Initial Database and Tech Bench User                   #
################################################################################

# Create Tech Bench Database
CREATE SCHEMA IF NOT EXISTS `application`;

# Create the TB User
CREATE USER IF NOT EXISTS 'dbUser'@'%' IDENTIFIED WITH caching_sha2_password BY 'applicationDatabase';
GRANT ALL PRIVILEGES ON `application`.* TO 'dbUser'@'%';
FLUSH PRIVILEGES;
