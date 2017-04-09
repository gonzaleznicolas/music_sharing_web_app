<!DOCTYPE html>
<!--
471 Group
-->
<html>
    <head>
        <link rel="stylesheet" href="styles/searchsong.css">
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
        
        <a href="http://projbsn.cpsc.ucalgary.ca/index.php">Home Page</a>
        &nbsp&nbsp&nbsp&nbsp
        <a href="http://projbsn.cpsc.ucalgary.ca/searchartist.php">Search Artist</a>
        &nbsp&nbsp&nbsp&nbsp
        <a href="http://projbsn.cpsc.ucalgary.ca/searchalbum.php">Search Album</a>
        &nbsp&nbsp&nbsp&nbsp
        <a href="http://projbsn.cpsc.ucalgary.ca/searchreview.php">Search Review</a>
        <br>
        <br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
            Song Name: <input type="text" name="sname"><br><br>
            <input type="submit" name="submit" value="Search"/> <br><br>
        </form>
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
