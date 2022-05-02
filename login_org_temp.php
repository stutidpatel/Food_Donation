<?php

    include('connectdb.php');
    error_reporting(0);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $email = $password = $emailError = $passwordError = "";
        $flag = 0;

        if(isset($_POST['login'])) {

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            

            $email = $_POST['email'];
            $password = $_POST['password'];

            if(!empty($email)) {
                $email = test_input($_POST['email']);
                $email = $_POST['email'];
            }

            else {
                $flag = 1;
                $emailError = "Email is required";
            }

        
            if (empty($_POST['password'])) {
                $passwordError = "Password is required";
                $flag = 1;
            }

            else 
                $password = test_input($_POST['password']);


            if($flag == 0) {

                $sql = "SELECT emailid, psw FROM organisation WHERE emailid = '$email' and psw = '$password'";
                $result = $conn->query($sql);

                echo mysqli_num_rows($result);

                if(mysqli_num_rows($result) == 1)
                    echo "LOGGED IN SUCCESSFULLY";
                else
                    echo "INVALID CREDENTIALS";
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
    <form method="post" action="organisation_login.php">
    <div style="display:flex;font-size: 23px;font-family: 'Ubuntu', sans-serif;letter-spacing: 2px;margin-bottom: 2rem;">
            <div style="font-weight: bolder;font-size: 25px;align-items: center;margin-right: 5rem;">EMAIL: </div>
                <div style="margin-right: 5rem;"><input type="text" placeholder="Enter Email-Id" name="email" id="email" value="<?php echo $email; ?>" style="width: 100%;
                text-align: center;
                border-radius: 10rem;
                height: 40px;"></div>
                <span><?php echo $emailError; ?></span>
           </div> 

            <div style="display:flex;font-size: 23px;font-family: 'Ubuntu', sans-serif;letter-spacing: 2px;margin-bottom: 2rem;">
                <div style="font-weight: bolder;font-size: 25px;align-items: center;margin-right: 5rem;">PASSWORD: </div>
                <div style="margin-right: 5rem;"><input type="password" placeholder="Password" name="password" id="password" style="width: 100%;
                    text-align: center;
                    border-radius: 10rem;
                    height: 40px;"></div>
                    <span><?php echo $passwordError; ?></span>
            </div>

            <button name='login'>LOGIN</button>

        </form>
</body>
</html>