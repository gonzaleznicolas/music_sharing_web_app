<!DOCTYPE html>
<!--
471 Group
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Music Sharing-Login Form</title>
        <style>
        table, th, td { border: 1px solid black; }
        </style>
    </head>
    <body>
        <h3>Login Form</h3>
        <table>
            <tr>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/index.php">Home Page</a></td>
            </tr>
            <tr>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/newuserform.php">New User Form</a></td>
            </tr>
        </table>
        <br>
        TODO: Three input fields: username, password, type<br>
        Type is admin, moderator, or user (dropdown list?)<br>
        while only users can be created on the site, every type of user can login here.<br>
        We can also make three seperate login forms to make the logic easier.<br>
        ex. fill out form 1 if you are a user, fill out form 2 if you are a moderator...<br>
        
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
