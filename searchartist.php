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
        <link rel="stylesheet" href="styles/searchartist.css">
        <meta charset="UTF-8">
        <title>Music Sharing-Artist Search</title>
        <style>
        table, th, td { border: 1px solid black; }
        </style>
    </head>
    <body>
        <?php
        //Start the database connection
        include('config.php');

        $userID = $_SESSION["UserID"];  //userID
        
        $searchString= $type="";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $searchString = test_input($_POST["ss"]);
            $type = test_input($_POST["t"]);
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>

        <h3>Search Artist</h3>
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
        <a href="http://projbsn.cpsc.ucalgary.ca/searchalbum.php">Search Album</a>
        &nbsp&nbsp&nbsp&nbsp
        <a href="http://projbsn.cpsc.ucalgary.ca/searchreview.php">Search Review</a>
        <br>
        <br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
            Search by artist stage name or by artist ID number? <br>
            <select name="t">
                <option value="byStageName">Search by Stage Name</option>
                <option value="byID">Search By ID</option>
            </select> <br><br>
            Stage Name or ID: <input type="text" name="ss"><br><br>
            <input type="submit" name="submit" value="Search"/> <br><br>
        </form>
        <?php

            if (($type != NULL) && ($searchString != NULL))
            {
                echo "Results for ";
                Print "<i>$searchString</i>";
                echo ":<br><br>";
                echo "<hr>";

                if ($type == "byStageName")
                {
                    $result = $conn->query("SELECT ArtistID, StageName, RealName, AddedDate FROM artist WHERE StageName = '$searchString';");

                    if($result->num_rows >0){           //check if query results in more than 0 rows
                        $count = 0;
                        while($row = $result->fetch_assoc()){   //loop until all rows in result are fetched
                            $count = $count + 1;
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


                            echo "<h3>Result # $count</h3>";
                            echo "Artist ID: ".$row["ArtistID"]."<br>";
                            echo "Stage Name: ".$row["StageName"]."<br>";
                            echo "Real Name: ".$row["RealName"]."<br>";
                            echo "Date Added: ".$row["AddedDate"]."<br>";
                            echo "Average Rating: ".$avgrating."<br>";


                            echo "<br><i><strong>Albums by this artist:</strong></i><br>";

                            $albums = $conn->query("SELECT AlbumName FROM album WHERE ArtistID='$aID';");
                            if($albums->num_rows >0){           //check if query results in more than 0 rows
                                while($row3 = $albums->fetch_assoc()){   //loop until all rows in result are fetched
                                    echo $row3["AlbumName"]."<br>";

                                }
                            }

                            echo "<br><i><strong>Songs by this artist:</strong></i><br>";

                            $songs = $conn->query("SELECT SongName FROM song WHERE ArtistID='$aID';");
                            if($songs->num_rows >0){           //check if query results in more than 0 rows
                                while($row1 = $songs->fetch_assoc()){   //loop until all rows in result are fetched
                                    echo $row1["SongName"]."<br>";

                                }
                            }
                            echo "<br>";
                        }
                    }


                }
                else if ($type == "byID")
                {
                    $result = $conn->query("SELECT ArtistID, StageName, RealName, AddedDate FROM artist WHERE ArtistID = '$searchString';");

                    if($result->num_rows >0){           //check if query results in more than 0 rows
                        $count = 0;
                        while($row = $result->fetch_assoc()){   //loop until all rows in result are fetched
                            $count = $count + 1;
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


                            echo "<h3>Result</h3>";
                            echo "Artist ID: ".$row["ArtistID"]."<br>";
                            echo "Stage Name: ".$row["StageName"]."<br>";
                            echo "Real Name: ".$row["RealName"]."<br>";
                            echo "Date Added: ".$row["AddedDate"]."<br>";
                            echo "Average Rating: ".$avgrating."<br>";


                            echo "<br><i><strong>Albums by this artist:</strong></i><br>";

                            $albums = $conn->query("SELECT AlbumName FROM album WHERE ArtistID='$aID';");
                            if($albums->num_rows >0){           //check if query results in more than 0 rows
                                while($row3 = $albums->fetch_assoc()){   //loop until all rows in result are fetched
                                    echo $row3["AlbumName"]."<br>";

                                }
                            }

                            echo "<br><i><strong>Songs by this artist:</strong></i><br>";

                            $songs = $conn->query("SELECT SongName FROM song WHERE ArtistID='$aID';");
                            if($songs->num_rows >0){           //check if query results in more than 0 rows
                                while($row1 = $songs->fetch_assoc()){   //loop until all rows in result are fetched
                                    echo $row1["SongName"]."<br>";

                                }
                            }
                            echo "<br>";
                        }
                    }
                }
            }
            else if ($searchString == NULL)
            {


                $result = $conn->query("SELECT ArtistID, StageName, RealName, AddedDate FROM artist;");

                if($result->num_rows >0){           //check if query results in more than 0 rows
                    $count = 0;
                    while($row = $result->fetch_assoc()){   //loop until all rows in result are fetched
                        $count = $count + 1;
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


                        echo "<br><br>";
                        echo "Artist ID: ".$row["ArtistID"]."<br>";
                        echo "Stage Name: ".$row["StageName"]."<br>";
                        echo "Real Name: ".$row["RealName"]."<br>";
                        echo "Date Added: ".$row["AddedDate"]."<br>";
                        echo "Average Rating: ".$avgrating."<br>";


                        echo "<i><strong>Albums by this artist:</strong></i><br>";

                        $albums = $conn->query("SELECT AlbumName FROM album WHERE ArtistID='$aID';");
                        if($albums->num_rows >0){           //check if query results in more than 0 rows
                            while($row3 = $albums->fetch_assoc()){   //loop until all rows in result are fetched
                                echo $row3["AlbumName"]."<br>";

                            }
                        }

                        echo "<i><strong>Songs by this artist:</strong></i><br>";

                        $songs = $conn->query("SELECT SongName FROM song WHERE ArtistID='$aID';");
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

