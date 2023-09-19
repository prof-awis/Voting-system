<?php 

    require('db_connect.php');

    if(isset($_POST['save'])) {
            $firstname = $surname = $email = $password = '';
            $phonenumber = 0;

            $firstname = $_POST['fname'];
            $surname = $_POST['surname'];
            $phonenumber = $_POST['phonenumber'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $success = '';

            $error = array('firsname' => '', 'surname' => '', 'phonenumber' => '', 'email' => '', 'password' => '', 'general' => '');

            if(empty($firstname)) {
                $error['firstname'] = "<p style='color: red;'>Please enter your first name</p>";
            } else {
                $firstname = htmlspecialchars($firstname);
                if(!preg_match('/^[a-z ]+$/i', $firstname)){
                    $error['firstname'] = "<p style='color: red;'>Please use letters a to z only for your first name</p>";
                }
            }

            if(empty($surname)) {
                $error['surname'] = "<p style='color: red;'>Please enter your last name</p>";
            } else {
                $surname = htmlspecialchars($surname);
                if(!preg_match('/^[a-z ]+$/i', $surname)){
                    $error['surname'] = "<p style='color: red;'>Please use letters a to z only for your sur name</p>";
                }
            }

            if(empty($phonenumber)) {
                $error['phonenumber'] = "<p style='color: red;'>Please enter your phone number</p>";
            } else {
                $phonenumber = htmlspecialchars($phonenumber);
                if(!is_numeric($phonenumber)) {
                    $error['phonenumber'] = "<p style='color: red;'>Phone Number must be a valid phone number between 0 to 9</p>";
                }
                if(strlen($phonenumber) != 10) {
                    $error['phonenumber'] = "<p style='color: red;'>Your number should have ten digits</p>";
                }
            }

            if(empty($email)) {
                $error['email'] = "<p style='color: red;'>Please enter your email address</p>";
            } else {
                $email = htmlspecialchars($email);
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error['email'] = "<p style='color: red;'>Invalid Email Address ($email), please check it and try again</p>";
                }
            }

            if(empty($password)) {
                $error['password'] = "<p style='color: red;'>Please enter your password</p>";
            } else {
                $password = htmlspecialchars($password);
                $password = crypt($password, 'vote_2022');
            }

            if(array_filter($error)) {
                $error['general'] = "<p style='color: red;'>Please sort out the above errors</p>";
            } else {
                $sql = "INSERT INTO user (firstname, othernames, contact, emailaddress, password) VALUES ('$firstname', '$surname', '$phonenumber', '$email', '$password')"; 
                if($dbconnect->query($sql) === TRUE) {
                    $success = "<p style='color: green;'>Sign Up successfull.</p>";
                    header("Location: login.php");
                } else {
                    $error['general'] = "<p style='color: red;'>Error $sql $dbconnect->error</p>";
                }
            }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>SignUp</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: #080710;
}
.background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.shape:first-child{
    background: linear-gradient(
        #1845ad,
        #23a2f6
    );
    left: -80px;
    top: -80px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #ff512f,
        #f09819
    );
    right: -30px;
    bottom: -80px;
}
form{
    height: auto;
    width: 400px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #e5e5e5;
}
input[type="submit"]{
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}
.social{
  margin-top: 30px;
  display: flex;
}
.social div{
  background: red;
  width: 150px;
  border-radius: 3px;
  padding: 5px 10px 10px 5px;
  background-color: rgba(255,255,255,0.27);
  color: #eaf0fb;
  text-align: center;
}
.social div:hover{
  background-color: rgba(255,255,255,0.47);
}
.social .fb{
  margin-left: 25px;
}
.social i{
  margin-right: 4px;
}

.no:checked ~ input[type='submit'] {
    display: none;
}

    </style>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action='signup.php' method='post' id='register'>
        <h3>Sign Up Here</h3>

        <label for="fname">First Name</label>
        <input type="text" placeholder="First Name" maxlength="15" id="fname" name="fname" value="<?php if(isset($firstname)) {echo $firstname;} ?>">
        <?php 
            if(isset($error['firstname'])) {
                echo $error['firstname'];
            }
         ?>
         <div id="fnameerror" style="color: red;"></div>

        <label for="surname">Surname</label>
        <input required type="text" placeholder="surname" maxlength="15" id="surname" name="surname" value="<?php if(isset($surname)) {echo $surname;} ?>">
        <?php 
            if(isset($error['surname'])) {
                echo $error['surname'];
            }
         ?>
         <div id="surnameerror" style="color: red;"></div>

        <label for="phonenumber">Phone Number</label>
        <input required pattern="[0-9]{10}" type="number" placeholder="07xxxxxxxx" maxlength="0799999999" min="0100000000" id="phonenumber" name="phonenumber" value="<?php if(isset($phonenumber)) {echo $phonenumber;} ?>">
        <?php 
            if(isset($error['phonenumber'])) {
                echo $error['phonenumber'];
            }
         ?>
         <div id="phonenumbererror" style="color: red;"></div>

        <label for="email">Email Address</label>
        <input required type="email" placeholder="Email Address" id="email" autocomplete="off" name="email" value="<?php if(isset($email)) {echo $email;} ?>">
        <?php 
            if(isset($error['email'])) {
                echo $error['email'];
            }
         ?>
         <div id="emailerror" style="color: red;"></div>

        <label for="password">Password</label>
        <input required type="password" placeholder="Password" name='password' id="password" value="<?php if(isset($password)) {echo $password;} ?>">
        <?php 
            if(isset($error['password'])) {
                echo $error['password'];
            }
         ?>
         <div id="passworderror" style="color: red;"></div>

        <?php 
            if(isset($error['general'])) {
                echo $error['general'];
            }
         ?>

        <?php 
            if(isset($success)) {
                echo $success;
            }
         ?>

         <label for="policy">Agree to our privacy policy</label>
         <label>Yes</label>
         <input type="radio" name="policy" class="yes" id="yes">
         <label>No</label>
         <input type="radio" name="policy" class="no" id="no">

        <input type='submit' id='save' name='save' value='Signup'></input>
        <div class="social">
          <div class="go"><i class="fab fa-google"></i>  Google</div>
          <div class="fb"><i class="fab fa-facebook"></i>  Facebook</div>
        </div>
    </form>

    <!-- <script>

        const form = document.getElementById('register');
        const fname = document.getElementById('fname');
        const surname = document.getElementById('surname');
        const phonenumber = document.getElementById('phonenumber');
        const email = document.getElementById('email');
        const password = document.getElementById('password');

        console.log(fname.value);

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            if(fname.value.length === 0) document.getElementById('fnameerror').innerText = 'Enter your first name';
            if(surname.value.length === 0) document.getElementById('surnameerror').innerText = 'Enter your sur name';
            if(phonenumber.value.length === 0) document.getElementById('phonenumbererror').innerText = 'Enter your phone number';
            if(email.value.length === 0) document.getElementById('emailerror').innerText = 'Enter your email address';
            if(password.value.length === 0) document.getElementById('passworderror').innerText = 'Please enter a password';
        })

    </script> -->

</body>
</html>
