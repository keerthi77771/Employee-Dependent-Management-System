<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee & Dependent Management System</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Basic styling for the homepage */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
        }
        .container {
            text-align: center;
        }
        .container h1 {
            font-size: 2em;
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            font-size: 1em;
            text-decoration: none;
            color: #fff;
            background-color: #007BFF;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Employee & Dependent Management System</h1>
        <p>Welcome to the management system. Please choose an option below:</p>
        
        <!-- Link to Employee CRUD page -->
        <a href="view_employees.php" class="button">Manage Employees</a>
        
        <!-- Link to Dependent CRUD page -->
        <a href="view_dependents.php" class="button">Manage Dependents</a>
    </div>
</body>
</html>
