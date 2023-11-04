<!DOCTYPE html>
<html lang="en">
<?php
require('config.php');
session_start();
//IF USER IS LOGGED IN GO BACK TO INDEX

//if (isset($_SESSION['username'])) {
//header('location:user.php');
//}







$message = "";
$name_error = "";
$pass_error = "";
if (isset($_POST['sign_up'])) {
    $Name = $_POST['name'];
    $Email = $_POST['email_reg'];
    $password = $_POST['pass_reg'];
    if (strlen($password) < 6) {
        $pass_error = 'Your password needs to have a minmun of 6 letters <br>';
    }
    if (filter_var($Name, FILTER_VALIDATE_INT)) {
        $name_error = 'Please enter a valid username not a number  <br>';
    }
    if (strlen($password) >= 6 && !filter_var($Name, FILTER_VALIDATE_INT)) {
        $query1 = "select name , email , password  from users where email='$Email'";
        $results = $conn->query($query1);
        if ($results->num_rows > 0) {
            $message = "You already Registered";
        } else {

            $newpassword = sha1($password);  // encrypt
            $query2 = "insert into users(name , email , password , type) values ('$Name', '$Email', '$newpassword' , 1)";
            $conn->query($query2);
            $_SESSION['username'] = $Name;
            header('location:user.php');
        }
    }
}

?>

<head>
    <title>Library Management System</title>
    <link rel="stylesheet" type="text/css" href="./css/project.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="main">
            <input type="checkbox" id="chk" aria-hidden="true">
            <?php if (isset($_GET["login_required"])) : ?>
            <div style="padding: 0px 0px;color: red;text-align: center;">
                <p> You need to login first to view book details</p>
            </div>
            <?php endif; ?>
            <div class="signup">
                <form method="POST" action="">
                    <label for="chk" aria-hidden="true">Sign up</label>
                    <input type="text" name="name" placeholder="User name" required="">
                    <div style="padding: 0px 60px;">
                        <p style="font-size:12px;color:red;">
                            <?php echo $name_error; ?>
                        </p>
                    </div>
                    <input type="email" name="email_reg" placeholder="Email" required="">
                    <input type="password" name="pass_reg" placeholder="Password" required="">
                    <div style="padding: 0px 60px;">
                        <p style="font-size:12px;color:red;">
                            <?php echo $pass_error; ?>
                        </p>
                    </div>
                    <div style="padding: 0px 60px;">
                        <p style="font-size:12px;color:red;">
                            <?php echo $message; ?>
                        </p>
                    </div>
                    <button name="sign_up">Sign up</button>
                </form>
            </div>


            <?php     // login 

            if (isset($_POST['login'])) {
                $Email_log = $_POST['email_log'];
                $password_log =  sha1($_POST['pass_log']);
                $query2 = "select name, email , password ,type  from users where email='$Email_log' AND password='$password_log'";
                $results = $conn->query($query2);
                $arr = $results->fetch_array();
                $username = $arr[0];
                $email = $arr[1];
                $pass = $arr[2];
                $type = $arr[3];
                // if ($results->num_rows > 0) {

                if ($email == $Email_log && $pass == $password_log) {
                    $_SESSION['username'] = $username;
                    $_SESSION['type'] = $type;

                    if ($type == 0) {
                        header('location:home_admin.php');
                    } else {


                        header('location:user.php');
                    }
                } else {
                    echo "<script>
                                    alert('wrong email or password!');
                                </script>";
                    echo "<script>
                                    window.location.href = 'login.php'
                                </script>";
                }


                // if ($results->num_rows > 0) {
                // encrypt

                //if oldpass=newpass
                //echo "<script>window.location.href = 'index.php'</script>";
                //         header('location:user.php');
                //     } else {
                //         echo "<script>alert('Incorrect Password')</script>";
                //     }
            }

            ?>



            <div class="login">
                <form method="POST" action="">
                    <label for="chk" aria-hidden="true">Login</label>
                    <input type="email" name="email_log" placeholder="Email" required="">
                    <input type="password" name="pass_log" placeholder="Password" required="">
                    <button name="login">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>