
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
        <link rel="stylesheet" href="styles/style.css">
        <title>Music Sharing-Review</title>
    </head>
    <body>
        <?php
        //connect to database
        include('config.php');
        $t = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; //tab character
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
        
        $type = $_POST['type']; //Get the submitted data
        $artistID = $_POST['artistID'];
        $review = $_POST['review'];
        $otherID = $_POST['otherID'];
        $date = date('Y/m/d');
        $time = date('h:i:s', time());
        
        if ($otherID == "") { //If otherID was not filled, set to NULL
            $otherID = NULL;
        }
        
        if ($artistID != "" || $rating != "") { //Do a query if at least these two have values
            if ($type == "album" && $otherID != NULL) { //Album and id filled out
                $sql = "INSERT INTO review (DatePosted, TimePosted, Content, ArtistID, AlbumName, UserWhoWrote) 
                        VALUES ('$date', '$time', '$review', '$artistID', '$otherID', '$userID')";
                mysqli_query($conn,$sql);
            }
            else if ($type == "song" && $otherID != NULL) { //Song and id filled out
                $sql = "INSERT INTO review (DatePosted, TimePosted, Content, SongName, ArtistID, UserWhoWrote) 
                        VALUES ('$date', '$time', '$review', '$otherID', '$artistID', '$userID')";
                mysqli_query($conn,$sql);
            }
            else { //Otherwise, can only do artist with info given
                $sql = "INSERT INTO review (DatePosted, TimePosted, Content, ArtistID, UserWhoWrote) 
                        VALUES ('$date', '$time', '$review', '$artistID', '$userID')";
                mysqli_query($conn,$sql);
            }
        }
        ?>
        
        <h3>Reviews</h3>
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
            <input type="submit" name="Logout" value="Logout" />
        </form>
        <br><br>
        <table class="center">
            <tr>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/userpage.php">User Page</a></td>
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
        Review by filling out Artist ID and Review message.<br>
        You may optionally review an Album or a Song (Still specify the artist!).<br>
        <form action="review.php" method="post">
            *Artist ID: <input type="text" name="artistID">&nbsp;&nbsp;&nbsp;&nbsp; 
            *Review message: <input type="text" name="review"><br>
            If not reviewing artist: 
                <select name="type">
                    <option value="null"> </option>
                    <option value="album">Album</option>
                    <option value="song">Song</option>
                </select> &nbsp;&nbsp;&nbsp;&nbsp;
            Album or Song name: <input type="text" name="otherID"><br>
            <input type="submit" value="Submit">
        </form>
        <br><br>
        
        <?php
        //Display number of strikes against user
        $sql = "SELECT * FROM user_warning WHERE UserID = '$userID'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "Total number of strikes against you: " . $row["NumStrikes"];
            }
        }
        
        //Display review warnings for this user
        echo "<br><br>You have the following reviews flagged currently:<br>";
        $sql = "SELECT R.*
                FROM review AS R, flag AS F
                WHERE R.UserWhoWrote = '$userID'
                    AND R.ReviewID = F.ReviewID"; //Get all flagged reviews by user
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "ReviewID: " . $row["ReviewID"] . "<br>";
                echo "Song Name: " . $row["SongName"] . "<br>";
                echo "Content: " . $row["Content"] . "<br><br>";
            }
        }
        ?>
        
        <?php
        $conn->close(); //close the connection to database
        ?>
    </body>
</html>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        