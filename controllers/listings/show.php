<?php

$config = require basePath('config/db.php');
$db = new Database($config);

$id = $_GET['id'];

// Create params arrays
$params = [
    'id' => $id,
];


// Use a placeholder and add params array as second arguments
$listing = $db->query('SELECT * FROM listings WHERE id = :id = ' . $params)->fetch();

inspect($listing);
