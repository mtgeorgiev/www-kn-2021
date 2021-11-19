<?php

require_once "./User.php";

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$user = new User($data['email'], $data['password']);

echo json_encode([
    'email' => $user->getEmail(),
]);