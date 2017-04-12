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
        <h3>User Page</h3>
        <br>
        TODO: <br>
        display user id<br>
        display who user is following<br>
        display warnings from a mod to this user, their strikes, and the related review?<br>
        display recommended songid<br>
        links to song search, album search, artist search<br>
        form 1: follow userid<br>
        form 2: rate songid<br>
        form 3: rate albumid<br>
        form 4: rate artistid<br>
        form 5: review songid<br>
        form 6: review albumid<br>
        form 7: review artistid<br>
        form 8: declare listens to songid<br>
        form 9: recommend songid to userid<br>
        logout button.<br>
        
        <?php
            // put your code here
            $servername = "localhost";          //should be same for you
            $username = "projbsn_root";                 //same here
            $password = "brentseannick471";     //your localhost root password
            $db = "projbsn_musicsharing";       //your database name
            
            $conn = new mysqli($servername, $username, $password, $db);
            
            if($conn->connect_error){
                die("Connection failed".$conn->connect_error);
            }
            $conn-> close();            //close the connection to database
        ?>
    </body>
</html>
