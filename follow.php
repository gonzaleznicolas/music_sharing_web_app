
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
        <title>Music Sharing-Follow</title>
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
        <?php
        $followid = $_POST['followid'];
        
        if ($followid != NULL) {
            echo $followid;
        }
        
        $sql = "INSERT INTO following (FollowerID, FolloweeID) VALUES ('$userID', '$followid')";
        if(!mysqli_query($conn,$sql)){
            echo "Not successful";
        }
        else {
            echo "successful";
        }
        
        ?>
        
        <h3>Follow</h3>
        
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
        //Display who this user is following
        echo "You are following these users:<br>";
        $sql = "SELECT * FROM following WHERE FollowerID = '$userID'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "Followee: " . $row["FolloweeID"] . "<br>";
            }
        }
        
        //Display who is following this user
        echo "<br>These users follow you:<br>";
        $sql = "SELECT * FROM following WHERE FolloweeID = '$userID'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "Follower: " . $row["FollowerID"] . "<br>";
            }
        }
        ?>
        <br><br><br>
        <form action="follow.php" method="post">
            Follow this ID: <input type="text" name="followid"> &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" value="Submit">
        </form>
        
        <?php
        echo "<br><br>test1";
        $conn->close(); //close the connection to database
        ?>
    </body>
</html>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        