<?php 
// Include the database connection
include 'includes/db_connection.php';

// Check if SSN is set in the query string
if (!isset($_GET['ssn'])) {
    header("Location: view_employees.php"); // Redirect to the list page if SSN is missing
    exit;
}

// Retrieve SSN from the query string
$ssn = $_GET['ssn'];

// Handle delete confirmation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Delete the employee record from the database
    $stmt = $pdo->prepare("DELETE FROM Employee WHERE ssn = ?");
    try {
        $stmt->execute([$ssn]);
        header("Location: view_employees.php"); // Redirect to the list page after deletion
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Employee</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Delete Employee</h1>
    <p>Are you sure you want to delete this employee?</p>
    <form method="post" action="">
        <button type="submit">Yes, Delete</button>
        <a href="view_employees.php" class="link-button">Cancel</a>
    </form>
</body>
</html>