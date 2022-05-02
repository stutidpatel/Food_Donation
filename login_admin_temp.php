<?php

error_reporting(0);
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $password = $emailError = $passwordError = "";
    $flag = 0;

    if (isset($_POST['login'])) {

        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        if (!empty($email)) {
            $email = test_input($_POST['email']);
            $email = $_POST['email'];
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

        if ($flag == 0) {

            echo $email . "<br>";
            echo $password;

            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "donation";

            $conn = mysqli_connect($servername, $username, $password, $database);
            if (!$conn) {
                die("Sorry we failed to connect: " . mysqli_connect_error());
            }

            $sql = "SELECT emailid, password FROM user WHERE emailid = '$email' and password = '$password'";
            $result = $conn->query($sql);

            echo mysqli_num_rows($result);

            if (mysqli_num_rows($result) == 1) {
                echo "LOGGED IN SUCCESSFULLY";
            } else {
                echo "INVALID CREDENTIALS";
            }

        }
    }
}

?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Organisation</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

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
</head>

<body style="background-color: black;">
    <form method="post" action="login.php">
    <div style="display:flex;font-size: 23px;font-family: 'Ubuntu', sans-serif;letter-spacing: 2px;margin-bottom: 2rem;">
            <div style="font-weight: bolder;font-size: 25px;align-items: center;margin-right: 5rem;">EMAIL: </div>
                <div style="margin-right: 5rem;"><input type="text" class="form-control p-4" placeholder="Enter Email-Id" name="email" id="email" value="<?php echo $email; ?>" style="width: 100%;
                text-align: center;
                border-radius: 10rem;
                height: 40px;"></div>
                <span><?php echo $emailError; ?></span>
           </div>

            <div style="display:flex;font-size: 23px;font-family: 'Ubuntu', sans-serif;letter-spacing: 2px;margin-bottom: 2rem;">
                <div style="font-weight: bolder;font-size: 25px;align-items: center;margin-right: 5rem;">PASSWORD: </div>
                <div style="margin-right: 5rem;"><input type="password" class="form-control p-4" placeholder="Password" name="password" id="password" style="width: 100%;
                    text-align: center;
                    border-radius: 10rem;
                    height: 40px;"></div>
                    <span><?php echo $passwordError; ?></span>
            </div>

            <button class="btn btn-primary font-weight-semi-bold px-4" style="height: 50px;" name='login'>LOGIN</button>
        <a style="color:white" href='register_admin.php'>Not registered?</a>

        </form>
</body>
</html>
