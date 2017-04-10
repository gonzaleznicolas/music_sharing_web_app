
<?php
// Start the session
session_start();
if ($_SESSION["UserID"] == NULL) {
    header("Location: http://projbsn.cpsc.ucalgary.ca/loginform.php");
    exit();
}
if ($_SESSION["Mode"] != "Admin") {
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
        <title>Music Sharing-Admin Page</title>
        <style type="text/css">
            td { width: 100px;}
            table { table-layout: fixed; }
        </style>
    </head>
    <body>

        <?php
        // put your code here
        include('config.php');
        $currentDate = getdate();
        $date = $currentDate[year] . "/" . $currentDate[mon] . "/" . $currentDate[mday];    //formatted for integers
        $userID = $_SESSION["UserID"];

        $Logout = $albumName = $artistName = $song = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $Logout = test_input($_POST["Logout"]);
            $albumName = test_input($_POST["Album"]);
            $artistName = test_input($_POST["Artist"]);
            $song = test_input($_POST["Song"]);
            $realName = test_input($_POST["RealName"]);
            $length = test_input($_POST["Length"]);
            $year = test_input($_POST["Year"]);
            $genre = test_input($_POST["Genre"]);
            $sales = test_input($_POST["Sales"]);
        }
        
        if ($artistName == "Artist stage name") {
            $artistName = NULL;
        }
        if ($realName == "Artist real name") {
            $realName = NULL;
        }
        if ($albumName == "Album name") {
            $albumName = NULL;
        }
        if ($song == "Song name") {
            $song = NULL;
        }
        if ($year == "Album year") {
            $year = NULL;
        }
        if ($sales == "Album sales") {
            $sales = NULL;
        }
        if ($genre == "Song genre") {
            $genre = NULL;
        }
        if ($length == "Song length") {
            $length = NULL;
        }

        if ($artistName != NULL) {
            //add music
            //check if artist exists
            $artistID = "";
            $checkArtist = mysqli_fetch_array($conn->query("SELECT ArtistID FROM artist WHERE StageName = '$artistName';"));

            if ($checkArtist[0] == NULL) {
                //if the artist doesn't exist
                $nextArtistID = mysqli_fetch_array($conn->query("SELECT MAX(ArtistId) FROM artist;"));

                $artistID = $nextArtistID[0];
                $artistID++;



                $conn->query("INSERT INTO artist(ArtistID, AdminWhoAddedID, StageName, AddedDate, RealName) VALUES('$artistID', '$userID', '$artistName', '$date', '$realName');");
            } else {
                $artistID = $checkArtist[0];
                
            }

            //if album isnt null, check if it exists already
            //echo $albumName;

            if ($albumName != NULL) {
                //check if it exists
                $checkAlbum = mysqli_fetch_array($conn->query("SELECT AlbumName FROM album WHERE AlbumName = '$albumName';"));

                //echo $checkAlbum;
                if ($checkAlbum == NULL) {
                    //add               
                $conn->query("INSERT INTO album(AlbumName, ArtistID, AdminWhoAddedID, AddedDate, Year, Sales) VALUES('$albumName', '$artistID', '$userID', '$date', '$year', '$sales');");
                }
                else{
                    $albumName = $checkAlbum[0];
                }
            }

            //echo $song;
            if ($song != NULL) {
                $checkSong = mysqli_fetch_array($conn->query("SELECT SongName, ArtistID FROM song WHERE SongName = '$song' AND ArtistID = '$artistID';"));
                if ($checkSong == NULL) {
                    //add song
                    //echo "within adding song";
                    $conn->query("INSERT INTO song(SongName, ArtistID, AlbumName, AdminWhoAddedID, AddedDate, Genre, Length) VALUES('$song', '$artistID', '$albumName', '$userID', '$date', '$genre', '$length');");
                }
            }
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
        <h3>Admin Page</h3>
        <?php
        if (userID != "" && userID != NULL) {
            $sql = "SELECT * FROM admin WHERE AdminID = '$userID'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "Admin: " . $row["AdminID"] . " - " . $row["Name"] . "<br>"; 
                }
            }
        }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
            <input type="submit" name="Logout" value="Logout" />
        </form>
        <br><br>
        <b><i>Add Music</b></i><br><br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            Artist Name: <input type="text" name="Artist"  value="" /><br><br>
            Real Name: <input type="text" name="RealName"  value="" /><br><br>
            Album: <input type="text" name="Album"  value="" /><br><br>
            Song: <input type="text" name="Song"  value="" /><br><br>
            Year: <input type="text" name="Year" onfocus="if (this.value=='Album year') this.value = ''" value="Album year" /><br><br>
            Sales: <input type="text" name="Sales" onfocus="if (this.value=='Album sales') this.value = ''" value="Album sales" /><br><br>
            Genre: <input type="text" name="Genre" onfocus="if (this.value=='Song genre') this.value = ''" value="Song genre" /><br><br>
            Length: <input type="text" name="Length" onfocus="if (this.value=='Song length') this.value = ''" value="Song length" /><br><br>
            <input type="submit" name="Add" value="Add Music!" /><br><br>  
        </form>
        
        <?php
        $conn->close();            //close the connection to database
        ?>
    </body>
</html>
