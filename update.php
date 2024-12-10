<?php

session_start();
require_once 'auth.php';

// Check if user is logged in
if (!is_logged_in()) {
    header('Location: login.php');
    exit;
}

$host = 'localhost'; 
$dbname = 'animals'; 
$user = 'jacob'; 
$pass = 'jacob';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}


$animal_id = (int)$_GET['animal_id'];

//Fetch Animal
$sql = 'SELECT * FROM animals WHERE animal_id = :animal_id';
$stmt = $pdo->prepare($sql);
$stmt->execute(['animal_id' => $animal_id]);
$animal = $stmt->fetch();

// Handle form submission for updating
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $scientific_name = htmlspecialchars($_POST['scientific_name']);
    $habitat = htmlspecialchars($_POST['habitat']);
    $diet = htmlspecialchars($_POST['diet']);
    $conservation_status = htmlspecialchars($_POST['conservation_status']);
    $fun_fact = htmlspecialchars($_POST['fun_fact']);
}

