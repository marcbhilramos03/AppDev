<?php

include realpath(__DIR__ . '/app/layout/header.php');

if (isset($_POST["register"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];

    if (empty($email)) {
        array_push($invalid, "Email should not be empty.");
    }
    if (empty($password)) {
        array_push($invalid, "Password should not be empty.");
    }
    if (empty($firstName)) {
        array_push($invalid, "First Name should not be empty.");
    }
    if (empty($lastName)) {
        array_push($invalid, "Last Name should not be empty.");
    }

    if (count($invalid) == 0) {
        $verifyEmail = $usersFacade->verifyEmail($email);
        if ($verifyEmail == 0) {
            $password = md5($password);
            $addUser = $usersFacade->addUser($firstName, $lastName, $email, $password);
            if ($addUser) {
                header("Location: login.php?userAdded");
            }
        } else {
            array_push($invalid, "Email already been taken.");
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

</style>


<main class="form">
    <form action="register.php" method="post">
        <h1 class="h3 mb-3 fw-normal text-light">Register</h1>
        <?php include realpath(__DIR__ . '/errors.php') ?>
        <div class="form-floating">
            <input type="text" class="form-control" id="firstName" placeholder="First Name" name="first_name">
            <label for="firstName">First Name</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="lastName" placeholder="Last Name" name="last_name">
            <label for="lastName">Last Name</label>
        </div>
        <div class="form-floating">
            <input type="email" class="form-control" id="email" placeholder="Email" name="email">
            <label for="email">Email</label>
        </div>
        <div class="form-floating mb-4">
            <input type="password" class="form-control" id="password" placeholder="Password" name="password">
            <label for="password">Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-warning text-light" type="submit" name="register">Register</button>
        <p class="text-light mt-2">Already had an account? <a href="login.php" class="text-decoration-none text-warning">Login Now</a></p>
    </form>
</main>

<?php include realpath(__DIR__ . '/app/layout/footer.php') ?>