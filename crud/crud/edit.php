<?php
include "db.php";

$id = $_GET['id'];

if (empty($id)) {
    die("Invalid ID");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $age   = $_POST['age'];

    $stmt = $conn->prepare("UPDATE users SET name=?, email=?, age=? WHERE id=?");
    $stmt->bind_param("ssii", $name, $email, $age, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("User not found");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="card shadow-lg border-0">

        <div class="card-header bg-info text-dark text-center">
            <h3>Edit User</h3>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control"
                           value="<?php echo $user['name']; ?>" required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control"
                           value="<?php echo $user['email']; ?>" required>
                </div>

                <div class="mb-3">
                    <label>Age</label>
                    <input type="number" name="age" class="form-control"
                           value="<?php echo $user['age']; ?>" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="index.php" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>