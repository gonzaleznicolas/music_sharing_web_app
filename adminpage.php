
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
        $currentDate = getdate();
        $date = $currentDate[year] . "/" . $currentDate[mon] . "/" . $currentDate[mday];    //formatted for integers
        $userID = $_SESSION["UserID"];

        $Logout = $albumName = $artistName = $song = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $Logout = test_input($_POST["Logout"]);
            $albumName = test_input($_POST["Album"]);
            $artistName = test_input($_POST["Artist"]);
            $song = test_input($_POST["Song"]);
        }

        if ($artistName != NULL) {
            //add music
            //check if artist exists
            $checkArtist = mysqli_fetch_array($conn->query("SELECT ArtistID FROM artist WHERE StageName = '$artistName';"));
            //echo $checkArtist[0];

            if ($checkArtist[0] == NULL) {
                //if the artist doesn't exist
                $nextArtistID = mysqli_fetch_array($conn->query("SELECT COUNT(ArtistId) FROM artist;"));
                $nextArtistID++;
                $artistID = $nextArtistID;
                $conn->query("INSERT INTO artist(ArtistID, AdminWhoAddedID, StageName, AddedDate) VALUES('$nextArtistID', '$userID', '$artistName', '$date');");
            } else {
                //$artistID = mysqli_fetch_array($conn->query("SELECT ArtistId FROM artist WHERE StageName = '$name';"));
                $artistID = $checkArtist[0];
                //echo $artistID;
            }

            //if album isnt null, check if it exists already
            echo $albumName;
            if ($albumName != NULL) {
                //check if it exists
                $checkAlbum = mysqli_fetch_array($conn->query("SELECT AlbumName FROM album WHERE AlbumName = '$albumName';"));
                if ($checkAlbum == NULL) {
                    //add
                    $conn->query("INSERT INTO album(AlbumName, ArtistID, AdminWhoAddedID, AddedDate) VALUES('$albumName', '$artistID', '$userID', '$date');");
                }
                
            }
            
            echo $song;
            if ($song != NULL){
                $checkSong = mysqli_fetch_array($conn->query("SELECT SongName, ArtistID FROM song WHERE SongName = '$song' AND ArtistID = '$artistID';"));
                if(count($checkSong)==0){
                    //add song
                    $conn->query("INSERT INTO song(SongName, ArtistID, AlbumName, AdminWhoAddedID, AddedDate) VALUES('$song', '$artistID', '$albumName', '$userID', '$date');");
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
        <br>

        TODO: <br>
        UserID: <?php echo $_SESSION["UserID"] ?><br>
        Add Music:
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            Artist: <input type="text" name="Artist" value="" /><br><br>
            Album: <input type="text" name="Album" value="" /><br><br>
            Song: <input type="text" name="Song" value="" /><br><br>
            <input type="submit" name="Add" value="Add Music!" /><br><br>  
        </form>
        form 1: add artist- note: artist must be added before a song and album can be added<br>
        form 2: add song- note: a song might NOT belong to an album, but must belong to an artist<br>
        form 3: add album<br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
            <input type="submit" name="Logout" value="Logout" />

        </form>
        logout button^<br>

<?php
$conn->close();            //close the connection to database
?>
    </body>
</html>
