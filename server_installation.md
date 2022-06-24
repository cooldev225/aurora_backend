# Server Installation

## Follow Inscructions on README.md

## check ubuntu version

lsb_release -a

`Release: 20.04`

## install apache2

sudo apt update

sudo apt-get -y install apache2

## Launch artisan server

php artisan serve --port=3000 &

## Allow Firewall port 80 and 443

sudo ufw allow 80

sudo ufw allow 443

sudo ufw allow OpenSSH

sudo ufw enable

sudo ufw status

## Update apache config

sudo nano /etc/apache2/sites-available/000-default.conf

<VirtualHost \*:80>

ProxyPreserveHost On

ProxyRequests Off

ServerName www.example.com

ServerAlias example.com

ProxyPass / http://localhost:3000/

ProxyPassReverse / http://localhost:3000/

</VirtualHost>

### After make these changes, add the needed modules and restart apache

sudo a2enmod proxy && sudo a2enmod proxy_http && sudo service apache2 restart
