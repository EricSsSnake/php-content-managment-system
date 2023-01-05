<?php
include_once "../../config/Database.php";
include_once "api/users/login.php";
include_once "api/users/read.php";
include_once "api/categories/read.php";

$database = new Database;
$db = $database->connect();
$root_url = $database->root_url;

if (isset($_POST['submit'])) {
    $msg = '';
    $msg_class = '';
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (empty($name)) {
        $msg = 'All fields are required.';
        $msg_class = 'err';
    } else {
        $query = "INSERT INTO cms_category SET name = :name";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->execute();

        if ($stmt->execute()) {
            $msg = 'Category was created.';
            $msg_class = 'success';
        } else {
            $msg = 'Category was not created.';
            $msg_class = 'err';
        }
    }
}
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
                            10
                        </span>
                    </li>

                    <li>
                        <a href="<?php echo "$root_url/login/dashboard/posts.php"; ?>">
                            <img src="../../images/pencil.png" alt="posts">Posts
                        </a>

                        <span class="num">
                            10
                        </span>
                    </li>

                    <li class="active">
                        <a href="<?php echo "$root_url/login/dashboard/categories.php"; ?>">
                            <img src="../../images/categories.png" alt="categories">Categories
                        </a>

                        <span class="num">
                            10
                        </span>
                    </li>

                    <li>
                        <a href="<?php echo "$root_url/login/dashboard/users.php"; ?>">
                            <img src="../../images/user.png" alt="users">Users
                        </a>

                        <span class="num">
                            10
                        </span>
                    </li>
                </ul>
            </aside>

            <article class="dashboard-face">
                <section class="header">
                    <p>Add a new category</p>
                </section>

                <section class="body">
                    <section class="msg <?php echo isset($_POST['submit']) ? $msg_class : 'hidden'; ?>">
                        <?php echo isset($_POST['submit']) ? $msg : null; ?>
                    </section>

                    <form class="add-post" action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>' method='POST'>
                        <section>
                            <label for="name">Category Name</label><br>
                            <input type="text" name="name" placeholder="Category name...">
                        </section>

                        <section>
                            <input type="submit" value="Save" id="add-post-submit-btn" name="submit">
                        </section>
                    </form>
                </section>
            </article>
        </article>
    </main>
</body>

</html>