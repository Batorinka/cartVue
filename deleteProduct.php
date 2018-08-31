<?php

$pdo = new PDO('mysql:host=localhost; dbname=app; charset=utf8', 'root', '');

$statement = $pdo->prepare('DELETE FROM products WHERE id=:id');
$statement->execute([':id' => $_POST['product_id']]);