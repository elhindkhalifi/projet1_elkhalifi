<?php
include "./public/header.php";
//using two methods to check wether to use is logged in for now :both token and user logged in sessions 
//todo: only token in one file to call eveerytime pour rendre le code plus propre
session_start();
if (!isset($_SESSION['token'])) {
    // Redirect to login if the token is not present
    header("Location: ./authentification/login.php");
    exit();
}
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    // Redirect tau login quand user pas connecter
    $url = './authentification/login.php';
    header('Location: ' . $url);
    exit();

}
?>
<div style="display: flex;">

<!-- Sidebar Section -->
<aside style="background-color: #2D2D2D; color: #ffffff; padding: 20px; text-align: center; width: 300px;">
     <h2>Explore More</h2>
     <div class="container">
  	 	<div class="row">
  	 		<div class="footer-col">
               <br>
  	 			<h4>Products</h4>
  	 			<ul>
                    <li><a href="#hats">Hats</a></li>
                    <li><a href="#gloves">Gloves</a></li>
                    <li><a href="#jackets">Winter Jackets</a></li>
                    <li><a href="#shoes">Shoes</a></li>
  	 			</ul><br>
                   <h4>Profile</h4>
  	 			<ul>
  	 				<li><a href="./authentification/updateUser.php">Edit Profile Info</a></li>
  	 				<li><a href="./authentification/updatePwd.php">Reset your password</a></li>
                    <li><a href="#">Your addresses</a></li>
                    <li><a href="./authentification/logout.php">Logout</a></li>
                    <li><a href="./authentification/deleteUser.php">Delete account</a></li>
  	 			</ul>
                <br>
                   <h4>Follow us</h4>
  	 			<div class="social-links">
  	 				<a href="#"><i class="fab fa-facebook-f"></i></a>
  	 				<a href="#"><i class="fab fa-twitter"></i></a>
  	 				<a href="#"><i class="fab fa-instagram"></i></a>
  	 			</div>
  	 		
  	 		
</aside>
<section>
<!-- Stylish Welcome Section -->
<section style="background-color: #BDC4CD; padding: 50px; text-align: center;">
    <div class="container">
        <h2>Welcome to Inda's Winter Clothing</h2>
        <p>
            Founded by Hind Elkhalifi, a visionary college student at Teccart College in Montreal, Inda's Winter Clothing sets the stage for a new era in winter fashion. We are dedicated to crafting high-quality, stylish, and comfortable clothing that keeps you warm and confident throughout the season.
        </p>
        <p>
            Explore our curated collections, featuring trendy jackets, cozy scarves, and more. Indulge in warmth with confidence and style.
        </p>
    </div>
    </section>



<!-- Our Commitment to Quality -->
<section style="background-color: #BDC4CD; padding: 50px; text-align: center;">
    <div class="container">
        <h2>Our Commitment to Quality</h2>
        <p>
            At Inda's, quality is non-negotiable. We source the finest materials and employ skilled artisans to ensure each garment meets the highest standards of craftsmanship.
        </p>
        <p>
            From stitching to finishing touches, every detail is a testament to our commitment to delivering excellence in durability and style.
        </p>
    </div>
</section>

<!-- Explore Our Collections -->
<section style="background-color: #BDC4CD; padding: 50px; text-align: center;">
    <div class="container">
        <h2>Explore Our Collections</h2>
        <p>
            Discover a world of winter fashion at Inda's. Our curated collections feature a diverse range of styles, colors, and textures to suit every taste.
        </p>
        <p>
            From statement jackets to cozy scarves, each piece is designed to elevate your cold-weather wardrobe.
        </p>
    </div>
</section>

<!-- Our Story Section -->
<section style="background-color: #24262A; color: #ffffff; padding: 50px; text-align: center;">
    <div class="container">
        <h2>Our Story</h2>
        <p>
            Inda's Winter Clothing was born out of the creative vision of Hind Elkhalifi, a passionate college student at Teccart College in Montreal. Fueled by a desire to redefine winter fashion in Montreal, Hind embarked on a journey to create a brand that blends style, comfort, and warmth.
        </p>
        <p>
            With a relentless pursuit of excellence, Inda's has evolved into a symbol of fashion-forward winter wear, catering to those who seek both functionality and elegance in their cold-weather wardrobe.
        </p>
    </div>
</section>

</section>
</div>

<!-- Our Team Section -->
<section style="background-color: #BDC4CD; padding: 50px; text-align: center;">
    <div class="container">
        <h2>Our Team</h2>
        <div class="row">
            <div class="column">
                <div class="card">
           
                    <div class="container"  style="background-color: white">
                        <h2>Hind Elkhalifi</h2>
                        <p class="title">CEO & Founder</p>
                        <p>
                            Hind Elkhalifi, the visionary founder of Inda's Winter Clothing, is a college student at Teccart College in Montreal. With a creative spark and a pursuit of innovation, Hind blends fashion and warmth, setting new standards for winter wear in Montreal.
                        </p>
                        <p>Email: elhindkhalifi@gmail.com</p>
                        <p><button class="button">Contact</button></p>
                    </div>
                </div>
            </div>

            <div class="column">
                <div class="card">
                   
                    <div class="container" style="background-color: white">
                        <h2>Julian Dussollier</h2>
                        <p class="title">PHP College Professor</p>
                        <p>
                            Julian Dussollier, a dedicated PHP expert and college professor, played a pivotal role in inspiring Hind Elkhalifi to embark on the journey of creating Inda's Winter Clothing. His expertise and guidance contributed to the realization of this innovative venture.
                        </p>
                        <p>Email: julian@julian.ca</p>
                        <p><button class="button">Contact</button></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include "./public/footer.php";
?>

