<?php
include_once "config/Database.php";
include_once "api/posts/read.php";
$database = new Database;
$root_url = $database->root_url;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ErfanTech Blog | Welcome</title>
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
                    <li id="login-li"><a href="login/login.php">Login</a></li>
                    <li id="signup-li"><a href="login/signup.php" id="signup-btn">Signup</a></li>
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
                <?php foreach ($posts_arr as $post) : ?>
                    <article>
                        <section class="article-header">
                            <h3 class="title">
                                <?php echo $post['title']; ?>
                            </h3>

                            <p class="tags">
                                <span>Published on: </span>
                                <?php echo $post['created']; ?>
                                <span>Category: </span>
                                <span id="category"><?php echo $post['category']; ?></span>
                            </p>
                        </section>

                        <section class="article-body">
                            <?php echo mb_strimwidth($post['message'], 0, 700, "..."); ?>
                        </section>

                        <section class="readmore">
                            <a href="<?php echo 'http://localhost/php_cms/single_read/article.php?id=' . $post['id']; ?>" id="readmore-btn">Read more</a>
                        </section>
                    </article>
                <?php endforeach; ?>
            </section>
        </section>
    </main>
</body>

</html>