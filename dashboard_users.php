<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<!DOCTYPE html>
<html lang="en">
<?php
require('config.php');
$sql = "select * from users";
$result = $conn->query($sql);
?>


<head>
    <link rel="stylesheet" type="text/css" href="./css/2ndo.css" />
    <link rel="stylesheet" type="text/css" href="./css/Dashboard.css" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Users List</title>
</head>

<body>
    <?php
    include('userdashboard_header.php');
    ?>

    <div class="users">
        <div class="cont-table">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">type</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {

                ?>
                    <tbody>


                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?php if ($row['type'] == 0) {
                                    echo "Admin";
                                } else {
                                    echo "User";
                                } ?>





                            </td>

                            <td>

                                <form action="" class="dB">
                                    <div><a class="btn edit" href="edituser.php?editid=<?= $row['id'] ?>"> Edit</a>
                                    </div>
                                    <div><a class="btn clear" href="delete_users.php?deleteid=<?= $row['id'] ?>">Delete</a>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
            </table>
        </div>
    </div>
    <div class="footer" style="top: 86%;">
        <form action="" class="dB">
            <div class="btn num">Total Users Numbers: <label for=""><?= mysqli_num_rows($result) ?></label></div>
            <div><a href="adduser.php" class="btn add">Add Users</a></div>
        </form>
    </div>
</body>

</html>