# Ver Configuracion de ip #

	ifconfig eth0
	o
	ip a show eth0
	o
	ip addr list eth0 | awk '/inet /{sub(/\/[0-9]+/,"",$2); print $2}'
	o
	ifconfig eth0 | awk '/inet /{print $2}'

# Instalar Apache #

	sudo yum install httpd
	o
	yum --enablerepo=remi,remi-php56 install httpd php php-common

### Para crear el servicio ###

	sudo systemctl enable httpd.service

### Para desactivar el serivicio ###

	sudo systemctl disable httpd.service

### Para iniciar el servicio ###
	sudo systemctl start httpd.service

### para parar el servicio ###

	sudo systemctl stop httpd.service

### Reiniciar el servicio ###

	sudo systemctl restart httpd.service

### Estado del servicio ###

	sudo systemctl is-active httpd.service

### permiso de acceso  ###

	sudo firewall-cmd --permanent --zone=public --add-service=http 

### httpd service default configuration ###

	Default config file: /etc/httpd/conf/httpd.conf
	Configuration files which load modules : /etc/httpd/conf.modules.d/ directory (e.g. PHP)
	Select MPMs (Processing Model) as loadable modules [worker, prefork (default)] and event: /etc/httpd/conf.modules.d/00-mpm.conf
	Default ports: 80 and 443 (SSL)
	Default log files: /var/log/httpd/{access_log,error_log}

# PHP #

	yum --enablerepo=remi,remi-php56 install php-pecl-apcu php-cli php-pear php-pdo 	php-mysqlnd 
	php-pgsql php-pecl-mongo php-sqlite php-pecl-memcache php-pecl-memcached php-gd php-mbstring php-mcrypt php-xml

# POstgres 9.4 #

	rpm -Uvh http://yum.postgresql.org/9.4/redhat/rhel-7-x86_64/pgdg-centos94-9.4-1.noarch.rpm

	yum -y update

	yum install postgresql94-server postgresql94-contrib

### Servicio ###
	
	systemctl enable postgresql-9.4

### Iniciar Postgres ###

	/usr/pgsql-9.4/bin/postgresql94-setup initdb

	systemctl start postgresql-9.4

### Ajusar Iptables/Firewall ###

	firewall-cmd --permanent --add-port=5432/tcp
	firewall-cmd --permanent --add-port=80/tcp
	firewall-cmd --reload

### cambiando la clave de postgres ###

	como root

	su - postgres

	psql

	\password postgres 

	CREATE EXTENSION adminpack;

	\q

### configurar postgres hba ###

	nano /var/lib/pgsql/9.4/data/pg_hba.conf

### Configurar tcp/ip ###

	nano /var/lib/pgsql/9.4/data/postgresql.conf

### phppgAdmin ###

	yum install epel-release
	
	yum update
	
	yum install phpPgAdmin httpd

	nano /etc/httpd/conf.d/phpPgAdmin.conf


#Composer#

	curl -s https://getcomposer.org/installer | php

	sudo mv composer.phar /usr/local/bin/composer

# GIT #

	sudo yum install git-core

