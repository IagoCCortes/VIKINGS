# Vikings

## Descrição
Um site desenvolvido em PHP para controle de registros de cartórios de uma empresa

## Pré-requisitos
* [PHP](https://www.php.net/downloads.php); 
* [Apache](https://www.apachelounge.com/download/);
* [Mysql](https://dev.mysql.com/downloads/mysql/);
* opcionalmente você pode baixar o [XAMPP](https://www.apachefriends.org/download.html), uma distribuição Apache que contém PHP e Mysql;
* as dependencias PHP foram geridas pelo [Composer](https://getcomposer.org/download/).

## Instalação 
Primeiramente edite os scripts 'createDBVIKINGS.php' e '/VIKINGS/Config/db.php' com seus dados de usuário e senha do mysql server.

```php
//createDBVIKINGS.php
$bdd = new PDO('mysql:host=localhost', '<usuario>', '<senha>');
$sql = "CREATE DATABASE IF NOT EXISTS VIKINGS";
$req = $bdd->prepare($sql);
$req->execute();
///VIKINGS/Config/db.php
self::$bdd = new PDO('mysql:dbname=vikings;host=localhost', '<usuario>', '<senha>');
```

Rode [este](http://localhost/VIKINGS/createDBVIKINGS.php) script para criar a base dados: 'VIKINGS', duas tabelas: 'CARTORIOS E USUARIOS' e, 
popular a tabela CARTORIOS com os dados presentes na planilha excel Cartórios (deve estar na mesma pasta do script).  

Depois disso basta acessar o site [aqui](http://localhost/VIKINGS/).

## Contatos
* iagocortes@gmail.com