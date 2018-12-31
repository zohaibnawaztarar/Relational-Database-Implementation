<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Team 3">

    <title>OpenAir Booking | Bookings</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
        crossorigin="anonymous">

    <!-- Custom CSS -->
    <link href="css/dash.css" rel="stylesheet">
	

    <!-- Connect to the database -->
    <?php include_once "../php/db_connect.php"; ?>
    <?php include_once "php/display.php"; ?>
</head>

<body>
    <div id="id1" class="userDetails">
        <?php
error_reporting(E_ALL & ~E_NOTICE); //Hide error messages (e.g. notices on homepage, will only be turned on when releasing website)
$url = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
$message = "REFERER is: " . parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
//echo "<script type='text/javascript'>alert('$message');</script>";

$userName = "";
$encrypPass = "";

//Check website navigating from before allowing post requests only if ftom the same server as this
if ($url != "") { //If the referee is not an about:blank page or been entered from the URL bar or a first entry
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
if ($url == "") { //If the referee is an about:blank page or been entered from the URL bar or a first entry
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

if ($encrypPass == "") {
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
        <a class="navbar-brand" href="../index.php"><i class="fas fa-paper-plane"></i> OpenAir Booking</a>
        <button class="navbar-toggler my-1" type="button" data-toggle="collapse" data-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../about.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../packages.php">Packages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../faq.php">FAQs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../contact-us.php">Contact Us</a>
                </li>
            </ul>
            <form class="navbar-form form-inline" action="../login.php" method="POST">
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
                        <a class="nav-link active account" href="../dashboard.php">
                            <?php
if ($userName != "") {
    echo "$userName" . "'s ";
}
?>Account
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="../login.php" method="POST">
                            <input type='hidden' name="logout" value="true">
                            <button class="btn btn-outline-success login-btn my-2 my-sm-0 mr-2" type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="header">
        <div class="container">
            <div class="row">
                <div class="text-center mx-auto mb-4">
                    <h1 class="my-5">
                    <?php
                        if ($userName != "") {
                            echo "$userName" . "'s ";
                        }
                    ?>Dashboard</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="dash">
        <div class="container">
            <div class="row justify-content-around mt-5">
                <div class="col-sm-4 m-auto">
                    <button class="btn back-btn" onclick="location.href='../dashboard.php';" type="back"><i class="fas fa-long-arrow-alt-left"></i>
                        Back to Dash</button>
                </div>
                <div class="col-sm-8 m-auto text-center">
                    <h1><i class="fas fa-briefcase"></i> Bookings</h1>
                    <?php
                    if (isset($_GET['cancel'])) {
                        echo '<h4 style="color: grey;"><i class="fas fa-ban" style="color: var(--accent)"></i> Cancelled Action!</h4>';
                        echo '<br/>';
                    }
                    ?>
                </div>
            </div>
            <div class="row my-5">
                <div class="col-sm-4 buttonlist">
                    <button id="view" class="btn crud-btn my-1" onclick="showHideCRUD(this.id)" type="back">View All</button>
                    <button id="add" class="btn crud-btn my-1" onclick="showHideCRUD(this.id)" type="back">Create Booking</button>
                    <button id="update" class="btn crud-btn my-1" onclick="showHideCRUD(this.id)" type="back">Update Booking</button>
                    <button id="remove" class="btn crud-btn my-1" onclick="showHideCRUD(this.id)" type="back">Remove Booking</button>
                </div>
                <div class="col-sm-8">
                    <div id="view_all_div">
                        <div class="table-responsive-xl">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Reference</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Details</th>
                                        <th scope="col">Customer ID</th>
                                        <th scope="col">Branch ID</th>
                                        <th scope="col">Package ID</th>
                                        <th scope="col">Service Booking ID</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php tableBookingsShow($conn); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="add_div">
                        <form action="php/bookings/add.php" method="GET">
                                <div class="form-group form-inline my-1">
                                    <label class="mx-3">Reference:</label>
                                    <input name="reference" class="form-control" type="text" placeholder="e.g. ABC-DEF-1" value="" required />
                                </div>
                                <div class="form-group form-inline my-1">
                                    <label class="mx-3">Date:</label>
                                    <input name="date" class="form-control" type="date" placeholder="e.g. yyyy-mm-dd" value="" required />
                                </div>
                                <div class="form-group form-inline my-1">
                                    <label class="mx-3">Details:</label>
                                    <input name="details" class="form-control" type="text" placeholder="e.g. Payment received: 2018-11-12" value="" required />
                                </div>
                                <div class="form-group form-inline my-1">
                                    <label class="mx-3">Customer ID:</label>
                                    <select name="customer_id" class="form-control" required>
                                    <?php
                                        $sql_customer = "SELECT * FROM customers";
                                        $resultset_customer = mysqli_query($conn, $sql_customer) or die("database error:" . mysqli_error($conn));
                                        while ($record_customer = mysqli_fetch_assoc($resultset_customer)) {
                                            unset($customer_id, $customer_desc);
                                            $customer_id = $record_customer['customer_id'];
                                            $customer_desc = $record_customer['customer_first_name'] . " " . $record_customer['customer_last_name'];
                                            ?>
                                    <option value="<?php echo $customer_id; ?>">
                                        <?php echo $customer_id . " - " . $customer_desc ?>
                                    </option>';
                                    <?php }?>
                                </select>
                                </div>
                                <div class="form-group form-inline my-1">
                                    <label class="mx-3">Branch ID:</label>
                                    <select name="branch_id" class="form-control" required>
                                    <?php
                                        $sql_branch = "SELECT * FROM branch";
                                        $resultset_branch = mysqli_query($conn, $sql_branch) or die("database error:" . mysqli_error($conn));
                                        while ($record_branch = mysqli_fetch_assoc($resultset_branch)) {
                                            unset($branch_id, $branch_name);
                                            $branch_id = $record_branch['branch_id'];
                                            $branch_desc = $record_branch['branch_name'];
                                            ?>
                                    <option value="<?php echo $branch_id; ?>">
                                        <?php echo $branch_id . " - " . $branch_desc ?>
                                    </option>';
                                    <?php }?>
                                </select>
                                </div>
                                <div class="form-group form-inline my-1">
                                    <label class="mx-3">Package ID:</label>
                                    <select name="pkg_id" class="form-control" required>
                                    <?php
                                        $sql_pkg = "SELECT * FROM package";
                                        $resultset_pkg = mysqli_query($conn, $sql_pkg) or die("database error:" . mysqli_error($conn));
                                        while ($record_pkg = mysqli_fetch_assoc($resultset_pkg)) {
                                            unset($pkg_id, $pkg_name);
                                            $pkg_id = $record_pkg['pkg_id'];
                                            $pkg_desc = $record_pkg['pkg_city'];
                                            ?>
                                    <option value="<?php echo $pkg_id; ?>">
                                        <?php echo $pkg_id . " - " . $pkg_desc ?>
                                    </option>';
                                    <?php }?>
                                </select>
                                </div>
                                <div class="form-group form-inline my-1">
                                    <label class="mx-3">Service Booking ID:</label>
                                    <select name="service_booking_id" class="form-control" required>
                                    <?php
                                        $sql_service_booking = "SELECT * FROM service_booking";
                                        $resultset_service_booking = mysqli_query($conn, $sql_service_booking) or die("database error:" . mysqli_error($conn));
                                        while ($record_service_booking = mysqli_fetch_assoc($resultset_service_booking)) {
                                            unset($service_booking_id, $service_booking_name);
                                            $service_booking_id = $record_service_booking['service_booking_id'];
                                            $service_booking_desc = $record_service_booking['service_booking_start_date'] . " - " . $record_service_booking['service_booking_end_date'];
                                            ?>
                                    <option value="<?php echo $service_booking_id; ?>">
                                        <?php echo $service_booking_id . " - " . $service_booking_desc ?>
                                    </option>';
                                    <?php }?>
                                </select>
                                </div>
                                <div class="form-group form-inline my-4">
                                    <button type="submit" class="btn btn-danger mx-2" name="add" value="add">Add</button>
                                    <button type="submit" class="btn btn-secondary" name="cancel" value="cancel" formnovalidate>Cancel</button>
                                </div>
                        </form>
                    </div>
                    <div id="update_div">
                    <?php
                        if (!isset($_GET['update_booking_id_select'])) { ?>
                        <form action="" method="GET">
                            <div class="form-group">
                                <label for="update_booking_select">Select Booking to Modify:</label>
                                <select class="form-control" id="update_booking_select" name="update_booking_id_select">
                                    <?php
                                        $sql = "SELECT * FROM booking";
                                        $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                        while ($record = mysqli_fetch_assoc($resultset)) {
                                            unset($id, $name);
                                            $id = $record['booking_id'];
                                            $desc = $record['booking_reference'];
                                            ?>
                                    <option value="<?php echo $id; ?>">
                                        <?php echo $id . " - " . $desc ?>
                                    </option>';
                                    <?php }?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" name="select" value="select">Select</button>
                        </form> 
                    <?php } ?>
                        <div id="update_details">
                            <?php
                                if (isset($_GET['update_booking_id_select'])) {
                                    $usr = $_GET['update_booking_id_select'];
                                    $sql = "SELECT * FROM booking WHERE booking_id = $usr";
                                    $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                    while ($record = mysqli_fetch_assoc($resultset)) {
                            ?>
                            <form action="php/bookings/update.php" method="GET">
                                <input name="id_update" class="form-control" type="hidden" value="<?php echo $record['booking_id']; ?>" required />
                                <div class="form-group form-inline my-1">
                                    <label class="mx-3">Reference:</label>
                                    <input name="reference" class="form-control" type="text" value="<?php echo $record['booking_reference']; ?>" required />
                                </div>
                                <div class="form-group form-inline my-1">
                                    <label class="mx-3">Date:</label>
                                    <input name="date" class="form-control" type="date" value="<?php echo $record['booking_date']; ?>" required />
                                </div>
                                <div class="form-group form-inline my-1">
                                    <label class="mx-3">Details:</label>
                                    <input name="details" class="form-control" type="text" value="<?php echo $record['booking_details']; ?>" required />
                                </div>
                                <div class="form-group form-inline my-1">
                                    <label class="mx-3">Customer ID:</label>
                                    <select name="customer_id" class="form-control" required>
                                    <?php
                                        $sql_customer = "SELECT * FROM customers";
                                        $resultset_customer = mysqli_query($conn, $sql_customer) or die("database error:" . mysqli_error($conn));
                                        while ($record_customer = mysqli_fetch_assoc($resultset_customer)) {
                                            unset($customer_id, $customer_desc);
                                            $customer_id = $record_customer['customer_id'];
                                            $customer_desc = $record_customer['customer_first_name'] . " " . $record_customer['customer_last_name'];
                                            ?>
                                    <option value="<?php echo $customer_id; 
                                    if ($record['customers_customer_id'] == $record_customer['customer_id']) {
                                        echo "\" selected=\"selected";
                                    }
                                    ?>">
                                        <?php echo $customer_id . " - " . $customer_desc ?>
                                    </option>';
                                    <?php }?>
                                </select>
                                </div>
                                <div class="form-group form-inline my-1">
                                    <label class="mx-3">Branch ID:</label>
                                    <select name="branch_id" class="form-control" required>
                                    <?php
                                        $sql_branch = "SELECT * FROM branch";
                                        $resultset_branch = mysqli_query($conn, $sql_branch) or die("database error:" . mysqli_error($conn));
                                        while ($record_branch = mysqli_fetch_assoc($resultset_branch)) {
                                            unset($branch_id, $branch_name);
                                            $branch_id = $record_branch['branch_id'];
                                            $branch_desc = $record_branch['branch_name'];
                                            ?>
                                    <option value="<?php echo $branch_id; 
                                    if ($record['branch_branch_id'] == $record_branch['branch_id']) {
                                        echo "\" selected=\"selected";
                                    }
                                    ?>">
                                        <?php echo $branch_id . " - " . $branch_desc ?>
                                    </option>';
                                    <?php }?>
                                </select>
                                </div>
                                <div class="form-group form-inline my-1">
                                    <label class="mx-3">Package ID:</label>
                                    <select name="pkg_id" class="form-control" required>
                                    <?php
                                        $sql_pkg = "SELECT * FROM package";
                                        $resultset_pkg = mysqli_query($conn, $sql_pkg) or die("database error:" . mysqli_error($conn));
                                        while ($record_pkg = mysqli_fetch_assoc($resultset_pkg)) {
                                            unset($pkg_id, $pkg_name);
                                            $pkg_id = $record_pkg['pkg_id'];
                                            $pkg_desc = $record_pkg['pkg_city'];
                                            ?>
                                    <option value="<?php echo $pkg_id; 
                                    if ($record['package_pkg_id'] == $record_pkg['pkg_id']) {
                                        echo "\" selected=\"selected";
                                    }
                                    ?>">
                                        <?php echo $pkg_id . " - " . $pkg_desc ?>
                                    </option>';
                                    <?php }?>
                                </select>
                                </div>
                                <div class="form-group form-inline my-1">
                                    <label class="mx-3">Service Booking ID:</label>
                                    <select name="service_booking_id" class="form-control" required>
                                    <?php
                                        $sql_service_booking = "SELECT * FROM service_booking";
                                        $resultset_service_booking = mysqli_query($conn, $sql_service_booking) or die("database error:" . mysqli_error($conn));
                                        while ($record_service_booking = mysqli_fetch_assoc($resultset_service_booking)) {
                                            unset($service_booking_id, $service_booking_name);
                                            $service_booking_id = $record_service_booking['service_booking_id'];
                                            $service_booking_desc = $record_service_booking['service_booking_start_date'] . " - " . $record_service_booking['service_booking_end_date'];
                                            ?>
                                    <option value="<?php echo $service_booking_id; 
                                    if ($record['service_booking_id'] == $record_service_booking['service_booking_id']) {
                                        echo "\" selected=\"selected";
                                    }
                                    ?>">
                                        <?php echo $service_booking_id . " - " . $service_booking_desc ?>
                                    </option>';
                                    <?php }?>
                                </select>
                                </div>
                                <div class="form-group form-inline my-4">
                                    <button type="submit" class="btn btn-danger mx-2" name="update" value="update">Update</button>
                                    <button type="submit" class="btn btn-secondary" name="cancel" value="cancel" formnovalidate>Cancel</button>
                                </div>
                            </form>
                                    <?php } }?> 
                        </div>
                    </div>
                    <div id="remove_div">
                    <?php
                        if (!isset($_GET['remove_booking_id_select'])) { ?>
                        <form action="" method="GET">
                            <div class="form-group">
                                <label for="remove_booking_select">Select Booking to Remove:</label>
                                <select class="form-control" id="remove_booking_select" name="remove_booking_id_select">
                                    <?php
                                        $sql = "SELECT * FROM booking";
                                        $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                        while ($record = mysqli_fetch_assoc($resultset)) {
                                            unset($id, $name);
                                            $id = $record['booking_id'];
                                            $desc = $record['booking_reference'];
                                            ?>
                                    <option value="<?php echo $id; ?>">
                                        <?php echo $id . " - " . $desc ?>
                                    </option>';
                                    <?php }?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" name="select" value="select">Select</button>
                        </form> 
                    <?php } ?>
                        <div id="remove_details">
                            <?php
                                if (isset($_GET['remove_booking_id_select'])) {
                                    $usr = $_GET['remove_booking_id_select'];
                                    $sql = "SELECT * FROM booking WHERE booking_id = $usr";
                                    $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
                                    while ($record = mysqli_fetch_assoc($resultset)) {
                            ?>
                            <form action="" method="GET">
                            <div class="form-group form-inline my-1">
                                    <label class="mx-3">Reference:</label>
                                    <input class="form-control" type="text" value="<?php echo $record['booking_reference']; ?>" readonly />
                                </div>
                                <div class="form-group form-inline my-1">
                                    <label class="mx-3">Date:</label>
                                    <input class="form-control" type="date" value="<?php echo $record['booking_date']; ?>" readonly />
                                </div>
                                <div class="form-group form-inline my-1">
                                    <label class="mx-3">Details:</label>
                                    <input class="form-control" type="text" value="<?php echo $record['booking_details']; ?>" readonly />
                                </div>
                                <div class="form-group form-inline my-1">
                                    <label class="mx-3">Customer ID:</label>
                                    <input class="form-control" type="text" value="<?php echo $record['customers_customer_id']; ?>" readonly />
                                </div>
                                <div class="form-group form-inline my-1">
                                    <label class="mx-3">Branch ID:</label>
                                    <input class="form-control" type="text" value="<?php echo $record['branch_branch_id']; ?>" readonly />
                                </div>
                                <div class="form-group form-inline my-1">
                                    <label class="mx-3">Package ID:</label>
                                    <input class="form-control" type="text" value="<?php echo $record['package_pkg_id']; ?>" readonly />
                                </div>
                                <div class="form-group form-inline my-1">
                                    <label class="mx-3">Service Booking ID:</label>
                                    <input class="form-control" type="text" value="<?php echo $record['service_booking_id']; ?>" readonly />
                                </div>
                                <div class="form-group form-inline my-4">
                                <button type="submit" class="btn btn-secondary mx-2" name="cancel" value="cancel">Cancel</button>
                                    </div>
                            </form>
                            <form action="php/bookings/remove.php" method="GET">
                                <div class="form-group form-inline m-0">
                                    <input name="id_delete" class="form-control" type="hidden" value="<?php echo $record['booking_id']; ?>" readonly />
                                </div>
                                <div class="form-group form-inline mb-4">
                                    <button type="submit" class="btn btn-danger mx-2" name="remove" value="remove">Remove</button>
                                </div>
                            </form>
                                    <?php } }?> 
                        </div>
                    </div>
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

    <div id="id8" class="showHideElements">
        <?php
if (($userName != "") && ($encrypPass != "")) {
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

        <script type="text/javascript">
            function showHideCRUD(clicked_id) {
                var v = document.getElementById("view_all_div");
                var a = document.getElementById("add_div");
                var u = document.getElementById("update_div");
                var r = document.getElementById("remove_div");
                if (clicked_id == "view") {
                    a.style.display = "none";
                    u.style.display = "none";
                    r.style.display = "none";
                    v.style.display = "block";
                } else if (clicked_id == "add") {
                    v.style.display = "none";
                    u.style.display = "none";
                    r.style.display = "none";
                    a.style.display = "block";
                } else if (clicked_id == "update") {
                    a.style.display = "none";
                    v.style.display = "none";
                    r.style.display = "none";
                    u.style.display = "block";
                } else {
                    a.style.display = "none";
                    u.style.display = "none";
                    v.style.display = "none";
                    r.style.display = "block";
                }
            }
        </script>
            <script type="text/javascript">
                var v = document.getElementById("view_all_div");
                var a = document.getElementById("add_div");
                var u = document.getElementById("update_div");
                var r = document.getElementById("remove_div");

                <?php
                if (isset($_GET['select'])) {
                    if (isset($_GET['update_booking_id_select'])) {
                        echo 'u.style.display = "block";';
                    } else if (isset($_GET['remove_booking_id_select'])) {
                        echo 'r.style.display = "block";';
                    } else {
                        echo 'v.style.display = "block";';
                    }
                } else {
                    echo 'v.style.display = "block";';
                }
                ?>
    </script>
    </div>
</body>

</html>