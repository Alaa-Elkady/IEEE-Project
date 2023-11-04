<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<!DOCTYPE html>
<html lang="en">
<?php
require('config.php');
$sql = "select * from library";
$result = $conn->query($sql);
?>



<head>
    <link rel="stylesheet" type="text/css" href="./css/2nd.css" />
    <link rel="stylesheet" type="text/css" href="./css/Dashboard.css" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Books List</title>
</head>

<body>
    <?php
    include('bookdashboard_header.php');
    ?>

    <div class="users">
        <div class="cont-table">
            <table class="table book">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Book Name</th>
                        <th scope="col">Author</th>
                        <th scope="col">Description</th>

                        <th scope="col">Submission Date</th>
                        <th scope="col">Cover</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <?php
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {

                ?>
                <tbody>
                    <tr>
                        <td><?= $row['book_id'] ?></td>
                        <td><?= $row['book_name'] ?></td>

                        <td><?= $row['author_name'] ?></td>
                        <td>
                            <p><?= $row['description'] ?></p>
                        </td>
                        <td><?= $row['date'] ?></td>
                        <td><?= $row['book_image'] ?></td>
                        <td>
                            <form action="" class="dB">
                                <div><a class="btn edit" href="editbook.php?id=<?= $row['book_id'] ?>"> Edit</a>
                                </div>
                                <div><a class="btn clear"
                                        href="delete_books.php?deleteid=<?= $row['book_id'] ?>">Delete</a>
                                </div>
                            </form>
                        </td>
                    </tr>


                </tbody>
                <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>

</body>

</html>