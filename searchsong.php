<?php
// Start the session
session_start();

?>
<!DOCTYPE html>
<!--
471 Group
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Music Sharing-Song Search</title>
        <style>
        table, th, td { border: 1px solid black; }
        </style>
    </head>
    <body>
        <?php
        //Start the database connection
        include('config.php');

        $userID = $_SESSION["UserID"];  //userID
        
        $songName= "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $songName = test_input($_POST["sname"]);
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>

        <h3>Search Song By Song Name</h3>
        <?php
        if (userID != "" && userID != NULL) {
            $sql = "SELECT * FROM user WHERE UserID = '$userID'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "User: " . $row["UserID"] . " - " . $row["Name"] . "<br><br>"; 
                }
            }
        }
        ?>
        
        <a href="http://projbsn.cpsc.ucalgary.ca/index.php">Home Page</a>
        &nbsp&nbsp&nbsp&nbsp
        <a href="http://projbsn.cpsc.ucalgary.ca/userpage.php">User Page</a>
        &nbsp&nbsp&nbsp&nbsp
        <a href="http://projbsn.cpsc.ucalgary.ca/searchartist.php">Search Artist</a>
        &nbsp&nbsp&nbsp&nbsp
        <a href="http://projbsn.cpsc.ucalgary.ca/searchalbum.php">Search Album</a>
        &nbsp&nbsp&nbsp&nbsp
        <a href="http://projbsn.cpsc.ucalgary.ca/searchreview.php">Search Review</a>
        &nbsp&nbsp&nbsp&nbsp
        <a href="http://projbsn.cpsc.ucalgary.ca/searchuser.php">Search User</a>
        <br>
        <br>
        TODO: <br>
        form 1: search song name. <br>
        &nbsp display back all id's for a song name.<br>
        form 2: search song id.<br>
        &nbsp display all song fields, except adminwhoaddedid<br>
        &nbsp display the artist its by<br>
        &nbsp display the album its from<br>
        &nbsp display average rating<br>
        &nbsp give ids of reviews<br>
        Make all id's clickable? Would take you to the page and auto-search that id?<br>
        
        
        <?php

            // display search results:
            if ($songName != NULL)
            {
                echo "Results for ";
                Print "<i>$songName</i>";
                echo ":<br><br>";

                echo "<hr>";


                $result = $conn->query("SELECT SongName, ArtistID, AlbumName, Genre, Length, AddedDate FROM song WHERE SongName = '$songName';");



                if($result->num_rows >0){           //check if query results in more than 0 rows
                    $count = 0;
                    while($row = $result->fetch_assoc()){   //loop until all rows in result are fetched
                        $count = $count + 1;
                        $avgrating = "";
                        $sn = $row["SongName"];
                        $aID = $row["ArtistID"];
                        $rating = $conn->query("SELECT AVG(Rating) FROM song_rating WHERE SongName='$sn' AND ArtistID='$aID';");
                        if ($ratingRow = $rating->fetch_assoc())
                        {
                            $avgrating = $ratingRow["AVG(Rating)"];
                        }
                        if ($avgrating=="")
                        {
                            $avgrating = "Not Rated Yet";
                        }

                        $artistName = $conn->query("SELECT StageName FROM artist WHERE ArtistID='$aID';");
                        if($artistName->num_rows >0){           //check if query results in more than 0 rows
                            while($row2 = $artistName->fetch_assoc()){   //loop until all rows in result are fetched
                                $artist_name = $row2["StageName"];

                            }
                        }

                        echo "<br>"."<strong>Result # </strong>".$count."<br>";
                        echo "Song Name: ".$row["SongName"]."<br>";
                        echo "Artist ID: ".$row["ArtistID"]."<br>";
                        echo "Artist Stage Name: ".$artist_name."<br>";
                        echo "Album Name: ".$row["AlbumName"]."<br>";
                        echo "Genre: ".$row["Genre"]."<br>";
                        echo "Length(s): ".$row["Length"]."<br>";
                        echo "Date Added: ".$row["AddedDate"]."<br>";
                        echo "Average Rating: ".$avgrating."<br><br>";

                    }
                }
                

            }
            else if ($songName == NULL)
            {
                echo "All songs available:<br><br>";
                echo "<hr>";

                $result = $conn->query("SELECT SongName, ArtistID, AlbumName, Genre, Length, AddedDate FROM song;");



                if($result->num_rows >0){           //check if query results in more than 0 rows
                    $count = 0;
                    while($row = $result->fetch_assoc()){   //loop until all rows in result are fetched
                        $count = $count + 1;
                        $avgrating = "";
                        $sn = $row["SongName"];
                        $aID = $row["ArtistID"];
                        $rating = $conn->query("SELECT AVG(Rating) FROM song_rating WHERE SongName='$sn' AND ArtistID='$aID';");
                        if ($ratingRow = $rating->fetch_assoc())
                        {
                            $avgrating = $ratingRow["AVG(Rating)"];
                        }
                        if ($avgrating=="")
                        {
                            $avgrating = "Not Rated Yet";
                        }

                        $artistName = $conn->query("SELECT StageName FROM artist WHERE ArtistID='$aID';");
                        if($artistName->num_rows >0){           //check if query results in more than 0 rows
                            while($row2 = $artistName->fetch_assoc()){   //loop until all rows in result are fetched
                                $artist_name = $row2["StageName"];

                            }
                        }

                        //echo "<br>"."<strong>Result # </strong>".$count."<br>";
                        echo "<br><br>";
                        echo "Song Name: ".$row["SongName"]."<br>";
                        echo "Artist ID: ".$row["ArtistID"]."<br>";
                        echo "Artist Stage Name: ".$artist_name."<br>";
                        echo "Album Name: ".$row["AlbumName"]."<br>";
                        echo "Genre: ".$row["Genre"]."<br>";
                        echo "Length(s): ".$row["Length"]."<br>";
                        echo "Date Added: ".$row["AddedDate"]."<br>";
                        echo "Average Rating: ".$avgrating."<br><br>";

                    }
                }
                

            }
            $conn-> close();            //close the connection to database
        ?>

    </body>
</html>
