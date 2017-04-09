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
        <h3>Moderator Page</h3>
        <br>
        TODO: <br>
        display mod id?<br>
        display warnings from this mod about review?<br>
        display warnings from this mod to a user, and their strikes?<br>
        form 1: make flag for reviewid and warn userwhowrote<br>
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
