<?php
    session_start();
    require("header.php");

    $firstname=$_SESSION['firstname'];
    $other_names=$_SESSION['othernames'];
?>    

<!-- Mobile Menu end
<div class="breadcome-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcome-list">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="breadcomb-wp">
                                    <div class="breadcomb-icon">
                                        <i class="icon nalika-home"></i>
                                    </div>
                                    <div class="breadcomb-ctn">
                                        <h2>Register to Vie</h2>
                                        <p>Welcome <?php echo $firstname;?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="breadcomb-report">
                                    <button data-toggle="tooltip" data-placement="left" title="Download Report" class="btn"><i class="icon nalika-download"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
     </div> -->
<?php require('footer.php')?>