<?php 
include 'includes/db_connection.php';
$error_message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ssn = $_POST['ssn'];
    $dependentname = $_POST['dependentname'];
    $relationship = $_POST['relationship'];

    // Check if the combination of SSN and dependent name already exists
    $check_stmt = $pdo->prepare("SELECT * FROM Dependent WHERE ssn = ? AND dependentname = ?");
    $check_stmt->execute([$ssn, $dependentname]);
    if ($check_stmt->fetch()) {
        $error_message = "A dependent with this name already exists for the selected SSN.";
    } else {
        // Insert the new dependent
        $stmt = $pdo->prepare("INSERT INTO Dependent (ssn, dependentname, relationship) VALUES (?, ?, ?)");
        try {
            $stmt->execute([$ssn, $dependentname, $relationship]);
            // Redirect with a success parameter only if insertion is successful
            header("Location: add_dependent.php?success=1");
            exit;
        } catch (Exception $e) {
            $error_message = "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Dependent</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('success')) {
                alert("Dependent successfully added!");
            }
        };
    </script>
</head>
<body>
    <h1>Add New Dependent</h1>

    <!-- Display error message if any -->
    <?php if (!empty($error_message)): ?>
        <div class="error-message"><?= htmlspecialchars($error_message) ?></div>
    <?php endif; ?>

    <form method="post" action="">
        <label for="ssn">Employee SSN:</label>
        <select id="ssn" name="ssn" required>
            <option value="">Select Employee SSN</option>
            <?php
            // Fetch available SSNs from Employee table
            $ssn_stmt = $pdo->query("SELECT ssn FROM Employee");
            while ($row = $ssn_stmt->fetch()): ?>
                <option value="<?= htmlspecialchars($row['ssn']) ?>">
                    <?= htmlspecialchars($row['ssn']) ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <label for="dependentname">Dependent Name:</label>
        <input type="text" id="dependentname" name="dependentname" required maxlength="50"><br><br>

        <label for="relationship">Relationship:</label>
        <input type="text" id="relationship" name="relationship" required maxlength="50"><br><br>

        <button type="submit">Add Dependent</button>
    </form>
    <br>
    <a href="view_dependents.php">Back to Dependent List</a>
</body>
</html>
