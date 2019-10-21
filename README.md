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

## Funcionamento
Ao acessar o site o usuário é automaticamente redirecionado para 'Root/index.php' que realizará os requires nos arquivos necessários para a classe Dispatcher.
Esta recebe da classe Request a url requisitada pelo o usuário e a divide, por meio da classe Router, em domínio, controlador e ação. Baseado nas últimas duas 
partes da url o dispatcher chama o controlador correto e executa a ação requisitada.

Durante a execução da ação, caso necessário, o controlador requisita dados do banco de dados para o modelo condizente ao seu controlador e este modelo, realizará 
a conexão com o bd, por meio da classe singleton Database, realizará o comando sql e, caso o comando tenha sido um select retornará os dados para o controlador que 
os repassará para a view solicitada pelo usuário.

## Funcionalidades
- [x] Visualização dos dados dos cartórios
    - [x] Paginação
    - [x] Search bar
- [x] Criação de registros de cartórios
    - [x] Manual
    - [x] por meio de arquivo xml
- [x] Edição dos registros cadastrados
- [x] Possibilidade de deletar registros
- [x] Enviar email para emails presentes no relatório
    - [X] enviar para todos
    - [X] enviar somente para os emails ligados a registros ativos
- [x] Permitir exportar os dados de cartorios pra uma planilha excel
- [ ] Autenticação
    - [X] Sign Up
    - [X] Login
    - [X] Logout
    - [ ] Criação de perfis (controle de acesso)
- [ ] Mensagens de erro/sucesso 

## Contatos
* iagocortes@gmail.com