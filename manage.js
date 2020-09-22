$(document).ready(function(){
    var DOMAIN= "http://localhost/inventory_system";

//---------------maange categories (manage_categories.php) starts-----------------------
manageCategories(1);

function manageCategories(pn){
    $.ajax({
        url:"http://localhost/inventory_system/includes/process.php",
        method:"POST",
        data:{manageCategories:1,pageno:pn},
        success:function(data){
            //alert(data);
            $("#get_category").html(data);
        }
    })//end of ajax
    }
    
    $("body").delegate(".page-link","click",function() {
        var pn=$(this).attr("pn");
      //  alert(pn);
        manageCategories(pn); 
    })//end of body delegate function.
    
//---------------manage categories (manage_categories.php) ends-----------------------
    
//---------------------------delete categories starts here-------------

$("body").delegate(".del_cat","click",function (){
   var did=$(this) .attr("did");
   if(confirm("Are You sure that you want to delete it?")){
     // alert("yes");

     $.ajax({
        url:"http://localhost/inventory_system/includes/process.php",
        method:"POST",
        data:{deleteCategories:1,id:did},
        success:function(data){
            //alert(data);
           if(data=="DEPENDENT_CATEGORY"){
               alert("You can't delet this category, as other subcategories are depend on this Parent Category.")
           }else if(data=="CATEGORY_DELETED"){
               alert("Category is deleted successfully");
               manageCategories(1);
           }else if(data=="ITEM_IS_DELETED"){
               alert("Item deleted Successfully");
           }else{
               alert(data);
               console.log(data);
           }
        }
    })//end of ajax

   }else{
    //alert("no");
   }
})

//---------------------------delete categories ends here-------------


//*****************------------edit categories start here-------------------*****************

//------------------------fetch get categories---dropdown starts here-----------
fetch_category();
function fetch_category(){
    
    $.ajax({
           url:"http://localhost/inventory_system/includes/process.php",
           method:"POST",
           data:{getCategory:1},
           success:function(data) {
           // alert(data);
            
               //following lines for updatecategorymodal.php page
               var choose_parent= "<option value=''>Choose Parent Category</option>";
               var root= "<option value='0'>Root</option>";
               $("#update_parent_cat").html(choose_parent+root+data);
                //following line for updateproductmodal.php pge
                var choose= "<option value=''>Choose Category</option>";
                $("#update_select_cat").html(choose+data);
           }
           })//end of ajax
    }//end of fetch_category() function

   
//------------------------fetch get categories---dropdown ends here-----------

//---------------------getSinglerecord starts here---------------------------
$("body").delegate(".edit_cat","click",function(){
   //alert("edit is clicked");
   var eid=$(this).attr("eid");
   //alert(eid);

   $.ajax({
        url:"http://localhost/inventory_system/includes/process.php",
        method:"POST",
        dataType:"json",//here we are going to fetch data in form(modal),so we use json datatype
        data:{getsingleCategory:1,id:eid},
        success:function(data){
            console.log(data);//here data is an json object
            console.log(data['category_name']);//cetegory_name is database col name
         //   alert(data['parent_cat']);//parent_cat is database col name
           $("#cid").val(data['cid']);
           $("#update_cat_name").val(data['category_name']);
           $("#update_parent_cat").val(data['parent_cat']);
        }

   })//end of ajax
})//end of delegate function
//---------------------getSinglerecord starts here-------------------------

//----------update category -update categorymodal start-------------------------
$("#form_update_category").on("submit",function () {
   // alert("ready to update data");
    if($("#update_cat_name").val()==''){
        $("#update_cat_name").addClass("border-danger");
        $("#cat_name_error").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>Please enter Category name<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
    }else{
        $.ajax({
            url:"http://localhost/inventory_system/includes/process.php",
            method:"POST",
            data:$("#form_update_category").serialize(),
            success:function(data){
                    // alert(data);
                    if(data="UPDATED_SUCCESSFULLY"){
                        $("#cat_add_success").html("<div class='alert alert-success alert-dismissible fade show' role='alert'>Category is upadated successfully ...!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
                       manageCategories(1);
                      //  window.location.href=" ";
                    }else{
                        $("#cat_add_success").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>Something went wrong ...!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
                    }
            }
       })//end of ajax
        
    } 
})

//----------update category-update categorymodal end-------------------------

//*************************edit categories ends here****************************************


//--------------------------------------manage brand (manage_brands.php)start here-----------------------------

manageBrands(1);

function manageBrands(pn){
    $.ajax({
        url:"http://localhost/inventory_system/includes/process.php",
        method:"POST",
        data:{manageBrands:1,pageno:pn},
        success:function(data){
            //alert(data);
            $("#get_brand").html(data);
        }
    })//end of ajax
    }
    
    $("body").delegate(".page-link","click",function() {
        var pn=$(this).attr("pn");
      //  alert(pn);
        manageBrands(pn); 
    })//end of body delegate function.
    
//--------------------------------------manage brand(manage_brands.php) end here-----------------------------

//--------------------------------------delete brand start----------------------

$("body").delegate(".del_brand","click",function () {
    var did=$(this).attr("did");
    //alert(did);
    if(confirm("Are You sure that you want to delete it?")){
        // alert("yes");
        $.ajax({
            url:"http://localhost/inventory_system/includes/process.php",
            method:"POST",
            data:{deleteBrand:1,id:did},
            success:function (data) {
                //alert(data);
                if(data="ITEM_IS_DELETED"){
                    alert("Brand is deleted Successfully...!")
                    manageBrands(1);
                }
            }

        })//end of ajax
    }else{
        // alert("no"); 
    }

})

//--------------------------------------delete brand ends----------------------

//******************************edit brand starts *******************************
//------------------------getsinglebrand starts here-------------------
$("body").delegate(".edit_brand","click",function(){
             var eid=$(this).attr("eid");
             //alert(eid);
    $.ajax({
            url:"http://localhost/inventory_system/includes/process.php",
            method:"POST",
            dataType:"json",
            data:{getsingleBrand:1,id:eid},
            success:function(data){
             //alert(data);  
             //    console.log(data);
             //   console.log(data["bid"]);
                
               $("#bid").val(data['bid']);
                $("#update_brand_name").val(data['brand_name']);
               }
     })//end of ajax

})
//------------------------getsinglebrand ends-------------------

//------------------------updatesinglebrand start-------------------
$("#form_update_brand").on("submit",function(){
   // alert("ready to update");
    $.ajax({
        url:"http://localhost/inventory_system/includes/process.php",
        method:"POST",
        data:$("#form_update_brand").serialize(),
        success:function(data){
           // alert(data);
           if(data=="BRAND_UPDATED_SUCCESSFULLY"){
               //alert("Brand updated successfully");
                $("#brand_add_success").html("<div class='alert alert-success alert-dismissible fade show' role='alert'>Brand is upadated successfully ...!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
                manageBrands(1); 
           }else{
               alert("something went wrong");
           }
        }
    })//end of ajax
})
//------------------------updatesinglebrand end-------------------
//******************************edit brand ends here *******************************


//------------------manage products(manage_products.php) start----------------------

manageProducts(1);
function manageProducts(pn){
  $.ajax({
    url:"http://localhost/inventory_system/includes/process.php",
    method:"post",
    data:{manageProducts:1,pageno:pn},
    success:function(data){
       // alert(data);
       $("#get_product").html(data);
    }
  })//end of ajax
}

$("body").delegate(".page-link","click",function(){
    var pn=$(this).attr("pn");
    manageProducts(pn);
})

//------------------manage products(manage_products.php) end----------------------
//-------------------------------------delete product start-----------------------------
$("body").delegate(".del_product","click",function () {
    var did=$(this).attr("did");
    //alert(did);
    if(confirm("Are you sure you want to delete this product?")){
       //  alert("yes");
     $.ajax({
        url:"http://localhost/inventory_system/includes/process.php",
        method:"POST",
        data:{deleteProduct:1,id:did},
        success:function(data){
            //alert(data);
            if(data=="ITEM_IS_DELETED"){
                alert("Product is deleted successfully...!")
                manageProducts(1);
            }else{
                alert("something went wrong");
            }
        }
     })//end of ajax


    }else{
     //alert("No");
    }
})

//-------------------------------------delete product end-----------------------------

//**************************edit product starts here****************************/

//--------------------getsingleproduct start here-------------------
//----------------fetch brands for (productmodal.php) page starts here-------------
fetch_brand();
function fetch_brand(){
    $.ajax({
        url:"http://localhost/inventory_system/includes/process.php",
        method:"POST",
        data:{getBrand:1},
        success:function(data){
          //  alert(data);
          var choose = "<option value=''>Choose Brand</option>"
          $("#update_select_brand").html(choose+data);
        }
    })//end of ajax
}//end of fetch_brand()

//----------------fetch brands for (productmodal.php) page ends here-------------

$("body").delegate(".edit_product","click",function () {
    var eid=$(this).attr("eid");
    //alert(eid);
    $.ajax({
        url:"http://localhost/inventory_system/includes/process.php",
        method:"POST",
        dataType:"json",
        data:{getsingleProduct:1,id:eid},
        success:function(data){
            //alert(data);
            console.log(data);
            $("#pid").val(data['pid']);
            $("#update_product_name").val(data['product_name']);
            $("#update_select_cat").val(data['cid']);
            $("#update_select_brand").val(data['bid']);
            $("#update_product_price").val(data['product_price']);
            $("#update_product_qty").val(data['product_stock']);
            
        }

    })//end of ajax
})
//--------------------getsingleproduct end here-------------------


//-------------------------------upadte product start-------------
$("#update_form_product").on("submit",function(){
    //alert("ready to update");
    $.ajax({
        url:"http://localhost/inventory_system/includes/process.php",
        method:"POST",
        data:$("#update_form_product").serialize(),
        success:function(data){
           // alert(data);
            //console.log(data);    
            if(data=="UPDATED"){
                $("#product_add_success").html("<div class='alert alert-success alert-dismissible fade show' role='alert'>Product is upadated successfully ...!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
                manageProducts(1);
            }   else{
                alert(data);
                console.log(data);    
            }
        }

    })//end of ajax

})

//-------------------------------upadte product end-------------

//**************************edit product endss here****************************/
})//end of document.ready function