<?php

$pdo = new PDO('mysql:host=mysql;port=3306;dbname=test', 'root', null, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$pdo->exec('SET NAMES utf8mb4');

$pdo->exec('DROP TABLE IF EXISTS `file_log`');
$pdo->exec('CREATE TABLE `file_log` (`id` INT AUTO_INCREMENT PRIMARY KEY, `filename` varbinary(765) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
$pdo->exec("INSERT INTO `file_log` (`filename`) VALUES ('/var/log/foo.log'), ('/var/log/bar.log')");

$stmt = $pdo->prepare('SELECT * FROM `file_log` WHERE `filename` REGEXP ?');
$stmt->execute(['.*']);

var_dump($stmt->fetchAll(PDO::FETCH_ASSOC));