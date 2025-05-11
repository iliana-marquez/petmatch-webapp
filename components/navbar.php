<?php
require_once "db_connect.php"; 

if ($id) {
    $sql = "SELECT * FROM `users` WHERE `id` = {$id}";
    $result = mysqli_query($conn, $sql);
    $person = mysqli_fetch_assoc($result);
}
?>
<header>
    <img class="logo" src="images/logo.svg" alt="logo">
    
    <nav class="navLinks">
        <a>Hi, <?= $person["first_name"]; ?>!</a>
        <img class="img-thumbnail" src="images/<?= $person["picture"] ?>">
        <?php if (isset($_SESSION["admn"])): ?>
            <a href="create_pet.php"><button class="bttn" type="button"><i class='bx bxs-dog'></i><i class='bx bx-plus' ></i></button></a>
            <a href="dashboard.php"><button class="bttn" type="button">Dashboard</button></a>
        <?php endif; ?>
        <a id="profilePic" href="edit_profile.php"><button>My account</button></a>
        <a class="" href="./logout.php?logout"><button>Logout</button></a>
    </nav>
</header>