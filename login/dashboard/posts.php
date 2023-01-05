<?php
include_once "../../config/Database.php";
include_once "api/users/login.php";

if (isset($_POST['dlt_submit'])) {
    $dlt_id = $_POST['dlt_id'];

    $query = "DELETE FROM cms_posts WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $dlt_id);
    $stmt->execute();
}

include_once "api/posts/read.php";
include_once "api/categories/read.php";
include_once "api/users/read.php";
$database = new Database;
$root_url = $database->root_url;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../../css/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ErfanTech Posts</title>
</head>

<body class="dashboard-body">
    <header>
        <nav style="margin: 0;">
            <ul>
                <section class="logo">
                    <a href="<?php echo $root_url . '/index.php'; ?>" id="logo">ErfanTech</a>
                </section>

                <section class="nav-menu">
                    <li id="welcome-li"><span><?php echo 'Welcome ' . $users_arr[0]['first_name']; ?></span></li>
                    <li id="logout-li"><a href="<?php echo $root_url . '/login/logout.php'; ?>">Logout</a></li>
                </section>
            </ul>
        </nav>

        <article class="dashboard-header">
            <section style="margin-right: -.5rem;"><img src="../../images/gear.png" alt="dashboard"></section>
            <section>
                <h2>Dashboard</h2>
            </section>
            <section><span class="tag">Manage your site</span></section>
        </article>
    </header>

    <main>
        <article class="dashboard-container">
            <aside class="dashboard-list">
                <ul>
                    <li>
                        <a href="<?php echo "$root_url/login/dashboard/dashboard.php"; ?>">
                            <img src="../../images/gear.png" alt="dashboard">Dashboard
                        </a>

                        <span class="num">
                            <?php echo count($posts_arr) + count($categories_arr) + count($users_arr_read); ?>
                        </span>
                    </li>

                    <li class="active">
                        <a href="<?php echo "$root_url/login/dashboard/posts.php"; ?>">
                            <img src="../../images/pencil.png" alt="posts">Posts
                        </a>

                        <span class="num">
                            <?php echo count($posts_arr); ?>
                        </span>
                    </li>

                    <li>
                        <a href="<?php echo "$root_url/login/dashboard/categories.php"; ?>">
                            <img src="../../images/categories.png" alt="categories">Categories
                        </a>

                        <span class="num">
                            <?php echo count($categories_arr); ?>
                        </span>
                    </li>

                    <li>
                        <a href="<?php echo "$root_url/login/dashboard/users.php"; ?>">
                            <img src="../../images/user.png" alt="users">Users
                        </a>

                        <span class="num">
                            <?php echo count($users_arr_read); ?>
                        </span>
                    </li>
                </ul>
            </aside>

            <article class="dashboard-face">
                <section class="header">
                    <p>Post Listing</p>
                </section>

                <section class="body">
                    <section style="margin-bottom: 1.5rem;"><a id="add-post-btn" href="add_post.php">Add New</a></section>

                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($posts_arr as $post) : ?>
                                <tr>
                                    <td><?php echo $post['title']; ?></td>
                                    <td><?php echo $post['category']; ?></td>
                                    <td><?php echo $post['user']; ?></td>
                                    <td>
                                        <span class="<?php echo $post['status'] === 'published' ? 'published' : ($post['status'] === 'draft' ? 'draft' : 'archived'); ?>">
                                            <?php echo $post['status']; ?>
                                        </span>
                                    </td>
                                    <td><?php echo $post['created']; ?></td>
                                    <td><?php echo $post['updated']; ?></td>
                                    <td>
                                        <form action='edit_post.php' method='POST'>
                                            <input type="hidden" name="edit_id" value="<?php echo $post['id']; ?>">
                                            <input type="submit" value="Edit" name="edit_submit" id="edit-btn-table">
                                        </form>
                                    </td>
                                    <td>
                                        <form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>' method='POST'>
                                            <input type="hidden" name="dlt_id" value="<?php echo $post['id']; ?>">
                                            <input type="submit" value="Delete" name="dlt_submit" id="dlt-btn-table">
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </section>


            </article>
        </article>
    </main>
</body>

</html>