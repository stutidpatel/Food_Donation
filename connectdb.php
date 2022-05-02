<?php

    $servername = "localhost";
    $username = "root";
    $password1 = "";
    $database = "test";

    $conn = mysqli_connect($servername, $username, $password1, $database,5306);
    if (!$conn)
        die("Sorry we failed to connect: ". mysqli_connect_error());

?>