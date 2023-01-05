<?php
include_once "../config/Database.php";
include_once "../classes/Posts.php";
$database = new Database;
$root_url = $database->root_url;

$database = new Database;
$db = $database->connect();

$posts = new Posts($db);
$posts->id = isset($_GET['id']) ? $_GET['id'] : die();
$posts->read_single();


$posts_arr = [
    'id' => $posts->id,
    'title' => $posts->title,
    'message' => $posts->message,
    'category_id' => $posts->category_id,
    'userid' => $posts->userid,
    'status' => $posts->status,
    'created' => $posts->created,
    'updated' => $posts->updated,
    'category' => $posts->category
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <section class="logo">
                    <a href="<?php echo $root_url . '/index.php'; ?>" id="logo">ErfanTech</a>
                </section>

                <section class="nav-menu">
                    <li class="active"><a href="<?php echo $root_url . '/index.php'; ?>">Home</a></li>
                    <li><a href="<?php echo $root_url . '/index.php'; ?>">About</a></li>
                    <li><a href="<?php echo $root_url . '/index.php'; ?>">Contact</a></li>
                </section>

                <section class="login-signup">
                    <li id="login-li"><a href="../login/login.php">Login</a></li>
                    <li id="signup-li"><a href="../login/signup.php" id="signup-btn">Signup</a></li>
                </section>
            </ul>
        </nav>
    </header>

    <main>
        <section class="container">
            <section class="header">
                <ul>
                    <section class="header-title">
                        <h2>Newest Posts</h2>
                    </section>

                    <section class="header-menu">
                        <li class="active"><a href="<?php echo $root_url . '/index.php'; ?>">Home</a></li>
                        <li><a href="<?php echo $root_url . '/index.php'; ?>">About</a></li>
                        <li><a href="<?php echo $root_url . '/index.php'; ?>">Contact</a></li>
                    </section>
                </ul>
            </section>

            <section class="body">
                <section class="article-header">
                    <h2 class="title" style="color: #32c473; font-size: 2.5rem;"><?php echo $posts_arr['title']; ?></h2>

                    <p class="tags">
                        <span>Published on: </span>
                        <?php echo $posts_arr['created']; ?>
                        <span>Category: </span>
                        <span id="category"><?php echo $posts_arr['category']; ?></span>
                    </p>
                </section>

                <section class="article-body" style="margin-bottom: 2rem;">
                    <?php echo $posts_arr['message']; ?>
                </section>
            </section>
        </section>
    </main>
</body>

</html>