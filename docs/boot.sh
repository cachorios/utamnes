#!/usr/bin/env bash

sudo yum update

#instalamos Apache

yum -y install  httpd

#resguardamo el conf
cp /etc/httpd/conf/httpd.conf ~/httpd.conf.backup

#Actualizamos la carpeta de acceso web
rm -rf /var/www

ln -fs /vagrant /var/www

# instalamos PHP5

## agregamos estos repositorios
rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm

yum install php56w php56w-opcache php56w-gd php56w-intl php56w-mcrypt php56w-mysqlnd php56w-pdo php56w-pecl-xdebug php56w-xml php55w-ldap php55w-pear php55w-xml ph55w-xmlrpc php55w-snmp php55w-soap

# Reiniciamos el servidor web:

sudo /bin/systemctl enable httpd.service
sudo /bin/systemctl start httpd.service	

echo "ServerName localhost" | sudo tee /etc/apache2/sites-available/fqdn.conf

echo "ServerName localhost" | sudo tee /etc/httpd/conf.d/vhost.conf


# Reiniciamos nuevamente el servidor web:
sudo /bin/systemctl start httpd.service	


#mysql

yum -y install mariadb-server mariadb

systemctl start mariadb

systemctl enable mariadb

#habiliatr firewalld para http
firewall-cmd --permanent --zone=public --add-service=http
firewall-cmd --permanent --zone=public --add-service=https

#Firewall para mysql
firewall-cmd --permanent --zone=public --add-service=mysql

firewall-cmd --reload