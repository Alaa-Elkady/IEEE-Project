<?php
require_once('config.php');
if (isset($_GET['deleteid'])) {                                            // get..> access variable/parameter from url 
    $user_id = $_GET['deleteid'];             // access deleteid from url 

    $query3 = "delete from users where id =$user_id";
    $results = $conn->query($query3);
    if ($results) {
        header('location:dashboard_users.php');
    } else {
        die(mysqli_error($conn));
    }
}
