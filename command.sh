sudo apt-get update &&
sudo apt-get dist-upgrade &&
sudo apt-get install apache2 &&
sudo apt-get install software-properties-commo &&
sudo add-apt-repository ppa:ondrej/php &&
sudo apt update &&
sudo apt-get install php7.4 &&
sudo apt install php-curl php-cli php-mbstring git unzip  php7.4-mysql php7.4-dom php7.4-xml php7.4-xmlwriter phpunit php-mbstring php-xml &&
sudo apt install python3-certbot-apache &&

RM-110596-011684
curlydev07



sudo apt install mysql-client-core-8.0     # version 8.0.30-0ubuntu0.20.04.2, or
sudo apt install mariadb-client-core-10.3 

CREATE DATABASE matildas_beauty;

GRANT ALL PRIVILEGES ON *.* TO 'user'@'localhost' IDENTIFIED BY PASSWORD '123456789';
GRANT ALL PRIVILEGES ON *.* TO 'db_user@localhost' IDENTIFIED BY '123456789';
CREATE USER 'user'@'localhost' IDENTIFIED BY '123456789';

GRANT ALL PRIVILEGES ON *.* TO 'user'@'localhost' WITH GRANT OPTION;


ssh -i "C:/Users/Leoneex/Documents/PrivateKeys/mb.pem" ubuntu@34.214.172.85

<VirtualHost *:80>
    ServerAdmin support@ahtcloud.com
    ServerName 34.214.172.85.ca
    ServerAlias www.34.214.172.85.ca
    DocumentRoot /var/www/matildas_beauty/public

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined

    <Directory /var/www/matildas_beauty>
        Require all granted
        AllowOverride All
        Options Indexes Multiviews FollowSymLinks
    </Directory>
</VirtualHost>






niacinamide 170,744
Niacinamide Cream 29,925



 Shampoo and  Conditioner Lifusha Sakura Shampoo

mysql -u user -p matildasbeauty < products.sql

CREATE USER 'local'@'%' IDENTIFIED  BY '123456';