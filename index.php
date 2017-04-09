<!DOCTYPE html>
<!--
471 Group
-->
<html>
    <head>
        <link rel="stylesheet" href="styles/homepage.css">
        <meta charset="UTF-8">
        <title>Music Sharing-Home Page</title>
        <style>
        table, th, td { border: 1px solid black; }
        </style>
    </head>
    <body>
        Reference link: <a href="http://projbsn.cpsc.ucalgary.ca/ref/">Mitch Proj. Delete me later!</a><br>
        <hr>
        <h3>Music Share</h3>
        <h4>Listen - Rate - Review - Recommend - Enjoy</h4>
        By: Brenton Kruger, Sean Hoey, Nicolas Gonzalez
        <br><br>
        <div class="image"><img src="images/play.png" alt="logo" width="300" height="300"></div>
        <br>
        <a href="http://projbsn.cpsc.ucalgary.ca/newuserform.php">New User</a>
        &nbsp&nbsp&nbsp&nbsp
        <a href="http://projbsn.cpsc.ucalgary.ca/loginform.php">Login</a>
        <br><br>
        List of pages incase they are not linked to yet:<br>
        <a href="http://projbsn.cpsc.ucalgary.ca/index.php">Home Page</a><br>
        <a href="http://projbsn.cpsc.ucalgary.ca/loginform.php">Login Form</a><br>
        <a href="http://projbsn.cpsc.ucalgary.ca/newuserform.php">New User Form</a><br>
        <a href="http://projbsn.cpsc.ucalgary.ca/adminpage.php">Admin Page</a><br>
        <a href="http://projbsn.cpsc.ucalgary.ca/moderatorpage.php">Moderator Page</a><br>
        <a href="http://projbsn.cpsc.ucalgary.ca/userpage.php">User Page</a><br>
        <a href="http://projbsn.cpsc.ucalgary.ca/searchsong.php">Search Song</a><br>
        <a href="http://projbsn.cpsc.ucalgary.ca/searchalbum.php">Search Album</a><br>
        <a href="http://projbsn.cpsc.ucalgary.ca/searchartist.php">Search Artist</a><br>
        <a href="http://projbsn.cpsc.ucalgary.ca/searchreview.php">searchreview</a><br>
        <br>        
        
        
        <?php
            $servername = "localhost";
            $username = "projbsn_root";
            $password = "brentseannick471";
            $db = "projbsn_musicsharing";
            $conn = new mysqli($servername, $username, $password, $db);
            
            if($conn->connect_error){
                die("Connection failed".$conn->connect_error);
            }
            
            
            
            
            
            //REFERENCE CODE:
            /*
            //sql insertion
            $sql = "INSERT INTO names (names) VALUES ('John')";
            echo "<br><br>Inserting  into db: ";
            if($conn->query($sql)==TRUE){       //try executing the query 
                echo "Query executed<br>";
            }
            else{
                echo "Query did not execute<br>";
            }
            */
            
            /*
            //sql get query
            $sql = "SELECT SongName FROM song";
            echo "<br><br>Printing 'SongName' column data from the 'song' table:<br>";
            $result = $conn->query($sql);       //execute the query
            
            if($result->num_rows >0){           //check if query results in more than 0 rows
                while($row = $result->fetch_assoc()){   //loop until all rows in result are fetched
                    echo "Song name: ".$row["SongName"]."<br>"; //here we are looking at one row, and printing the value in "SongName" column
                }
            }
            */
            $conn-> close(); //close the connection to database
        ?>
    </body>
</html>
