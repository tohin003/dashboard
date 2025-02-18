<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tohinphp";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn) {
    echo "connected"; 
} else {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['submit'])) {
    $id = $_GET['id'];
    echo "ID to delete: $id"; 

    $query = "DELETE FROM `products` WHERE `id`='$id'";
    echo "Query: $query"; 

    $data = mysqli_query($conn, $query);

    if ($data) {
        echo "Record deleted Successfully!";  
        ?>
        <meta http-equiv="refresh" content="0; url=http://localhost/purple/dist/pages/tables/product-table.php">
        <?php
    } else {
        echo "Record deletion Failed.";  
        echo "Error: " . mysqli_error($conn); // Show MySQL error
    }
} else {
    echo "Click on the delete button to save the changes";
}

?>

