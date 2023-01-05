<?php
session_start();

include_once "../config/Database.php";
$database = new Database;
$db = $database->connect();
$root_url = $database->root_url;

if (isset($_POST['submit'])) {
    $err = $err_class = '';
    $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $type = 2;
    $password = '';

    if ($_POST['password'] == $_POST['password_2']) {
        $password = md5($_POST['password']);
    } else {
        $err = "Your passwords don't match.";
    }

    if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($type)) {
        $err = 'All fields are required.';
        $err_class = 'err';
        $err = $_POST['password'] != $_POST['password_2'] ? "Your passwords don't match." : $err;
    } else {
        $query = "INSERT INTO cms_user SET first_name = :first_name, last_name = :last_name, email = :email, password = :password, type = :type";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':type', $type);
        $stmt->execute();

        if ($stmt->execute()) {
            $err = 'Acoount was created.';
            $err_class = 'success';
            session_destroy();
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            header("location:$root_url/login/dashboard/dashboard.php");
        } else {
            $err = 'Account was not created.';
            $err_class = 'err';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ErfanTech Blog | Signup</title>
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
                <span>Create your account</span>
            </section>

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <p class="err">
                    <?php echo isset($_POST['submit']) ? $err : ''; ?>
                </p>

                <section>
                    <span><img src="../images/name.png" alt="first_name"></span>
                    <input type="text" name="first_name" placeholder="First Name">
                </section>

                <section>
                    <span><img src="../images/name.png" alt="last_name"></span>
                    <input type="text" name="last_name" placeholder="Last Name">
                </section>

                <section>
                    <span><img src="../images/user.png" alt="user"></span>
                    <input type="email" name="email" placeholder="Email">
                </section>

                <section>
                    <span><img src="../images/password.png" alt="password"></span>
                    <input type="password" name="password" placeholder="Password">
                </section>

                <section>
                    <span><img src="../images/password.png" alt="password"></span>
                    <input type="password" name="password_2" placeholder="Retype your password">
                </section>

                <section style="border: none; margin-top: 2rem;">
                    <input type="submit" value="Signup" name="submit" id="login-submit-btn">
                </section>
            </form>
        </article>
    </main>
</body>

</html>