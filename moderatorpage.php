
<?php
// Start the session
session_start();
if ($_SESSION["UserID"] == NULL) {
    header("Location: http://projbsn.cpsc.ucalgary.ca/loginform.php");
    exit();
}
if ($_SESSION["Mode"] != "Mod") {
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
        <link rel="stylesheet" href="styles/style.css">
        <meta charset="UTF-8">
        <title>Music Sharing-Moderator Page</title>
        <style>
            table, th, td { border: 1px solid black; }
        </style>
    </head>
    <body>
        <?php
        // put your code here
        include('config.php');
        $userID = $_SESSION["UserID"];

        $Logout = $reviewID = $checkFlag = $checkReviewID = $checkWarning = $goForBarney = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $Logout = test_input($_POST["Logout"]);
            $reviewID = test_input($_POST["ReviewID"]);
            $goForBarney = test_input($_POST["Add"]);
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

        if ($goForBarney == "Submit") { //if submit button is pressed.
            //get next flag ID
            $checkFlag = mysqli_fetch_array($conn->query("SELECT ModId, ReviewID FROM flag WHERE ReviewID = '$reviewID';"));

            if ($checkFlag == NULL) {
                
                //create flag and update user_warning
                $conn->query("INSERT INTO flag(ModID, ReviewID) VALUES('$userID', '$reviewID');");
                //get user id from the review
                $checkReviewID = mysqli_fetch_array($conn->query("SELECT UserWhoWrote FROM review WHERE ReviewID = '$reviewID';"));
                $offendingUser = $checkReviewID[0];
                //check user warning
                $checkWarning = mysqli_fetch_array($conn->query("SELECT UserID, NumStrikes FROM user_warning WHERE UserID = '$offendingUser';"));
                if ($checkWarning == NULL) {
                    //create a warning
                    $conn->query("INSERT INTO user_warning (ModID, UserID, NumStrikes) VALUES('$userID', '$offendingUser', '1');");
                } else {
                    //increment warning number
                    $numStrikes = $checkWarning[1];
                    $numStrikes++;
                    $conn->query("UPDATE user_warning SET NumStrikes = '$numStrikes' WHERE ModID = '$userID' AND UserID = '$offendingUser'");
                }
            } 
            
        }
        ?>
        <h3>Moderator Page</h3>
        <br>
        ModID: <?php echo $_SESSION["UserID"] ?><br>



        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            ReviewID: <input type="text" name="ReviewID" value="" /><br><br>
            <input type="submit" name="Add" value="Submit" /><br><br>
        </form>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
            <input type="submit" name="Logout" value="Logout" />

        </form>

        <?php
        $conn->close();            //close the connection to database
        ?>
    </body>
</html>
