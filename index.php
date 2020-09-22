<?php
include_once("./database/constants.php");
session_start();
if(isset($_SESSION['userid'])){
header("Location:".DOMAIN."/dashboard.php");
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

<!------------------------------------login starts--------------------------------------------------->
<br/>
<div class="container">

<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
<?php
     if(isset($_GET['msg']) && !empty($_GET['msg'])){
?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
 <?php echo $_GET['msg']; ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<?php
    }
?>
<div class="signinerror"></div>
    <div class="card mx-auto" style="width: 100%;">
        <img src="images/login_icon.png" class="card-img-top mx-auto img-fluid" style="width:auto;" alt="Login Icon">
            <div class="card-body mx-auto" style="width:100%;">
                <h5 class="card-title">User Login</h5>
            
                <form id="login_form" onsubmit="return false">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="loginemail" name="loginemail">
                            <small id="loginemail_error" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="loginpass" name="loginpass">
                            <small id="loginpass_error" class="form-text text-muted"></small>
                        </div>
                    
                 
                   <button type="submit" class="btn btn-primary"><i class="fas fa-lock">&nbsp;</i>Login</button>  
                 
                   <button type="submit" class="btn btn-primary"> <a href="register.php" style="color:white;"><i class="fas fa-user-plus">&nbsp;</i>Register</a></button>
                   <div class="overlay"></div>
                </form>
            
            </div>
            <div class="card-footer">
                <a href="#">Forget Password?</a>
            </div>
        </div>



    </div>
    <div class="col-md-4"></div>
</div>
      


</div>

<!---------------------------------------login ends--------------------------------------------------->

<!-----------------------------bootstrap code starts here--------------------------------------------------------
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>----->
<script src="jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<!-----------------------------bootstrap code ends here------------------------------------------------------------->
    <script type="text/javascript" src="main.js"></script>
</body>
</html>