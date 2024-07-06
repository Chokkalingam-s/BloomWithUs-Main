<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "bloom";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM events WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Fetch all posts
$result = $conn->query("SELECT * FROM events ORDER BY created_at ASC");

// Fetch post for editing if edit action is set
$editPost = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editPost = $conn->query("SELECT * FROM events WHERE id = $id")->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $images = [];
    $upload_dir = 'uploads/';
    foreach ($_FILES['images']['name'] as $key => $name) {
        $target_file = $upload_dir . basename($name);
        if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $target_file)) {
            $images[] = $name;
        }
    }

    $images_json = json_encode($images);

    if ($action == 'add') {
        $stmt = $conn->prepare("INSERT INTO events (title, description, images) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $description, $images_json);
    } elseif ($action == 'edit') {
        $id = $_POST['id'];
        $stmt = $conn->prepare("UPDATE events SET title = ?, description = ?, images = ? WHERE id = ?");
        $stmt->bind_param("sssi", $title, $description, $images_json, $id);
    }
    $stmt->execute();
    $stmt->close();
    header("Location: admin_dashboard.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>BloomWithUs</title>
    <link rel="icon" href="http://bloomwithus.co.in/logo.png" type="image/x-icon">
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }
        .container-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100%;
        }
        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        footer {
            flex-shrink: 0;
            background: #f8f9fa;
        }
    </style>

</head>

<body class="index-page">
    <div class="container-wrapper">
        <header id="header" class="header d-flex align-items-center fixed-top">
            <div class="container-fluid container-xl position-relative d-flex align-items-center">
                <a href="index.html" class="logo d-flex align-items-center me-auto">
                    <img src="http://bloomwithus.co.in/logo.png" alt="">
                    <h1 class="sitename">BloomWithUs</h1>
                </a>
                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="admin_dashboard.php" class="active">Add Post</a></li>
                        <li><a href="admin_dashboard.php#ManagePost" class="active">Manage Post</a></li>
                        <li><a href="logout.php" style="color: red;">Logout</a></li>
                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>
                <a class="btn-getstarted" href="appointment.php">View Appointments</a>
            </div>
        </header>

        <main class="main" style="margin-top: 13vh;">
    <div class="container mt-5" >
        <!-- Add New Post Card -->
        <div class="card mb-4" id="AddPost">
            <div class="card-body" >
                <h2 class="card-title">Add New Post</h2>
                <form action="admin_dashboard.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="add">
                    <div class="mb-3">
                        <label for="title" class="form-label">Event Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Event Description</label>
                        <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="images" class="form-label">Event Images</label>
                        <input type="file" class="form-control" id="images" name="images[]" multiple required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Post</button>
                </form>
            </div>
        </div>

        <!-- Edit Post Card -->
        <?php if ($editPost): ?>
        <div class="card mb-4" id="EditPost">
            <div class="card-body" >
                <h2 class="card-title">Edit Post</h2>
                <form action="admin_dashboard.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" value="<?php echo $editPost['id']; ?>">
                    <div class="mb-3">
                        <label for="title" class="form-label">Event Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($editPost['title']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Event Description</label>
                        <textarea class="form-control" id="description" name="description" rows="5" required><?php echo htmlspecialchars($editPost['description']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="images" class="form-label">Event Images</label>
                        <input type="file" class="form-control" id="images" name="images[]" multiple>
                        <div class="mt-2">
                            <?php
                            $images = json_decode($editPost['images'], true);
                            if (is_array($images)) {
                                foreach ($images as $image) {
                                    echo "<img src='uploads/$image' alt='' style='width:50px;height:50px;margin-right:5px;' class='img-thumbnail'>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Post</button>
                </form>
            </div>
        </div>
        <?php endif; ?>

        <!-- Post List Card -->
        <div class="card" id="ManagePost">
            <div class="card-body">
                <h2 class="card-title mt-4 mb-3">Manage Posts</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td>
                                <a href="admin_dashboard.php?edit=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="admin_dashboard.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>


        <footer id="footer" class="footer position-relative light-background">
            <div class="container copyright text-center mt-4">
                <p style="display: flex; justify-content: center;">©<span>Copyright</span> <strong class="px-1 sitename">BloomWithUs</strong><span>All Rights Reserved</span></p>
                <div class="credits">
                    Designed by <a href="https://rudraksha.org.in/" target="_blank"> Rudraksha</a>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <!-- Preloader -->
    <div id="preloader"></div>
    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>
</body>

</html>
