#!/bin/bash

sudo apt-get -y update

sudo apt-get -y install apache2

echo mysql-server-5.5 mysql-server/root_password password root | debconf-set-selections
echo mysql-server-5.5 mysql-server/root_password_again password root | debconf-set-selections
sudo apt-get -y install mysql-server libapache2-mod-auth-mysql php5-mysql

apt-get install -y php5 libapache2-mod-php5

if ! [ -L /var/www ]; then
	rm -rf /var/www
	ln -fs /vagrant/public /var/www
fi

/etc/init.d/apache2 restart
