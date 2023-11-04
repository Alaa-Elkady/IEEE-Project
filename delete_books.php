<?php
require_once('config.php');
if (isset($_GET['deleteid'])) {                                            // get..> access variable/parameter from url 
    $book_id = $_GET['deleteid'];             // access deleteid from url 

    $query3 = "delete from library where book_id =$book_id";
    $results = $conn->query($query3);
    if ($results) {
        header('location:dashboard_books.php');
    } else {
        die(mysqli_error($conn));
    }
}