<?php
include('config.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./css/userEditition.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Users</title>
</head>
<?php


if (isset($_POST['add_user'])) {

    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_pass = sha1($_POST['user_pass']);
    $user_type = $_POST['user_type'];


    $insert = "insert into users(name , email , password , type) values
     ('$user_name', '$user_email', '$user_pass', '$user_type')";
    mysqli_query($conn, $insert);
    header('location:dashboard_users.php');
}

?>

<body>
    <div class="back">
        <div class="container">
            <div class="login-box">
                <p>Add User's Info</p>
                <form action="adduser.php" method="post">
                    <div class="user-box">
                        <input required="" name="user_type" type="text">
                        <label>Type</label>
                    </div>
                    <div class="user-box">
                        <input required="" name="user_name" type="text">
                        <label>Name</label>
                    </div>
                    <div class="user-box">
                        <input required="" name="user_email" type="email">
                        <label>Email</label>
                    </div>
                    <div class="user-box">
                        <input required="" name="user_pass" type="password">
                        <label>Password</label>
                    </div>


                    <button name="add_user" type="submit" class="animatedBtn"><span></span>
                        <span></span>
                        <span></span>
                        <span></span> Add User</button>
                </form>

            </div>
        </div>
    </div>
</body>

</html>