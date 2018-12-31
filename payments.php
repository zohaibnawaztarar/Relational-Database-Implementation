<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>OpenAir Booking | Payment</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
	 crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
	 crossorigin="anonymous">
	<!-- Custom CSS -->
	<link href="css/payment.css" rel="stylesheet">
</head>

<body>
	<div id="id1" class="userDetails">
		<?php
				error_reporting(E_ALL & ~E_NOTICE); //Hide error messages (e.g. notices on homepage, will only be turned on when releasing website)
				$url = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
				$message = "REFERER is: ".parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);


				$currpackage = "";

				if(isset($_GET['package'])) {
            		$currpackage = $_GET['package'];
        		}

					//Check website navigating from before allowing post requests only if ftom the same server as this
				if($url != "") { //If the referee is not an about:blank page or been entered from the URL bar or a first entry
					if ((array_key_exists('userName', $_POST) && (htmlspecialchars($_POST['userName']) != $userName))) {
						$userName = htmlspecialchars($_POST['userName']);
					}

					if ((array_key_exists('encrypPass', $_POST) && (htmlspecialchars($_POST['encrypPass']) != $encrypPass))) {
						$encrypPass = htmlspecialchars($_POST['encrypPass']);
					}

					if ((array_key_exists('pkg_location', $_POST) && (htmlspecialchars($_POST['pkg_location']) != $selectedPayment))) {
						$selectedPayment = htmlspecialchars($_POST['pkg_location']);
					}
					if ((array_key_exists('pkg_price', $_POST) && (htmlspecialchars($_POST['pkg_price']) != $pkg_price))) {
						$pkg_price = htmlspecialchars($_POST['pkg_price']);
					}
				}

					//Destroy session if navigating
					session_start();
					//Reset session if coming from other website
					//Remove?//if(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) != $_SERVER['SERVER_NAME']){
					if($url == "") { //If the referee is an about:blank page or been entered from the URL bar or a first entry
						//http://php.net/manual/en/function.session-destroy.php
						// Unset all of the session variables.
						$_SESSION = array();

						// If it's desired to kill the session, also delete the session cookie.
						// Note: This will destroy the session, and not just the session data!
						if (ini_get("session.use_cookies")) {
							$params = session_get_cookie_params();
							setcookie(session_name(), '', time() - 42000,
								$params["path"], $params["domain"],
								$params["secure"], $params["httponly"]
							);
						}

						// Finally, destroy the session.
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
					}else{
						$_SESSION['userName'] = $userName;
					}

					if ($encrypPass == "") {
						if ((isset($_SESSION['encrypPass'])) && !empty($_SESSION['encrypPass'])) {
								$encrypPass = $_SESSION["encrypPass"];
								if ($encrypPass == " ") {
									$encrypPass = "";
								}
						}
					}else{
						$_SESSION['encrypPass'] = $encrypPass;
					}

					if($url != "") { //If the referee is not an about:blank page or been entered from the URL bar or a first entry
						if ((array_key_exists('selectedPayment', $_POST) && (htmlspecialchars($_POST['selectedPayment']) != $selectedPayment))) {
							$selectedPayment = htmlspecialchars($_POST['selectedPayment']);
						}
					}


					if ($selectedPayment == "") {
						if ((isset($_SESSION['selectedPayment'])) && !empty($_SESSION['selectedPayment'])) {
								$selectedPayment = $_SESSION["selectedPayment"];
								if ($selectedPayment == " ") {
									$selectedPayment = "";
								}
						}
					}else{
						$_SESSION['selectedPayment'] = $selectedPayment;
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
				<li class="nav-item">
					<a class="nav-link" href="faq.php">FAQs</a>
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
						<a class="nav-link account" href="dashboard.php">
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

	<div class="container">
		<button class="btn search-btn mt-4" onclick="window.history.back();"><i class="fas fa-chevron-left"></i> Back to Packages</button>
		<div class="row mb-5">
			<div class="col">
				<?php
		include_once("php/db_connect.php");
		$sql = "SELECT * FROM ViewPackages_Page WHERE pkg_id = $currpackage";
        $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
        while( $record = mysqli_fetch_assoc($resultset) ) {
        ?>
				<div class="card my-4">
					<img class="card-img-top img-fluid" src="resources/<?php echo $record['pkg_image']; ?>" alt="">
					<div class="card-body mx-3">
						<h1 class="card-title display-4"><?php echo $record['pkg_city']; ?>, <?php echo $record['pkg_country']; ?></h1>
						<h2>Price: £<?php echo $record['pkg_price']; ?></h2>
						<h3>Available: <?php echo $record['avail_start_date']; ?> - <?php echo $record['avail_end_date']; ?></h3>
						<h4>Attractions: <?php echo $record['attract_type']; ?> - <?php echo $record['attract_location']; ?></h3>
						<p class="card-text">Description: <?php echo $record['pkg_description']; ?></p>
					</div>
					<div class="card-footer">
					<form action="https://www.sandbox.paypal.com/cgi-bin/webscr/checkout/login" method="post" target="_top">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="DZJS46MSHRV74">
			<input type="hidden" name="exp" value="guest">
			<table style="display: none;">
			<tr><td><input type="hidden" name="on0" value="Packages">Packages</td></tr><tr><td><select name="os0">
				<option value="Shanghai"<?=$selectedPayment == 'Shanghai' ? ' selected="selected"' : '';?>>Shanghai £0.01</option>
				<option value="New York"<?=$selectedPayment == 'New York' ? ' selected="selected"' : '';?>>New York £0.01</option>
				<option value="Hong Kong"<?=$selectedPayment == 'Hong Kong' ? ' selected="selected"' : '';?>>Hong Kong £0.01</option>
			</select> </td></tr>
			</table>
			<input type="hidden" name="currency_code" value="GBP">
			<input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/checkout-logo-large.png" name="submit" alt="PayPal – The safer, easier way to pay online!">
			<img alt="" src="https://www.sandbox.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1">
		</form>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
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

		<div id="id8" class="showHideElements">
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