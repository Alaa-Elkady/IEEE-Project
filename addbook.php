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
    <title>Add Book</title>

</head>

<?php


if (isset($_POST['add_book'])) {

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

    $insert = "INSERT INTO library( book_name , author_name , description ,  file, book_image) 
     VALUES ('$book_name','$book_author','$book_info' , '$file_up','$image_up')";
    mysqli_query($conn, $insert);



    if (move_uploaded_file($image_location, $image_up) and move_uploaded_file($file_location, $file_up)) {

        echo "<script> alert ( 'uploaded sucessfully') </script>";
        header('location:dashboard_books.php');
    } else {
        echo "<script> alert ('uploaded failed') </script>";
    }
}


?>



<body>
    <div class="back">
        <div class="container">
            <div class="login-box">
                <p>Add Book's Info</p>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">

                    <div class=" user-box">
                        <input name="book_name" required="" type="text">
                        <label>Book Name</label>
                    </div>
                    <div class="user-box">
                        <textarea name="book_info" required=""></textarea>
                        <label>Info</label>
                    </div>
                    <div class="user-box">
                        <input name="book_author" required="" type="text">
                        <label>Author</label>
                    </div>
                    <!-- <label>Submission Date</label>

                    <div class="user-box">
                        <input type="date">

                    </div> -->
                    <label for="arquivo">Choose an image :</label>
                    <input class="inpdddut" required="" name="book_image" type="file">
                    <label for="arquivo">Choose a file:</label>
                    <input class="inpdddut" required="" name="book_file" type="file">



                    <button name="add_book" type="submit" class="animatedBtn"><span></span>
                        <span></span>
                        <span></span>
                        <span></span> Add Book</button>
            </div>


            </form>

        </div>
    </div>
    </div>
</body>

</html>