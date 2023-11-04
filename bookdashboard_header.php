<html>

<head>
    <link rel="stylesheet" href="./css/2ndo.css">
    <link rel="stylesheet" href="./css/Dashboard.css">
</head>

<body>
    <?php
    session_start();
    require('config.php');

    ?>
    <div class="container-fluid">
        <a class="navbar-brand"><img class="logo" src="./images/download.webp" /></a>
        <nav class="sections">
            <ul>
                <li><a href="./home_admin.php">Home</a></li>
                <li><a href="./Dashboard_users.php">Users</a></li>
                <li><a href="./Dashboard_books.php">Books</a></li>
                <?php if (isset($_SESSION["username"])) : ?>
                <li><a href="./logout.php">Log Out</a></li>
                <?php endif; ?>
            </ul>
        </nav>

        <?php
        $query = "select * from library";

        if (isset($_POST['search'])) {
            $search = mysqli_escape_string($conn, $_POST['search_text']);
            $query .= " where library.book_name like '%" . $search . "%' or library.author_name like '%" . $search . "%'; ";
        }
        $result = $conn->query($query);

        ?>







        <form method="POST">
            <div class="input-wrapper">
                <button class="icon" type="submit" name="search">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="25px" width="25px">
                        <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#fff"
                            d="M11.5 21C16.7467 21 21 16.7467 21 11.5C21 6.25329 16.7467 2 11.5 2C6.25329 2 2 6.25329 2 11.5C2 16.7467 6.25329 21 11.5 21Z">
                        </path>
                        <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#fff"
                            d="M22 22L20 20"></path>
                    </svg>
                </button>
                <input placeholder="search.." class="input" name="search_text" type="text" style="color: black;">
            </div>
        </form>

    </div>
    <div class="footer" style="top: 86%;">
        <form action="" class="dB">
            <div class="btn num">Total Users Numbers: <label for=""><?= mysqli_num_rows($result) ?></label></div>
            <div><a href="adduser.php" class="btn add">Add Users</a></div>
        </form>
    </div>




</body>

</html>