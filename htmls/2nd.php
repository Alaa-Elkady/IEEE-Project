<!DOCTYPE html>
<html lang="en">
<?php
require('config.php');
$query = "select *from library ";

if (isset($_Get['search'])) {
    $search = mysqli_escape_string($conn, $_GET['search']);
    $query .= " where library.book_name  like % " . $search . "%   or library.au00000000000000thor_name like % " . $search . "%       ";
}
$results = $conn->query($query);

// 
?>
<?php
$sql = "select * from library";
$all = $conn->query($sql);
?>


<head>
    <link rel="stylesheet" type="text/css" href="./css/2nd.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
</head>

<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand"><img class="logo" src="./images/download.webp"></a>
            <form class="d-flex" role="search" method="GET">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <?php
    while ($row = mysqli_fetch_assoc($all)) {

    ?>
    <div class="container">
        <div class="card" style="width: 18rem;">
            <img src="./images/pexels-photo-1106468.jpeg" class="card-img-top" alt="...">
            <div class="card-body">
                <h3 class="card-title"><?php echo $row["book_name"]; ?></h3>
                <h2 class="card-title"><?php echo $row["author_name"]; ?></h2>

                <p class="card-text"><?php echo $row["description"]; ?></p>
                <a href="#" class="btn btn-primary">Read More</a>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
</body>

</html>