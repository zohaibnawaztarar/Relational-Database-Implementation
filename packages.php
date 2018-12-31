<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>OpenAir Booking | Packages</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
        crossorigin="anonymous">
    <!-- Custom CSS -->
    <link href="css/packages.css" rel="stylesheet">
	

    <?php
	error_reporting(E_ALL & ~E_NOTICE); //Hide error messages (e.g. notices on homepage, will only be turned on when releasing website)
	$url = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);

    //This breaks the GETs for some reason?
    //if($url != "") { //If the referee is not an about:blank page or been entered from the URL bar or a first entry
        $where = "";
        $when = "";
        $dur = "";
        $num = "";
        $order = "";

		if(isset($_GET['where'])) {
            $where = $_GET['where'];
        }

        if(isset($_GET['when'])) {
            $when = $_GET['when'];
        }

        if(isset($_GET['duration'])) {
			$dur = $_GET['duration'];
        }

        if(isset($_GET['numOfTrav'])) {
			$num = $_GET['numOfTrav'];
        }
        
        if(isset($_GET['order'])) {
			$order = $_GET['order'];
		}
	//}
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

</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="index.php"><i class="fas fa-paper-plane"></i> OpenAir Booking</a>
        <button class="navbar-toggler my-1" type="button" data-toggle="collapse" data-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
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
                <li class="nav-item active">
                    <a class="nav-link" href="#">Packages<span class="sr-only">(current)</span></a>
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
                    <input readonly="true" id="id3.1" class="form-control mr-2" type="text" placeholder="Username" name="userName"
                        required>
                    <input readonly="true" id="id3.2" class="form-control mr-2" type="password" placeholder="Password"
                        name="uncrypPass" required>
                        <input class="form-control" type="hidden" name="remember" value="checked">
                    <button class="btn btn-outline-success login-btn my-2 my-sm-0 mr-2" type="submit">Log In</button>
                    <button class="btn btn-outline-success login-btn my-2 my-sm-0 mr-2" type="register" onclick="location.href='register.php';">Register</button>
                </div>
            </form>
            <div id="id4" class="logout">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link account" href="dashboard.php">
                            <?php echo $userName ?>'s Account</a>
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
                    <h1 class="mt-5">Search again?</h1>
                    <hr />
                    <form class="form-inline mb-5" action="packages.php" method="GET">
                        <select disabled class="form-control m-1 mb-2 mx-2">
                            <option value="" disabled selected>United Kingdom</option>

                            <option value="AF">Afghanistan</option>
                            <!-- Disabled for now - use array like this & store array as session item http://jsfiddle.net/UThAr/ -->
                            <option value="ZW">Zimbabwe</option>
                        </select>
                        <select class="form-control m-1 mb-2 mx-2" name="where">
                            <option value="? OR 1=1" disabled selected>Destination</option>
                            <option value="Afganistan">Afghanistan</option>
                            <option value="Albania">Albania</option>
                            <option value="Algeria">Algeria</option>
                            <option value="American Samoa">American Samoa</option>
                            <option value="Andorra">Andorra</option>
                            <option value="Angola">Angola</option>
                            <option value="Anguilla">Anguilla</option>
                            <option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
                            <option value="Argentina">Argentina</option>
                            <option value="Armenia">Armenia</option>
                            <option value="Aruba">Aruba</option>
                            <option value="Australia">Australia</option>
                            <option value="Austria">Austria</option>
                            <option value="Azerbaijan">Azerbaijan</option>
                            <option value="Bahamas">Bahamas</option>
                            <option value="Bahrain">Bahrain</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Barbados">Barbados</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Belgium">Belgium</option>
                            <option value="Belize">Belize</option>
                            <option value="Benin">Benin</option>
                            <option value="Bermuda">Bermuda</option>
                            <option value="Bhutan">Bhutan</option>
                            <option value="Bolivia">Bolivia</option>
                            <option value="Bonaire">Bonaire</option>
                            <option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
                            <option value="Botswana">Botswana</option>
                            <option value="Brazil">Brazil</option>
                            <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                            <option value="Brunei">Brunei</option>
                            <option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option>
                            <option value="Burundi">Burundi</option>
                            <option value="Cambodia">Cambodia</option>
                            <option value="Cameroon">Cameroon</option>
                            <option value="Canada">Canada</option>
                            <option value="Canary Islands">Canary Islands</option>
                            <option value="Cape Verde">Cape Verde</option>
                            <option value="Cayman Islands">Cayman Islands</option>
                            <option value="Central African Republic">Central African Republic</option>
                            <option value="Chad">Chad</option>
                            <option value="Channel Islands">Channel Islands</option>
                            <option value="Chile">Chile</option>
                            <option value="China">China</option>
                            <option value="Christmas Island">Christmas Island</option>
                            <option value="Cocos Island">Cocos Island</option>
                            <option value="Colombia">Colombia</option>
                            <option value="Comoros">Comoros</option>
                            <option value="Congo">Congo</option>
                            <option value="Cook Islands">Cook Islands</option>
                            <option value="Costa Rica">Costa Rica</option>
                            <option value="Cote DIvoire">Cote D'Ivoire</option>
                            <option value="Croatia">Croatia</option>
                            <option value="Cuba">Cuba</option>
                            <option value="Curaco">Curacao</option>
                            <option value="Cyprus">Cyprus</option>
                            <option value="Czech Republic">Czech Republic</option>
                            <option value="Denmark">Denmark</option>
                            <option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option>
                            <option value="Dominican Republic">Dominican Republic</option>
                            <option value="East Timor">East Timor</option>
                            <option value="Ecuador">Ecuador</option>
                            <option value="Egypt">Egypt</option>
                            <option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                            <option value="Eritrea">Eritrea</option>
                            <option value="Estonia">Estonia</option>
                            <option value="Ethiopia">Ethiopia</option>
                            <option value="Falkland Islands">Falkland Islands</option>
                            <option value="Faroe Islands">Faroe Islands</option>
                            <option value="Fiji">Fiji</option>
                            <option value="Finland">Finland</option>
                            <option value="France">France</option>
                            <option value="French Guiana">French Guiana</option>
                            <option value="French Polynesia">French Polynesia</option>
                            <option value="French Southern Ter">French Southern Ter</option>
                            <option value="Gabon">Gabon</option>
                            <option value="Gambia">Gambia</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Germany">Germany</option>
                            <option value="Ghana">Ghana</option>
                            <option value="Gibraltar">Gibraltar</option>
                            <option value="Great Britain">Great Britain</option>
                            <option value="Greece">Greece</option>
                            <option value="Greenland">Greenland</option>
                            <option value="Grenada">Grenada</option>
                            <option value="Guadeloupe">Guadeloupe</option>
                            <option value="Guam">Guam</option>
                            <option value="Guatemala">Guatemala</option>
                            <option value="Guinea">Guinea</option>
                            <option value="Guyana">Guyana</option>
                            <option value="Haiti">Haiti</option>
                            <option value="Hawaii">Hawaii</option>
                            <option value="Honduras">Honduras</option>
                            <option value="Hong Kong">Hong Kong</option>
                            <option value="Hungary">Hungary</option>
                            <option value="Iceland">Iceland</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Iran">Iran</option>
                            <option value="Iraq">Iraq</option>
                            <option value="Ireland">Ireland</option>
                            <option value="Isle of Man">Isle of Man</option>
                            <option value="Israel">Israel</option>
                            <option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option>
                            <option value="Japan">Japan</option>
                            <option value="Jordan">Jordan</option>
                            <option value="Kazakhstan">Kazakhstan</option>
                            <option value="Kenya">Kenya</option>
                            <option value="Kiribati">Kiribati</option>
                            <option value="Korea North">Korea North</option>
                            <option value="Korea Sout">Korea South</option>
                            <option value="Kuwait">Kuwait</option>
                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Laos">Laos</option>
                            <option value="Latvia">Latvia</option>
                            <option value="Lebanon">Lebanon</option>
                            <option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option>
                            <option value="Libya">Libya</option>
                            <option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option>
                            <option value="Luxembourg">Luxembourg</option>
                            <option value="Macau">Macau</option>
                            <option value="Macedonia">Macedonia</option>
                            <option value="Madagascar">Madagascar</option>
                            <option value="Malaysia">Malaysia</option>
                            <option value="Malawi">Malawi</option>
                            <option value="Maldives">Maldives</option>
                            <option value="Mali">Mali</option>
                            <option value="Malta">Malta</option>
                            <option value="Marshall Islands">Marshall Islands</option>
                            <option value="Martinique">Martinique</option>
                            <option value="Mauritania">Mauritania</option>
                            <option value="Mauritius">Mauritius</option>
                            <option value="Mayotte">Mayotte</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Midway Islands">Midway Islands</option>
                            <option value="Moldova">Moldova</option>
                            <option value="Monaco">Monaco</option>
                            <option value="Mongolia">Mongolia</option>
                            <option value="Montserrat">Montserrat</option>
                            <option value="Morocco">Morocco</option>
                            <option value="Mozambique">Mozambique</option>
                            <option value="Myanmar">Myanmar</option>
                            <option value="Nambia">Nambia</option>
                            <option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option>
                            <option value="Netherland Antilles">Netherland Antilles</option>
                            <option value="Netherlands">Netherlands (Holland, Europe)</option>
                            <option value="Nevis">Nevis</option>
                            <option value="New Caledonia">New Caledonia</option>
                            <option value="New Zealand">New Zealand</option>
                            <option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option>
                            <option value="Nigeria">Nigeria</option>
                            <option value="Niue">Niue</option>
                            <option value="Norfolk Island">Norfolk Island</option>
                            <option value="Norway">Norway</option>
                            <option value="Oman">Oman</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Palau Island">Palau Island</option>
                            <option value="Palestine">Palestine</option>
                            <option value="Panama">Panama</option>
                            <option value="Papua New Guinea">Papua New Guinea</option>
                            <option value="Paraguay">Paraguay</option>
                            <option value="Peru">Peru</option>
                            <option value="Phillipines">Philippines</option>
                            <option value="Pitcairn Island">Pitcairn Island</option>
                            <option value="Poland">Poland</option>
                            <option value="Portugal">Portugal</option>
                            <option value="Puerto Rico">Puerto Rico</option>
                            <option value="Qatar">Qatar</option>
                            <option value="Republic of Montenegro">Republic of Montenegro</option>
                            <option value="Republic of Serbia">Republic of Serbia</option>
                            <option value="Reunion">Reunion</option>
                            <option value="Romania">Romania</option>
                            <option value="Russia">Russia</option>
                            <option value="Rwanda">Rwanda</option>
                            <option value="St Barthelemy">St Barthelemy</option>
                            <option value="St Eustatius">St Eustatius</option>
                            <option value="St Helena">St Helena</option>
                            <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                            <option value="St Lucia">St Lucia</option>
                            <option value="St Maarten">St Maarten</option>
                            <option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
                            <option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
                            <option value="Saipan">Saipan</option>
                            <option value="Samoa">Samoa</option>
                            <option value="Samoa American">Samoa American</option>
                            <option value="San Marino">San Marino</option>
                            <option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option>
                            <option value="Senegal">Senegal</option>
                            <option value="Serbia">Serbia</option>
                            <option value="Seychelles">Seychelles</option>
                            <option value="Sierra Leone">Sierra Leone</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Slovakia">Slovakia</option>
                            <option value="Slovenia">Slovenia</option>
                            <option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option>
                            <option value="South Africa">South Africa</option>
                            <option value="Spain">Spain</option>
                            <option value="Sri Lanka">Sri Lanka</option>
                            <option value="Sudan">Sudan</option>
                            <option value="Suriname">Suriname</option>
                            <option value="Swaziland">Swaziland</option>
                            <option value="Sweden">Sweden</option>
                            <option value="Switzerland">Switzerland</option>
                            <option value="Syria">Syria</option>
                            <option value="Tahiti">Tahiti</option>
                            <option value="Taiwan">Taiwan</option>
                            <option value="Tajikistan">Tajikistan</option>
                            <option value="Tanzania">Tanzania</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Togo">Togo</option>
                            <option value="Tokelau">Tokelau</option>
                            <option value="Tonga">Tonga</option>
                            <option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
                            <option value="Tunisia">Tunisia</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option>
                            <option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
                            <option value="Tuvalu">Tuvalu</option>
                            <option value="Uganda">Uganda</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Erimates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States of America">United States of America</option>
                            <option value="Uraguay">Uruguay</option>
                            <option value="Uzbekistan">Uzbekistan</option>
                            <option value="Vanuatu">Vanuatu</option>
                            <option value="Vatican City State">Vatican City State</option>
                            <option value="Venezuela">Venezuela</option>
                            <option value="Vietnam">Vietnam</option>
                            <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                            <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                            <option value="Wake Island">Wake Island</option>
                            <option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
                            <option value="Yemen">Yemen</option>
                            <option value="Zaire">Zaire</option>
                            <option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
                        </select>
                        <input class="form-control m-1 mb-2 mx-2" type="text" placeholder="When" name="when" onfocus="(this.type='date')"
                            onblur="(this.type='text')">
                        <input class="form-control m-1 mb-2 mx-2" type="number" placeholder="Duration (days)" name="duration"
                            min="1" max="60">
                        <select class="form-control m-1 mb-lg-2 mb-3 mx-2" placeholder="No. of Travellers" name="numOfTrav">
                            <option value="" disabled selected>No. of Travellers</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                        <button class="btn btn-success search-btn mx-1 m-auto" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <form action="packages.php" method="GET">
            <input type="hidden" name="where" value="<?php echo $where; ?>" />
            <input type="hidden" name="when" value="<?php echo $when; ?>" />
            <input type="hidden" name="duration" value="<?php echo $dur; ?>" />
            <input type="hidden" name="numOfTrav" value="<?php echo $num; ?>" />
            <div class="row my-3 text-center sorters">
                <div class="col-lg-3">
                    <button class="btn search-btn mx-1 m-auto" value="price_desc" name="order" type="submit"><i class="fas fa-sort-amount-down"></i>
                        Sort by Price DESC</button>
                </div>
                <div class="col-lg-3">
                    <button class="btn search-btn mx-1 m-auto" value="price_asc" name="order" type="submit"><i class="fas fa-sort-amount-up"></i>
                        Sort by Price ASC</button>
                </div>
                <div class="col-lg-3">
                    <button class="btn search-btn mx-1 m-auto" value="date_asc" name="order" type="submit"><i class="fas fa-sort-amount-down"></i>
                        Sort by Earliest Date</button>
                </div>
                <div class="col-lg-3">
                    <button class="btn search-btn mx-1 m-auto" value="date_desc" name="order" type="submit"><i class="fas fa-sort-amount-up"></i>
                        Sort by Latest Date</button>
                </div>
            </div>
            <div class="row my-3 text-center sorters">
                <div class="col-lg-3">
                    <button class="btn search-btn mx-1 m-auto" value="city_desc" name="order" type="submit"><i class="fas fa-sort-amount-down"></i>
                        Sort by City Name DESC</button>
                </div>
                <div class="col-lg-3">
                    <button class="btn search-btn mx-1 m-auto" value="city_asc" name="order" type="submit"><i class="fas fa-sort-amount-up"></i>
                        Sort by City Name ASC</button>
                </div>
                <div class="col-lg-3">
                    <button class="btn search-btn mx-1 m-auto" value="country_desc" name="order" type="submit"><i class="fas fa-sort-amount-down"></i>
                        Sort by Country Name DESC</button>
                </div>
                <div class="col-lg-3">
                    <button class="btn search-btn mx-1 m-auto" value="country_asc" name="order" type="submit"><i class="fas fa-sort-amount-up"></i>
                        Sort by Country Name ASC</button>
                </div>
            </div>
        </form>
        <hr />
        <!-- Card Generation -->
		
        <?php
        include_once("php/db_connect.php");
        $sql = "SELECT * FROM viewpackages WHERE pkg_id>0";

        if (!empty($where)) {
            $sql .= " AND pkg_country = '$where'";
        }

        if (!empty($when)) {
            $sql .= " AND '$when' >= avail_start_date";
            if (!empty($dur)) {
                $laterwhen = date('Y-m-d', strtotime($when . ' + ' . $dur . ' days'));
                $sql .= " AND '$laterwhen' <= avail_end_date";
            }
        }

        if (!empty($order)) {
            if ($order == "price_desc") {
                $sql .= " ORDER BY pkg_price DESC";
            } else if ($order == "price_asc") {
                $sql .= " ORDER BY pkg_price ASC";
            } else if ($order == "date_desc") {
                $sql .= " ORDER BY avail_end_date DESC";
            } else if ($order == "date_asc") {
                $sql .= " ORDER BY avail_end_date ASC";
            } else if ($order == "city_desc") {
                $sql .= " ORDER BY pkg_city DESC";
            } else if ($order == "city_asc") {
                $sql .= " ORDER BY pkg_city ASC";
            } else if ($order == "country_desc") {
                $sql .= " ORDER BY pkg_country DESC";
            } else if ($order == "country_asc") {
                $sql .= " ORDER BY pkg_country ASC";
            }
        }

        //echo $sql;

        $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
        $num_rows = mysqli_num_rows($resultset);
	
        if ($num_rows == 0) {
            echo '<h1 class="display-3 pb-5 text-center">No packages found!</h1>';
			echo '<h1 class="display-3 pb-5 text-center"><br><br><br></h1>';
        
		
		} elseif ($num_rows ==1) {
			
		while( $record = mysqli_fetch_assoc($resultset) ) {
		
        ?>
        <div class="card my-3">
            <div class="row no-gutters">
                <img src="./resources/<?php echo $record['pkg_image']; ?>" alt="" width="300"/>
                <div class="col">
                    <div class="card-body">
                        <h4 class="card-title">
                            <?php echo $record['pkg_city']; ?>,
                            <?php echo $record['pkg_country']; ?>
                        </h4>
                        <h3 class="card-title mb-2">
                            £
                            <?php echo $record['pkg_price']; ?>
                        </h3>
                        <p class="card-text">
                            <?php echo $record['pkg_description']; ?>
                        </p>
                        <form action="payments.php" method="GET">
                            <input type='hidden' name="package" value="<?php echo $record['pkg_id']; ?>">
                            <button class="btn btn-success buy-btn mx-1 m-auto" type="buy"><i class="fas fa-shopping-cart"></i> Buy</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

		<h1 class="display-3 pb-5 text-center"><br><br></h1>
		
        <?php } 
        } else {
        while( $record = mysqli_fetch_assoc($resultset) ) {
        ?>
        <div class="card my-3">
            <div class="row no-gutters">
                <img src="./resources/<?php echo $record['pkg_image']; ?>" alt="" width="300"/>
                <div class="col">
                    <div class="card-body">
                        <h4 class="card-title">
                            <?php echo $record['pkg_city']; ?>,
                            <?php echo $record['pkg_country']; ?>
                        </h4>
                        <h3 class="card-title mb-2">
                            £
                            <?php echo $record['pkg_price']; ?>
                        </h3>
                        <p class="card-text">
                            <?php echo $record['pkg_description']; ?>
                        </p>
                        <form action="payments.php" method="GET">
                            <input type='hidden' name="package" value="<?php echo $record['pkg_id']; ?>">
                            <button class="btn btn-success buy-btn mx-1 m-auto" type="buy"><i class="fas fa-shopping-cart"></i> Buy</button>
                        </form>
                    </div>
                </div>
            </div>
			
        </div>
		
        <?php } } ?>
        
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

    <script type="text/javascript">
        $(document).ready(function () {
            // executes when HTML-Document is loaded and DOM is ready
            console.log("document is ready");


            $(".card").hover(
                function () {
                    $(this).addClass('shadow-lg').css('cursor', 'pointer');
                },
                function () {
                    $(this).removeClass('shadow-lg');
                }
            );

            // document ready
        });
    </script>

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