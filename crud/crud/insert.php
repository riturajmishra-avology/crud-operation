<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];

    // Checking if the user with this email already exist (If yes then show error message)
    $stmt1 = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt1->bind_param("s", $email);
    $stmt1->execute(); 
    $result = $stmt1->get_result(); // If the $result holds any record then, it means user exists with this email

    if(mysqli_num_rows($result) > 0) {
        echo "<h2 style='color: red;'>User with this email already exists.</h2>";
        exit();
    }

    // Prepare statement
    $stmt = $conn->prepare("INSERT INTO users (name, email, age) VALUES (?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("ssi", $name, $email, $age);
    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Form</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-header text-center">
                    <h4>Add Users</h4>
                </div>

                <div class="card-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" class="form-control" id="age" name="age" placeholder="Enter your age" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>