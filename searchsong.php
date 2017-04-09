<!DOCTYPE html>
<!--
471 Group
-->
<html>
    <head>
        <link rel="stylesheet" href="styles/searchsong.css">
        <meta charset="UTF-8">
        <title>Music Sharing-Admin Page</title>
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

        <h3>Search Song</h3>
        
        <a href="http://projbsn.cpsc.ucalgary.ca/index.php">Home Page</a><br>
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

                Print "<strong>SongName&emsp;&emsp;&emsp;&emsp;ArtistID&emsp;&emsp;&emsp;&emsp;Album&emsp;&emsp;&emsp;&emsp;Genre&emsp;&emsp;&emsp;&emsp;Length(s)&emsp;&emsp;&emsp;&emsp;DateAdded&emsp;&emsp;&emsp;&emsp;AverageRating</strong><br>";
                echo "<hr>";


                $result = $conn->query("SELECT SongName, ArtistID, AlbumName, Genre, Length, AddedDate FROM song WHERE SongName = '$songName';");



                if($result->num_rows >0){           //check if query results in more than 0 rows
                    while($row = $result->fetch_assoc()){   //loop until all rows in result are fetched

                        $avgrating = "not rated yet";
                        $sn = $row["SongName"];
                        $aID = $row["ArtistID"];
                        $rating = $conn->query("SELECT AVG(Rating) FROM song_rating WHERE SongName='$sn' AND ArtistID='$aID';");
                        if ($ratingRow = $rating->fetch_assoc())
                        {
                            echo "<br>";
                            $avgrating = $ratingRow["AVG(Rating)"];
                            echo "<br>";
                        }


                        echo $row["SongName"]."&emsp;&emsp;&emsp;&emsp;".$row["ArtistID"]."&emsp;&emsp;&emsp;&emsp;".$row["AlbumName"]."&emsp;&emsp;&emsp;&emsp;".$row["Genre"]."&emsp;&emsp;&emsp;&emsp;".$row["Length"]."&emsp;&emsp;&emsp;&emsp;".$row["AddedDate"]."&emsp;&emsp;&emsp;&emsp;".$avgrating."<br>"; //here we are looking at one row, and printing the values in that row
                    }
                }
                

            }




            $conn-> close();            //close the connection to database
        ?>
    </body>
</html>
