<!DOCTYPE html>
<html lang="en">
<?php
session_start();

require('config.php');


$name = '';
if (isset($_SESSION['username']) && strpos($_SERVER['HTTP_REFERER'], "login.php")) {
    $name = $_SESSION['username'];
    echo "<script>alert('Welcome " . $_SESSION['username'] . "!');</script>";
}
$query = "select * from library";

if (isset($_POST['search'])) {
    $search = mysqli_escape_string($conn, $_POST['search_text']);
    $query .= " where library.book_name  like '%" . $search . "%'   or library.author_name like '%" . $search . "%'; ";
}
$all = $conn->query($query);


?>



<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/all.css">
    <link rel="stylesheet" href="./css/2ndo.css">

    <link rel="stylesheet" href="./css/team.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>

    <link rel="stylesheet" href="./css/2nd.css">
</head>

<body>
    <div class="header">

        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" style="margin-left:20px"><img class="logo" src="./images/download.webp"></a>
                <nav class="sections">
                    <ul>
                        <li><a href="user.php">Home</a></li>
                        <li><a href="user.php#contact">Contact Us</a></li>
                        <?php if (isset($_SESSION["username"])) : ?>
                        <li><a href="./logout.php">Log Out</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>

                <form method="POST">
                    <div class="input-wrapper">
                        <button class="icon" type="submit" name="search">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="25px"
                                width="25px">
                                <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#fff"
                                    d="M11.5 21C16.7467 21 21 16.7467 21 11.5C21 6.25329 16.7467 2 11.5 2C6.25329 2 2 6.25329 2 11.5C2 16.7467 6.25329 21 11.5 21Z">
                                </path>
                                <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#fff"
                                    d="M22 22L20 20"></path>
                            </svg>
                        </button>
                        <input placeholder="search.." class="input" name="search_text" type="text"
                            style="color: black;">
                    </div>
                </form>

                <div class="userLoggedIn ">
                    <img src="./images/avatar.jpg" alt="" class=userIcon>
                    <?php if (isset($_SESSION["username"])) : ?>
                    <p><?php echo $_SESSION['username']; ?></p>
                    <?php else : ?>
                    <p style="width: auto;height: auto;padding: 11px;color: white;border-radius: 40px;">Guest</p>
                    <?php endif; ?>

                </div>

            </div>
        </nav>
    </div>
    <div class="books" id="books" style="background-color: oldlace;">
        <div class="container">
            <div class="row ">
                <?php
                while ($row = mysqli_fetch_assoc($all)) {
                    $words = explode(' ', $row['description']);
                    $first_15_words = array_slice($words, 0, 15);
                    // Convert the array back into a string
                    $shortened_string = implode(' ', $first_15_words);
                    //}
                    // else {
                    //   echo "0 results";
                    //}

                    //echo "<p>" . substr($row["description"], 0, 100) . "...</p>";
                    //echo "<a href='card_details.php?id=" . $row["id"] . "'>Read More</a>";
                ?>

                <div class="card">
                    <img src="<?php echo $row['book_image'] ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo $row["book_name"]; ?></h2>
                        <h4 class="card-title"><?php echo $row["author_name"]; ?></h4>

                        <p class="card-text"><?php echo $shortened_string; ?></p>
                        <?php if (isset($_SESSION["username"])) : ?>
                        <a href='book.php?id=<?= $row["book_id"] ?>' class="btn btn-primary card-btn"> Read More</a>
                        <?php else : ?>
                        <a href='login.php?login_required=true' class="btn btn-primary card-btn"> Read More</a>
                        <?php endif; ?>
                        <?php
                            // if type !=0 or !=1 ...> please login firt , header('location:login.php')
                            ?>
                    </div>

                </div>

                <?php
                }
                ?>
            </div>

        </div>
    </div>