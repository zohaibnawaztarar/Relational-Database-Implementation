<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">


	<title>OpenAir Booking | FAQ</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
	 crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
	 crossorigin="anonymous">
	<!-- Custom CSS -->
	<link href="css/packages.css" rel="stylesheet">
	<link href="css/faq.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>

<body>

	<div id="id1" class="userDetails">
		<?php
			error_reporting(E_ALL & ~E_NOTICE); //Hide error messages (e.g. notices on homepage, will only be turned on when releasing website)
			$url = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
			$message = "REFERER is: ".parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
			//echo "<script type='text/javascript'>alert('$message');</script>";

			$userName = "";
			$encrypPass = "";

			//Check website navigating from before allowing post requests only if ftom the same server as this
			if($url != "") { //If the referee is not an about:blank page or been entered from the URL bar or a first entry
				if ((array_key_exists('userName', $_POST) && (htmlspecialchars($_POST['userName']) != $userName))) {
					$userName = htmlspecialchars($_POST['userName']);
				}
				if ((array_key_exists('encrypPass', $_POST) && (htmlspecialchars($_POST['encrypPass']) != $encrypPass))) {
					$encrypPass = htmlspecialchars($_POST['encrypPass']);
				}
			}

			//Destroy session if navigating
			session_start();
			//Reset session if coming from other website
			//Remove?//if(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) != $_SERVER['SERVER_NAME']){
			if($url == "") { //If the referee is an about:blank page or been entered from the URL bar or a first entry
				//http://php.net/manual/en/function.session-destroy.php
				//Unset all of the session variables.
				$_SESSION = array();

				//If it's desired to kill the session, also delete the session cookie.
				//Note: This will destroy the session, and not just the session data!
				if (ini_get("session.use_cookies")) {
					$params = session_get_cookie_params();
					setcookie(session_name(), '', time() - 42000,
						$params["path"], $params["domain"],
						$params["secure"], $params["httponly"]
					);
				}

				//Finally, destroy the session.
				session_destroy();
				session_start();
			}

			if ($userName == "") {
				if ((isset($_SESSION['userName'])) && !empty($_SESSION['userName'])) {
					$userName = $_SESSION["userName"];
					if ($userName == " ") {
						$userName = "";
					}
				}
			} else {
				$_SESSION['userName'] = $userName;
			}

			if ($encrypPass == "") {
				if ((isset($_SESSION['encrypPass'])) && !empty($_SESSION['encrypPass'])) {
					$encrypPass = $_SESSION["encrypPass"];
					if ($encrypPass == " ") {
						$encrypPass = "";
					}
				}
			} else {
				$_SESSION['encrypPass'] = $encrypPass;
			}

			if ($userName == "") {
				if (isset($_COOKIE["userName"])) {
					$userName = $_COOKIE["userName"];
					if ($userName == " ") {
						$userName = "";
					}
				}
			}

			if ($encrypPass == ""){
				if (isset($_COOKIE["encrypPass"])) {
					$encrypPass = $_COOKIE["encrypPass"];
					if ($encrypPass == " ") {
						$encrypPass = "";
					}
				}
			}

		?>
	</div>

	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		<a class="navbar-brand" href="index.php"><i class="fas fa-paper-plane"></i> OpenAir Booking</a>
		<button class="navbar-toggler my-1" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive"
		 aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="index.php">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="about.php">About Us</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="packages.php">Packages</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="#"><span class="sr-only">(current)</span>FAQs</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="contact-us.php">Contact Us</a>
				</li>
			</ul>
			<form class="navbar-form form-inline" action="login.php" method="POST">
				<div id="id3" class="form-group">
					<input readonly="true" id="id3.1" class="form-control mr-2" type="text" placeholder="Username" name="userName" required>
					<input readonly="true" id="id3.2" class="form-control mr-2" type="password" placeholder="Password" name="uncrypPass" required>
					<input class="form-control" type="hidden" name="remember" value="checked">
					<button class="btn btn-outline-success login-btn my-2 my-sm-0 mr-2" type="submit">Log In</button>
					<button class="btn btn-outline-success login-btn my-2 my-sm-0 mr-2" type="register" onclick="location.href='register.php';">Register</button>
				</div>
			</form>
			<div id="id4" class="logout">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link account" href="login.php">
							<?php
                            if ($userName != ""){
                                echo "$userName"."'s";
                            }
                            ?> Account
						</a>
					</li>
					<li class="nav-item">
						<form action="login.php" method="POST">
							<input type='hidden' name="logout" value="true">
							<button class="btn btn-outline-success login-btn my-2 my-sm-0 mr-2" type="submit">Logout</button>
						</form>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="place">
		<div class="container">
			<div class="row">
				<div class="text-center mx-auto mb-4">
					<h1 class="mt-5">FAQs</h1>
					<hr />
				</div>
			</div>
		</div>
	</div>
	<!-- Page Content -->

	<div class="container">
		<div class="faq">
			<section class="cd-faq mt-4">
				<ul class="cd-faq-categories">
					<li><a class="selected" href="#bookings">Bookings</a></li>
					<li><a href="#luggage">Luggage</a></li>
					<li><a href="#holiday">On Holiday</a></li>

				</ul> <!-- cd-faq-categories -->

				<div class="cd-faq-items">
					<ul id="bookings" class="cd-faq-group">
						<li class="cd-faq-title">
							<h2>Bookings</h2>
						</li>
						<li>
							<a class="cd-faq-trigger" href="#0">What are the cancellation charges on my booking?</a>
							<div class="cd-faq-content">
								<p>There are 25% cancellation charges. We need all cancellations from the lead passenger, with your booking number
									and reason for cancelling.</p>
							</div> <!-- cd-faq-content -->
						</li>

						<li>
							<a class="cd-faq-trigger" href="#0">How far in advance can I book?</a>
							<div class="cd-faq-content">
								<p>We usually sell holidays for about 18 months in advance.</p>
							</div> <!-- cd-faq-content -->
						</li>

					</ul> <!-- cd-faq-group -->

					<ul id="luggage" class="cd-faq-group">
						<li class="cd-faq-title">
							<h2>Luggage</h2>
						</li>
						<li>
							<a class="cd-faq-trigger" href="#0">Can I take a laptop, ipod, or ipad or Kindle on-board with me?</a>
							<div class="cd-faq-content">
								<p> This type of equipment is now allowed on aircraft, but you can only use it once the aircraft is airborne. You
									may be asked to demonstrate it as you clear Security.Please also note that if your equipment has phone capability
									(including data connections), as, for example with smartphones, ipads, tablet computers, portable games consoles
									and many eReaders, these need to be switched to flight mode or switched off completely if this is not possible.</p>
							</div> <!-- cd-faq-content -->
						</li>

						<li>
							<a class="cd-faq-trigger" href="#0">How should I pack my wedding dress or suit?</a>
							<div class="cd-faq-content">
								<p>You are welcome to take your wedding dress or wedding suit onboard our partner flights in addition to your hand
									luggage. Flight crew will, where space permits, hang your dress or suit for you but on some flights the wardrobe
									space is very limited and we cannot guarantee this. Please pack your dress in a box or bag so that when the crew
									can’t find space to hang it, it can be safely stowed. With any wedding suits, please make sure they are packed in
									a soft suit carrier. If you prefer not to carry it and would like to check it in, please pack your dress or suit
									into a separate suitcase and mark the suitcase as ‘fragile wedding garments’. Where possible the items should be
									packed into a plastic bag for extra protection. Please note that if the separate suitcase is outside of your baggage
									allowance you will need to purchase additional baggage. If you are flying with a different airline, please contact
									them directly.</p>
							</div> <!-- cd-faq-content -->
						</li>

						<li>
							<a class="cd-faq-trigger" href="#0">Can I take my asthma inhaler on board?</a>
							<div class="cd-faq-content">
								<p>Yes, an asthma inhaler can be taken on board the flight with you.</p>
							</div> <!-- cd-faq-content -->
						</li>


					</ul> <!-- cd-faq-group -->

					<ul id="holiday" class="cd-faq-group">
						<li class="cd-faq-title">
							<h2>On Holiday</h2>
						</li>
						<li>
							<a class="cd-faq-trigger" href="#0">Will someone meet me when I arrive?</a>
							<div class="cd-faq-content">
								<p>Yes, either a rep or a ground handler will meet you upon your arrival.</p>
							</div> <!-- cd-faq-content -->
						</li>

						<li>
							<a class="cd-faq-trigger" href="#0">Will we have a Welcome Meeting?</a>
							<div class="cd-faq-content">
								<p>Your welcome meeting is held by a OpenAir Booking local expert full of information and helpful tips and advice.
									We provide welcome meetings in many of our resorts.</p>
							</div> <!-- cd-faq-content -->
						</li>

						<li>
							<a class="cd-faq-trigger" href="#0">What currency do I use to pay departure tax?</a>
							<div class="cd-faq-content">
								<p>If you've got to pay departure taxes, then these will usually need to be paid in the local currency.</p>
							</div> <!-- cd-faq-content -->
						</li>

						<li>
							<a class="cd-faq-trigger" href="#0">What is the best currency to take to Cuba?</a>
							<div class="cd-faq-content">
								<p>Credit cards issued by US banks and US Dollar currency are not accepted in Cuba. You will need to purchase Cuban
									Pesos which can only be bought locally.</p>
							</div> <!-- cd-faq-content -->
						</li>

						<li>
							<a class="cd-faq-trigger" href="#0">What is included in a welcome pack?</a>
							<div class="cd-faq-content">
								<p> At your Welcome Meeting with our Reps, you'll be given a Welcome Pack with lots of useful info about your chosen
									destination.</p>
							</div> <!-- cd-faq-content -->
						</li>


					</ul> <!-- cd-faq-group -->


				</div> <!-- cd-faq-items -->
				<a href="#0" class="cd-close-panel">Close</a>
			</section> <!-- cd-faq -->
		</div>
		<script src="js/main.js"></script>
		<!-- Resource jQuery -->

	</div>

	<!-- Footer -->
	<footer class="py-3 bg-dark">
		<div class="container">
			<p class="m-0 text-center text-white">Copyright &copy; OpenAir Booking 2018</p>
		</div>
		<!-- /.container -->
	</footer>

	<!-- Bootstrap core JavaScript -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
	 crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
	 crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
	 crossorigin="anonymous"></script>

	<div class="showHideElements">
		<?php
			if ( ($userName != "") && ($encrypPass != "") ) {
			    // Show logout
				echo '<script type="text/javascript">';
				echo 'var x = document.getElementById("id4");';
				echo 'x.style.display = "block";';
				echo '</script>';
			} else {
				//Show Login
				echo '<script type="text/javascript">';
					echo 'var x = document.getElementById("id3");';
					echo 'x.style.display = "block";';
					echo 'document.getElementById("id3.1").readOnly = false;';
					echo 'document.getElementById("id3.2").readOnly = false;';
					echo '</script>';
			}
		?>
	</div>

</body>

</html>