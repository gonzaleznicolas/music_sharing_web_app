
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
        <link rel="stylesheet" href="styles/style.css">
        <title>Music Sharing-Recommend</title>
        <style type="text/css">
            td { width: 100px;}
            table { table-layout: fixed; }
        </style>
    </head>
    <body>
        <?php
        //connect to database
        include('config.php');
        $t = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; //tab character
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
        
        //Execute recommend
        $songname = $_POST['songname']; //Get the submitted data
        $artistID = $_POST['artistID'];
        $recommendID = $_POST['recommendID'];
        $message = $_POST['message'];
        
        //Run query if each field was filled
        if ($songname != "" && $artistID != "" && $recommendID != "" && $message != ""){
            $sql = "INSERT INTO recommendation (SongName, ArtistID, ByUserID, ForUserID, Message)
                    VALUES ('$songname', '$artistID', '$userID', '$recommendID', '$message')";
            mysqli_query($conn,$sql);
        }
        ?>
        
        <h3>Recommend</h3>
        
        <?php
        if (userID != "" && userID != NULL) {
            $sql = "SELECT * FROM user WHERE UserID = '$userID'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "User: " . $row["UserID"] . " - " . $row["Name"] . "<br>"; 
                }
            }
        }
        ?>
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
            <input type="submit" name="Logout" value="Logout" />
        </form>
        <br><br>
        <table class="center">
            <tr>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/userpage.php">User Page</a></td>
            </tr>
        </table>
        <br>
        <table class="center">
            <tr>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/review.php">Review</a></td>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/rate.php">Rate</a></td>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/follow.php">Follow</a></td>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/recommend.php">Recommend</a></td>
            </tr>
        </table>
        <br><br>
        <i><b>Recommend a song to another user:</i></b><br>
        <form action="recommend.php" method="post">
            Song Name: <input type="text" name="songname"><br>
            Artist ID: <input type="text" name="artistID"><br>
            Recommend to: <input type="text" name="recommendID"><br>
            Message: <input type="text" name="message"><br>
            <input type="submit" value="Submit">
        </form>
        <br><br>
        <?php
        //Display song recommendations for this user
        echo "<strong><i>These songs are recommended to you:</i></strong><br><br>";
        $sql = "SELECT * FROM recommendation WHERE ForUserID = '$userID'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "Recommended by: " . $row["ByUserID"] . $t . "Song Name: " . $row["SongName"] . "<br>";
                echo "Message: " . $row["Message"] . "<br><br>";
            }
        }

        //display recommendations this user has made
        echo "<strong><i>These are the recommendations you have made:</i></strong><br><br>";
        $sql1 = "SELECT * FROM recommendation WHERE ByUserID = '$userID'";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
                echo "Recommended by: " . $row1["ByUserID"] . $t . "Song Name: " . $row1["SongName"] . "<br>";
                echo "Message: " . $row1["Message"] . "<br><br>";
            }
        }
        ?>
        
        <?php
        $conn->close(); //close the connection to database
        ?>
    </body>
</html>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        