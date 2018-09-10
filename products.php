<?php

$pdo = new PDO('mysql:host=localhost; dbname=app; charset=utf8', 'root', '123');

$statement = $pdo->query('SELECT * FROM products');
$statement->execute();
echo json_encode($statement->fetchAll(PDO::FETCH_ASSOC));