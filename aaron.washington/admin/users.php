<?php 

include "../lib/php/functions.php";

$filename = "../data/users.json";
$users = file_get_json($filename);


$empty_user = (object) [
    "name" => "",
    "type" => "",
    "email" => "",
    "classes" => [],
];


// file_put_contents, json_encode, explode function, $_POST
// CRUD, Create Read Update Delete


if (isset($_GET['action'])) {
    switch($_GET['action']) {
        case "update":
            $users[$_GET['id']]->name = $_POST['user-name'];
            $users[$_GET['id']]->type = $_POST['user-type'];
            $users[$_GET['id']]->email = $_POST['user-email'];
            $users[$_GET['id']]->classes = explode(", ", $_POST['user-classes']);

            file_put_contents($filename, json_encode($users));
            header("location:{$_SERVER['PHP_SELF']}?id={$_GET['id']}");
            break;
        case "create":
            $empty_user->name = $_POST['user-name'];
            $empty_user->type = $_POST['user-type'];
            $empty_user->email = $_POST['user-email'];
            $empty_user->classes = explode(", ", $_POST['user-classes']);

            $id = count($users);

            $users[] = $empty_user;

            file_put_contents($filename, json_encode($users));
            header("location:{$_SERVER['PHP_SELF']}?id=$id");
            break;
        case "delete":
            array_splice($users,$_GET['id'],1);
            file_put_contents($filename, json_encode($users));
            header("location:{$_SERVER['PHP_SELF']}");
            break;
    }
}


function showUserPage($user) {

$id = $_GET['id'];
// if it's TRUE that our condition "$id" equals "new", then the value is "Add"; Otherwise the value is "Edit"
$addoredit = $id == "new" ? "Add" : "Edit";  
$createorupdate = $id == "new" ? "create" : "update";
$classes = implode(", ", $user->classes);

//heredoc, last line HTML; must be completely on the left
$display = <<<HTML
<div class="card-light" style="text-align: left;">
    <h3>$user->name</h3>
    <div>
        <strong>Type</strong>
        <span>$user->type</span>
    </div>
    <div>
        <strong>Email</strong>
        <span>$user->email</span>
    </div>
    <div>
        <strong>Classes</strong>
        <span>$classes</span>
    </div>
</div>
HTML;


$form = <<<HTML
<div class="card-light">
    <h3>$addoredit User</h3>
    <form method="post" action="{$_SERVER['PHP_SELF']}?id=$id&action=$createorupdate">
        <div class="form-control">
            <label class="form-label" for="user-name">Name</label>
            <input type="text" class="form-input" value="$user->name" name="user-name" id="user-name" placeholder="Enter User Name">
        </div>
        <div class="form-control">
            <label class="form-label" for="user-type">Type</label>
            <input type="text" class="form-input" value="$user->type" name="user-type" id="user-type" placeholder="Enter User Type">
        </div>
        <div class="form-control">
            <label class="form-label" for="user-email">Email</label>
            <input type="email" class="form-input" value="$user->email" name="user-email" id="user-email" placeholder="Enter User Email">
        </div>
        <div class="form-control">
            <label class="form-label" for="user-classes">Classes</label>
            <input type="text" class="form-input" value="$classes" name="user-classes" id="user-classes" placeholder="Enter User Classes, comma separated">
        </div>
        <div class="form-control">
            <input type="submit" class="form-button form-control" value="Save Changes">
        </div>
    </form>
</div>
HTML;


$output = $id == "new" ? $form : 
    "<div class='grid gap'>
        <div class='col-xs-12 col-md-7'>$display</div>
        <div class='col-xs-12 col-md-5'>$form</div>
    </div>
    ";


$delete = $id == "new" ? : "<a href='{$_SERVER['PHP_SELF']}?id=$id&action=delete'>Delete</a>";


echo <<<HTML
<nav class="display-flex">
    <div class="flex-stretch"><a href="{$_SERVER['PHP_SELF']}">Back</a></div>
    <div class="flex-none">$delete</div>
</nav>
$output
HTML;
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Admin Page</title>
    <?php include "../parts/meta.php"; ?>
</head>
<body>

    <header class="navbar">
        <div class="container display-flex" style="margin-bottom: 0;">
            <div class="flex-none">
                <h5>User Admin</h5>
            </div>
            <div class="flex-stretch"></div>
            <nav class="nav nav-flex flex-none">
                <ul>
                    <li><a href="<?= $_SERVER['PHP_SELF'] ?>">User List</a></li>
                    <li><a href="<?= $_SERVER['PHP_SELF'] ?>?id=new">Add New User</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container" style="padding-top: 3rem;">
        <div class="card-light" style="text-align: left;">
            <?php

            if(isset($_GET['id'])) {
                showUserPage($_GET['id'] == "new" ? $empty_user : $users[$_GET['id']]);
            } else {

            ?>

            <h3>User List</h3>

            <nav class="nav">
                <ul style="padding-left: 0;">

                    <?php 
                    
                    for($i=0;$i<count($users);$i++){
                        echo "<li class='form-control'>
                            <a href='admin/users.php?id=$i' style='padding-left: 0;'>{$users[$i]->name}</a>
                        </li>";
                    }
                    
                    ?>

                </ul>
            </nav>

            <?php } ?>
        </div>
    </div>
    
</body>
</html>