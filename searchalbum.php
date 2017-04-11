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
        <link rel="stylesheet" href="styles/searchalbum.css">
        <meta charset="UTF-8">
        <title>Music Sharing-Album Search</title>
        <style>
        table, th, td { border: 1px solid black; }
        </style>
    </head>
    <body>
        <?php
        //Start the database connection
        include('config.php');
        
        $userID = $_SESSION["UserID"];  //userID

        $albumName= "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $albumName = test_input($_POST["aname"]);
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>

        <h3>Search Album by Album Name</h3>
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
        <a href="http://projbsn.cpsc.ucalgary.ca/searchsong.php">Search Song</a>
        &nbsp&nbsp&nbsp&nbsp
        <a href="http://projbsn.cpsc.ucalgary.ca/searchartist.php">Search Artist</a>
        &nbsp&nbsp&nbsp&nbsp
        <a href="http://projbsn.cpsc.ucalgary.ca/searchreview.php">Search Review</a>
        &nbsp&nbsp&nbsp&nbsp
        <a href="http://projbsn.cpsc.ucalgary.ca/searchuser.php">Search User</a>
        <br>
        <br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
            Album Name: <input type="text" name="aname"><br><br>
            <input type="submit" name="submit" value="Search"/> <br><br>
        </form>
        <?php

            // display search results:
            if ($albumName != NULL)
            {
                echo "Results for ";
                Print "<i>$albumName</i>";
                echo ":<br><br>";

                echo "<hr>";


                $result = $conn->query("SELECT AlbumName, ArtistID, Year, Sales, AddedDate FROM album WHERE AlbumName = '$albumName';");



                if($result->num_rows >0){           //check if query results in more than 0 rows
                    $count = 0;
                    while($row = $result->fetch_assoc()){   //loop until all rows in result are fetched
                        $count = $count + 1;
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

                        echo "<h3>Result # $count</h3>";
                        echo "Album Name: ".$row["AlbumName"]."<br>";
                        echo "Artist ID: ".$row["ArtistID"]."<br>";
                        echo "Artist Stage Name: ".$artist_name."<br>";
                        echo "Year: ".$row["Year"]."<br>";
                        echo "Sales: ".$row["Sales"]."<br>";
                        echo "Date Added: ".$row["AddedDate"]."<br>";
                        echo "Average Rating: ".$avgrating."<br>";
                        echo "<br><i><strong>Songs in this album:</strong></i><br>";

                        $songs = $conn->query("SELECT SongName FROM song WHERE AlbumName='$albumName' AND ArtistID='$aID';");
                        if($songs->num_rows >0){           //check if query results in more than 0 rows
                            while($row1 = $songs->fetch_assoc()){   //loop until all rows in result are fetched
                                echo $row1["SongName"]."<br>";

                            }
                        }
                        echo "<br>";
                    }
                }
                

            }
            else if ($albumName == NULL)
            {
                echo "All albums available:<br><br>";
                echo "<hr>";


                $result = $conn->query("SELECT AlbumName, ArtistID, Year, Sales, AddedDate FROM album;");



                if($result->num_rows >0){           //check if query results in more than 0 rows
                    $count = 0;
                    while($row = $result->fetch_assoc()){   //loop until all rows in result are fetched
                        $count = $count + 1;
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

                        echo "<br><br>";
                        echo "Album Name: ".$row["AlbumName"]."<br>";
                        echo "Artist ID: ".$row["ArtistID"]."<br>";
                        echo "Artist Stage Name: ".$artist_name."<br>";
                        echo "Year: ".$row["Year"]."<br>";
                        echo "Sales: ".$row["Sales"]."<br>";
                        echo "Date Added: ".$row["AddedDate"]."<br>";
                        echo "Average Rating: ".$avgrating."<br>";
                        echo "<i><strong>Songs in this album:</strong></i><br>";

                        $songs = $conn->query("SELECT SongName FROM song WHERE AlbumName='$an' AND ArtistID='$aID';");
                        if($songs->num_rows >0){           //check if query results in more than 0 rows
                            while($row1 = $songs->fetch_assoc()){   //loop until all rows in result are fetched
                                echo $row1["SongName"]."<br>";

                            }
                        }
                        echo "<br>";
                    }
                }
            }



            $conn-> close();            //close the connection to database
        ?>

    </body>
</html>
