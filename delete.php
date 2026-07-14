<?php

$conn = new mysqli("localhost", "root", "", "user_management");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "DELETE FROM users WHERE id = $id";


    if ($conn->query($sql) === TRUE) {

        echo "User deleted successfully!";

        header("refresh:2;url=index.php");

    } else {

        echo "Error: " . $conn->error;

    }

}


$conn->close();

?>