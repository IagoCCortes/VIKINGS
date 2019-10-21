<?php
ini_set('max_execution_time', 0);

require_once 'vendor/autoload.php';

$bdd = new PDO('mysql:host=localhost', 'ragnar', 'teste0209');
$sql = "CREATE DATABASE IF NOT EXISTS VIKINGS";
$req = $bdd->prepare($sql);
$req->execute();

$bdd = new PDO('mysql:dbname=vikings;host=localhost', 'ragnar', 'teste0209');
$sql = "CREATE TABLE IF NOT EXISTS CARTORIOS
                  (COD INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
                  NOME VARCHAR(255) NOT NULL,
                  RAZAO VARCHAR(255) NOT NULL,
                  DOCUMENTO BIGINT UNSIGNED NOT NULL,
                  CEP VARCHAR(8) NOT NULL,
                  ENDERECO VARCHAR(255) NOT NULL,
                  BAIRRO VARCHAR(255) NOT NULL,
                  CIDADE VARCHAR(255) NOT NULL,
                  UF VARCHAR(2) NOT NULL,
                  TELEFONE VARCHAR(20),
                  EMAIL VARCHAR(255),
                  TABELIAO VARCHAR(255),
                  ATIVO TINYINT UNSIGNED NOT NULL,
                  XML_ATUALIZAR TINYINT UNSIGNED NOT NULL DEFAULT 0,
                  CRIADO_EM TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                  ATUALIZADO_EM TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";
$req = $bdd->prepare($sql);
$req->execute();

$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
if($reader) {
  $reader->setReadDataOnly(true);
  $spreadsheet = $reader->load('Cartórios.xlsx');  
  $sheetData = $spreadsheet->getActiveSheet()->toArray();

  foreach($sheetData as $row) {
    // get columns
    $nome = isset($row[0]) ? $row[0] : "";
    $razao = isset($row[1]) ? $row[1] : "";
    $documento = isset($row[2]) ? $row[2] : "";
    $cep = isset($row[3]) ? $row[3] : "";
    $endereco = isset($row[4]) ? $row[4] : "";
    $bairro = isset($row[5]) ? $row[5] : "";
    $cidade = isset($row[6]) ? $row[6] : "";
    $uf = isset($row[7]) ? $row[7] : "";
    $telefone = isset($row[8]) ? $row[8] : "";
    $email = isset($row[9]) ? $row[9] : "";
    $tabeliao = isset($row[10]) ? $row[10] : "";
    $ativo = $row[11] == 'SIM' ? 1 : 0;

    // insert item
    $query = "INSERT INTO cartorios(NOME, RAZAO, DOCUMENTO, CEP, ENDERECO, BAIRRO, CIDADE, UF, TELEFONE, EMAIL, TABELIAO, ATIVO) ";
    $query .= "values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $req = $bdd->prepare($query);
    $req->execute(array($nome, $razao, $documento, $cep, $endereco, $bairro, $cidade, $uf, $telefone, $email, $tabeliao, $ativo));
  }
}

$sql = "CREATE TABLE IF NOT EXISTS USUARIOS
                  (COD INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
                  USERNAME TINYTEXT  NOT NULL,
                  EMAIL TINYTEXT  NOT NULL,
                  PASSWORD LONGTEXT NOT NULL,
                  CRIADO_EM TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                  ATUALIZADO_EM TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";
$req = $bdd->prepare($sql);
$req->execute();
?>