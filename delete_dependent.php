<?php 
include 'includes/db_connection.php';

if (!isset($_GET['ssn']) || !isset($_GET['dependentname'])) {
    header("Location: view_dependents.php");
    exit;
}

$ssn = $_GET['ssn'];
$dependentname = $_GET['dependentname'];

// Handle delete confirmation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $pdo->prepare("DELETE FROM Dependent WHERE ssn = ? AND dependentname = ?");
    try {
        $stmt->execute([$ssn, $dependentname]);
        header("Location: view_dependents.php");
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
    <title>Delete Dependent</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Delete Dependent</h1>
    <p>Are you sure you want to delete this dependent?</p>
    <form method="post" action="">
        <button type="submit">Yes, Delete</button>
        <a href="view_dependents.php" class="link-button">Cancel</a>
    </form>
</body>
</html>
