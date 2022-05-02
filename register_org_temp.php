<?php 

    include('connectdb.php');

    error_reporting(0);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $oname = $email = $password = $cpassword = $city = $onameError = $emailError = $passwordError = $cpasswordError = $cityError = "";
        $flag = 0;

        if(isset($_POST['register'])) {

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            
            $oname = $_POST['oname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];
            $city = $_POST['city'];

            if(!empty($oname)) 
                $oname = test_input($_POST['oname']);

            else {
                $flag = 1;
                $onameError = "Organisation Name is required";
            }

            if(!empty($email)) 
                $email = test_input($_POST['email']);

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

            if (empty($_POST['cpassword'])) {
                $cpasswordError = "Confirm Password is required";
                $flag = 1;
            }

            else if($password != $cpassword) {
                $cpasswordError = "Password and Confirm Password should match";
                $flag = 1;
            }

            else 
                $cpassword = test_input($_POST['password']);

            if(!empty($city)) 
                $cnumber = test_input($_POST['cnumber']);
    
            else {
                $flag = 1;
                $cnumberError = "City is required";
            }

            if($flag == 0) {
            
                $sql = "SELECT emailid FROM user WHERE emailid = '$email'";
                $result = $conn->query($sql);


                if(mysqli_num_rows($result) == 0) {
                    $sql = "INSERT INTO organisation (oname, emailid, city, psw)" . 
                    "VALUES ('$oname', '$email', '$city', '$password');";
                    $result = $conn->query($sql);

                    echo "LOGGED IN SUCCESSFULLY";
                }
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
    <form method="post" action="organisation.php">
    <div style="display:flex;font-size: 23px;font-family: 'Ubuntu', sans-serif;letter-spacing: 2px;margin-bottom: 2rem;">
            
            <div style="font-weight: bolder;font-size: 25px;align-items: center;margin-right: 5rem;">ORGANISATION NAME: </div>
                <div style="margin-right: 5rem;"><input type="text" placeholder="Enter Organisation Name" name="oname" id="oname" value="<?php echo $oname; ?>" style="width: 100%;
                text-align: center;
                border-radius: 10rem;
                height: 40px;"></div>
                <span><?php echo $onameError; ?></span>
           </div> 

    
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

            <div style="display:flex;font-size: 23px;font-family: 'Ubuntu', sans-serif;letter-spacing: 2px;margin-bottom: 2rem;">
                <div style="font-weight: bolder;font-size: 25px;align-items: center;margin-right: 5rem;">CONFIRM PASSWORD: </div>
                <div style="margin-right: 5rem;"><input type="password" placeholder="Password" name="cpassword" id="cpassword" style="width: 100%;
                    text-align: center;
                    border-radius: 10rem;
                    height: 40px;"></div>
                    <span><?php echo $cpasswordError; ?></span>
            </div>

            <div style="display:flex;font-size: 23px;font-family: 'Ubuntu', sans-serif;letter-spacing: 2px;margin-bottom: 2rem;">
                <div style="font-weight: bolder;font-size: 25px;align-items: center;margin-right: 5rem;">MOBILE NUMBER: </div>
                <div style="margin-right: 5rem;"><input type="text" placeholder="Enter city" name="city" id="city" style="width: 100%;
                    text-align: center;
                    border-radius: 10rem;
                    height: 40px;"></div>
                    <span><?php echo $cityError; ?></span>
            </div>

            <button name='register'>Register</button>
        </div>
        </form>
</body>
</html>