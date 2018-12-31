<?php
include_once "../../../php/db_connect.php";

if (isset($_GET['add'])) {
$firstname = $_GET['first_name'];
$lastname = $_GET['last_name'];
$phone = $_GET['phone'];
$email = $_GET['email'];
$age = $_GET['age'];
$gender = $_GET['gender'];
$nation = $_GET['nation'];
$address_id = $_GET['address_id'];

$sql = "INSERT INTO customers (customer_first_name, customer_last_name, customer_phone, customer_email, customer_age, customer_gender, customer_nationality, address_address_id) VALUES ('$firstname', '$lastname', '$phone', '$email', '$age', '$gender', '$nation', '$address_id')";

if (mysqli_query($conn, $sql)) {
    echo "New Record Created Successfully";
    echo '<button onclick="location.href=\'../../customers.php?added=added\';">Go Back</button>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    echo "<br>";
    echo "<br>";
    echo '<button onclick="location.href=\'../../customers.php?cancel=cancel\';">Go Back</button>';
}


} else {
    echo "Insert operation cancelled!";
    echo "<br>";
    echo "<br>";
    echo '<button onclick="location.href=\'../../customers.php?cancel=cancel\';">Go Back</button>';
}


mysqli_close($conn);
?>