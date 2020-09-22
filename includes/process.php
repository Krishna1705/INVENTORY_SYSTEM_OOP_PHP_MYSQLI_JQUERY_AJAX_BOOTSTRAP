<?php

//echo "yes we are ready to get user registration data";
include_once("../database/constants.php");
include_once("user.php");
include_once("DBOperation.php");
include_once("manage.php");
//------------------USER REGISTRATION DATA------------
if(isset($_POST['username']) && isset($_POST['email'])){
    $user =new User();
    $result=$user->createUserAccount($_POST['username'],$_POST['email'],$_POST['password'],$_POST['usertype']);
    echo $result;
    exit();
}


//----------------User login Data-----------------------
//echo "we are ready to get login data";
if(isset($_POST['loginemail']) && isset($_POST['loginpass'])){
    $user= new User();
    $result=$user->userLogin($_POST['loginemail'],$_POST['loginpass']);
    echo $result;
    exit();
}

//---------------------getCategory data------------------------------
if(isset($_POST['getCategory'])){
  $dbo= new DBOperation();
  // print_r($dbo->getAllRecord('categories')) ;
  $rows=$dbo->getAllRecord('categories');

  foreach($rows as $row){
  echo  "<option value=".$row['cid'].">".$row['category_name']."</option>";
  }
  exit();
}


//------------------------add category data-------------------------------
if(isset($_POST['cat_name']) && isset($_POST['parent_cat'])){
  $dbo=new DBOperation();
  $result=$dbo->addCategory($_POST['parent_cat'],$_POST['cat_name']);
  echo $result;
  exit();
}
//----------------------------add brand data---------------------------
if(isset($_POST['brand_name'])){
  $dbo=new DBOperation();
  $result=$dbo->addBrand($_POST['brand_name']);
  echo $result;
  exit();
}

//------------------fetch brand--productmodal.php----------------------
if(isset($_POST['getBrand'])){
 $dbo=new DBOperation();
 $rows= $dbo->getAllRecord('brands');

  foreach($rows as $row){
    echo "<option value=".$row['bid'].">".$row['brand_name']."</option>";
  }
exit();
}

//--------------insert products-productmodal.php-------------------------

if(isset($_POST['added_date']) && isset($_POST['product_name'])){
  $dbo=new DBOperation();
  //$result=$dbo->addProduct($cid,$bid,$product_name,$product_price,$product_qty,$date);
  $result=$dbo->addProduct($_POST['select_cat'],$_POST['select_brand'],$_POST['product_name'],$_POST['product_price'],$_POST['product_qty'],$_POST['added_date']);
  echo $result;
  exit();
}

//--------------------------manage categories(manage_categories.php)----------------
if(isset($_POST['manageCategories'])){
$obj=new Manage();
$result=$obj->manageRecordWithPagination("categories",$_POST["pageno"]);//this function returns : array("rows"=>$rows,"pagination"=>$a["pagination"]);
$rows=$result["rows"];
$pagination=$result["pagination"];

if(count($rows)>0){
  //$n=0;
  $n=($_POST["pageno"]*5)-5;
   foreach($rows as $row){
     echo"
            
                <tr>
                  <th scope='row'>".++$n."</th>
                  <td>".$row['category']."</td>
                  <td>".$row['parent']."</td>
                  <td>
                      <a href='#' class='btn btn-success btn-sm'>Active</a>
                  </td>
                  <td>
                      <a href='#' class='btn btn-danger btn-sm del_cat' did=".$row['cid'].">Delete</a>
                      <a href='#' class='btn btn-primary btn-sm edit_cat' eid=".$row['cid']." data-toggle='modal' data-target='#updatecategorymodal'>Edit</a>
                  </td>
                  </tr>
        ";
       }
     echo "<tr><td colspan='5'>".$pagination." </td></tr>";
       exit();
   }

  
}//end of manage categories

//-----------------------------------delete categories----------------
if(isset($_POST['deleteCategories'])){
  $obj=new Manage();
  $result=$obj->deleteRecord("categories","cid",$_POST['id']);
  echo $result;
  exit();
}

//********************update categories start-************************
//-----------------getsinglerecordcategory start -----------------------
if(isset($_POST['getsingleCategory'])){
  $obj=new manage();
  $result=$obj->getsingleRecord("categories",'cid',$_POST['id']);//return result in form of array
  //now we want this array into our javascript(manage.js) so we will encode above result(array) into json format
  echo json_encode($result);//which will return us an object.
  exit();
}
//-----------------getsinglerecordcategory end-----------------------
//-------------------------update single category start------------------
if(isset($_POST['update_cat_name']) && isset($_POST['update_parent_cat'])){
  $obj=new manage();
  $result=$obj->updatecategory("categories",'cid',$_POST['cid'],$_POST['update_parent_cat'],$_POST['update_cat_name'],1);
  echo $result;
  exit();
}

//-------------------------update single category end------------------
//********************update categories ends-************************


//--------------------------manage brands(manage_brands.php)----------------
if(isset($_POST['manageBrands'])){
  $obj=new Manage();
  $result=$obj->manageRecordWithPagination("brands",$_POST["pageno"]);//this function returns : array("rows"=>$rows,"pagination"=>$a["pagination"]);
  $rows=$result["rows"];
  $pagination=$result["pagination"];
  
  if(count($rows)>0){
    //$n=0;
    $n=($_POST["pageno"]*5)-5;
     foreach($rows as $row){
       echo"
              
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
          ";
         }
       echo "<tr><td colspan='5'>".$pagination." </td></tr>";
         exit();
     }
  
    
  }//end of manage brands

  //-------------------------------delete brand start--------------------------------------
  if(isset($_POST['deleteBrand'])){
    $obj=new Manage();
    $result=$obj->deleteRecord("brands",'bid',$_POST['id']);
    echo $result;
    exit();
  }
  //-------------------------------delete brand ends--------------------------------------

  //-------------------------------**************edit brand start*****************--------------------------------------
  //------------------------getsinglebrand start-------------------
  if(isset($_POST['getsingleBrand'])){
    $obj=new Manage();
    $result= $obj->getsingleRecord("brands",'bid',$_POST['id']);
    echo json_encode($result);
    exit();
  }
  //------------------------getsinglebrand ends-------------------

  //------------------------updatesinglebrand start-------------------
if(isset($_POST['update_brand_name'])){
  //echo "ready to process";
  $obj=new manage();
  //echo $obj->updatebrand("brands",'bid',11,"lgggggggggggg",1);
  $result= $obj->updatebrand("brands",'bid',$_POST['bid'],$_POST['update_brand_name'],1);
  echo $result;
  exit();
}
  //------------------------updatesinglebrand end-------------------

  //-----------------***************************edit brand ends**********************--------------------------------------

//---------------------manage product(manage_products.php) start-------------------------
if(isset($_POST['manageProducts'])){
  $obj= new Manage();
  $result=$obj->manageRecordWithPagination("products",$_POST['pageno']);// return array("rows"=>$rows,"pagination"=>$a["pagination"]);
  $rows=$result["rows"];
  $pagination=$result["pagination"];
//$n=0;
$n=($_POST["pageno"]*5)-5;
  foreach ($rows as $row) {
  echo"  <tr>
                            <th scope='row'>".++$n."</th>
                            <td>".$row['product_name']."</td>
                            <td>".$row['category_name']."</td>
                            <td>".$row['brand_name']."</td>
                            <td>".$row['product_price']."</td>
                            <td>".$row['product_stock']."</td>
                            <td>".$row['added_date']."</td>
                            <td>
                                <a href='#' class='btn btn-success btn-sm'>Active</a>
                            </td>
                            <td>
                                <a href='#' class='btn btn-danger btn-sm del_product' did='".$row['pid']."'>Delete</a>
                                <a href='#' class='btn btn-primary btn-sm edit_product' eid='".$row['pid']."' data-toggle='modal' data-target='#updateproductmodal'>Edit</a>
                            </td>
                        </tr>";
  }
  echo "<tr><td colspan='9'>".$pagination." </td></tr>";
         exit();
}//end of  manage product(manage_products.php) 

//-------------------------------------delete product start-----------------------------
if(isset($_POST['deleteProduct'])){
  $obj=new Manage();
  $result= $obj->deleteRecord("products","pid",$_POST['id']);
  echo $result;
}
//**************************edit product starts here****************************/
if(isset($_POST['getsingleProduct'])){
  $obj=new Manage();
  $result= $obj->getsingleRecord("products","pid",$_POST['id']);
  echo json_encode($result);//array to string conversion,bcoz we want this array from php to javascript 
  exit();
}

if(isset($_POST['update_added_date']) && isset($_POST['update_product_name'])){
  $obj=new Manage();
  //echo $obj->updateProduct($table,$pk,$id,$cid,$bid,$product_name,$product_price,$product_stock,$added_date,$status);
  $result= $obj->updateProduct("products","pid",$_POST['pid'],$_POST['update_select_cat'],$_POST['update_select_brand'],
  $_POST['update_product_name'],$_POST['update_product_price'],$_POST['update_product_qty'],$_POST['update_added_date'],1);
  echo $result;
  exit();
}
//**************************edit product endss here****************************/

//------------------------------order processing-------------------------------------
if(isset($_POST['getNewOrderItem'])){
  $obj=new DBOperation();
  $rows=$obj->getAllRecord("products");
?>
            <tr>
                <td><b class='number'>1</b></td>

                <td>
                    <select name='pid[]' class='form-control pid' required>
                      <option value="">Choose Product</option>
                      <?php
                          foreach($rows as $row){
                      ?>
                            
                               <option value='<?php echo $row['pid']; ?>'><?php echo $row['product_name']; ?></option>
                     <?php
                          }
                      ?>
                    </select>
                </td>
              
                <td>
                  <input type='text' name='tqty[]' class='form-control tqty' readonly>
                </td>
                <td>
                  <input type='text' name='qty[]'  class='form-control qty' required>
                </td>
                <td>
                  <input type='text' name='price[]'  class='form-control price' value='' readonly>
                </td>
                
                <td>Rs.<span class="amt">0</span></td>
                
             <td>
                <input type='hidden' name='pro_name[]'  class='form-control pro_name' value='' readonly>
             </td>     
                
            </tr>
  
<?php
exit();
}//end of (isset($_POST['getNewOrderItem']))

//************get price and qty of one product
if(isset($_POST['getPriceAndQty'])){

  $obj=new Manage();
  $result=$obj->getsingleRecord("products",'pid',$_POST['id']);
  echo json_encode($result);//remember when you are working with json data then in js file u must define datatype as json,
                            //otherwise it will not work and gives you undefined data.
  exit();
}//end of isset($_POST['getPriceAndQty']))

//***********ORDER accepting************ */
if(isset($_POST['order_date']) AND isset($_POST['customer_name'])) 
{
  $order_date=$_POST['order_date'];
  $customer_name=$_POST['customer_name'];

  //now getting array data from order_form
  $arr_tqty=$_POST['tqty'];
  $arr_qty=$_POST['qty'];
  $arr_price=$_POST['price'];
  $arr_pro_name=$_POST['pro_name'];

  $sub_total=$_POST['sub_total'];
  $gst=$_POST['gst'];
  $discount=$_POST['discount'];
  $net_total=$_POST['net_total'];
  $paid=$_POST['paid'];
  $due=$_POST['due'];
  $payment_type=$_POST['payment_type'];

  $obj=new Manage();
  $result= $obj->storeCustomerInvoice( $customer_name, $order_date,$arr_tqty, $arr_qty,
                     $arr_price,$arr_pro_name,$sub_total, $gst,$discount,$net_total,$paid,$due,$payment_type);

  echo $result;
}
?>