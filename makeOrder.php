<?php

$products = $_POST['products'];

$pdo = new PDO('mysql:host=localhost; dbname=app; charset=utf8', 'root', '');

foreach ($products as $product) {
  $statement = $pdo->prepare('INSERT INTO orders (title, price, quantity)
    VALUES (:title, :price, :quantity)');

  $statement->execute([
    ':title'    => $product['title'],
    ':price'    => $product['price'],
    ':quantity' => $product['quantity']
  ]);
}