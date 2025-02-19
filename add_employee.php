<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'includes/db_connection.php'; 

// Initialize error message variable
$error_message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ssn = $_POST['ssn'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];

    // Back-end Validation
    if (!preg_match("/^\d{9}$/", $ssn)) {
        $error_message = "SSN must be exactly 9 digits.";
    } elseif (empty($dob) || !strtotime($dob)) {
        $error_message = "Date of Birth is required and must be valid.";
    } elseif (strlen($fname) > 50 || strlen($lname) > 50 || strlen($address) > 255) {
        $error_message = "First name, last name, and address must not exceed their respective length limits.";
    } else {
        // Check for duplicate SSN
        $check_stmt = $pdo->prepare("SELECT ssn FROM Employee WHERE ssn = ?");
        $check_stmt->execute([$ssn]);
        if ($check_stmt->fetch()) {
            // Display alert and redirect for duplicate SSN
            echo "<script>
                    alert('An employee with this SSN already exists.');
                    window.location.href = 'view_employees.php';
                  </script>";
            exit;
        }

        // Insert the new employee into the database
        $stmt = $pdo->prepare("INSERT INTO Employee (ssn, fname, lname, dob, address) VALUES (?, ?, ?, ?, ?)");
        try {
            $stmt->execute([$ssn, $fname, $lname, $dob, $address]);
            header("Location: add_employee.php?success=1"); // Redirect back with a success flag
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
    <title>Add New Employee</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        // Show success message if "success" parameter is present
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('success')) {
                alert("Employee successfully added!");
            }
        };
    </script>
    <style>
        /* Style for error message display */
        .error-message {
            color: red;
            font-weight: bold;
            text-align: center;
            margin: 20px;
        }
    </style>
</head>
<body>
    <h1>Add New Employee</h1>

    <!-- Display error message if it exists -->
    <?php if (!empty($error_message)): ?>
        <div class="error-message"><?= htmlspecialchars($error_message) ?></div>
    <?php endif; ?>

    <form method="post" action="">
        <label for="ssn">SSN (9 digits):</label>
        <input type="text" id="ssn" name="ssn" required pattern="\d{9}" title="SSN must be exactly 9 digits"><br><br>

        <label for="fname">First Name:</label>
        <input type="text" id="fname" name="fname" required maxlength="50"><br><br>

        <label for="lname">Last Name:</label>
        <input type="text" id="lname" name="lname" required maxlength="50"><br><br>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required><br><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required maxlength="255"><br><br>

        <button type="submit">Add Employee</button>
    </form>
    <br>
    <a href="view_employees.php">Back to Employee List</a>
</body>
</html>
