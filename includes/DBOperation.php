<?php

class DBOperation{
    private $con;
    function __construct()
        {
            include_once("../database/db.php");
            $db=new Database();     
            $this->con=$db->connect();
    }//end of constructor

    public function addCategory($parent,$cat){
       $pre_stmt=$this->con->prepare("INSERT INTO `categories`(`parent_cat`, `category_name`, `status`) VALUES 
       (?,?,?)");
        $status=1;
        $pre_stmt->bind_param("isi",$parent,$cat,$status);
        $result= $pre_stmt->execute() or die($this->con->error);
        if($result){
            return "CATEGORY_ADDED";
        }else{
            return 0;
        }       
    }//end of addCategory() method--in database categories table-we have made category_name column- unique.

    public function getAllRecord($table){
        $pre_stmt=$this->con->prepare("SELECT * FROM $table");
        //$parent_cat_id=0;
        //$pre_stmt->bind_param("i",$parent_cat_id);
        $pre_stmt-> execute() or die($this->con->error);
        $result=$pre_stmt->get_result();
      
        if($result->num_rows>0){

            $rows=array();
            while($row=$result->fetch_assoc()){
              $rows[]=$row;
            }
            return $rows;
        }else{
            return 0;
        }

    }//end of getAllRecord() method

    public function addBrand($brand_name){
        $pre_stmt=$this->con->prepare("INSERT INTO `brands`(`brand_name`, `status`) VALUES (?,?)");
        $status=1;
        $pre_stmt->bind_param("si",$brand_name,$status);
        $result=$pre_stmt->execute() or die($this->con->error);
       if($result){
           return "BRAND_ADDED";
       }else{
           return 0;
       }
    }//end of addBrand() class--in database brands table-we have made brand_name column- unique.

    public function addProduct($cid,$bid,$product_name,$product_price,$product_qty,$added_date){
    $pre_stmt=$this->con->prepare("SET FOREIGN_KEY_CHECKS=0");
    $pre_stmt=$this->con->prepare("INSERT INTO `products`(`cid`, `bid`, `product_name`, `product_price`, `product_stock`, `added_date`, `p_status`)
     VALUES (?,?,?,?,?,?,?)");
     $status=1;
     $pre_stmt->bind_param("iisdisi",$cid,$bid,$product_name,$product_price,$product_qty,$added_date,$status);
     $result=$pre_stmt->execute() or die($this->con->error);
     if($result){
         return "NEW_PRODUCTS_ADDED";
     }else{
         return 0;
     }
}/*end of addproduct()---------productmodal.php---in database products table,
we have made pid-PRIMARY KEY
BID,CID-FOREIGN KEY,dont forget in relation view in database make it on DELETE-CASCADE AND ON UPDATE-CASCADE INSTEAD OF RESTRICT,OTHERWISE 
IT WILL THROUGH YOU AN #1452:CANT ADD OR UPDATE CHILD ROW: FOREIGN KEY CONSTRAINT ERROR.
we have made product_name colum UNIQUE in database */

}//end of class

//$db= new DBOperation();
//echo $db->addProduct(2,3,"BANDI",250,200,2020-07-22);
//echo $db->addCategory(3,"anti virus1");
//echo "<pre>";
//print_r($db->getAllRecord('categories'));

?>