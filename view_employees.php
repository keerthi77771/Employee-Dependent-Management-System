<?php 
include 'includes/db_connection.php';

// Initialize search variables
$search_query = '';
$search_results = [];

// Handle search form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $search_query = trim($_POST['search']);
    
    // Prepare a query to search by SSN, first name, or last name
    $stmt = $pdo->prepare("SELECT * FROM Employee WHERE ssn LIKE ? OR fname LIKE ? OR lname LIKE ?");
    $stmt->execute(["%$search_query%", "%$search_query%", "%$search_query%"]);
    $search_results = $stmt->fetchAll();
} else {
    // Fetch all employees if no search query
    $stmt = $pdo->query("SELECT * FROM Employee");
    $search_results = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Employees</title>
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
        .search-container {
            margin-bottom: 15px;
        }
        .search-input {
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 200px;
        }
        .search-button {
            padding: 8px 15px;
            font-size: 14px;
            border-radius: 4px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        .search-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Employee List</h1>

    <!-- Home button for easier navigation -->
    <a href="index.php" class="button home-button">Home</a>

    <!-- Add New Employee button at the top for easy access -->
    <a href="add_employee.php" class="button add-button">Add New Employee</a>

    <!-- Search Form -->
    <div class="search-container">
        <form method="post" action="">
            <input type="text" name="search" class="search-input" placeholder="Search by SSN, First or Last Name" value="<?= htmlspecialchars($search_query) ?>">
            <button type="submit" class="search-button">Search</button>
        </form>
    </div>

    <div class="table-container">
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>SSN</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>DOB</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($search_results) > 0): ?>
                    <?php foreach ($search_results as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['ssn']) ?></td>
                            <td><?= htmlspecialchars($row['fname']) ?></td>
                            <td><?= htmlspecialchars($row['lname']) ?></td>
                            <td><?= htmlspecialchars($row['dob']) ?></td>
                            <td><?= htmlspecialchars($row['address']) ?></td>
                            <td>
                                <a href="edit_employee.php?ssn=<?= urlencode($row['ssn']) ?>" class="button edit-button">Edit</a>
                                <a href="delete_employee.php?ssn=<?= urlencode($row['ssn']) ?>" class="button delete-button" onclick="return confirm('Are you sure you want to delete this employee?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center; color: red;">No employees found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Additional link to go back to the Dependent List -->
    <br><br>
    <a href="view_dependents.php" class="button home-button">View Dependents</a>
</body>
</html>
