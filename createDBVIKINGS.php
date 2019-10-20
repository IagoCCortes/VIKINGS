<?php
$bdd = new PDO('mysql:host=localhost', 'ragnar', 'teste0209');
$sql = "CREATE DATABASE IF NOT EXISTS VIKINGS";
$req = $bdd->prepare($sql);
$req->execute();

$bdd = new PDO('mysql:dbname=vikings;host=localhost', 'ragnar', 'teste0209');
$sql = "CREATE TABLE IF NOT EXISTS CARTORIOS
                  (COD INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
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
                  XML_ATUALIZAR TINYINT UNSIGNED NOT NULL DEFAULT 1,
                  CRIADO_EM TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                  ATUALIZADO_EM TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";
$req = $bdd->prepare($sql);
$req->execute();

$bdd = new PDO('mysql:dbname=vikings;host=localhost', 'ragnar', 'teste0209');
$sql = "CREATE TABLE IF NOT EXISTS EMAILS
                  (COD INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
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
                  XML_ATUALIZAR TINYINT UNSIGNED NOT NULL DEFAULT 1,
                  CRIADO_EM TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
$req = $bdd->prepare($sql);
$req->execute();
?>