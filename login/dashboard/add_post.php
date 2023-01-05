<?php
include_once "../../config/Database.php";
include_once "api/users/login.php";
include_once "api/users/read.php";
include_once "api/posts/read.php";
include_once "api/categories/read.php";

$database = new Database;
$db = $database->connect();
$root_url = $database->root_url;

if (isset($_POST['submit'])) {
    $msg = '';
    $msg_class = '';
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (empty($title) || empty($message) || empty($category) || empty($status)) {
        $msg = 'All fields are required.';
        $msg_class = 'err';
    } else {
        $query_category_id = "SELECT p.category_id FROM cms_category as c LEFT JOIN cms_posts as p ON c.id = p.category_id WHERE c.name = :category LIMIT 0,1";
        $stmt = $db->prepare($query_category_id);
        $stmt->bindParam(':category', $category);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $category_id = $row['category_id'];

        $query_userid = "SELECT p.userid FROM cms_user as u LEFT JOIN cms_posts as p ON u.id = p.userid WHERE u.email = :email LIMIT 0,1";
        $stmt = $db->prepare($query_userid);
        $stmt->bindParam(':email', $_SESSION['email']);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $userid = $row['userid'];
        $current_timestamp = date('Y-m-d h:i:s');

        $query = "INSERT INTO cms_posts SET title = :title, message = :message, category_id = :category_id, userid = :userid, status = :status, created = :created, updated = :updated";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':message', $message);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':userid', $userid);
        $stmt->bindParam(':created', $current_timestamp);
        $stmt->bindParam(':updated', $current_timestamp);
        $stmt->execute();

        if ($stmt->execute()) {
            $msg = 'Post was created.';
            $msg_class = 'success';
        } else {
            $msg = 'Post was not created.';
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

                    <li class="active">
                        <a href="<?php echo "$root_url/login/dashboard/posts.php"; ?>">
                            <img src="../../images/pencil.png" alt="posts">Posts
                        </a>

                        <span class="num">
                            10
                        </span>
                    </li>

                    <li>
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
                    <p>Add a new post</p>
                </section>

                <section class="body">
                    <section class="msg <?php echo isset($_POST['submit']) ? $msg_class : 'hidden'; ?>">
                        <?php echo isset($_POST['submit']) ? $msg : null; ?>
                    </section>

                    <form class="add-post" action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>' method='POST'>
                        <section>
                            <label for="title">Title</label><br>
                            <input type="text" name="title" placeholder="Post title...">
                        </section>

                        <section>
                            <label for="message">Message</label><br>
                            <textarea name="message" id="message" cols="30" rows="10" placeholder="Post message..."></textarea>
                        </section>

                        <section>
                            <label for="category">Category</label><br>

                            <select name="category" id="category">
                                <?php foreach ($categories_arr as $category) : ?>
                                    <option value="<?php echo $category['name']; ?>">
                                        <?php echo $category['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </section>

                        <section class="radio-btns">
                            <section>
                                <input type="radio" name="status" value="published">
                                <label for="published">Publish</label>
                            </section>

                            <section>
                                <input type="radio" name="status" value="draft">
                                <label for="draft">Draft</label>
                            </section>

                            <section>
                                <input type="radio" name="status" value="archived">
                                <label for="archived">Archive</label>
                            </section>
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