
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
        <title>Music Sharing-Follow</title>
        <style type="text/css">
            td { width: 100px;}
            table { table-layout: fixed; }
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
        //Execute follow
        $followid = $_POST['followid']; //Get the submitted data
        $sql = "INSERT INTO following (FollowerID, FolloweeID) VALUES ('$userID', '$followid')";
        //Try inserting row
        mysqli_query($conn,$sql);
        //Execute unfollow
        $unfollowid = $_POST['unfollowid'];
        $sql = "DELETE FROM following
                WHERE FollowerID = '$userID' 
                    AND FolloweeID = '$unfollowid'";
        //Try deleting row
        mysqli_query($conn,$sql);
        ?>
        <h3>Follow</h3>
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
        <form action="follow.php" method="post">
            Follow this ID: <input type="text" name="followid"> &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" value="Submit">
        </form>
        <br><br>
        <form action="follow.php" method="post">
            Unfollow this ID: <input type="text" name="unfollowid"> &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" value="Submit">
        </form>
        <br><br>
        
        <?php
        //Display who this user is following
        echo "<i><b>You are following these users:</i></b><br><br>";
        $sql = "SELECT * FROM following WHERE FollowerID = '$userID'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "Followee: " . $row["FolloweeID"] . "<br>";
            }
        }
        //Display who is following this user
        echo "<br><i><b>These users follow you:</i></b><br><br>";
        $sql = "SELECT * FROM following WHERE FolloweeID = '$userID'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "Follower: " . $row["FollowerID"] . "<br>";
            }
        }
        ?>
        
        <?php
        $conn->close(); //close the connection to database
        ?>
    </body>
</html>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        