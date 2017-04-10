
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
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styles/style.css">
        <title>Music Sharing-New User Form</title>
        <style>
            table, th, td { border: 1px solid black; }
        </style>
    </head>
    <body>
        <?php
        include('config.php');
        
        
        //find next id available. It will be automatically assigned.
        //get count of users.
        $count = mysqli_fetch_array($conn->query("SELECT COUNT(UserId) FROM user;"));
        //echo $count[0];
        $newID = $count[0] + 1;
                
                
                
        $user = $pass = $dob = $name = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //$user = test_input($_POST["user"]);
            $pass = test_input($_POST["passw"]);
            $dob = test_input($_POST["dob"]);
            $name = test_input($_POST["name"]);
            
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        
        if($name != NULL || $pass != NULL || $dob != NULL){
            $conn->query("INSERT INTO user(UserID, Password, DOB, Name) VALUES('$newID', '$pass', '$dob', '$name');");
                  
            //echo "user made.";
            header("Location: http://projbsn.cpsc.ucalgary.ca/loginform.php");
            exit();
           // header("Refresh:0");    //refresh the page to make the next user available.
            //send to login
        }


        
        $conn->close(); //close the connection to database
        ?>

        <h3>New User Form</h3>
        <table class="center">
            <tr>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/index.php">Home Page</a></td>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/loginform.php">Login Form</a></td>
            </tr>
        </table>
        <br><br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
            UserID: <?php echo $newID ?> <br><br>
            Password: <input type="text" name="passw" value="" maxlength="100" /> <br><br>
            Name: <input type="text" name="name" value="" maxlength="100" /> <br><br>
            DOB (yyyy/mm/dd): <input type="text" name="dob" value="" maxlength="100" /> <br><br>
            
            <input type="submit" name="submit" value="submit"/> <br>

        </form>

        <?php
        //echo $user;
        ?>

    </body>
</html>
