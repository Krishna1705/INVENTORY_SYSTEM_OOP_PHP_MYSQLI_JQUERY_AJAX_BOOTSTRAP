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

    <!------------------------------------new_order starts--------------------------------------------------->
<br/>
<div class="container">
<div class="row">
    <div class="col-md-12 mx-auto">
            <div class="card"  style="box-shadow: 0 0 25px 0 lightgrey;">
                <h3 class="card-header">New Order</h3>
                <div class="card-body">
              <!--error-->
              <div id="error">

              </div>
                
                  <form action="" onsubmit="return false" id="get_order_data">
                      <div class="form-group row">
                          <label for="order_date" class="col-sm-3" align="right">Order Date</label>
                          <div class="col-sm-6">
                             <input type="text" class="form-control" id="order_date" name="order_date" value="<?php echo date("Y-m-d") ?>" readonly>
                          </div>   
                      </div>

                      <div class="form-group row">
                          <label for="customer_name" class="col-sm-3" align="right">Customer Name* </label>
                          <div class="col-sm-6">
                             <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter Customer Name" required>
                          </div>   
                      </div>

                      <div class="card" style="box-shadow: 0 0 10px 0 lightgrey;">
                          <div class="card-body">
                              <h3>Make an Order List</h3>
                              <table align="center" class="table table-bordered table-hovered" >
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>Item Name</th>
                                          <th>Total Quantity</th>
                                          <th>Quantity</th> 
                                          <th>Price</th>
                                          <th>Total</th>
                                      </tr>
                                  </thead>
                                  <tbody id="invoice_item">
                                    <!--<tr>
                                          <td><b id="number">1</b></td>
                                          <td>
                                              <select name="pid[]" id="pid" class="form-control" required>
                                                  <option value="">Washing Machine</option>
                                              </select>
                                          </td>
                                          <td>
                                             <input type="text" name="tqty[]" id="tqty" class="form-control" readonly>
                                          </td>
                                          <td>
                                             <input type="text" name="qty[]" id="qty" class="form-control" required>
                                          </td>
                                          <td>
                                             <input type="text" name="price[]" id="price" class="form-control" readonly>
                                          </td>
                                          <td>Rs.1540</td>
                                      </tr>-->

                                  </tbody>
                              </table>
                              <center>
                                  <button class="btn btn-success" id="add">Add</button>
                                  <button class="btn btn-danger" id="remove">Remove</button>
                              </center>
                          </div><!--card-body ends -->
                      </div><!--make order list card ends here-->
                      
                      <p></p>
                      <div class="form-group row">
                        <label for="sub_total" class="col-sm-3" align="right"> Sub Total </label>
                        <div class="col-sm-6">
                            <input type="text" name="sub_total" id="sub_total" class="form-control" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="gst" class="col-sm-3" align="right">GST (18%) </label>
                        <div class="col-sm-6">
                            <input type="text" name="gst" id="gst" class="form-control" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="discount" class="col-sm-3" align="right"> Discount </label>
                        <div class="col-sm-6">
                            <input type="text" name="discount" id="discount" class="form-control" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="net_total" class="col-sm-3" align="right"> Net Total </label>
                        <div class="col-sm-6">
                            <input type="text" name="net_total" id="net_total" class="form-control" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="paid" class="col-sm-3" align="right"> Paid </label>
                        <div class="col-sm-6">
                            <input type="text" name="paid" id="paid" class="form-control" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="due" class="col-sm-3" align="right"> Due </label>
                        <div class="col-sm-6">
                            <input type="text" name="due" id="due" class="form-control" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="payment_type" class="col-sm-3" align="right"> Payment Method </label>
                        <div class="col-sm-6">
                            <select name="payment_type" id="payment_type" class="form-control" required>
                                <option value="">Choose Payment method</option>
                                <option value="cash">Cash</option>
                                <option value="card">Card</option>
                                <option value="draft">Draft</option>
                                <option value="cheque">Cheque</option>
                            </select>
                        </div>
                      </div>

                      <center>
                          <input type="submit" class="btn btn-info" id="order_form" value="Order">
                          <input type="submit" class="btn btn-success d-none" id="print_invoice" value="Print Invoice">
                      </center>

                  </form>
                
                </div>
           </div>
    </div>
  
</div>

<br>
</div>




    <!-----------------------------------------new_order ends--------------------------------------------------->

    <!-----------------------------bootstrap code starts here--------------------------------------------------------
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>----->
    <script src="jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <!-----------------------------bootstrap code ends here------------------------------------------------------------->
    <script type="text/javascript" src="order.js"></script>

</body>

</html>