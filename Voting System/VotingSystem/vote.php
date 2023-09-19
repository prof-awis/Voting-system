<?php 

session_start();
 require('db_connect.php');
 require("header.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

//require "../my_functions.php";


if (isset($_POST['vote'])) {
    $president = $vicepresident = 0;
    $error = $success = "";

    $user_id = $_SESSION['user_id'];

    // if (isset($_POST['president'])) {
    //     $president = sanitize($_POST['president']);
    // }


    // if (isset($_POST['vicepresident'])) {
    //     $vicepresident = sanitize($_POST['vicepresident']);
    // }






    $election_id = 1;
    //check whether student has alreday registered for this election
    $sql = "SELECT * FROM vote WHERE user_id = $user_id AND election_id = $election_id ";
    $result = mysqli_query($dbconnect, $sql);
    $row = mysqli_num_rows($result);

    $row = mysqli_num_rows($result);
    //$success=$row;



    if ($row > 0) {
        $error = "<div class='alert alert-danger alert-mg-b' role='alert'>You have already voted in this election.'</div>";
    } else {
        //   saving data to database
        // $sql = "INSERT INTO vote (user__id , candidate__id , election__id ) VALUES ($user_id,$president,$election_id)";
        // $sql .= "INSERT INTO vote (user__id , candidate__id , election__id ) VALUES ($user_id,$vicepresident,$election_id)";

        $sql = "INSERT INTO vote (user_id, candidates_id, election_id ) 
                            VALUES ($user_id,$president,$election_id), 
                            ($user_id,$vicepresident,$election_id)";

        // $sql = "INSERT INTO candidate (user__id,position_id, election_id) VALUES($user_id,3,1)";

        // $sql = "INSERT INTO vote (user_id , candidate_id , election_id ) VALUES ($user_id,$president,$election_id)";

        if (mysqli_query($dbconnect, $sql)) {
            $success = "<p style='color:green;'>You have successfully Voted .</p>";
        } else {
            // $error = '<div class="alert alert-danger alert-mg-b" role="alert"> <strong>Oh snap!</strong> Change a few things up and try submitting again. </div> . $dbconnect->error . "</p>';
            // $error = "<p style='color:red;'> Error: " . $dbconnect->error . "</p>";
            $error = "<div class='alert alert-danger alert-mg-b' role='alert'>  .$dbconnect->error . '</div>";
        }
    }
}

?>


<!-- President Section -->

<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="breadcomb-wp">
                                <div class="breadcomb-icon">
                                    <i class="icon nalika-new-file"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>President</h2>
                                    <p>
                                        Vote for your preferred Presidential Candidate
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="breadcomb-report">
                                <button data-toggle="tooltip" data-placement="left" title="Download Report" class="btn">
                                    <i class="icon nalika-download"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Candidates Area -->

<div class="product-new-list-area">
    <div class="container-fluid">
        <div class="row">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="voteForm">

                <?php
                $sql = "SELECT * FROM candidates WHERE position_id = 1 AND election_id=1 ";
                $result = mysqli_query($dbconnect, $sql);
                $presidents = mysqli_fetch_all($result, MYSQLI_ASSOC);

                foreach ($presidents as $pres) {
                    $user_id = $pres['user_id'];

                    $candidates_id = $pres['id'];

                    $user_sql = "SELECT * FROM user WHERE id= $user_id";
                    $user_results = mysqli_query($dbconnect, $user_sql);
                    $user_details = mysqli_fetch_assoc($user_results);
                    $firstname = $user_details['firstname'];
                    $othernames = $user_details['othernames'];
                ?>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="single-new-trend mg-t-30">
                            <a href="#"><img src="img/new-product/5.png" alt="" ></a>
                            <div class="overlay-content">
                                <br />
                                <a href="#">
                                    <h1>President</h1>
                                </a>
                                <a href="#" class="btn-small"><?php echo $firstname . " " . $othernames; ?></a>
                                <br />

                                <a href="#">
                                    <h4><?php echo $firstname . " " . $othernames; ?></h4>
                                </a>
                                <div class="pro-rating">
                                    <input type="radio" name="president" id="president" value="<?php echo $candidates_id; ?>" style="width:30px; height:30px; cursor:pointer" />
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>

        </div>
    </div>
</div>

<!-- Vice President Section -->


<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="breadcomb-wp">
                                <div class="breadcomb-icon">
                                    <i class="icon nalika-new-file"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Vice President</h2>
                                    <p>
                                        Vote for your preferred Vice Presidantial Candidate
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="breadcomb-report">
                                <button data-toggle="tooltip" data-placement="left" title="Download Report" class="btn">
                                    <i class="icon nalika-download"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Candidates Area -->

<div class="product-new-list-area">
    <div class="container-fluid">
        <div class="row">
            <?php
            $sql = "SELECT * FROM candidates WHERE position_id = 2 AND election_id=1 ";
            $result = mysqli_query($dbconnect, $sql);
            $presidents = mysqli_fetch_all($result, MYSQLI_ASSOC);

            foreach ($presidents as $pres) {
                $user_id = $pres['user__id'];
                $candidates_id = $pres['user__id'];

                $user_sql = "SELECT * FROM user WHERE id= $user_id";
                $user_results = mysqli_query($dbconnect, $user_sql);
                $user_details = mysqli_fetch_assoc($user_results);
                $firstname = $user_details['firstname'];
                $othernames = $user_details['othernames'];
            ?>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="single-new-trend mg-t-30">
                        <a href="#"><img src="img/new-product/5.png" alt="" ></a>
                        <div class="overlay-content">
                            <br />
                            <a href="#">
                                <h1>Vice President</h1>
                            </a>
                            <a href="#" class="btn-small"><?php echo $firstname . " " . $othernames; ?></a>
                            <br />

                            <a href="#">
                                <h4><?php echo $firstname . " " . $othernames; ?></h4>
                            </a>
                            <div class="pro-rating">
                                <input type="radio" name="vicepresident" id="vicepresident" value="<?php echo $candidates_id; ?>" style="width:30px; height:30px; cursor:pointer" />
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>


        </div>
    </div>
    <div class="section-admin container-fluid res-mg-t-15" style="margin-top:15px;">
        <div class="row admin text-center">
            <div class="col-md-12">
                <div class="row">

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="admin-content analysis-progrebar-ctn res-mg-t-30">
                            <input type="submit" class="btn btn-custon-rounded-two btn-success" name="vote" value="Click To Cast Your Vote" id="vote" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php if (isset($success)) : echo $success;
endif; ?>
<?php if (isset($error)) : echo $error;
endif; ?>
</form>

<?php require("footer.php") ?>