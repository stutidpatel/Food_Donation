<?php
include 'connectdb.php';
error_reporting(0);
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fname = $lname = $email = $password = $cpassword = $cnumber = $fnameError = $lnameError = $emailError = $passwordError = $cpasswordError = $cnumberError = "";
    $flag = 0;

    if (isset($_POST['register'])) {

        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $cnumber = $_POST['cnumber'];

        if (!empty($fname)) {
            $fname = test_input($_POST['fname']);
        } else {
            $flag = 1;
            $fnameError = "First Name is required";
        }

        if (!empty($lname)) {
            $lname = test_input($_POST['lname']);
        } else {
            $flag = 1;
            $lnameError = "Last Name is required";
        }

        if (!empty($email)) {
            $email = test_input($_POST['email']);
        } else {
            $flag = 1;
            $emailError = "Email is required";
        }

        if (empty($_POST['password'])) {
            $passwordError = "Password is required";
            $flag = 1;
        } else {
            $password = test_input($_POST['password']);
        }

        if (empty($_POST['cpassword'])) {
            $cpasswordError = "Confirm Password is required";
            $flag = 1;
        } else if ($password != $cpassword) {
            $cpasswordError = "Password and Confirm Password should match";
            $flag = 1;
        } else {
            $cpassword = test_input($_POST['password']);
        }

        if (!empty($cnumber)) {
            $cnumber = test_input($_POST['cnumber']);
        } else {
            $flag = 1;
            $cnumberError = "Mobile Number is required";
        }

        if ($flag == 0) {

            $sql = "SELECT emailid FROM user WHERE emailid = '$email'";
            $result = $conn->query($sql);

            if (mysqli_num_rows($result) == 0) {
                $sql = "INSERT INTO user (fname, lname, emailid, mobnum, psw)" .
                    "VALUES ('$fname', '$lname', '$email', '$cnumber', '$password');";
                $result = $conn->query($sql);

                echo $password;

                echo "LOGGED IN SUCCESSFULLY";
            } else {
                echo "INVALID CREDENTIALS";
            }

        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="register.php">
    <div>

            <div>FIRST NAME: </div>
                <div><input type="text" placeholder="Enter First Name" name="fname" id="fname" value="<?php echo $fname; ?>" ></div>
                <span><?php echo $fnameError; ?></span>
           </div>

           <div>LAST NAME: </div>
                <div><input type="text" placeholder="Enter Last Name" name="lname" id="lname" value="<?php echo $lname; ?>" ></div>
                <span><?php echo $lnameError; ?></span>
           </div>


            <div>EMAIL: </div>
                <div><input type="text" placeholder="Enter Email-Id" name="email" id="email" value="<?php echo $email; ?>" ></div>
                <span><?php echo $emailError; ?></span>
           </div>

            <div>
                <div>PASSWORD: </div>
                <div><input type="password" placeholder="Password" name="password" id="password"></div>
                    <span><?php echo $passwordError; ?></span>
            </div>

            <div>
                <div>CONFIRM PASSWORD: </div>
                <div><input type="password" placeholder="Password" name="cpassword" id="cpassword"></div>
                    <span><?php echo $cpasswordError; ?></span>
            </div>

            <div>
                <div>MOBILE NUMBER: </div>
                <div><input type="number" placeholder="Mobile Number" name="cnumber" id="cnumber"></div>
                    <span><?php echo $cnumberError; ?></span>
            </div>

            <button name='register'>Register</button>

        </form>
</body>
</html>