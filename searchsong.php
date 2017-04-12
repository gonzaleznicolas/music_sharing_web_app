
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
        <h3>Search Song</h3>
        <br>
        TODO: <br>
        form 1: search song name. <br>
        &nbsp display back all id's for a song name.<br>
        form 2: search song id.<br>
        &nbsp display all song fields, except adminwhoaddedid<br>
        &nbsp display the artist its by<br>
        &nbsp display the album its from<br>
        &nbsp display average rating<br>
        &nbsp give ids of reviews<br>
        Make all id's clickable? Would take you to the page and auto-search that id?<br>
        
        
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
