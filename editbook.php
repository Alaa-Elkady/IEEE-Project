<?php
require('config.php');

?>
<!DOCTYPE html>
<html lang="en">

<?php

$edit_id = $_GET['id'];


$query = "select * from library where book_id = $edit_id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$bookid = $row['book_id'];
$bookname = $row['book_name'];
$bookinfo = $row['description'];
$bookauthor = $row['author_name'];
$bookfile = $row['file'];
$bookimage = $row['book_image'];




if (isset($_POST['edit_book'])) {
    $book_id = $_POST['book_id'];
    $book_name = $_POST['book_name'];
    $book_info = $_POST['book_info'];
    $book_author = $_POST['book_author'];


    $book_file = $_FILES['book_file'];
    $book_image = $_FILES['book_image'];

    $image_location = $_FILES['book_image']['tmp_name'];
    $image_name = $_FILES['book_image']['name'];
    $image_up = "bookcovers/" . $image_name;

    $file_location = $_FILES['book_file']['tmp_name'];
    $file_name = $_FILES['book_file']['name'];
    $file_up = "bookfiles/" . $file_name;

    $update = "UPDATE `library` SET book_name='$book_name' 
    , author_name='$book_author' , description='$book_info' , 
     file='$file_up', book_image='$image_up' WHERE book_id=$book_id  ";
    mysqli_query($conn, $update);



    if (move_uploaded_file($image_location, $image_up) and move_uploaded_file($file_location, $file_up)) {

        echo "<script> alert ( 'uploaded sucessfully') </script>";
        header('location:dashboard_books.php');
    } else {
        echo "<script> alert ('uploaded failed') </script>";
    }
}




?>

<head>
    <link rel="stylesheet" href="./css/userEditition.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
</head>

<body>
    <div class="back">
        <div class="container">
            <?php if (isset($_GET['id'])) : ?>
                <div class="login-box">
                    <p>Edit User's Info</p>
                    <form method="post" action="editbook.php" enctype="multipart/form-data">

                        <div class="user-box">
                            <input required="" name="book_id" type="text" value="<?php echo $bookid; ?>" readonly>
                            <label>Book ID</label>
                        </div>
                        <div class="user-box">
                            <input required="" name="book_name" type="text" value="<?php echo $bookname; ?>">
                            <label>Book Name</label>
                        </div>
                        <div class="user-box">
                            <textarea name="book_info" required=""><?php echo $bookinfo; ?></textarea>
                            <label>Info</label>
                        </div>
                        <div class="user-box">
                            <input required="" name="book_author" type="text" value="<?php echo $bookauthor; ?>">
                            <label>Author</label>
                        </div>

                        <label for="arquivo">Choose an image :</label>
                        <input class="inpdddut" name="book_image" id="arquivo" type="file" required value="<?php echo $bookimage; ?>">

                        <label for="arquivo">Choose file:</label>
                        <input class="inpdddut" name="book_file" id="file" type="file" required value="<?php echo $bookfile; ?>">


                        <button name="edit_book" type="submit" class="animatedBtn"><span></span>
                            <span></span>
                            <span></span>
                            <span></span> Edit Book</button>

                    </form>

                </div>
            <?php else : ?>
                <div class="login-box">
                    <p>Please select a book first</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>