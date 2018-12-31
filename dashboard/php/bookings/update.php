<?php
include_once "../../../php/db_connect.php";

if (isset($_GET['update'])) {
    $id = $_GET['id_update'];
    $reference = $_GET['reference'];
    $date = $_GET['date'];
    $details = $_GET['details'];
    $customer_id = $_GET['customer_id'];
    $branch_id = $_GET['branch_id'];
    $pkg_id = $_GET['pkg_id'];
    $service_booking_id = $_GET['service_booking_id'];

$sql = "UPDATE booking SET booking_reference = '$reference', booking_date = '$date', booking_details = '$details', customers_customer_id = '$customer_id', branch_branch_id = '$branch_id', package_pkg_id = '$pkg_id', service_booking_id = '$service_booking_id' WHERE booking_id = '$id'";

if (mysqli_query($conn, $sql)) {
    echo "Modified Record Successfully.";
    echo '<button onclick="location.href=\'../../bookings.php?updated=updated\';">Go Back</button>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    echo "<br>";
    echo "<br>";
    echo '<button onclick="location.href=\'../../bookings.php?cancel=cancel\';">Go Back</button>';
}


} else {
    echo "Update operation cancelled!";
    echo "<br>";
    echo "<br>";
    echo '<button onclick="location.href=\'../../bookings.php?cancel=cancel\';">Go Back</button>';
}


mysqli_close($conn);
?>