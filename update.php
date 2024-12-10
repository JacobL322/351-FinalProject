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

    //Update
    $update_sql = 'UPDATE animals SET name = :name, scientific_name = :scientific_name, habitat = :habitat, diet = :diet, conservation_status = :conservation_status, fun_fact = :fun_fact WHERE animal_id = :animal_id';
    $update_stmt = $pdo->prepare($update_sql);
    $update_stmt->execute([
        'name' => $name,
        'scientific_name' => $scientific_name,
        'habitat' => $habitat,
        'diet' => $diet,
        'conservation_status' => $conservation_status,
        'fun_fact' => $fun_fact,
        'animal_id' => $animal_id
    ]);

    header('location: crud.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;700&display=swap" rel="stylesheet">
    <title>Update - The Animal Archive</title>
</head>

<body>

    <div class="request-container">
        <form method="POST" action="" class="login-form">
            <h1>Update Animal</h1>
            <img src="Animal Archive Logo.png" width= "75px" height = "75px">
            <div class = "request-row">
                <input placeholder = "Name:" class = "form-input" type="text" id="name" name="name" value="<?php echo htmlspecialchars($animal['name']); ?>" required>
                <label class = "form-label" for="name">Name:</label>
            </div>
            <div class = "request-row">
                <input placeholder = "Scientific Name" class = "form-input" type="text" id="scientific_name" name="scientific_name" value="<?php echo htmlspecialchars($animal['scientific_name']); ?>" required>
                <label class = "form-label" for="scientific_name">Scientific Name:</label>
            </div>
            <div class = "request-row">
                <input placeholder = "Habitat:" class = "form-input" type="text" id="habitat" name="habitat" value="<?php echo htmlspecialchars($animal['habitat']); ?>" required>
                <label class = "form-label" for="habitat">Habitat:</label>
            </div>
            <div class = "request-row">
                <input placeholder = "Diet:" class = "form-input" type="text" id="diet" name="diet" value="<?php echo htmlspecialchars($animal['diet']); ?>" required>
                <label class = "form-label" for="diet">Diet:</label>
            </div>
            <div class = "request-row">
                <input placeholder = "Conservation Status:" class = "form-input" type="text" id="conservation_status" name="conservation_status" value="<?php echo htmlspecialchars($animal['conservation_status']); ?>" required>
                <label class = "form-label" for="conservation_status">Conservation Status:</label>
            </div>
            <div class = "request-row">
                <input placeholder = "Fun Fact:" class = "form-input" type="text" id="fun_fact" name="fun_fact" value="<?php echo htmlspecialchars($animal['fun_fact']); ?>" required>
                <label class = "form-label" for="fun_fact">Fun Fact:</label>
            </div>
            <button type="submit" name="submit" class = "submit-button">Update</button>
        </form>
    </div>
</body>
</html>

