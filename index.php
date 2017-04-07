<!DOCTYPE html>
<!--
471 Group
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Music Sharing-Home Page</title>
        <style>
        table, th, td { border: 1px solid black; }
        </style>
    </head>
    <body>
        Reference link: <a href="http://projbsn.cpsc.ucalgary.ca/ref/">Mitch Proj. Delete me later!</a><br>
        <hr>
        <h3>Home Page</h3>
        <h4>This website is for sharing musical tastes with others. Rate, review and recommend songs and artists to others... and more</h4>
        
        You must be logged in to access the website:
        <table>
            <tr>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/loginform.php">Login Form</a></td>
            </tr>
            <tr>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/newuserform.php">New User Form</a></td>
            </tr>
        </table>
        
        
        
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
