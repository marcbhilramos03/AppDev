<?php

include realpath(__DIR__ . '/app/layout/header.php');

if (isset($_GET["userAdded"])) {
    array_push($success, "You have successfully created an account.");
}

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($email)) {
        array_push($invalid, "Email should not be empty.");
    }
    if (empty($password)) {
        array_push($invalid, "Password should not be empty.");
    }

    if (count($invalid) == 0) {
        $password = md5($password);

        $verifyEmailPassword = $usersFacade->verifyEmailPassword($email, $password);
        if ($verifyEmailPassword == 1) {
            $login = $usersFacade->login($email, $password);
            while ($row = $login->fetch(PDO::FETCH_ASSOC)) {
                $_SESSION["user_id"] = $row["id"];
                $_SESSION["first_name"] = $row["first_name"];
                $_SESSION["last_name"] = $row["last_name"];
                $_SESSION["email"] = $row["email"];
                header("Location: index.php");
            }
        } else {
            array_push($invalid, "There is no account with this email. Kindly create an account now."); 
        }
    }
}

?>

<style>
    html,
    body {
        height: 100%;
    }

    body {
        display: flex;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #058240;
    }

    .form {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
    }

    .form .checkbox {
        font-weight: 400;
    }

    .form .form-floating:focus-within {
        z-index: 2;
    }

    .form input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>


<main class="form">
    <form action="login.php" method="post">
        <h1 class="h3 mb-3 fw-normal text-light">Login</h1>
        <?php include realpath(__DIR__ . '/errors.php') ?>
        <div class="form-floating">
            <input type="email" class="form-control" id="email" placeholder="Email" name="email">
            <label for="email">Email</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="password" placeholder="Password" name="password">
            <label for="password">Password</label>
        </div>
        <div class="checkbox mb-3">
            <label class="text-light">
                <input type="checkbox" value="remember-me" name="remember_me"> Remember me
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-warning text-light" type="submit" name="login">Login</button>
        <p class="text-light mt-2">Don't have an account? <a href="register.php" class="text-decoration-none text-warning">Register Now</a></p>
    </form>
</main>

<?php include realpath(__DIR__ . '/app/layout/footer.php') ?>