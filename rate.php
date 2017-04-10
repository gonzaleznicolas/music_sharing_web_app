
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
        <title>Music Sharing-Rate</title>
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
        
        //Execute rate
        $type = $_POST['type']; //Get the submitted data
        $artistID = $_POST['artistID'];
        $rating = $_POST['rating'];
        $otherID = $_POST['otherID'];
        if ($artistID != "" || $rating != "") { //Do a query if at least these two have values
            if ($type == "album" && $otherID != "") { //Album and id filled out
                $sql = "INSERT INTO album_rating (AlbumName, ArtistID, ByUserID, Rating) 
                        VALUES ('$otherID', '$artistID', '$userID', '$rating')";
                mysqli_query($conn,$sql);
            }
            else if ($type == "song" && $otherID != "") { //Song and id filled out
                $sql = "INSERT INTO song_rating (SongName, ArtistID, ByUserID, Rating) 
                        VALUES ('$otherID', '$artistID', '$userID', '$rating')";
                mysqli_query($conn,$sql);
            }
            else { //Otherwise, can only do artist with info given
                $sql = "INSERT INTO artist_rating (ArtistID, ByUserID, Rating) 
                        VALUES ('$artistID', '$userID', '$rating')";
                mysqli_query($conn,$sql);
            }
        }
        ?>
        
        <h3>Rate</h3>
        
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
        
        Rate by filling out Artist ID and Rating.<br>
        You may optionally rate an Album or a Song (Still specify the artist!).<br>
        <form action="rate.php" method="post">
            *Artist ID: <input type="text" name="artistID">&nbsp;&nbsp;&nbsp;&nbsp; 
            *Rating: <input type="text" name="rating"><br>
            If not rating artist: 
                <select name="type">
                    <option value="null"> </option>
                    <option value="album">Album</option>
                    <option value="song">Song</option>
                </select> &nbsp;&nbsp;&nbsp;&nbsp;
            Album or Artist name: <input type="text" name="otherID"><br>
            <input type="submit" value="Submit">
        </form>
        <br><br>
        
        <?php
        //Display songs rated
        echo "You have rated these songs:<br>";
        $sql = "SELECT *, StageName FROM song_rating AS a, artist AS b 
                WHERE ByUserID = '$userID'
                    AND a.ArtistID = b.ArtistID";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "Song name: " . $row["SongName"] . $t . "Artist ID: " . $row["ArtistID"] . $t . "Artist stage name: " . $row["StageName"] . $t . "Rating: " . $row["Rating"] . "<br>";
            }
        }
        
        //Display albums rated
        echo "<br><br>You have rated these albums:<br>";
        $sql = "SELECT *, StageName FROM album_rating AS a, artist AS b 
                WHERE ByUserID = '$userID'
                    AND a.ArtistID = b.ArtistID";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "Album name: " . $row["AlbumName"] . $t . "Artist ID: " . $row["ArtistID"] . $t . "Artist stage name: " . $row["StageName"]. $t . "Rating: " . $row["Rating"] . "<br>";
            }
        }
        
        //Display artists rated
        echo "<br><br>You have rated these artists:<br>";
        $sql = "SELECT *, StageName FROM artist_rating AS a, artist AS b
                WHERE ByUserID = '$userID' 
                    AND a.ArtistID = b.ArtistID";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "Artist ID: " . $row["ArtistID"] . $t . "Stage Name: " . $row["StageName"] . $t . "Rating: " . $row["Rating"] . "<br>";
            }
        }
        ?>
        
        <?php
        $conn->close(); //close the connection to database
        ?>
    </body>
</html>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        