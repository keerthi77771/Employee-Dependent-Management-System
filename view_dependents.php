<?php 
include 'includes/db_connection.php';

$searchTerm = '';
$dependents = [];

// Handle search
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchTerm = trim($_POST['search']);
    $stmt = $pdo->prepare("SELECT * FROM Dependent WHERE ssn LIKE ? OR dependentname LIKE ? OR relationship LIKE ?");
    $stmt->execute(["%$searchTerm%", "%$searchTerm%", "%$searchTerm%"]);
    $dependents = $stmt->fetchAll();
} else {
    // Fetch all dependents if no search term is provided
    $stmt = $pdo->query("SELECT * FROM Dependent");
    $dependents = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Dependents</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Additional styling */
        .button {
            padding: 8px 15px;
            font-size: 14px;
            border-radius: 4px;
            text-decoration: none;
            color: white;
            display: inline-block;
            margin: 5px;
        }
        .add-button {
            background-color: #007bff;
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 15px;
            display: inline-block;
        }
        .home-button {
            background-color: #007bff;
            color: white;
            margin-bottom: 20px;
            display: inline-block;
        }
        .edit-button {
            background-color: #28a745; /* Green */
        }
        .delete-button {
            background-color: #dc3545; /* Red */
        }
        .table-container {
            max-height: 400px; /* Adjust the height as needed */
            overflow-y: auto;
            margin-top: 15px;
        }
        .error-message {
            color: red;
            font-weight: bold;
            margin: 20px;
            text-align: center;
        }
        .search-bar {
            margin-bottom: 15px;
        }
        .search-input {
            padding: 5px;
            font-size: 14px;
            width: 250px;
        }
        .search-button {
            padding: 5px 10px;
            font-size: 14px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .search-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Dependent List</h1>

    <!-- Home button for easier navigation -->
    <a href="index.php" class="button home-button">Home</a>

    <!-- Add New Dependent button at the top for easy access -->
    <a href="add_dependent.php" class="button add-button">Add New Dependent</a>

    <!-- Search form -->
    <form method="POST" action="view_dependents.php" class="search-bar">
        <input type="text" name="search" class="search-input" placeholder="Search by SSN, Dependent Name, or Relationship" value="<?= htmlspecialchars($searchTerm) ?>">
        <button type="submit" class="search-button">Search</button>
    </form>

    <div class="table-container">
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>SSN</th>
                    <th>Dependent Name</th>
                    <th>Relationship</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($dependents) > 0): ?>
                    <?php foreach ($dependents as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['ssn']) ?></td>
                            <td><?= htmlspecialchars($row['dependentname']) ?></td>
                            <td><?= htmlspecialchars($row['relationship']) ?></td>
                            <td>
                                <a href="edit_dependent.php?ssn=<?= urlencode($row['ssn']) ?>&dependentname=<?= urlencode($row['dependentname']) ?>" class="button edit-button">Edit</a>
                                <a href="delete_dependent.php?ssn=<?= urlencode($row['ssn']) ?>&dependentname=<?= urlencode($row['dependentname']) ?>" class="button delete-button" onclick="return confirm('Are you sure you want to delete this dependent?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align: center;">No dependents found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Additional link to go back to the Employee List -->
    <br><br>
    <a href="view_employees.php" class="button home-button">Back to Employee List</a>
</body>
</html>
