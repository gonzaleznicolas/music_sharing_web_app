<!DOCTYPE html>
<!--
471 Group
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Music Sharing-New User Form</title>
        <style>
        table, th, td { border: 1px solid black; }
        </style>
    </head>
    <body>
        <h3>New User Form</h3>
        <table>
            <tr>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/index.php">Home Page</a></td>
            </tr>
            <tr>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/loginform.php">Login Form</a></td>
            </tr>
        </table>
        
        TODO: Two input fields: username, password<br>
        Mods and admins can only be created off the web. only regular users can sign up like this.<br>
        
        Two implementations to decide on:<br>
        option 1- username must be a unique string.<br>
        option 2- You do not get a username. instead the username field is auto-filled with the next available <br>incremented integer in from the user table. this integer will act as your username.<br>
        
        <?php
            $servername = "localhost";
            $username = "projbsn_root";
            $password = "brentseannick471";
            $db = "projbsn_musicsharing";
            
            $conn = new mysqli($servername, $username, $password, $db);
            
            if($conn->connect_error){
                die("Connection failed".$conn->connect_error);
            }
            $conn-> close(); //close the connection to database
        ?>
    </body>
</html>
