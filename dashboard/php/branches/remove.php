<?php
include_once "../../../php/db_connect.php";

if (isset($_GET['remove'])) {
    $id = $_GET['id_delete'];

    $sql = "DELETE FROM branch WHERE branch_id='$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Record $id deleted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

} else {
    echo "Something went wrong! Please go back and ensure all the fields are filled in correctly.";
}

echo '<button onclick="location.href=\'../../branches.php?removed=removed\';">Go Back</button>';
mysqli_close($conn);
?>