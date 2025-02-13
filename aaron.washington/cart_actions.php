<?php

include_once "lib/php/functions.php";


switch($_GET['action']) {
    case "add-to-cart":
        $product = makeQuery(makeConn(),"SELECT * FROM `products` WHERE `id`=".$_POST['product-id'])[0];
        addToCart($_POST['product-id'],$_POST['product-quantity'],$_POST['product-color']);
        header("location:cart.php?id={$_POST['product-id']}");
        break;
    case "update-cart-item":
        $p = cartItemById($_POST['id']);
        $p->quantity = $_POST['quantity'];
        header("location:cart.php");
        break;
    case "delete-cart-item":
        // array_filter runs a function over each array item and filters out those that return false
        $_SESSION['cart'] = array_filter($_SESSION['cart'],function($o){return $o->id!=$_POST['id'];});
        header("location:cart.php");
        break;
    case "reset-cart":
        resetCart();
        break;
    default:
        die("Incorrect Action");
}

print_p([$_GET,$_POST,$_SESSION]);

?>