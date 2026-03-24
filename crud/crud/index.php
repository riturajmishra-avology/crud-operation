<?php
include "db.php";
// Pagination
$limit = 3; // Show 4 records per pages
// Get Current Page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
// Calculate offset
$offset = ($page - 1) * $limit;

// Base query
$sql = "SELECT * FROM users";

// Sorting
if (isset($_GET['sort']) && $_GET['sort'] == 'age') {
    $sql .= " ORDER BY age ASC";
}

// Fetch data with LIMIT
$sql .= " LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);

// Get Total records
$totalQuery = "SELECT COUNT(*) as total FROM users";
$totalResult = mysqli_query($conn, $totalQuery);
$totalRow = mysqli_fetch_assoc($totalResult);
$totalRecords = $totalRow['total'];

// Calculate total pages
$totalPages = ceil($totalRecords / $limit);
?>


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
                <div class="d-flex justify-content-between mb-3">
                    <a href="insert.php" class="btn btn-success">Add User</a>
                    <a href="?sort=age&page=<?php echo $page; ?>" class="btn btn-success">Sort by Age</a>
                </div>
                <div class="table-responsive">
                    <?php
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
                                            <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger me-2">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <br>
                        <?php
                        $start = max(1, $page - 2);
                        $end = min($totalPages, $page + 2);
                        ?>

                        <nav>
                            <ul class="pagination justify-content-center">

                                <!-- First Button -->
                                <?php if ($page > 1) { ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=1&sort=<?php echo $_GET['sort'] ?? ''; ?>">First</a>
                                    </li>
                                <?php } ?>

                                <!-- Previous Button -->
                                <?php if ($page > 1) { ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?php echo $page - 1; ?>&sort=<?php echo $_GET['sort'] ?? ''; ?>">Previous</a>
                                    </li>
                                <?php } ?>

                                <!-- First Page + Dots -->
                                <?php if ($start > 1) { ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=1&sort=<?php echo $_GET['sort'] ?? ''; ?>">1</a>
                                    </li>

                                    <?php if ($start > 2) { ?>
                                        <li class="page-item disabled"><span class="page-link">...</span></li>
                                    <?php } ?>
                                <?php } ?>

                                <!-- Middle Pages -->
                                <?php for ($i = $start; $i <= $end; $i++) { ?>
                                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                                        <a class="page-link" href="?page=<?php echo $i; ?>&sort=<?php echo $_GET['sort'] ?? ''; ?>">
                                            <?php echo $i; ?>
                                        </a>
                                    </li>
                                <?php } ?>

                                <!-- Last Page + Dots -->
                                <?php if ($end < $totalPages) { ?>
                                    <?php if ($end < $totalPages - 1) { ?>
                                        <li class="page-item disabled"><span class="page-link">...</span></li>
                                    <?php } ?>

                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?php echo $totalPages; ?>&sort=<?php echo $_GET['sort'] ?? ''; ?>">
                                            <?php echo $totalPages; ?>
                                        </a>
                                    </li>
                                <?php } ?>

                                <!-- Next Button -->
                                <?php if ($page < $totalPages) { ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?php echo $page + 1; ?>&sort=<?php echo $_GET['sort'] ?? ''; ?>">Next</a>
                                    </li>
                                <?php } ?>

                                <!-- Last Button -->
                                <?php if ($page < $totalPages) { ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?php echo $totalPages; ?>&sort=<?php echo $_GET['sort'] ?? ''; ?>">Last</a>
                                    </li>
                                <?php } ?>

                            </ul>
                        </nav>
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