# php-gsl
PHP game server list.  Game servers can advertise their info, and players can get a list of active servers, which is updated regularly by pinging the servers.

# Requirements
* Web Server with PHP 5.6+ and PHP extensions: pdo_mysql, sockets
* MySQL 5.6+

# Installation
* Create a MySQL database and import ./db/mysql/install.sql
* Create a MySQL user with SELECT,INSERT,UPDATE access to that database and update ./conf/db.php with the credentials
* Add your game(s) to the "game" table
* Create a cron job to run ./cron.sh every minute
* Make ./htdocs/ the root of a virtual host in your web server. For example, point http://yourserver/ to ./htdocs/

# URLs
* The default server advertise URL is: http://yourserver/advertise/
* Game List: /games.bson
* Server List for Game 1: /game1_servers.bson
