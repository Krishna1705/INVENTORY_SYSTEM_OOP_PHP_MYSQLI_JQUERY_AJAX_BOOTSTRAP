<?php


class Manage{
    private $con;
    function __construct()
    {
        include_once("../database/db.php");
        $db=new Database();
        $this->con=$db->connect();
    }

    public function manageRecordWithPagination($table,$pno){

        /*here we are going to fetch the records from the db tables brands,categories and products.
        its easy to fetch the records from brands and products table,
        but categories is a recursive table (as there is foreign key constraint in this table),
        so we will consider this table as two tables and create two objects of the table,and we will join these 2 objects
        and then fetch data from it*/
        /*for more details about sql query: search it on google write sql join here and then visit https://www.geeksforgeeks.org/ link*/
//call pagination function which returns an array with pagination and limit according to current page as follows 

           $a= $this->pagination($this->con,$table,$pno,5);
            if($table=='categories'){
                $sql="SELECT p.category_name as category,c.category_name as parent,p.status,p.cid 
                FROM categories p LEFT JOIN categories c 
                ON p.parent_cat=c.cid ".$a["limit"];
                }elseif($table=='products'){
                  $sql="SELECT p.pid,p.product_name,c.category_name,b.brand_name,p.product_price,p.product_stock,p.added_date,p.p_status 
                  FROM products p, categories c, brands b WHERE p.bid=b.bid AND p.cid=c.cid ".$a["limit"];
                }
                else{
                  $sql="SELECT * FROM ".$table." ".$a["limit"];
                }
                $result=$this->con->query($sql) or die($this->con->error);

                $rows=array();//declares an array

                if($result->num_rows>0){
                   while($row=$result->fetch_assoc()){
                     $rows[]=$row;//store db result in this $rows[] array
                   }
                }

                return array("rows"=>$rows,"pagination"=>$a["pagination"]);
           
    }//end of manageRecordWithPagination

    private function pagination($con,$table,$pno,$n){
    //$totalRecords=1000;till now here we have declared total no of records,but now we are going to fetch it from database table as follows:
        $result=$con->query("SELECT * FROM ".$table);
        
        //echo "<pre>";
        //print_r($result);
        
        //$rowcount=mysqli_num_rows($result);
        $rowcount=$result->num_rows;
     //   echo "TOTAL NO OF RECORDS : ".$rowcount;
      //  echo "<BR>";
        
        //so now $rowcount=$totalRecords
        
        $pageno=$pno;//here $pageno means current page
        $numberOfRecordsPerPage=$n;//ex:10-number of record per page
        
        //$totalpages=$last
        
        //$last=ceil($totalRecords/$numberOfRecordsPerPage);//1000/10=100-no.of pages
        $last=ceil($rowcount/$numberOfRecordsPerPage);//here ['rows'] is a name of column which we have given in above $sql query.
      //  echo "TOTAL NO OF PAGES : ".$last;
        
        $pagination="<ul class='pagination'>";
        
          
          if($last!=1){
          
            //to show previous 
            if($pageno>1){
                $previous="";
                $previous=$pageno-1;
                $pagination=$pagination." <li class='page-item'><a class='page-link' pn='".$previous."' href='#'>Previous </a></li>";
               }//end of IF statement
             
            //to show the pages  before current page 
            //for($i=1;$i<$pageno;$i++){
                for($i=$pageno-5;$i<$pageno;$i++){
                    if($i>0){
                        $pagination = $pagination."<li class='page-item'><a class='page-link' pn='".$i."' href='#'>". $i ."&nbsp;&nbsp;</a></li>";      
                    }
              
            }  //end of for loop
        
           //to show the current page
            $pagination = $pagination."<li class='page-item'><a class='page-link' pn='".$pageno."' href='#' style='color:grey;'>". $pageno."&nbsp;&nbsp;</a></li>";  
        
           //to show remaining pages after current page
           
            for($i=$pageno+1;$i<=$last;$i++){
               
                $pagination=$pagination."<li class='page-item'><a class='page-link' pn='".$i."' href='#'> ". $i ."&nbsp;&nbsp;</a></li>";
                if($i>$pageno+4){
                    break;
                }
              }//end of if statement 
        
            //to show next
             if($pageno<$last){ 
                $next="";
                $next=$pageno+1;
                $pagination = $pagination."<li class='page-item'><a class='page-link' pn='".$next."' href='#'>Next</a></li></ul>";      
            }
        
           }//end of if statement--check $last
           //limit 0,10
           //limit 10,10
           //limit 20,10
           //limit 30,10
           //WE WILL FIRE AN QUERY TO LIMIT NO OF RECORDS PER PAGE AS FOLLOWS:
           $limit="LIMIT ".($pageno-1)*$numberOfRecordsPerPage.",".$numberOfRecordsPerPage;
          // return $pagination;--instead of only pagination,we will return an array which contain key value pair of pagination and limit as folllows:
         
          return ["pagination"=>$pagination,"limit"=>$limit];
        }//end of private pagination function



public function deleteRecord($table,$pk,$id){//here $pk is primary key(column name) of table from database
     if($table=='categories'){
        $pre_stmt=$this->con->prepare("SELECT ".$id." FROM categories WHERE parent_cat = ?");
        $pre_stmt->bind_param("i",$id);
        $pre_stmt->execute() or die($this->con->error);
        $result=$pre_stmt->get_result();

        if($result->num_rows>0){
          return "DEPENDENT_CATEGORY";
        }else{
         // return $table." IT CAN BE DELETE";
         $pre_stmt=$this->con->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
         $pre_stmt->bind_param("i",$id);
         $result=$pre_stmt->execute() or die($this->con->error);
         if($result){
           return ("CATEGORY_DELETED");
         }
        }
     }else{
       //return "other table can be deleted";
       $pre_stmt=$this->con->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
       $pre_stmt->bind_param("i",$id);
       $result=$pre_stmt->execute() or die($this->con->error);
       if($result){
         return ("ITEM_IS_DELETED");
       }

     }
}//end of deleteRecord()

public function getsingleRecord($table,$pk,$id){
$pre_stmt = $this->con->prepare("SELECT * FROM ".$table." WHERE ".$pk." = ?");
$pre_stmt->bind_param("i",$id);
$pre_stmt->execute() or die($this->con->error);
$result=$pre_stmt->get_result();
if($result->num_rows >0){
 //return "result fetched";
 $row=$result->fetch_assoc();
 return $row;
 
}else{
  return "something went wrong";
}
}//end of getsingleRecord()


public function updatecategory($table,$pk,$id,$parent_cat,$category_name,$status){
$pre_stmt=$this->con->prepare("UPDATE ".$table." SET parent_cat=?,category_name=?,status=? WHERE ".$pk." = ?");
$status=1;
$pre_stmt->bind_param("isii",$parent_cat,$category_name,$status,$id);
$result=$pre_stmt->execute() or die($this->con->error);
if($result){
  return "UPDATED_SUCCESSFULLY";
}else{
  return "something went wrong";
}

}//end  of updatecategory($table,$pk,$id,$parent_cat,$category_name,$status)

public function updatebrand($table,$pk,$id,$brand_name,$status){
  //UPDATE `brands` SET `bid`=[value-1],`brand_name`=[value-2],`status`=[value-3] WHERE 1
  $pre_stmt=$this->con->prepare("UPDATE ".$table." SET brand_name=?,status=? WHERE ".$pk." = ?");
  $status=1;
  $pre_stmt->bind_param("sii",$brand_name,$status,$id);
  $result=$pre_stmt->execute() or die($this->con->error);
  if($result){
    return "BRAND_UPDATED_SUCCESSFULLY";
  }else{
    return "something went wrong";
  }
  
  }//end of updatebrand

public function updateProduct($table,$pk,$id,$cid,$bid,$product_name,$product_price,$product_stock,$added_date,$status){
    /*$sql="UPDATE `products` SET 
    `pid`=[value-1],`cid`=[value-2],`bid`=[value-3],`product_name`=[value-4],
    `product_price`=[value-5],`product_stock`=[value-6],`added_date`=[value-7],
    `p_status`=[value-8] WHERE 1";*/
    $pre_stmt=$this->con->prepare("UPDATE ".$table." SET `cid`=?,`bid`=?,`product_name`=?,
    `product_price`=?,`product_stock`=?,`added_date`=?,
    `p_status`=? WHERE ".$pk." =?");
    $status=1;
    $pre_stmt->bind_param("iisdisii",$cid,$bid,$product_name,$product_price,$product_stock,$added_date,$status,$id);
    $result=$pre_stmt->execute() or die($this->con->error);
    if($result){
      return "UPDATED";
    }else{
      return "SOMETHING_WRONG";
    }
}//END OF updateProduct($table,$pk,$id,$cid,$bid,$product_name,$product_price,$product_stock,$added_date,$status)

//order processing customer-invoice storage
public function storeCustomerInvoice( $customer_name, $order_date,$arr_tqty, $arr_qty,
$arr_price,$arr_pro_name,$sub_total, $gst,$discount,$net_total,$paid,$due,$payment_type){
 
  $pre_stmt=$this->con->prepare("INSERT INTO `invoice`(`customer_name`, `order_date`, `sub_total`, 
  `gst`, `discount`, `net_total`, `paid`, `due`, `payment_type`) 
  VALUES (?,?,?,?,?,?,?,?,?)");
  $pre_stmt->bind_param("ssdddddds",$customer_name, $order_date,$sub_total, $gst,$discount,
  $net_total,$paid,$due,$payment_type);

  $pre_stmt->execute() or die($this->con->error);
 
  $invoice_no=$pre_stmt->insert_id;//return last id of table from database

  if($invoice_no != null){
    for($i=0; $i<count($arr_price); $i++){
      //here we are finding remaining quantity of products after giving it to the customers.
      $remain_qty=$arr_tqty[$i]-$arr_qty[$i];
     
      if($remain_qty<0){
         return "ORDER_FAIL_TO_COMPLETE";
      }else{
        //update product
        $sql="UPDATE products SET product_stock= '$remain_qty' WHERE product_name='$arr_pro_name[$i]'";
        $this->con->query($sql);

      }

      $insert_product=$this->con->prepare("INSERT INTO `invoice_details`(`invoice_no`, `product_name`, `price`, `qty`)
       VALUES (?,?,?,?)");
       $insert_product->bind_param("isdi",$invoice_no,$arr_pro_name[$i],$arr_price[$i],$arr_qty[$i]);
       $insert_product->execute() or die($this->con->error);
    }
    //return "ORDER_COMPLETED";
    return $invoice_no;
  }

}//end of storeCustomerInvoice() function

}//end of class Manage


//$obj=new manage();
//echo "<pre>";
//print_r($obj->manageRecordWithPagination("categories",1));
//echo $obj->deleteRecord("products",'pid',84);

//print_r($obj->getsingleRecord("categories",'cid',1)) ;
//echo $obj->updatecategory("categories",'cid',53,0,"Photoshop design software",1);
//echo $obj->updatebrand("brands",'bid',11,"lgggggggggggg",1);
//echo $obj->updateProduct($table,$pk,$id,$cid,$bid,$product_name,$product_price,$product_stock,$added_date,$status);
//echo $obj->updateProduct("products","pid",103,49,12,"woman black gagara",1000,50,"2020-08-02",1);