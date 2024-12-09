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

// Handle book search
$search_results = null;
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search_term = '%' . $_GET['search'] . '%';
    $search_sql = 'SELECT animal_id, name, scientific_name, habitat FROM animals WHERE name LIKE :search';
    $search_stmt = $pdo->prepare($search_sql);
    $search_stmt->execute(['search' => $search_term]);
    $search_results = $search_stmt->fetchAll();
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['name']) && isset($_POST['scientific_name']) && isset($_POST['habitat'])) {
        // Insert new entry
        $name = htmlspecialchars($_POST['name']);
        $scientific_name = htmlspecialchars($_POST['scientific_name']);
        $habitat = htmlspecialchars($_POST['habitat']);
        
        $insert_sql = 'INSERT INTO animals (name, scientific_name, habitat) VALUES (:name, :scientific_name, :habitat)';
        $stmt_insert = $pdo->prepare($insert_sql);
        $stmt_insert->execute(['name' => $name, 'scientific_name' => $scientific_name, 'habitat' => $habitat]);
    } elseif (isset($_POST['delete_animal_id'])) {
        // Delete an entry
        $delete_animal_id = (int) $_POST['delete_animal_id'];
        
        $delete_sql = 'DELETE FROM animals WHERE animal_id = :animal_id';
        $stmt_delete = $pdo->prepare($delete_sql);
        $stmt_delete->execute(['animal_id' => $delete_animal_id]);
    }
}

// Get all animals for main table
$sql = 'SELECT animal_id, name, scientific_name, habitat FROM animals';
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


    <!-- Hero Section -->
    <div class="hero-section">
        <h1 class="hero-title">The Animal Archive</h1>
        
        <!-- Search moved to hero section -->
        <div class="hero-search">
            <h2>Search for Animal</h2>
            <form action="" method="GET" class="search-form">
                <label for="search">Search by name:</label>
                <input type="text" id="search" name="search" required>
                <input type="submit" value="Search">
            </form>
            
            <?php if (isset($_GET['search'])): ?>
                <div class="search-results">
                    <h3>Search Results</h3>
                    <?php if ($search_results && count($search_results) > 0): ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Scientific Name</th>
                                    <th>Habitat</th>
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
                                    <td>
                                        <form action="index.php" method="post" style="display:inline;">
                                            <input type="hidden" name="delete_animal_id" value="<?php echo $row['animal_id']; ?>">
                                            <input type="submit" value="Remove">
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
        <h2>All animals in database</h2>
        <table class="half-width-left-align">
            <thead>
                <tr>
                    <th>animal_id</th>
                    <th>name</th>
                    <th>scientific_name</th>
                    <th>habitat</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $stmt->fetch()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['animal_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['scientific_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['habitat']); ?></td>
                    <td>
                        <form action="index.php" method="post" style="display:inline;">
                            <input type="hanimal_idden" name="delete_animal_id" value="<?php echo $row['animal_id']; ?>">
                            <input type="submit" value="Remove">
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Form section with container -->
    <div class="form-container">
        <h2>Add An Animal</h2>
        <form action="crud.php" method="post">
            <label for="name">name:</label>
            <input type="text" id="name" name="name" required>
            <br><br>
            <label for="scientific_name">Sizes:</label>
            <input type="text" id="scientific_name" name="scientific_name" required>
            <br><br>
            <label for="habitat">habitat:</label>
            <input type="text" id="habitat" name="habitat" required>
            <br><br>
            <input type="submit" value="Add Animal to Archive">
        </form>
    </div>
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