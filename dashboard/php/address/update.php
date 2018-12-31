<?php
include_once "../../../php/db_connect.php";

if (isset($_GET['update'])) {
$id = $_GET['id_update'];
$firstname = $_GET['first_name'];
$lastname = $_GET['last_name'];
$phone = $_GET['phone'];
$email = $_GET['email'];
$age = $_GET['age'];
$gender = $_GET['gender'];
$nation = $_GET['nation'];
$address_id = $_GET['address_id'];

$sql = "UPDATE customers SET customer_first_name = '$firstname', customer_last_name = '$lastname', customer_phone = '$phone', customer_email = '$email', customer_age = '$age', customer_gender = '$gender', customer_nationality = '$nation', address_address_id ='$address_id' WHERE customer_id = '$id'";

if (mysqli_query($conn, $sql)) {
    echo "Modified Record Successfully.";
    echo '<button onclick="location.href=\'../../customers.php?updated=updated\';">Go Back</button>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    echo "<br>";
    echo "<br>";
    echo '<button onclick="location.href=\'../../customers.php?cancel=cancel\';">Go Back</button>';
}


} else {
    echo "Something went wrong! Please go back and ensure all the fields are filled in correctly.";
    echo "<br>";
    echo "<br>";
    echo '<button onclick="location.href=\'../../customers.php?cancel=cancel\';">Go Back</button>';
}


mysqli_close($conn);
?>