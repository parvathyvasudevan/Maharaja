<?php
require_once __DIR__ . "/auth_guard.php";
require_once __DIR__ . "/../config/database.php";

// Handle Add
function slugify($text)
{
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/i', '-', $text);
    $text = trim($text, '-');
    return $text ?: 'category';
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'])) {
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $slug = slugify($name);
    $sql = "INSERT INTO categories (name, slug) VALUES ('$name', '$slug')";
    mysqli_query($link, $sql);
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $sql = "DELETE FROM categories WHERE id = $id";
    mysqli_query($link, $sql);
    header("Location: categories.php");
    exit;
}

$sql = "SELECT * FROM categories ORDER BY id DESC";
$result = mysqli_query($link, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Categories</h2>
            <a href="index.php" class="btn btn-secondary">Back to Dashboard</a>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <form method="post" class="row align-items-end">
                    <div class="col-md-8">
                        <label>New Category Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-success w-100">Add Category</button>
                    </div>
                </form>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td>
                            <?php echo $row['id']; ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row['name']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row['slug']); ?>
                        </td>
                        <td>
                            <a href="categories.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
