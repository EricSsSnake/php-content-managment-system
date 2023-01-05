<?php
include_once "../../config/Database.php";
include_once "api/users/login.php";
include_once "api/posts/read.php";
include_once "api/users/read.php";
include_once "api/categories/read.php";
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
    <title>ErfanTech Dashboard</title>
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
                    <li class="active">
                        <a href="<?php echo "$root_url/login/dashboard/dashboard.php"; ?>">
                            <img src="../../images/gear.png" alt="dashboard">Dashboard
                        </a>

                        <span class="num">
                            <?php echo count($posts_arr) + count($categories_arr) + count($users_arr_read); ?>
                        </span>
                    </li>

                    <li>
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
                <section class="header dashboard-header">
                    <p>Website overview</p>
                </section>

                <section class="cards">
                    <section class="card">
                        <a href="<?php echo "$root_url/login/dashboard/posts.php"; ?>">
                            <img src="../../images/pencil.png" alt="users">Posts
                        </a>
                    </section>

                    <section class="card">
                        <a href="<?php echo "$root_url/login/dashboard/categories.php"; ?>">
                            <img src="../../images/categories.png" alt="users">Categories
                        </a>
                    </section>

                    <section class="card">
                        <a href="<?php echo "$root_url/login/dashboard/users.php"; ?>">
                            <img src="../../images/user.png" alt="users">Users
                        </a>
                    </section>
                </section>
            </article>
        </article>
    </main>
</body>

</html>