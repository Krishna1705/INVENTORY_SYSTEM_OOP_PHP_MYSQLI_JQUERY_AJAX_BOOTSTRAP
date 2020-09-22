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

    <!------------------------------------registration form starts--------------------------------------------------->
    <br/>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>

            <div class="col-md-6">

                <div class="card mx-auto">
                    <div class="card-header">
                        <h4>User Registration Form</h4>
                    </div>
                    <div class="card-body">

                        <form id="register_form" onsubmit="return false" autocomplete="off">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Enter Usernme">
                                <small id="username_error" class="form-text text-muted"></small>
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email">
                                <small id="email_error" class="form-text text-muted"></small>
                            </div>

                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
                                <small id="password_error" class="form-text text-muted"></small>
                            </div>

                            <div class="form-group">
                                <label for="re_pass">Re-Enter Password:</label>
                                <input type="password" class="form-control" name="re_pass" id="re_pass" placeholder="Re-Enter Password">
                                <small id="re_pass_error" class="form-text text-muted"></small>
                            </div>

                            <div class="form-group">
                                <label for="usertype">UserType:</label>
                                <select class="form-control" name="usertype" id="usertype">
                                <option value="">Choose UserType</option>
                                    <option value="1">Admin</option>
                                    <option value="0">other</option>
                                </select>
                                <small id="usertype_error" class="form-text text-muted"></small>
                            </div>

                            <button type="submit" name="user_register" class="btn btn-primary"><i class="fas fa-user">&nbsp;</i>Register</button>
                            <span><a href="index.php">Login</a></span>
                            <div class="overlay"></div>
                        </form>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

    <!----------------------------------------registration form ends--------------------------------------------------->

    <!-----------------------------bootstrap code starts here------------------------------------------------------------
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>-------->
    <script src="jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <!-----------------------------bootstrap code ends here------------------------------------------------------------->
    <script type="text/javascript" src="main.js"></script>
</body>

</html>