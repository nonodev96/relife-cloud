```
     ,-----.,--.                  ,--. ,---.   ,--.,------.  ,------.
    '  .--./|  | ,---. ,--.,--. ,-|  || o   \  |  ||  .-.  \ |  .---'
    |  |    |  || .-. ||  ||  |' .-. |`..'  |  |  ||  |  \  :|  `--, 
    '  '--'\|  |' '-' ''  ''  '\ `-' | .'  /   |  ||  '--'  /|  `---.
     `-----'`--' `---'  `----'  `---'  `--'    `--'`-------' `------'
    ----------------------------------------------------------------- 
```


## Support & Documentation

Visit http://docs.c9.io for support, or to learn more about using Cloud9 IDE. 
To watch some training videos, visit http://www.youtube.com/user/c9ide


## Codeigniter for Api Controller

```
CREATE DATABASE menagerie;
```

## Install Database 

MySQL:

```
mysql-ctl install
phpmyadmin-ctl install
mysql-ctl start
```


## API Rest FULL Modelo W3C HTTP
```
$route['api/user/(:num)']["get"]    = 'User/get/$1';
$route['api/user']["post"]          = 'User/insert';
$route['api/user']["put"]           = 'User/update';
$route['api/user']["delete"]        = 'User/delete';
```

## TimeZone

UP1	--> (UTC + 1:00) Berlin, Brussels, Copenhagen, Madrid, Paris, Rome

## Entornos de trabajo

Los entornos de desarrollo han sido Ubuntu 16.04 Xenial Xerus, utilizando el IDE
Online de Cloud9, y el framework de PHP, Codeigniter para la gestion de los 
controladores de la API REST FULL, usando su gestion de rutas y (POO) 
Programación orienta a objetos.


## Validaciones

```
NICKNAME:
/[a-zA-Z]\w{4,14}/


PASSWORD:
/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/

^: anchored to beginning of string
\S*: any set of characters
(?=\S{8,}): of at least length 8
(?=\S*[a-z]): containing at least one lowercase letter
(?=\S*[A-Z]): and at least one uppercase letter
(?=\S*[\d]): and at least one number
$: anchored to the end of the string

$data["password"] = password_hash($data["password"], PASSWORD_BCRYPT, ["cost" => 12]);

```
