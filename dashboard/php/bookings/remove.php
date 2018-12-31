<?php
include_once "../../../php/db_connect.php";

if (isset($_GET['remove'])) {
    $id = $_GET['id_delete'];

    $sql = "DELETE FROM booking WHERE booking_id='$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Record $id deleted successfully.";
        echo '<button onclick="location.href=\'../../bookings.php?removed=removed\';">Go Back</button>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        echo "<br>";
        echo "<br>";
        echo '<button onclick="location.href=\'../../bookings.php?cancel=cancel\';">Go Back</button>';
    }

} else {
    echo "Remove operation cancelled!";
    echo "<br>";
    echo "<br>";
    echo '<button onclick="location.href=\'../../bookings.php?cancel=cancel\';">Go Back</button>';
}


mysqli_close($conn);
?>