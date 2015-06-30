# php-gsl
PHP game server list.  Game servers can advertise their info, and players can get a list of active servers, which is updated regularly by pinging the servers.


## Connecting Your Game Server to a GSL Server

### Requirements
* A brain (todo)

### Connection Information
* Announce URL: https://gsl.pow7.com/announce/
* Note: Until we have a valid certificate for HTTPS, please ignore warnings or change to http://

### Sample Requests

#### Connect
* https://gsl.pow7.com/announce/?game_name=Game&game_version=0.1&game_mode=Hard&name=MyServer&password=My$ecurePassword&port=42002
* The first step is for your server to Connect. If the server "name" does not exist, it will be created with the supplied password, otherwise the password is used to login to the server account.

##### Additional Parameters
* The server domain name can be supplied as the "host", otherwise the server's IP is used: &host=gameserver24.mydomain.com
* The 2 or 3 letter country code of the server can be set as "country": &country=CA
* The UTM coordinated can be set as "latitude" and "longitude": &latitude=45.42&longitude=-75.69
* The maximum players can be set as "max_players": &max_players=16

##### Return Data
* A JSON object is returned, with these properties:
* "message": The message is "OK" on success, otherwise an error message
* "time": When the server response was sent in unixtime
* A successful connection will also include:
* "session": Your server session ID, encoded in HEX
* "pong_ip", "pong_port": Where your server needs to respond to when receiving a ping from the GSL


#### Disconnect
* https://gsl.pow7.com/announce?session=0000000000000000000000000000000000000000
* It's best to disconnect the server when shutting down


## Running Your Own GSL Server

### Requirements
* Web Server with PHP 5.6+ including extensions: pdo_mysql, sockets, mongo
* MySQL 5.6+

### Installation
* Create a MySQL database and import ./db/mysql/install.sql
* Create a MySQL user with SELECT,INSERT,UPDATE access to that database and update ./conf/db.php with the credentials
* Add your game(s) to the `game` table
* Add modes to `game_mode` table for each game. For example, these could be: Easy, Normal, Hard, etc. or however else you want to group servers
* Create a cron job to run ./cron.sh at a regular interval which updates the server list.
* Make ./htdocs/ the root of a virtual host in your web server. For example, point http://yourserver/ to ./htdocs/

### URLs
* The default server announce URL is: http://yourserver/announce/
* Game List: /games/games.bson
* Mode List for a game named "Game": /games/Game/modes.bson
* Server List for the "Hard" mode of "Game": /games/Game/Hard/servers.bson
* (todo ... not supported yet!) Server List excluding passworded, and only including dedicated servers with anti-cheat protection: /games/Game/Hard/servers/?settings_include[]=Dedicated&settings_include[]=Anti-Cheat&settings_exclude[]=Passworded
* BSON encoding is recommended for it's small size, but the file extensions can be changed to ".json" to view the same data in the human readable JSON format
