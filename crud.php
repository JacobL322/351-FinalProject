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

// Handle Animal Search
$search_results = null;
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search_term = '%' . $_GET['search'] . '%';
    $search_sql = 'SELECT animal_id, name, scientific_name, habitat, diet, conservation_status, fun_fact FROM animals WHERE name LIKE :search';
    $search_stmt = $pdo->prepare($search_sql);
    $search_stmt->execute(['search' => $search_term]);
    $search_results = $search_stmt->fetchAll();
}

// Handle Form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['name']) && isset($_POST['scientific_name']) && isset($_POST['habitat']) && isset($_POST['diet']) && isset($_POST['conservation_status']) && isset($_POST['fun_fact'])) {
        // Insert new entry
        $name = htmlspecialchars($_POST['name']);
        $scientific_name = htmlspecialchars($_POST['scientific_name']);
        $habitat = htmlspecialchars($_POST['habitat']);
        $diet = htmlspecialchars($_POST['diet']);
        $conservation_status = htmlspecialchars($_POST['conservation_status']);
        $fun_fact = htmlspecialchars($_POST['fun_fact']);
        
        $insert_sql = 'INSERT INTO animals (name, scientific_name, habitat, diet, conservation_status, fun_fact) VALUES (:name, :scientific_name, :habitat, :diet, :conservation_status, :fun_fact)';
        $stmt_insert = $pdo->prepare($insert_sql);
        $stmt_insert->execute(['name' => $name, 'scientific_name' => $scientific_name, 'habitat' => $habitat, 'diet' => $diet, 'conservation_status' => $conservation_status, 'fun_fact' => $fun_fact]);
    } elseif (isset($_POST['delete_animal_id'])) {
        // Delete an entry
        $delete_animal_id = (int) $_POST['delete_animal_id'];
        
        $delete_sql = 'DELETE FROM animals WHERE animal_id = :animal_id';
        $stmt_delete = $pdo->prepare($delete_sql);
        $stmt_delete->execute(['animal_id' => $delete_animal_id]);
    }
}

// Get all Animals for main table
$sql = 'SELECT animal_id, name, scientific_name, habitat, diet, conservation_status, fun_fact FROM animals';
$stmt = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The Animal Archive</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>

    <header>
            <div class = "nav-container">
                <ul class = "nav-list">
                    <li class = "title-item">The Animal Archive</li>
                    <li class = "title-item"><img src="Animal Archive Logo.png" width="35px" height = "35px"></li>
                    <li class = "nav-item"><a href = "index.html" class = "nav-link">Home</a></li>
                    <li class = "nav-item"><a href = "about.html" class = "nav-link">About</a></li>
                    <li class = "nav-item"><a href = "login.php" class = "nav-link">Archive</a></li>
                    <li class = "nav-item"><a href = "resources.html" class = "nav-link">Resources</a></li>
                </ul>
            </div>
        </header>

        
        <!-- Search moved to hero section -->
         <br><br>
        <div class="hero-search">
            <h1 style = "text-align:center">Search for Animal</h1>
            <form action="" method="GET" class="search-form">
                <div class = "request-row">
                    <input class = "form-input" placeholder = "Animal Name" type="text" id="search" name="search" required>
                    <label class = "form-label" for="search">Animal Name:</label>
                </div>
                <input class = "submit-button" type="submit" value="Search">
            </form>
        </div>
            
            <?php if (isset($_GET['search'])): ?>
                <div class="search-results">
                    <h1 style = "text-align:center">Results</h1>
                    <?php if ($search_results && count($search_results) > 0): ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Scientific Name</th>
                                    <th>Habitat</th>
                                    <th>Diet</th>
                                    <th>Conservation Status</th>
                                    <th>Fun Fact</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($search_results as $row): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['animal_id']); ?></td>
                                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['scientific_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['habitat']); ?></td>
                                    <td><?php echo htmlspecialchars($row['diet']); ?></td>
                                    <td><?php echo htmlspecialchars($row['conservation_status']); ?></td>
                                    <td><?php echo htmlspecialchars($row['fun_fact']); ?></td>
                                    <td>
                                        <form action="crud.php" method="post" style="display:inline;">
                                            <input type="hidden" name="delete_animal_id" value="<?php echo $row['animal_id']; ?>">
                                            <input class = "submit-button" type="submit" value="Remove">
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No animals found matching your search.</p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Table section with container -->
    <div class="table-container">
        <br>
        <h1 style = "text-align: center">All Animals in Archive</h1>
        <table class="half-width-left-align">
            <thead>
                <tr class = "crud-tr">
                    <th class = "crud-th">Name</th>
                    <th class = "crud-th">Scientific Name</th>
                    <th class = "crud-th">Habitat</th>
                    <th class = "crud-th">Diet</th>
                    <th class = "crud-th">Conservation Status</th>
                    <th class = "crud-th">Fun Fact</th>
                    <th class = "crud-th">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $stmt->fetch()): ?>
                <tr class = "crud-tr">
                    <td class = "crud-td"><?php echo htmlspecialchars($row['name']); ?></td>
                    <td class = "crud-td"><?php echo htmlspecialchars($row['scientific_name']); ?></td>
                    <td class = "crud-td"><?php echo htmlspecialchars($row['habitat']); ?></td>
                    <td class = "crud-td"><?php echo htmlspecialchars($row['diet']); ?></td>
                    <td class = "crud-td"><?php echo htmlspecialchars($row['conservation_status']); ?></td>
                    <td class = "crud-td"><?php echo htmlspecialchars($row['fun_fact']); ?></td>
                    <td class = "crud-td">
                        <form action="crud.php" method="post" style="display:inline;">
                            <input type="hidden" name="delete_animal_id" value="<?php echo $row['animal_id']; ?>">
                            <input class = "crud-button" type="submit" value="Remove">
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <br>
    </div>

    <!-- Form section with container -->
    <div class="request-container">
        <h1>Add An Animal</h1>
        <img src="Animal Archive Logo.png" width= "75px" height = "75px">
        <form action="crud.php" method="post" class = "login-form">
        <div class = "request-row">
            <input placeholder = "Name" class = "form-input" type="text" id="name" name="name" required>
            <label class = "form-label" for="name">Name:</label>
        </div>
        <div class = "request-row">
            <input placeholder = "Scientific Name" class = "form-input" type="text" id="scientific_name" name="scientific_name" required>
            <label class = "form-label" for="scientific_name">Scientific Name:</label>
        </div>
        <div class = "request-row">
            <input placeholder = "Habitat" class = "form-input" type="text" id="habitat" name="habitat" required>
            <label class = "form-label" for="habitat">Habitat:</label>
        </div>
        <div class = "request-row">
            <input placeholder = "Diet" class = "form-input" type="text" id="diet" name="diet" required>
            <label class = "form-label" for="diet">Diet:</label>
        </div>
        <div class = "request-row">
            <input placeholder = "Conservation Status" class = "form-input" type="text" id="conservation_status" name="conservation_status" required>
            <label class = "form-label" for="conservation_status">Conservation Status:</label>
        </div>
        <div class = "request-row">
            <input placeholder = "" class = "form-input" type="text" id="fun_fact" name="fun_fact" required>
            <label class = "form-label" for="fun_fact">Fun Fact:</label>
        </div>
            <input class = "submit-button" type="submit" value="Add Animal to Archive">
        </form>
    </div>
    <br><br>
    <footer>
        <div class = "footer-container">
            <ul class = "footer-list">
                <li class = "nav-item"><h4>Join Our Email List To Recieve Updates!</h4></li>
                <li class = "nav-item">
                    <form  method = "POST" action ="" class = "footer-form">
                        <input type="email" class = "footer-input" placeholder = "email" id="email" name="email">
                    </form>
                </li>
            </ul>
        </div>
        <p style = "text-align:center; color:white;">© 2024 Animal Archive. All rights reserved.</p>
        <br>
    </footer>
</body>
</html>