<?php

include_once("./database/constants.php");
session_start();
if(!isset($_SESSION['userid'])){
header("Location:".DOMAIN."/index.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/398f0fd0dc.js" crossorigin="anonymous"></script>
    

</head>

<body>

    <!-----------------------------------------------------------------navbar starts --------------------------------------->
    <?php
    include_once("./templates/navbar.php");
    ?>
    <!-----------------------------------------------------------------navbar ends --------------------------------------->

    <!------------------------------------dashboard starts--------------------------------------------------->
    <br />
    <!-----------------------------------first container start----------------->
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card" style="width:100%;">
                    <img src="images/login_icon.png" class="card-img-top mx-auto img-fluid" style="width:auto;" alt="Login Icon">
                    <div class="card-body mx-auto" style="width:100%;">
                        <h5 class="card-title">User Profile</h5>
                        <p class="card-text"><i class="fas fa-user">&nbsp;</i> 
                                <?php
                                if(isset($_SESSION['username'])){
                                    echo $_SESSION['username'];   
                                }
                                ?>
                        </p>
                        <p class="card-text"><i class="fas fa-user">&nbsp; </i>Admin</p>
                        <p class="card-text"><i class="far fa-calendar-alt">&nbsp; </i>Last Login: <?php echo date("Y-m-d");?></p>

                        <!--<a href="#" class="btn btn-primary"><i class="fas fa-edit">&nbsp;</i>Edit Profile</a>-->
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="jumbotron" style="width:100%; height:100%;">
               
                <h2>
                Hello 
                <?php
                if(isset($_SESSION['username'])){
                    echo $_SESSION['username'];   
                }
                ?>,
                </h2>
                    <div class="row">
                        <div class="col-sm-6">
                            <iframe src="http://free.timeanddate.com/clock/i7d7ufib/n108/szw210/szh210/hoc009/hbw0/hfc9ff/cf100/hnc0f9/hwc000/fan2/fas16/fac555/fdi60/mqcf0f/mqs4/mql2/mqw4/mqd78/mhcf90/mhs4/mhl3/mhw4/mhd78/mmv0/hhc990/hhs2/hmc990/hms2/hscf09" frameborder="0" width="210" height="210"></iframe>
                        </div>

                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">New Orders</h5>
                                    <p class="card-text">Here you can make Invoices and create new orders.</p>
                                    <a href="new_order.php" class="btn btn-primary">New Order</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-----------------------------------first container ends----------------->
    <br/>
    <!-----------------------------------second container start----------------->
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Categories</h5>
                        <p class="card-text">Here you can manage Categories and you can add new parent and sub categories.</p>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#categorymodal">Add </a>
                        <a href="manage_categories.php" class="btn btn-primary">Manage </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Brands</h5>
                        <p class="card-text">Here you can manage your brands and create new brands.</p>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#brandmodal">Add </a>
                        <a href="manage_brands.php" class="btn btn-primary">Manage </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Products</h5>
                        <p class="card-text">Here you can manage your productss and create new products.</p>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#productmodal">Add </a>
                        <a href="manage_products.php" class="btn btn-primary">Manage </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-----------------------------------second container ends----------------->
<br>



    <!-----------------------------------------dashboard ends--------------------------------------------------->

    <!-----------------------------bootstrap code starts here--------------------------------------------------------
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>----->
    <script src="jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <!-----------------------------bootstrap code ends here------------------------------------------------------------->
    <script type="text/javascript" src="main.js"></script>

<!-- add category Modal starts-->
<?php
include_once("templates/categorymodal.php");
?>
<!-- add category Modal starts-->


<!-- add brand Modal starts-->
<?php
include_once("templates/brandmodal.php");
?>
<!-- add brand Modal starts-->


<!-- add product Modal starts-->
<?php
include_once("templates/productmodal.php");
?>
<!-- add product Modal starts-->




</body>

</html>