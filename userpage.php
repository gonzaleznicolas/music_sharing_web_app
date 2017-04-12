<!DOCTYPE html>
<!--
471 Group
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styles/style.css">
        <title>Music Sharing-User Page</title>
        <style type="text/css">
            td { width: 100px;}
            table { table-layout: fixed; }
        </style>
    </head>
    <body>
        <h3>User Page</h3>
        <?php
        if (userID != "" && userID != NULL) {
            $sql = "SELECT * FROM user WHERE UserID = '$userID'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "User: " . $row["UserID"] . " - " . $row["Name"] . "<br>"; 
                }
            }
        }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
            <input type="submit" name="Logout" value="Logout" />
        </form>
        <br><br>
        <table class="center">
            <tr>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/searchsong.php">Search Song</a></td>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/searchalbum.php">Search Album</a></td>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/searchartist.php">Search Artist</a></td>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/searchreview.php">Search Review</a></td>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/searchuser.php">Search User</a></td>
            </tr>
        </table>
        <br>
        <table class="center">
            <tr>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/review.php">Review</a></td>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/rate.php">Rate</a></td>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/follow.php">Follow</a></td>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/recommend.php">Recommend</a></td>
            </tr>
        </table>
        <br><br>
        <?php 
        //Write this user's info
        echo "Welcome, you are logged in as:<br>";
        $t = "&nbsp;&nbsp;&nbsp;&nbsp;"; //tab character
        $sql = "SELECT * FROM user WHERE UserID = '$userID'"; //write the query string
        $result = $conn->query($sql); //pass the string into the connection via query, and get result
        if ($result->num_rows > 0) { //check if query results in more than 0 rows
            while ($row = $result->fetch_assoc()) { //loop until all rows in result are fetched
                echo "UserID: " . $row["UserID"] . "$t Date of birth: " . $row["DOB"] . "$t Name: " . $row["Name"] . "<br>"; //print the values for that UserID relation
            }
        }
        ?>
        <br><br>
        
        <?php
        $conn->close(); //close the connection to database
        ?>
    </body>
</html>
















