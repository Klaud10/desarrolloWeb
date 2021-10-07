<?php

require 'includes/app.php';
$db = conectarDB();                      

// Crear email y pasword
$email = "correo@correo.com";
$password = "123456";

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

var_dump($passwordHash);

// Query para crear el usuario
$query = "INSERT INTO usuarios (email, password) VALUES ('${email}', '${passwordHash}');";

// Agregarlo a la base de datos
mysqli_query($db, $query);
