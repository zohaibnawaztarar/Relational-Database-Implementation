<?php
include_once "../../../php/db_connect.php";

if (isset($_GET['add'])) {
$branch_name = $_GET['branch_name'];
$branch_phone_number = $_GET['branch_phone_number'];
$branch_email= $_GET['branch_email'];
$address_address_id = $_GET['address_address_id'];

$sql = "INSERT INTO branch (branch_name, branch_phone_number, branch_email, address_address_id) VALUES ('$branch_name', '$branch_phone_number', '$branch_email', '$address_address_id')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


} else {
    echo "Something went wrong! Please go back and ensure all the fields are filled in correctly.";
}

echo '<button onclick="location.href=\'../../branches.php?added=added\';">Go Back</button>';
mysqli_close($conn);
?>