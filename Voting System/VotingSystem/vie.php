<?php
  
   //include the database connection page
   //require("logged_db.php");
   session_start();
   //create variable to pick up session variable
   $firstname=$_SESSION['firstname'];
   $othernames=$_SESSION['othernames'];

   //require the user defined function page
  // require("my_functions.php");
   //pick details from the form
   if(isset($_POST['vie'])){
    //create variables to hold form data
    $election_id= $position_id= 0;
    $success=$error='';
    //picking up data from the form
    $election_id=$_POST['election'];
    $position_id=$_POST['position'];
//prevent cross site script attack
   // $election_id=sanitize($election_id);
   // $position_id=sanitize($position_id);
   // $email=mysqli_real_escape_string($dbconnect,$email);
   // $password=htmlspecialchars($password);
     if(!is_numeric($election_id)){
        $error="an unexpected error occured.please try again.";
        //exit;
     }
     
    if(!is_numeric($position_id)){
        $error="an unexpected error occured.please try again.";
        //exit;
     }
      $user_id=$_SESSION['id'];

      //check whether student has alreday registered for this election
      $sql="SELECT * FROM candidates WHERE user_id=$user_id AND election_id=$election_id";
    //step 2-execute the sql statement using mysqli_function
    $result=mysqli_query($dbconnect,$sql);
    //step 3-check if a row has been found
    $row=mysqli_num_rows($result);
    //$success=$row;

    if($row>0){
        $error="<p style='color:red;'>You have already registred for this position.</p>";
    }else{
        //save the data to the database
        $sql="INSERT INTO candidates(user_id,position_id,election_id) 
                        VALUES($user_id,$position_id,$election_id)";
        //execute sql statement using query() function and check if data is saved successfully
        if($dbconnect->query($sql)===TRUE) {
        $success="<p style='color:green;'>You have successfully registered.</p>";

        }else{
        $error="<p style='color:red;'> Error:".$dbconnect->error. "</p>";
        }
    }

   }
   
   ?>
   <!--header starts here-->
  <?php require'header.php'?>
       <!--main content area starts here-->
        <div class="breadcome-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="breadcome-list">
                                <div class="row">
                                    <!--form goes here-->
                                    <div class="text-center m-b-md custom-login">
                                        <h1 style="color:gold">Register to vie</h1>

                                    </div>
                <div class="hpanel">
                    <div class="panel-body">
                        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="vieForm">
                            <div class="form-group">
                                <label class="control-label" for="election">Election</label>
                                <select name="election" id="election">
                                    <?php
                                       $dbconnect= mysqli_connect('localhost', 'admin', 'voting2022', 'voting');
                                         //retrieve data from database
                                          //step 1-write the sql statement
                                            $sql="SELECT * FROM election WHERE active = 1 ";
                                           //step 2-execute the sql statement using mysqli_function
                                           $result=mysqli_query($dbconnect,$sql);
                                            //step 3-fetch the results
                                            $election=mysqli_fetch_all($result, MYSQLI_ASSOC);

                                            foreach($election as $elect){?>
                                                 <option value="<?php echo $elect['id'];?>"><?php echo $elect['name'];?></option>;
                                          <?php
                                                }
                                    ?>
                                
                                </select>
                            </div>
                            <div class="form-group">
                             <label class="control-label" for="position">position</label>
                                <select name="position" id="position">
                                <?php
                                      
                                         //retrieve data from database
                                          //step 1-write the sql statement
                                            $sql="SELECT * FROM position";
                                           //step 2-execute the sql statement using mysqli_function
                                           $result=mysqli_query($dbconnect,$sql);
                                            //step 3-fetch the results
                                            $position=mysqli_fetch_all($result, MYSQLI_ASSOC);

                                            foreach($position as $post){?>
                                                 <option value="<?php echo $post['id'];?>"><?php echo $post['name'];?></option>;
                                          <?php
                                                }
                                    ?>
                                </select>
                            </div>
                                    <?php
                                        if (isset($success)):
                                            echo $success;
                                        endif;

                                        if(isset($error)):
                                            echo $error;
                                        endif;
                                                                
                                                                
                                        ?>
                            
										
                            </div>
                            <input type="submit" id="vie" name="vie" value="Register" class="btn btn-success btn-block loginbtn"/>
                          
                        </form>
                    </div>
                </div>
  
  
    <!--main content area ends here-->
        <!--Footer starts here-->
        <?php require 'footer.php'?>