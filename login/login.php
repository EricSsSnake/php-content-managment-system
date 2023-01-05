<?php
session_start();

include_once "../config/Database.php";
$database = new Database;
$db = $database->connect();
$root_url = $database->root_url;

$query = "SELECT * FROM cms_user";
$stmt = $db->prepare($query);
$stmt->execute();

$users_arr = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $users_item = [
        'email' => $row['email'],
        'password' => $row['password']
    ];

    array_push($users_arr, $users_item);
}

$inputs_arr = [];
$err = '';

if (isset($_POST['submit'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = md5($_POST['password']);

    $inputs_item = [
        'email' => $email,
        'password' => $password
    ];

    array_push($inputs_arr, $inputs_item);
}

if (!empty($inputs_arr) && in_array($inputs_arr[0], $users_arr)) {
    $_SESSION['email'] = $inputs_arr[0]['email'];
    $_SESSION['password'] = $inputs_arr[0]['password'];
    header("location:$root_url/login/dashboard/dashboard.php");
} else {
    $err = 'Email or password is incorrect.';
}

?>

<?php if (!empty($_SESSION)) : ?>
    <?php header("location:$root_url/login/dashboard/dashboard.php"); ?>
<?php else : ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link rel="stylesheet" href="../css/style.css">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ErfanTech Blog | Login</title>
    </head>

    <body>
        <header>
            <nav>
                <ul>
                    <section class="logo">
                        <a href="<?php echo $root_url . '/index.php'; ?>" id="logo">ErfanTech</a>
                    </section>

                    <section class="nav-menu">
                        <li><a href="<?php echo $root_url . '/index.php'; ?>">Home</a></li>
                        <li><a href="<?php echo $root_url . '/index.php'; ?>">About</a></li>
                        <li><a href="<?php echo $root_url . '/index.php'; ?>">Contact</a></li>
                    </section>
                </ul>
            </nav>
        </header>

        <main>
            <article class="login-container">
                <section class="header">
                    <span>Login to your account</span>
                </section>

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <p class="err">
                        <?php echo isset($_POST['submit']) ? $err : ''; ?>
                    </p>

                    <section>
                        <span><img src="../images/user.png" alt="user"></span>
                        <input type="email" name="email" placeholder="Email">
                    </section>

                    <section>
                        <span><img src="../images/password.png" alt="password"></span>
                        <input type="password" name="password" placeholder="Password">
                    </section>

                    <section style="border: none; margin-top: 2rem;">
                        <input type="submit" value="Login" name="submit" id="login-submit-btn">
                    </section>
                </form>
            </article>
        </main>
    </body>

    </html>

<?php endif; ?>