<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Users</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white text-center">
                <h3 class="mb-0">All Users</h3>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-end mb-3">
                    <a href="insert.php" class="btn btn-success">Add User</a>
                </div>
                <div class="table-responsive">
                    <?php
                    $conn = include "db.php";

                    if (!$conn) {
                        die("Connection failed");
                    }

                    $sql = "SELECT * FROM users";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                    ?>
                        <table class="table table-striped table-hover align-middle text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Age</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td class="fw-semibold"><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><span class="badge bg-success"><?php echo $row['age']; ?></span></td>
                                        <td>
                                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning me-2">Edit</a>
                                            <a href="delete.php?id=<?php echo $row['id']; ?>"class="btn btn-sm btn-danger me-2">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php
                    } else {
                        echo "<p class='text-center'>No users found</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>