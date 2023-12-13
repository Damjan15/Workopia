<?php

$config = require basePath('config/db.php');
$db = new Database($config);

$id = $_GET['id'];

// Create params array
$params = [
    'id' => $id,
];

// Use a placeholdet and add params array as second argument
$listing = $db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

inspect($listing);
