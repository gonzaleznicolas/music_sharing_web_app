<!DOCTYPE html>
<!--
471 Group
-->
<html>
    <head>
        <link rel="stylesheet" href="styles/searchreview.css">
        <meta charset="UTF-8">
        <title>Music Sharing-Search Review</title>
        <style>
        table, th, td { border: 1px solid black; }
        </style>
    </head>
    <body>
        <?php
        //Start the database connection
        include('config.php');

        $type=$artistid=$option="";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $type = test_input($_POST["type"]);
            $artistid = test_input($_POST["artistid"]);
            $option = test_input($_POST["option"]);
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>

        <h3>Search Review</h3>
        
        <a href="http://projbsn.cpsc.ucalgary.ca/index.php">Home Page</a>
        &nbsp&nbsp&nbsp&nbsp
        <a href="http://projbsn.cpsc.ucalgary.ca/userpage.php">User Page</a>
        &nbsp&nbsp&nbsp&nbsp
        <a href="http://projbsn.cpsc.ucalgary.ca/searchsong.php">Search Song</a>
        &nbsp&nbsp&nbsp&nbsp
        <a href="http://projbsn.cpsc.ucalgary.ca/searchalbum.php">Search Album</a>
        &nbsp&nbsp&nbsp&nbsp
        <a href="http://projbsn.cpsc.ucalgary.ca/searchartist.php">Search Artist</a>
        <br>
        <br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
            Search song/album/artist reviews: <br>
            <select name="type">
                <option value="song">Song</option>
                <option value="album">Album</option>
                <option value="artist">Artist</option>
            </select> <br><br>
            Artist ID: <input type="text" name="artistid"><br><br>
            Song/Album Name: <input type="text" name="option"><br><br>
            <input type="submit" name="submit" value="Search"/> <br><br>
        </form>
        <?php
            $inputFineFlag = "true";
            if ($artistid == NULL)
            {
                echo "Please specify the artist ID.<br>";
                $inputFineFlag = "false";
            }
            if ($type != "artist" && $option == NULL)
            {
                echo "If you are searching for song or album reviews, please indicate<br>the name of the song/album in the provided search box.";
                $inputFineFlag = "false";
            }
            
            if ($type != NULL && $inputFineFlag=="true")
            {
                // if here, the input is valid
                if ($type == "song")
                {
                    echo "Reviews for song ";
                    Print "<i>$option</i>";
                    echo " by artist with ID <i>$artistid</i>";
                    echo ":<br>";
                }
                else if ($type == "album")
                {
                    echo "Reviews for album ";
                    Print "<i>$option</i>";
                    echo " by artist with ID <i>$artistid</i>";
                    echo ":<br>";
                }
                else if ($type == "artist")
                {
                    echo "Reviews for artist with ID ";
                    Print "<i>$artistid</i>";
                    echo ":<br>";
                }
                echo "<hr>";

                
                if ($type == "artist")
                {
                    $result = $conn->query("SELECT ArtistID, StageName FROM artist WHERE ArtistID = '$artistid';");

                    if($result->num_rows >0){           //check if query results in more than 0 rows
                        while($row = $result->fetch_assoc()){   //loop until all rows in result are fetched
                            $avgrating = "";
                            $aID = $row["ArtistID"];
                            $rating = $conn->query("SELECT AVG(Rating) FROM artist_rating WHERE ArtistID='$aID';");
                            if ($ratingRow = $rating->fetch_assoc())
                            {
                                $avgrating = $ratingRow["AVG(Rating)"];
                            }
                            if ($avgrating=="")
                            {
                                $avgrating = "Not Rated Yet";
                            }

                            echo "Artist ID: ".$row["ArtistID"]."<br>";
                            echo "Stage Name: ".$row["StageName"]."<br>";
                            echo "Average Rating: ".$avgrating."<br>";
                            echo "<br><strong><i>Reviews:</i></strong><br>";

                            // find reviews for this artist
                            $reviews = $conn->query("SELECT Content, UserWhoWrote FROM review WHERE ArtistID = '$artistid' AND AlbumName IS NULL AND SongName IS NULL;");
                            if($reviews->num_rows >0){
                                while($row4 = $reviews->fetch_assoc())
                                {
                                    echo "<br><strong>User # </strong>".$row4["UserWhoWrote"]."<strong> wrote:</strong><br>";
                                    echo $row4["Content"];
                                    echo "<br>";
                                }
                            }

                            echo "<br>";
                        }
                    }
                }
                else if ($type == "album")
                {
                    $result = $conn->query("SELECT AlbumName, ArtistID, Sales FROM album WHERE ArtistID='$artistid' AND AlbumName = '$option';");



                    if($result->num_rows >0){           //check if query results in more than 0 rows
                        while($row = $result->fetch_assoc())
                        {   //loop until all rows in result are fetched
                            $avgrating = "";
                            $an = $row["AlbumName"];
                            $aID = $row["ArtistID"];
                            $rating = $conn->query("SELECT AVG(Rating) FROM album_rating WHERE AlbumName='$an' AND ArtistID='$aID';");
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

                            echo "Album Name: ".$row["AlbumName"]."<br>";
                            echo "Artist ID: ".$row["ArtistID"]."<br>";
                            echo "Artist Stage Name: ".$artist_name."<br>";
                            echo "Sales: ".$row["Sales"]."<br>";
                            echo "Average Rating: ".$avgrating."<br>";


                            // find reviews for this album
                            $reviews = $conn->query("SELECT Content, UserWhoWrote FROM review WHERE ArtistID = '$artistid' AND AlbumName='$option' AND SongName IS NULL;");
                            if($reviews->num_rows >0){
                                while($row4 = $reviews->fetch_assoc())
                                {
                                    echo "<br><strong>User # </strong>".$row4["UserWhoWrote"]."<strong> wrote:</strong><br>";
                                    echo $row4["Content"];
                                    echo "<br>";
                                }
                            }

                            echo "<br>";


                        }
                    }
                }
                else if ($type == "song")
                {
                    $result = $conn->query("SELECT SongName, ArtistID FROM song WHERE ArtistID='$artistid' AND SongName = '$option';");


                    if($result->num_rows >0){           //check if query results in more than 0 rows
                        while($row = $result->fetch_assoc())
                        {   //loop until all rows in result are fetched
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

                            echo "Song Name: ".$row["SongName"]."<br>";
                            echo "Artist ID: ".$row["ArtistID"]."<br>";
                            echo "Artist Stage Name: ".$artist_name."<br>";
                            echo "Average Rating: ".$avgrating."<br>";


                            // find reviews for this song
                            $reviews = $conn->query("SELECT Content, UserWhoWrote FROM review WHERE ArtistID = '$artistid' AND SongName='$option' AND AlbumName IS NULL;");
                            if($reviews->num_rows >0){
                                while($row4 = $reviews->fetch_assoc())
                                {
                                    echo "<br><strong>User # </strong>".$row4["UserWhoWrote"]."<strong> wrote:</strong><br>";
                                    echo $row4["Content"];
                                    echo "<br>";
                                }
                            }

                            echo "<br>";


                        }
                    }
                }

            }


            $conn-> close();            //close the connection to database
        ?>

    </body>
</html>


