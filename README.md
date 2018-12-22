# php-gsl
PHP game server list.  Game servers can advertise their info, and players can get a list of active servers, which is updated regularly by pinging the servers.



## Getting a Server List from a GSL

### Sample Requests

#### Get Game List
* http://gsl.pow7.com/games/games.json
* http://gsl.pow7.com/games/games.msgpack

#### Get Game Mode List
* http://gsl.pow7.com/games/Game/modes.json
* http://gsl.pow7.com/games/Game/modes.msgpack

#### Get Game Mode Server List
* http://gsl.pow7.com/games/Game/Hard/servers.json
* http://gsl.pow7.com/games/Game/Hard/servers.msgpack



## Connecting Your Game Server to a GSL Server

### Requirements
* Must be able to send/receive UDP, the default listing port is 42002

### Connection Information
* Announce URL: http://gsl.pow7.com/announce/
* Note: HTTPS can be used by ignoring the invalid certificate, we plan to get a valid cert soon

### Sample Requests

#### Connect
* http://gsl.pow7.com/announce/?game_name=Game&game_version=0.1&game_mode=Hard&name=MyServer&password=My$ecurePassword&port=42002
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
* "pong_ip", "pong_port": Where your server needs to respond when receiving a ping from the GSL

#### Disconnect
* http://gsl.pow7.com/announce/disconnect/?session=0000000000000000000000000000000000000000
* Your server should always disconnect when going offline (eg. reboot)

#### Demo Servers
* https://github.com/acerix/psilly-server
* https://github.com/acerix/php-gsl/blob/master/test/dummy_server.php#L2


## Running Your Own GSL Server

### Requirements
* Web Server with PHP 5.6+ including extensions: pdo_mysql, sockets
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
* Game List: /games/games.msgpack
* Mode List for a game named "Game": /games/Game/modes.msgpack
* Server List for the "Hard" mode of "Game": /games/Game/Hard/servers.msgpack
* MessagePack encoding is recommended for production as it is more compact, but the file extensions can be changed to ".json" for the JSON format which is easier to read
