<?php
require('config.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./css/book.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <div class="home" id="home">
        <div class="cont">
            <div class="header">
                <section>
                    <div class="skewed"></div>
                </section>
                <nav class="navbar bg-body-tertiary">
                    <div class="container-fluid">
                        <a class="navbar-brand"><img class="logo" src="./images/download.webp"></a>
                        <nav class="sections">
                            <ul>
                                <li><a href="./user.php">Home</a></li>

                                <?php if (isset($_SESSION["username"])) : ?>
                                    <li><a href="./logout.php">Log Out</a></li>
                                <?php endif; ?>
                            </ul>
                        </nav>

                    </div>
                </nav>
            </div>
            <?php

            if (isset($_GET['id'])) {

                $id = $_GET["id"];
                $sql = "SELECT book_name,author_name , description , book_image, file FROM library WHERE book_id= $id";
                $result = mysqli_query($conn, $sql);



                if (mysqli_num_rows($result) > 0) {
                    // Output the card details
                    $row = mysqli_fetch_assoc($result);
                    $book_name = $row["book_name"];
                    $author_name = $row["author_name"];
                    $description = $row["description"];
                    $book_image = $row["book_image"];
                    $book_file_location = $row["file"];
                }
            }
            if (isset($_POST["download"])) {

                if (isset($book_file_location)) {
                    //Read the url
                    $url = $book_file_location;


                    //Clear the cache
                    clearstatcache();
                    ob_start();
                    //Check the file path exists or not
                    if (file_exists($url)) {

                        //Define header information
                        header('Content-Description: File Transfer');
                        header('Content-type: application/pdf');
                        header('Content-Disposition: attachment; filename="' . basename($url) . '"');
                        header('Content-Length: ' . filesize($url));
                        header('Pragma: public');
                        while (ob_get_level()) {
                            ob_end_clean();
                        }
                        //Clear system output buffer
                        flush();

                        //Read the size of the file
                        readfile($url);

                        //Terminate from the script
                        die();
                    } else {
                        echo "File path does not exist.";
                    }
                }
                echo "File path is not defined.";
            }

            ?>



            <div class="cont-book">
                <div class="crdd">
                    <div class="img">
                        <img src="<?= $book_image; ?>" alt="">
                    </div>
                    <?php
                    if (isset($_COOKIE["font_color"])) {
                        echo "<style>label{color: " . $_COOKIE["font_color"] . "}</style>";
                    }

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {

                        setcookie("font_color", $_POST["color"], strtotime("+1 year"));

                        header("Location:" . $_SERVER["REQUEST_URI"]);
                        exit();
                    }

                    ?>
                    <form action=" " method="POST">

                        <input type="color" name="color">

                        <input type="submit" class="btn" value="Choose Font Color">
                    </form>


                </div>
                <div class=" contant">
                    <div class="name">Name: <label for=""><?= $book_name ?> </label></div>

                    <br>
                    <div class="Author">
                        Author: <label for=""> <?= $author_name ?></label>
                    </div>
                    <br>
                    <div class="descr">
                        Description:
                        <label>
                            <p> <?= $description ?> </p>
                        </label>
                    </div>
                    <br>
                    <form method="POST">

                        <button class="btn" name="download" type="submit">Download</button>
                    </form>
                </div>
            </div>






</body>

</html>