<!DOCTYPE html>
<!--
471 Group
-->
<html>
    <head>
        <link rel="stylesheet" href="styles/homepage.css">
        <meta charset="UTF-8">
        <title>Music Sharing-Home Page</title>
        <style>
        table, th, td { border: 1px solid black; }
        </style>
    </head>
    <body>
        <h3>Music Share</h3>
        <h4>Rate - Review - Recommend</h4>
        By: Brenton Kruger, Sean Hoey, Nicolas Gonzalez
        <br><br>
        <div class="image"><img src="images/play.png" alt="logo" width="200" height="200"></div>
        <br>
        <a href="http://projbsn.cpsc.ucalgary.ca/newuserform.php">New User</a>
        &nbsp&nbsp&nbsp&nbsp
        <a href="http://projbsn.cpsc.ucalgary.ca/loginform.php">Login</a>
        <br><br>

        Browse content in guest mode:<br><br>
        <a href="http://projbsn.cpsc.ucalgary.ca/searchsong.php">Search Song</a>&nbsp&nbsp&nbsp&nbsp
        <a href="http://projbsn.cpsc.ucalgary.ca/searchalbum.php">Search Album</a>&nbsp&nbsp&nbsp&nbsp
        <a href="http://projbsn.cpsc.ucalgary.ca/searchartist.php">Search Artist</a>&nbsp&nbsp&nbsp&nbsp
        <a href="http://projbsn.cpsc.ucalgary.ca/searchreview.php">Search Review</a><br><br>

        delete all of these later: <br>
        <a href="http://projbsn.cpsc.ucalgary.ca/userpage.php">User Page</a><br>
        <a href="http://projbsn.cpsc.ucalgary.ca/index.php">Home Page</a><br>
        <a href="http://projbsn.cpsc.ucalgary.ca/loginform.php">Login Form</a><br>
        <a href="http://projbsn.cpsc.ucalgary.ca/newuserform.php">New User Form</a><br>
        <a href="http://projbsn.cpsc.ucalgary.ca/adminpage.php">Admin Page</a><br>
        <a href="http://projbsn.cpsc.ucalgary.ca/moderatorpage.php">Moderator Page</a><br>
        <br>        
        
        
        <?php
            //Delete later
            $servername = "localhost";
            $username = "projbsn_root";
            $password = "brentseannick471";
            $db = "projbsn_musicsharing";
            $conn = new mysqli($servername, $username, $password, $db);
            
            if($conn->connect_error){
                die("Connection failed".$conn->connect_error);
            }
            
            
            
            $conn-> close(); //close the connection to database
        ?>
    </body>
</html>
