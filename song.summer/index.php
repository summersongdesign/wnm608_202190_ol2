<?php 
include_once "lib/php/function.php";
include_once "parts/templates.php";

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>

    <?php include "parts/meta.php"; ?>

</head>
<body>
	
<?php include "parts/navbar.php"; ?>


	<div id="viewWindow">
        <div class="view-window" style="background-image: url('../song.summer/img/view_window.png');"><a href="index.php"></a></div>
    </div>



	<div class="container">
		<article class="article card soft">
			<div class="display-flex flex-align-center">
				<div class="flex-stretch">
					<h2>Trending Products</h2>
				</div>
			</div>

			<div class="content cnt23">
			
			<?php include_once "parts/templates.php";

$result = makeQuery(
	makeConn(),
"
SELECT *
FROM `products`
ORDER BY `price` DESC
LIMIT 3
"

);

echo "<div class='grid gap'>" ,array_reduce($result,'productListTemplate'),"</div>";
?>
				<ul class="table_of"><a href="active_wear.php">More Products</a></ul>
		</article>

		<div class="container card soft">
	<h2>Recommended Tops</h2>
		<?php
		recommendedCategory("tops"); 
		?> 
	</div>


		<article class="card soft">
			<h2>Special Offers</h2>
			<!-- carousel -->
			<div class="carousel">
            <div class="slides">
                <div class="slide center" style="background:url(../song.summer/img/special1.png) center; background-size: cover"></div>
                <div class="slide slide_center" style="background:url(../song.summer/img/special2.png) center; background-size: cover"></div>
                <div class="slide" style="background: url(../song.summer/img/special3.png) center; background-size: cover"></div>

            </div>
            <div class="controls">
                <div class="control-left">&lt;</div>
                <div class="control-right">&gt;</div>
                <div class="control-pagination">  
                    <div class="control-dot">&bullet;</div>
                    <div class="control-dot">&bullet;</div>
                    <div class="control-dot">&bullet;</div>
                </div>
            </div>
        </div>

        <script>
        new Carousel({
        element: $(".carousel").eq(0),
        timing: 6000
        })
        </script>

			</div>
		</article>
	</div>



	<div class="container">

		<article class="card soft">
			<h2>New Memeber Benefits</h2>
			<div class="member_gift"></div>
			</div>

			</article>


			<ul class="table_of"><a href="#back_to_the_top">BACK TO THE TOP</a></ul>

			<section class="footer">
    <div class="social">
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-facebook-square"></i></a>
    </div>

    <p class="footer">Look and Fit @2021</p> 
</section>
		
	</div>

	
</body>

</html>