
<?php
// Start the session
session_start();
if ($_SESSION["UserID"] == NULL) {
    header("Location: http://projbsn.cpsc.ucalgary.ca/loginform.php");
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
        <title>Music Sharing-User Page</title>
        <style>
            table, th, td { border: 1px solid black; 
                            table-layout: fixed;
                            width: 100px;}
        </style>
    </head>
    <body>
        <?php
        //connect to database
        include('config.php');
        //echo $_SESSION["Mode"];
        $userID = $_SESSION["UserID"];  //userID

        $logout = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $Logout = test_input($_POST["Logout"]);
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if ($Logout === "Logout") {
            $_SESSION["Mode"] = "";
            $_SESSION["UserID"] = "";
            session_destroy();
            header("Location: http://projbsn.cpsc.ucalgary.ca/loginform.php");
            exit();
        }
        ?>

        <h3>User Page</h3>
        <?php 
        //Write this user's info
        echo "<br><br>Welcome, you are logged in as:<br>";
        $t = "&nbsp;&nbsp;&nbsp;&nbsp;"; //tab character
        $sql = "SELECT * FROM user WHERE UserID = '$userID'"; //write the query string
        $result = $conn->query($sql); //pass the string into the connection via query, and get result
        if ($result->num_rows > 0) { //check if query results in more than 0 rows
            while ($row = $result->fetch_assoc()) { //loop until all rows in result are fetched
                echo "UserID: " . $row["UserID"] . "$t Date of birth: " . $row["DOB"] . "$t Name: " . $row["Name"] . "<br>"; //print the values for that UserID relation
            }
        }
        ?>
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
            <input type="submit" name="Logout" value="Logout" />
        </form>
        <br><br>
        <table>
            <tr>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/searchsong.php">Search Song</a></td>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/searchalbum.php">Search Album</a></td>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/searchartist.php">Search Artist</a></td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/review.php">Review</a></td>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/rate.php">Rate</a></td>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/follow.php">Follow</a></td>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/recommend.php">Recommend</a></td>
            </tr>
        </table>
        <br><br>
        
        TODO: <br>
        form 1: follow userid<br>
        form 2: rate songid<br>
        form 3: rate albumid<br>
        form 4: rate artistid<br>
        form 5: review songid<br>
        form 6: review albumid<br>
        form 7: review artistid<br>
        form 8: declare listens to songid<br>
        form 9: recommend songid to userid<br>
        <br>
        <br>
        <br>
        <br>
        
        <?php
        echo "test1";
        $conn->close(); //close the connection to database
        ?>
    </body>
</html>
















