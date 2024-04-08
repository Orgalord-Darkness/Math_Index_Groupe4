<?php
$user = 'root';
$password = '';
$name = 'mathindex';

try {
    $mysqlClient = new PDO("mysql:host=127.0.0.1;dbname=$name", $user, $password);
    $mysqlClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    /*echo "La Connexion est réussie !";*/
} catch (PDOException $e) {
    echo"La Connexion a échoué !: " . $e->getMessage();
}





