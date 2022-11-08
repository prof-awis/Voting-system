<?php 
// Require the Database Connection Page
require("db_connect.php");


//checking if the save button is clicked

if(isset($_POST['save'])) {

    //creating variables to hold the form data
    $firstname=$surname=$email=$phonenumber=$password='';
    //$phonenumber=0; //assign it as a number and not a string

    //picking up the data from form
    $firstname=$_POST['fname'];
    $surname=$_POST['surname'];
    $phonenumber=$_POST['phonenumber'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    //an associative array to hold the errors
    $error = array("firstname" => "", "surname" => "", "phonenumber" => "", "email" => "", "password" => "", "general" => "");

    $success = '';
    //This is to see if your data is reaching the server
    //echo "<p style='color: white; '>$firstname $surname $phonenumber $email $password</p>";


    //Validating data
    //it is validation that prevents cross site scripting (xss) from happening. xss done by hackers
    //checking if firstname has been filled
        if(empty($firstname)) {
             $error['firstname'] = "<p style='color: red;'>Please enter your first name</p>";
        }

        else {
        //prevents Cross Site Scripting Attack
        $firstname=htmlspecialchars($firstname);

        //check whether special characters have been used on the name
        if ( !preg_match('/^[a-z]+$/i', $firstname)) {
            $error['firstname'] = "<p style='color: red;'>Please use letters a-z only on your first name</p>";
            }
        }

        //checking if surname has been filled
        if(empty($surname)) {
            $error['surname'] = "<p style='color: red;'>Please enter your surname</p>";
        }

        else {
            //prevents Cross Site Scripting Attack
            $surname=htmlspecialchars($surname);

            //check whether special characters have been used on the name
            if (!preg_match('/^[a-z]+$/i', $surname)) {
                $error['surname'] = "<p style='color: red;'>Please use letters a-z only on your surname</p>";
            }
        }

        //checking if phonenumber has been filled
        if(empty($phonenumber)) {
            $error['phonenumber'] = "<p style='color: red;'>Please enter your phone number</p>";
        }

        else {
            //prevents Cross Site Scripting Attack
            $phonenumber=htmlspecialchars($phonenumber);

            //check whether phone number is numbers
            if (!is_numeric($phonenumber)) {
                $error['phonenumber'] = "<p style='color: red;'>Phone number must be digits between 0-9 only</p>";
            }

            if (strlen($phonenumber) !=10) {
                $error['phonenumber'] = "<p style='color: red;'>Phone number must have 10 digits</p>";
            }
        }

        //checking if Email Address has been filled
        if(empty($email)) {
            $error['email'] = "<p style='color: red;'>Please enter your email</p>";
        }

        else {
            //prevents Cross Site Scripting Attack
            $email=htmlspecialchars($email);

            //check whether email address is valid
            if( !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error['email'] = "<p style='color: red;'>Invalid Email Address ($email), please check and try again<p/>";
            }
        }

        //checking if password has been filled
        if(empty($password)) {
            $error['password'] = "<p style='color: red;'>Please enter your password</p>";
        }

        else {
            //prevents Cross Site Scripting Attack
            $password=htmlspecialchars($password);
            $password = crypt($password, 'vote_2022');

            //   // Validate password strength
            //      $uppercase    = preg_match('@[A-Z]@', $password);
            //      $lowercase    = preg_match('@[a-z]@', $password);
            //      $number       = preg_match('@[0-9]@', $password);
            //      $specialchars = preg_match('@[^\w]@', $password);
  
            // if (!$uppercase || !$lowercase || !$number || !$specialchars || strlen($password) < 8) {
            //     $error['password'] = "<p style='color: red;'>Password is not Strong. Must at least have 8(eight) characters(special character, an uppercase, a lowercase and a number)</p>";
    
            //  } else {
            //     // $error['password'] = 'Password is Strong';
            //      } 
        }
         
    //feedback to the user
    if (array_filter($error)) {
        $error['general'] = "<p style='color: red;'>Please sort out the above errors before you can proceed.</p>"; 
       // echo "<script style='color: red;'>alert('Please sort out the above errors before you can proceed')</script>";
    }
    else{
        //This is the sql statement to insert data to the user table
        $sql = "INSERT INTO user(firstname, othernames, contact, emailaddress, password) 
                        VALUES ('$firstname', '$surname', $phonenumber, '$email', '$password')";

        //We execute the sql statement using the query() function
        //and check whether the data is saved successfully using the if statements
        if ($dbconnect->query($sql) === TRUE) {
             $success = "<p style='color: green; text-align: center; '>Successful Sign up.<br> Now you can <a href='login.php'>Log in</a></p>";
        }else {
            $error['general'] = "<p style='color: red;'> Error: " . $dbconnect->error . "</p>";
        }
       
    }
}

    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Emoaw Sign Up Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    
</head>

<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <form action="#" method="post" id="register">
        <h3>Sign Up Here</h3>

        <label for="fname">First Name</label>
        <!-- in order to persist data we use the value attribute  html validation:pattern attribute-->
        <input type="text" name="fname"  maxlength="15" id="fname" value="<?php if(isset($firstname)){echo $firstname;}?>" required>
        <!-- communicating errors -->
        <?php if (isset($error['firstname'])) {
                echo $error['firstname'];
            }?>
            <div id="fnameerror" stye="color: red;"></div>

        <label for="surname">Surname</label>
        <input type="text" name="surname" id="surname" value="<?php if(isset($surname)){echo $surname;}?>" required>
        <?php if (isset($error['surname'])) {
                echo $error['surname'];
            }?>

        <label for="phonenumber">Phone Number</label>
        <input type="number" name="phonenumber"  max="0799999999" min="0700000000" id="phonenumber" placeholder="07xxxxxxxx"
            value="<?php if(isset($phonenumber)){echo $phonenumber;}?>" required>
        <?php if (isset($error['phonenumber'])) {
                echo $error['phonenumber'];
            }?>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?php if(isset($email)){echo $email;}?>" required>
     <?php if (isset($error['email'])) {
                echo $error['email'];
            }?>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        <?php if (isset($error['password'])) {
                echo $error['password'];
            }?>

        <br><br>

        <?php if (isset($error['general'])) {
                echo $error['general'];
            }?>

        <?php if (isset($success)) {
                echo $success;
            }?>

            <label for="policy">Agree to our privacy policy</label>
            <label for="">Yes</label><input type="radio" name="policy" class="terms" id="yes">
            <label for="">No</label><input type="radio" name="policy" class="terms" id="no">

        <input type="submit" value="Sign Up" id="save" name="save">


        <div class="social">
            <div class="go"><i class="fab fa-google"></i>Google</div>
            <div class="fb"><i class="fab fa-facebook"></i>Facebook</div>
        </div>

    </form>

    <!-- javascript validation -->
    <script type="text/javascript">
        const form = document.getElementById('register');
        const fname = document.getElementById('fname');
        const phonenumber = document.getElementById('phonenumber');
        var error = document.getElementById('fnameerror');

        form.addEventListener('submit', (e) => {
            // alert("You are here");
        
            if (fname.value ==='' || fname.value == null) {
                error.innerText = "Enter your first name.";
                //disabling the submit button
                e.preventDefault();
            }

            if (phonenumber.value.length < 10 || phonenumber > 10) {
                alert("Phone number is supposed to be 10 digits");
                e.preventDefault();
            }
        } )
    </script>
 
</body>

</html>