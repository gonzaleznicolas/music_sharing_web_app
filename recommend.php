
<?php
// Start the session
session_start();
if ($_SESSION["UserID"] == NULL) {
    header("Location: http://projbsn.cpsc.ucalgary.ca/loginform.php");
    exit();
}
?>
<!DOCTYPE html>
<!--
471 Group
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Music Sharing-Recommend</title>
        <style>
            table, th, td { border: 1px solid black; }
        </style>
    </head>
    <body>
        <?php
        //connect to database
        include('config.php');
        //echo $_SESSION["Mode"];
        $userID = $_SESSION["UserID"];  //userID

        $logout = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $Logout = test_input($_POST["Logout"]);
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if ($Logout === "Logout") {
            $_SESSION["Mode"] = "";
            $_SESSION["UserID"] = "";
            session_destroy();
            header("Location: http://projbsn.cpsc.ucalgary.ca/loginform.php");
            exit();
        }
        ?>
        
        <h3>Recommend</h3>
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
            <input type="submit" name="Logout" value="Logout" />
        </form>
        <br><br>
        <table>
            <tr>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/userpage.php">User Page</a></td>
            </tr>
        </table>
        <br><br>
        
        <?php
        //Display song recommendations for this user
        echo "These songs are recommended to you:<br>";
        $sql = "SELECT * FROM recommendation WHERE ForUserID = '$userID'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "Recommended by: " . $row["ByUserID"] . "$t Song Name: " . $row["SongName"] . "<br>";
                echo "Message: " . $row["Message"] . "<br><br>";
            }
        }
        ?>
        
        
        <?php
        echo "<br><br>test1";
        $conn->close(); //close the connection to database
        ?>
    </body>
</html>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        