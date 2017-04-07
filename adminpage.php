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
        <h3>Admin Page</h3>
        <br>
        TODO: <br>
        display admin id?<br>
        form 1: add artist- note: artist must be added before a song and album can be added<br>
        form 2: add song- note: a song might NOT belong to an album, but must belong to an artist<br>
        form 3: add album<br>
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
