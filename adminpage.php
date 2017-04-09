
<?php
// Start the session
session_start();
if ($_SESSION["UserID"] == NULL) {
    header("Location: http://projbsn.cpsc.ucalgary.ca/loginform.php");
    exit();
}
if ($_SESSION["Mode"] != "Admin") {
    header("Location: http://projbsn.cpsc.ucalgary.ca/userpage.php");
    exit();
}
?>

<!DOCTYPE html>
<!--
471 Group
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Music Sharing-Admin Page</title>
        <style>
            table, th, td { border: 1px solid black; }
        </style>
    </head>
    <body>

        <?php
             // put your code here
            include('config.php');
        ?>
        <h3>Admin Page</h3>
        <br>

        TODO: <br>
        display admin id?<br>
        form 1: add artist- note: artist must be added before a song and album can be added<br>
        form 2: add song- note: a song might NOT belong to an album, but must belong to an artist<br>
        form 3: add album<br>
        logout button.<br>

        <?php
        $conn->close();            //close the connection to database
        ?>
    </body>
</html>
