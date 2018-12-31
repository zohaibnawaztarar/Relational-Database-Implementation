<?php
include_once "../../../php/db_connect.php";

if (isset($_GET['add'])) {
    $reference = $_GET['reference'];
    $date = $_GET['date'];
    $details = $_GET['details'];
    $customer_id = $_GET['customer_id'];
    $branch_id = $_GET['branch_id'];
    $pkg_id = $_GET['pkg_id'];
    $service_booking_id = $_GET['service_booking_id'];
    
    $sql = "INSERT INTO booking (booking_reference, booking_date, booking_details, customers_customer_id, branch_branch_id, package_pkg_id, service_booking_id) VALUES ('$reference', '$date', '$details', '$customer_id', '$branch_id', '$pkg_id', '$service_booking_id')";

    if (mysqli_query($conn, $sql)) {
    echo "New Record Created Successfully";
    echo '<button onclick="location.href=\'../../bookings.php?added=added\';">Go Back</button>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    echo "<br>";
    echo "<br>";
    echo '<button onclick="location.href=\'../../bookings.php?cancel=cancel\';">Go Back</button>';
}


} else {
    echo "Insert operation cancelled!";
    echo "<br>";
    echo "<br>";
    echo '<button onclick="location.href=\'../../bookings.php?cancel=cancel\';">Go Back</button>';
}


mysqli_close($conn);
?>