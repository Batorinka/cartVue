<?php

$product = $_POST['product'];

$pdo = new PDO('mysql:host=localhost; dbname=app; charset=utf8', 'root', '');

$statement = $pdo->prepare('INSERT INTO products (title, price, quantity)
  VALUES (:title, :price, :quantity)');

$statement->execute([
  ':title'    => $product['title'],
  ':price'    => $product['price'],
  ':quantity' => $product['quantity']
]);