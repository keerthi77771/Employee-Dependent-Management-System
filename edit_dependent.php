<?php 
include 'includes/db_connection.php';
$error_message = "";

// Check if ssn and dependentname are set in the query string
if (!isset($_GET['ssn']) || !isset($_GET['dependentname'])) {
    header("Location: view_dependents.php"); // Redirect to the list page if missing
    exit;
}

$ssn = $_GET['ssn'];
$dependentname = $_GET['dependentname'];

// Fetch current dependent data
$stmt = $pdo->prepare("SELECT * FROM Dependent WHERE ssn = ? AND dependentname = ?");
$stmt->execute([$ssn, $dependentname]);
$dependent = $stmt->fetch();

if (!$dependent) {
    header("Location: view_dependents.php");
    exit;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_dependentname = $_POST['dependentname'];
    $relationship = $_POST['relationship'];

    // Update the dependent's information
    $stmt = $pdo->prepare("UPDATE Dependent SET dependentname = ?, relationship = ? WHERE ssn = ? AND dependentname = ?");
    try {
        $stmt->execute([$new_dependentname, $relationship, $ssn, $dependentname]);
        header("Location: view_dependents.php"); // Redirect to the list page after update
        exit;
    } catch (Exception $e) {
        $error_message = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Dependent</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Edit Dependent</h1>

    <?php if (!empty($error_message)): ?>
        <div class="error-message"><?= htmlspecialchars($error_message) ?></div>
    <?php endif; ?>

    <form method="post" action="">
        <label for="dependentname">Dependent Name:</label>
        <input type="text" id="dependentname" name="dependentname" value="<?= htmlspecialchars($dependent['dependentname']) ?>" required maxlength="50"><br><br>

        <label for="relationship">Relationship:</label>
        <input type="text" id="relationship" name="relationship" value="<?= htmlspecialchars($dependent['relationship']) ?>" required maxlength="50"><br><br>

        <button type="submit">Update Dependent</button>
    </form>
    <br>
    <a href="view_dependents.php">Back to Dependent List</a>
</body>
</html>
