<?php

$totalQuantity = $_POST['totalQuantity'];
$totalPrice = $_POST['totalPrice'];
$products = $_POST['products'];

//Запись в таблицу orders строки с датой, общим количеством и ценой
$pdo = new PDO('mysql:host=localhost; dbname=app; charset=utf8', 'root', '123');

$statement = $pdo->prepare('INSERT INTO orders (totalQuantity, totalPrice)
												VALUES (:totalQuantity, :totalPrice)');

$statement->execute([
	':totalQuantity' => $totalQuantity,
	':totalPrice'    => $totalPrice
]);

//Получение id последнего заказа
$orderId = $pdo->lastInsertId();

//Запись в таблицу productsOfOrders товаров
foreach ($products as $product) {
  $statement = $pdo->prepare('INSERT INTO productsOfOrders (orderId, title, price, quantity)
    														  VALUES (:orderId, :title, :price, :quantity)');

  $statement->execute([
  	':orderId'  => $orderId,
    ':title'    => $product['title'],
    ':price'    => $product['price'],
    ':quantity' => $product['quantity']
  ]);
}