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
  <title>Register Admin</title>
  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Customized Bootstrap Stylesheet -->
  <link href="css/style.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Assistant:400,700" rel="stylesheet">
  <link rel="stylesheet" href="css\form.css">

</head>

<body>
  <!-- partial:index.partial.html -->
  <section class='login' id='login'>
    <div class='head'>
      <h1 class='company'>Register</h1>
    </div>
    <bR><br>
    <div class='form'>
      <form>
 
                <input type="text" class='text' placeholder="First Name" name="fname" id="fname" value="<?php echo $fname; ?>"> 
                <span><?php echo $fnameError; ?></span>
<br>
                <input type="text" class='text' placeholder="Last Name" name="lname" id="lname" value="<?php echo $lname; ?>"> 
                <span><?php echo $lnameError; ?></span>


            <input type="text" class='text' placeholder="Email-Id" name="email" id="email" value="<?php echo $email; ?>">
                <span><?php echo $emailError; ?></span>
       

            <input type="password" class='password' placeholder="Password" name="password" id="password">
                    <span><?php echo $passwordError; ?></span>
            <input type="password" class='password'placeholder="Confirm Password" name="cpassword" id="cpassword">
                    <span><?php echo $cpasswordError; ?></span>
            <input type="number" class='number' placeholder="Mobile Number" name="cnumber" id="cnumber">
                    <span><?php echo $cnumberError; ?></span>
<br>
<br>
<br>
        <center><a href="index.html" class='btn-login' name='register'>Register</a> </center>
      </form>
    </div>
  </section>
  <!-- <script src="./script.js"></script> -->

</body>

</html>