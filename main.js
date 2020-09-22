$(document).ready(function(){
    var DOMAIN= "http://localhost/inventory_system";

//-----------------------------------user registration starts here---------------------------
   //alert("helllo world");
    //we are using jquery here,we are not using javascript
    $("#register_form").on("submit",function(){
    var name=$("#username");
    var email=$("#email");
    var password=$("#password");
    var re_pass=$("#re_pass");
    var usertype=$("#usertype");
   // name_pattern=new RegExp(/^[A-Za-z_- ]+$/);
    //krishu19.patel19@gmail.com
    email_pattern=new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);
    var status=false;

    if(name.val()=='' || name.val().length<4){
        $("#username_error").html("<span class='text-danger'>Please fill the Username & lenght should be minimum 4 characters.</span>");
        name.addClass("border-danger");
        status = false;
    }else{
        $("#username_error").html("");
        name.removeClass("border-danger");
        status = true;
    }

    if(!email_pattern.test(email.val())){
        $("#email_error").html("<span class='text-danger'>Please enter Valid Email Address.</span>");
        email.addClass("border-danger");
        status = false;
    }else{
        $("#email_error").html("");
        email.removeClass("border-danger");
        status = true;
    }

    if(password.val()=='' || password.val().length<8){
        $("#password_error").html("<span class='text-danger'>Please enter password & lenght should be minimum 8 characters .</span>");
        password.addClass("border-danger");
        status = false;
    }else{
        $("#password_error").html("");
        password.removeClass("border-danger");
        status = true;
    }

    if(re_pass.val()=='' || re_pass.val().length<8){
        $("#re_pass_error").html("<span class='text-danger'>Please Re-enter password & lenght should be minimum 8 characters .</span>");
        re_pass.addClass("border-danger");
        status = false;
    }else{
        $("#re_pass_error").html("");
        re_pass.removeClass("border-danger");
        status = true;
    }

    if(usertype.val()==''){
        $("#usertype_error").html("<span class='text-danger'>Please Choose Usertype.</span>");
        usertype.addClass("border-danger");
        status = false;
    }else{
        $("#usertype_error").html("");
        usertype.removeClass("border-danger");
        status = true;
    }


    if(password.val() == re_pass.val() && status==true){
        $(".overlay").html("<div class='d-flex justify-content-center'><div class='spinner-border text-primary' role='status'><span class='sr-only'>Loading...</span></div></div>");
        //write ajax method here....
        $.ajax({
            url:"http://localhost/inventory_system/includes/process.php",
            method:"POST",
            data:$("#register_form").serialize(),
            success:function(data){
              //  alert(data);
              if(data=="EMAIL_ALREADY_EXISTS"){
                   $(".overlay").html("");
                   alert("Email is already Exists...");
                  
              }else if(data=="SOME_ERROR"){
                   $(".overlay").html("");
                   alert("Something went wrong...");
                 
              }else{
                $(".overlay").html("");
                  window.location.href=encodeURI("index.php?msg=You are registered successfully.Please login to continue.");
              }
            }
        })//end of ajax method


    }else{

        $("#re_pass_error").html("<span class='text-danger'>Password is  not matched .</span>");
        re_pass.addClass("border-danger");
        status = false;

    }

})//end of register_form-onsubmit event-jquery on method
//---------------------------------end of user registration ----------------------------------------------

//----------------------------------login form starts here-------------------------------------------------/
$("#login_form").on("submit",function(){
      //  alert("login button clicked");
        var loginemail=$("#loginemail");
        var loginpass=$("#loginpass");
        var status=false;

if (loginemail.val()==''){
    
     $("#loginemail_error").html("<span class='text-danger'>Please enter valid Email</span>")
     loginemail.addClass("border-danger");
    
     status=false;
}else{
        $("#loginemail_error").html("")
        loginemail.removeClass("border-danger");
        status= true;
    }


    if (loginpass.val()=='' || loginpass.val().length<8){
    
        $("#loginpass_error").html("<span class='text-danger'>Please enter valid minimum 8 digit Password</span>")
        loginpass.addClass("border-danger");
        status=false;
   }else{
           $("#loginpass_error").html("")
           loginpass.removeClass("border-danger");
           status= true;
       }



if(status== true){
    $(".overlay").html("<div class='d-flex justify-content-center'><div class='spinner-border text-primary' role='status'><span class='sr-only'>Loading...</span></div></div>");
    $.ajax({
        
        url:"http://localhost/inventory_system/includes/process.php",
        method:"POST",
        data:$("#login_form").serialize(),
        success:function(data) {
          
            if(data=="LOGGED_IN_SUCCESSFULLY"){
                //  alert("LOGGED_IN_SUCCESSFULLY");
                $(".overlay").html("");
                window.location.href="dashboard.php";
            }else if(data=="PASSWORD_NOT_MATCH"){
                 // alert("PASSWORD_NOT_MATCH");  
               $(".signinerror").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'> Please enter correct password.<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>&times;</span></button></div>");
               $(".overlay").html("");
            }else if(data=="EMAIL_IS_NOT_REGISTERED_YET"){
                 // alert("EMAIL_IS_NOT_REGISTERED_YET");
                 $(".signinerror").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'> Email is not registered.<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>&times;</span></button></div>");
                 $(".overlay").html("");
            }else{
                 // alert(data); 
                 console.log(data);
                 $(".overlay").html("");
            }
        }


    })//end of ajax method
}//end of if-else statement

})//end of login_form-onsubmit event-jquery on method
//-------------------------------------login form ends here-------------------------------------/


//-----------------------fetch get parent category(categorymodal.php) & select category(productmodal.php) start here---------------------------------------------
function fetch_category(){
$.ajax({
       url:"http://localhost/inventory_system/includes/process.php",
       method:"POST",
       data:{getCategory:1},
       success:function(data) {
        //alert(data);
           //following lines for categorymodal.php page
           var choose_parent= "<option value=''>Choose Parent Category</option>";
           var root= "<option value='0'>Root</option>";
           $("#parent_cat").html(choose_parent+root+data);
           //following line for productmodal.php pge
           var choose= "<option value=''>Choose Category</option>";
           $("#select_cat").html(choose+data);
       }
       })//end of ajax
}//end of fetch_category() function
fetch_category();

//----------------------fetch- get parent category(categorymodal.php) &select category(productmodal.php) ends here---------------------------------------------

//------------------------add category start here(categorymodal.php)----------------------------
$("#form_category").on("submit",function(){
   
    if($("#cat_name").val()==''){
       //alert("cat name required");
       $("#cat_name").addClass("border-danger");
       $("#cat_name_error").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>Please add Category name..!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
     
    }else{
       
        $.ajax({
                 url: "http://localhost/inventory_system/includes/process.php",
                 method:"POST",
                 data:$("#form_category").serialize(),
                 success:function(data) {
                     //alert(data);
                     if(data=="CATEGORY_ADDED"){
                            $("#cat_name").removeClass("border-danger");
                            $("#cat_name").val("");
                            $("#parent_cat").val("");
                            $("#cat_name_error").html("");
                            $("#cat_add_success").html("<div class='alert alert-success alert-dismissible fade show' role='alert'>New Category is added successfully ...!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
                            fetch_category();
                     }else{
                          alert(data);
                          $("#cat_name").val("");
                          $("#parent_cat").val("");
                     }  
                 }
        })//end of ajax
    }
})
//------------------------add category ends here(categorymodal.php)-------------------------

//------------------------add brands start here(brandmodal.php)-------------------------
$("#form_brand").on("submit",function(){
    if($("#brand_name").val()==''){
        $("#brand_name").addClass("border-danger");
        $("#brand_name_error").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>Please enter Brand name<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
    }else{
        $.ajax({
            url:"http://localhost/inventory_system/includes/process.php",
            method:"POST",
            data:$("#form_brand").serialize(),
            success:function(data) {
               // alert(data);
               if(data=="BRAND_ADDED"){
                $("#brand_name").removeClass("border-danger");
                $("#brand_name").val("");
                $("#brand_name_error").html("");
                $("#brand_add_success").html("<div class='alert alert-success alert-dismissible fade show' role='alert'>New Brand is added successfully ...!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
                fetch_brand();
               }else{
                alert(data);
                $("#brand_name").val("");
               }
            }
        })//end of ajax
    }
})
//------------------------add brands ends here(brandmodal.php)-------------------------

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
          $("#select_brand").html(choose+data);
        }
    })//end of ajax
}//end of fetch_brand()


//----------------fetch brands for (productmodal.php) page ends here-------------

//--------------------insert products starts (productmodal.php)-------------------------
$("#form_product").on("submit",function(){
   // alert("product insertion called");
    $.ajax({
        url:"http://localhost/inventory_system/includes/process.php",
        method:"POST",
        data:$("#form_product").serialize(),
        success:function(data) {
       //  alert(data);
          if(data=="NEW_PRODUCTS_ADDED"){
            $("#product_add_success").html("<div class='alert alert-success alert-dismissible fade show' role='alert'>New Product is added successfully ...!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            $("#product_name").val("");
            $("#product_price").val("");
            $("#product_qty").val("");
            $("#select_cat").val("");
            $("#select_brand").val("");
           }else{
            alert(data);
            
            $("#product_name").val("");
            $("#product_price").val("");
            $("#product_qty").val("");
            $("#select_cat").val("");
            $("#select_brand").val("");

           }
        }
    })//end of ajax
})


//--------------------insert products ends (productmodal.php)-------------------------


})//end of document.ready function