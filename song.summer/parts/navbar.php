<?php

include_once "lib/php/function.php";


?>

<input type = "checkbox" id ="menu" class="hidden"> 
<header class="navbar">
    <div class="container display-flex">
    <div class="flex-none">

            <h1 class="main_title" id="back_to_the_top"> <a href="index.php">Look and Fit</a> </h1>
    </div>
            <div class="flex-stretch flex-wrap"></div>
            <div class="flex-none menu-button">
                <label for="menu">&equiv;</label>
            </div>
            <nav class= "nav nav-flex">
                <ul class= "main_nav2">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="active_wear.php">Active Wear</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="cart.php">
                        <span>Cart</span>
                        <span class="badge"> <?= makeCartBadge();?> </span>
                    </a></li>
                    <li class="flex-stretch"><a href="admin.php">Admin</a></li>
                </ul>
            </nav>
        </div>
    </div>

</header>