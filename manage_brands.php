<?php

include_once("./database/constants.php");
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location:" . DOMAIN . "/index.php");
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

    <!------------------------------------manage brands starts--------------------------------------------------->
    <div class="container">
        <div class="row">
            <div class="col mx-auto">
                
                <table class=" table table-bordered table-hover" style="margin-top:2%;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="get_brand">
                   <!--
                       
                  <tr>
                    <th scope='row'>".++$n."</th>
                    <td>".$row['brand_name']."</td>
                    <td>
                        <a href='#' class='btn btn-success btn-sm'>Active</a>
                    </td>
                    <td>
                        <a href='#' class='btn btn-danger btn-sm del_brand' did=".$row['bid'].">Delete</a>
                        <a href='#' class='btn btn-primary btn-sm edit_brand' eid=".$row['bid']." data-toggle='modal' data-target='#updatebrandmodal'>Edit</a>
                    </td>
                    </tr>
                   -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-----------------------------------------manage brands ends--------------------------------------------------->

    <!-----------------------------bootstrap code starts here--------------------------------------------------------
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>----->
    <script src="jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <!-----------------------------bootstrap code ends here------------------------------------------------------------->
    <script type="text/javascript" src="manage.js"></script>


<!-- add update category Modal starts-->
<?php
include_once("templates/updatebrandmodal.php");
?>
<!-- add update category Modal starts-->

</body>

</html>

