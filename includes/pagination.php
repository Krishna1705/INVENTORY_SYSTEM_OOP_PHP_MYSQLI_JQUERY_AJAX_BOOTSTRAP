<?php

 $con=mysqli_connect("localhost","root","","testpagination");

function pagination($con,$table,$pno,$n){
//$totalRecords=1000;till now here we have declared total no of records,but now we are going to fetch it from database table as follows:
$result=$con->query("SELECT * FROM ".$table);

//echo "<pre>";
//print_r($result);

//$rowcount=mysqli_num_rows($result);
$rowcount=$result->num_rows;
echo "TOTAL NO OF RECORDS... : ".$rowcount;
echo "<BR>";


//now $rowcount is a result which contains an number of of rows from the database table
//so now $rowcount=$totalRecords

$pageno=$pno;//here $pageno means current page
$numberOfRecordsPerPage=$n;//ex:10

//$totalpages=$last

//$last=ceil($totalRecords/$numberOfRecordsPerPage);//1000/10=100-no.of pages
$last=ceil($rowcount/$numberOfRecordsPerPage);//here ['rows'] is a name of column which we have given in above $sql query.
echo "TOTAL NO OF PAGES : ".$last;

$pagination="";

  
  if($last!=1){
  
    //to show previous 
    if($pageno>1){
        $previous="";
        $previous=$pageno-1;
        $pagination=$pagination."<a href='pagination.php?pageno=".$previous."'>Previous </a>";
       }//end of IF statement
     
    //to show the pages  before current page 
    //for($i=1;$i<$pageno;$i++){
        for($i=$pageno-5;$i<$pageno;$i++){
            if($i>0){
                $pagination = $pagination."<a href='pagination.php?pageno=".$i."'>". $i ."&nbsp;&nbsp;</a>";      
            }
      
    }  //end of for loop

   //to show the current page
    $pagination = $pagination."<a href='pagination.php?pageno=".$pageno."' style='color:grey;'>". $pageno."&nbsp;&nbsp;</a>";  

   //to show remaining pages after current page
   
    for($i=$pageno+1;$i<=$last;$i++){
       
        $pagination=$pagination."<a href='pagination.php?pageno=".$i."'> ". $i ."&nbsp;&nbsp;</a>";
        if($i>$pageno+4){
            break;
        }
      }//end of if statement 

    //to show next
     if($pageno<$last){ 
        $next="";
        $next=$pageno+1;
        $pagination = $pagination."<a href='pagination.php?pageno=".$next."'>Next</a>";      
    }

   }//end of if statement--check $last
   //limit 0,10
   //limit 10,10
   //limit 20,10
   //limit 30,10
   //WE WILL FIRE AN QUERY TO LIMIT NO OF RECORDS PER PAGE AS FOLLOWS:
   $limit="LIMIT ".($pageno-1)*$numberOfRecordsPerPage.",".$numberOfRecordsPerPage;
  // return $pagination;--instead of onl pagination,we will return an array which contain key value pair of pagination and limit as folllows:
 
  return ["pagination"=>$pagination,"limit"=>$limit];
}//end of pagination function



if(isset($_GET['pageno'])){
    $pageno=$_GET['pageno'];
   
    $table="paragraph";
    //echo pagination($con,"xxx",$pageno,10);
   // echo "<pre>";
   // print_r(pagination($con,"xxx",$pageno,10));

   $array=pagination($con,$table,$pageno,10);

  $result=$con->query("SELECT * FROM ".$table." ".$array["limit"]);

if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        echo "<div style='margin:0 auto; font-size:20px;'><b>".$row['id']."</b> &nbsp;". $row['content']." </div>";
      }//end of while
}
  
   echo "<div style='font-size:20px;'>".$array['pagination']."</div>";
}

?>