
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
        <title>Music Sharing-Login Form</title>
        <link rel="stylesheet" href="styles/style.css">
        <style type="text/css">
            td { width: 130px;}
            table { table-layout: fixed; }
        </style>
    </head>
    <body>
        <?php
        //Start the database connection
        include('config.php');

        $user = $pass = $type = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //$user = test_input($_POST["user"]);
            $user = test_input($_POST["userid"]);
            $pass = test_input($_POST["password"]);
            $type = test_input($_POST["type"]);
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>
        <h3>Login Form</h3>
        <table class="center">
            <tr>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/index.php">Home Page</a></td>
                <td><a href="http://projbsn.cpsc.ucalgary.ca/newuserform.php">New User Form</a></td>
            </tr>
        </table>
        <br>
        <br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
            Type:
            <select name="type">
                <option value="user">User</option>
                <option value="admin">Administrator</option>
                <option value="mod">Moderator</option>
            </select> <br><br>

            UserID: <input type="text" name="userid"><br><br>
            Password: <input type="text" name="password"><br><br>
            <input type="submit" name="submit" value="Login"/> <br><br>
        </form>
        <br>

        <?php
        //logic for admittance
        if ($pass != NULL) {
            if ($type === admin) {
                //process login with administrator
                //AdminID and Password
                $creds = mysqli_fetch_array($conn->query("SELECT AdminId, Password FROM admin WHERE AdminID = '$user';"));
                if ($creds[1] === $pass) {
                    //proceed with login.
                    //edit the session values
                    $_SESSION["Mode"] = "Admin";
                    $_SESSION["UserID"] = $user;
                    header("Location: http://projbsn.cpsc.ucalgary.ca/adminpage.php");
                    exit();
                } else {
                    echo "Access Denied. Wrong Password.";
                }
            } else if ($type === mod) {
                //process login with Moderator
                //ModID and Password
                $creds = mysqli_fetch_array($conn->query("SELECT ModId, Password FROM moderator WHERE ModID = '$user';"));
                if ($creds[1] === $pass) {
                    //proceed with login.
                    //edit the session values
                    $_SESSION["Mode"] = "Mod";
                    $_SESSION["UserID"] = $user;
                    header("Location: http://projbsn.cpsc.ucalgary.ca/moderatorpage.php");
                    exit();
                } else {
                    echo "Access Denied. Wrong Password.";
                }
            } else {
                //process login with user
                //UserID and Password
                $creds = mysqli_fetch_array($conn->query("SELECT UserId, Password FROM user WHERE UserID = '$user';"));
                if ($creds[1] === $pass) {
                    //proceed with login.
                    //edit the session values
                    $_SESSION["Mode"] = "User";
                    $_SESSION["UserID"] = $user;
                    header("Location: http://projbsn.cpsc.ucalgary.ca/userpage.php");
                    exit();
                } else {
                    echo "Access Denied. Wrong Password.";
                }
            }
        }


        $conn->close(); //close the connection to database
        ?>
    </body>
</html>
