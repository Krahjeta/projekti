<?php
session_start();

require_once 'Database.php';



if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$database = new Database();
$db = $database->connect();
$post = new Post($db);

$posts = $post->getAllPosts();


if (isset($_POST['delete_post'])) {
    $post_id = $_POST['post_id'];
    if ($post->deletePost($post_id)) {
        $message = "Post deleted successfully.";
    } else {
        $message = "Failed to delete the post.";
    }

    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
    <a href="Website.php" class="logo"><img src="logo.png" alt="logo"></a>

    <div class="bx bx-menu" id="menu-icon"></div>

    <ul class="navbar">
        <li><a href="Website.php">Home</a></li>
        <li><a href="ride.php">Ride</a></li>
        <li><a href="service.php">Services</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="reviews.php">Reviews</a></li>
    </ul>

    <div class="header-btn">
        <?php
        if (isset($_SESSION['id'])) {
  
            echo '<li><a href="logout.php">Logout</a></li>';
            echo '<li><a href="dashboard.php">Dashboard</a></li>';
        } else {
 
            echo '<a href="#" class="sign-up">Sign Up</a>';
            echo '<a href="#" class="sign-in">Sign In</a>';
        }
        ?>
    </div>

    <li class="nav-profil">
        <div class="avatar">
            <img src="rev1.jpg" alt="User Avatar">
        </div>
        <ul>
            <?php
            if (isset($_SESSION['id'])) {
                echo '<li><a href="dashboard.php">Dashboard</a></li>';
                echo '<li><a href="logout.php">Log-out</a></li>';
            } else {
  
                echo '<li><a href="login.php">Sign In</a></li>';
                echo '<li><a href="signup.php">Sign Up</a></li>';
            }
            ?>
        </ul>
    </li>
</header>

<a href="add_post.php">Add New Post</a>
    <main>
        <h2>Manage Posts</h2>

        <?php if (isset($message)): ?>
            <div class="message">
                <span><?php echo htmlspecialchars($message); ?></span>
            </div>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($post['id']); ?></td>
                        <td><?php echo htmlspecialchars($post['title']); ?></td>
                        <td><?php echo htmlspecialchars($post['description']); ?></td>
                        <td><?php echo htmlspecialchars($post['price']); ?></td>
                        <td>
                            <a href="edit_post.php?id=<?php echo $post['id']; ?>">Edit</a>
                            <form method="POST" style="display:inline-block;">
                                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                <button type="submit" name="delete_post">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <footer>
        <p>&copy; 2024 Car Rental. All rights reserved.</p>
    </footer>
</body>
</html>
