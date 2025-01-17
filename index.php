<?php

include realpath(__DIR__ . '/app/layout/header.php');

$userId = 0;
if (isset($_SESSION["user_id"])) {
    $userId = $_SESSION["user_id"];
}
if (isset($_SESSION["first_name"])) {
    $firstName = $_SESSION["first_name"];
}
if (isset($_SESSION["last_name"])) {
    $lastName = $_SESSION["last_name"];
}

if ($userId == 0) {
    header("Location: login.php");
}

?>
<?php include realpath(__DIR__ . '/app/layout/sidebar.php') ?>

<div class="container">
    <div class="app-header d-flex justify-content-between">
        <div class="d-flex align-items-center">
            <!-- Add Click Event to Toggle Sidebar -->
            <i class="bi bi-list text-light fs-1" id="sidebarToggle"></i>
        </div>
        <div class="d-flex align-items-center text-center">
            <?php
            $fetchByUserId = $usersFacade->fetchByUserId($userId);
            foreach ($fetchByUserId as $user) { ?>
                <p class="text-light m-0 ps-2 pt-1">Welcome <?= $user["first_name"] ?></p>
            <?php }
            ?>
        </div>
        <div></div>
    </div>
</div>

<div class="app-body bg-light p-3">
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea, quae alias odit non consectetur obcaecati natus illum totam doloribus atque, perspiciatis repellendus velit! Error delectus odit consequuntur quae? Reiciendis, obcaecati? Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quo unde animi omnis dolor dignissimos, officiis repellendus expedita maxime eos! Ipsum hic aliquam, quidem modi officiis labore illo illum aspernatur eius. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis doloremque atque asperiores similique aliquam consequatur at porro necessitatibus fugiat incidunt earum, eum sint tempora, exercitationem, nihil ad eos soluta placeat? Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente asperiores consequuntur facere id rem, ea quisquam itaque nulla sint maxime veniam quidem, adipisci possimus impedit. Impedit perspiciatis animi possimus molestiae. Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati natus laudantium animi cum inventore ipsam dolorem accusamus adipisci quibusdam molestias recusandae, vel atque aut exercitationem illum veniam nobis debitis dicta!</p>
</div>

<?php include realpath(__DIR__ . '/app/layout/navbar.php') ?>
<?php include realpath(__DIR__ . '/app/layout/footer.php') ?>