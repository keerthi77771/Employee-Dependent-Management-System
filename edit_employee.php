<?php 
// Include the database connection
include 'includes/db_connection.php';

// Check if SSN is set in the query string
if (!isset($_GET['ssn'])) {
    header("Location: view_employees.php"); // Redirect to the list page if SSN is missing
    exit;
}

// Retrieve the employee's current data
$ssn = $_GET['ssn'];
$stmt = $pdo->prepare("SELECT * FROM Employee WHERE ssn = ?");
$stmt->execute([$ssn]);
$employee = $stmt->fetch();

// If no employee is found, redirect to the list page
if (!$employee) {
    header("Location: view_employees.php");
    exit;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];

    // Back-end Validation
    if (empty($dob) || !strtotime($dob)) {
        echo "Date of Birth is required and must be valid.";
        exit;
    }

    if (strlen($fname) > 50 || strlen($lname) > 50) {
        echo "First name and last name cannot exceed 50 characters.";
        exit;
    }

    // Update the employee's information in the database
    $stmt = $pdo->prepare("UPDATE Employee SET fname = ?, lname = ?, dob = ? WHERE ssn = ?");
    try {
        $stmt->execute([$fname, $lname, $dob, $ssn]);
        header("Location: view_employees.php"); // Redirect to the list page after update
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
    <title>Edit Employee</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Edit Employee</h1>
    <form method="post" action="">
        <label for="ssn">SSN:</label>
        <input type="text" id="ssn" name="ssn" value="<?= htmlspecialchars($employee['ssn']) ?>" readonly><br><br>

        <label for="fname">First Name:</label>
        <input type="text" id="fname" name="fname" value="<?= htmlspecialchars($employee['fname']) ?>" required maxlength="50"><br><br>

        <label for="lname">Last Name:</label>
        <input type="text" id="lname" name="lname" value="<?= htmlspecialchars($employee['lname']) ?>" required maxlength="50"><br><br>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" value="<?= htmlspecialchars($employee['dob']) ?>" required><br><br>

        <button type="submit">Update Employee</button>
    </form>
    <br>
    <a href="view_employees.php">Back to Employee List</a>
</body>
</html>
