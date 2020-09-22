$(document).ready(function(){
//alert("hello");
var DOMAIN="http://localhost/inventory_system";

addNewRow();

function addNewRow(){
   $.ajax({
          url:"http://localhost/inventory_system/includes/process.php",
          method:"POST",
          data:{getNewOrderItem:1},
          success:function(data){
              //alert(data);
              $("#invoice_item").append(data);

              //following code to ive number to the products
              var n=0;
              $(".number").each(function() {
                  $(this).html(++n);
              })
          }
   })//end of ajax
}//end of addnewrow() function

$("#add").click(function() {
    addNewRow();
    calculate(0,0);
})

$("#remove").click(function() {
    $("#invoice_item").children("tr:last").remove();
    calculate(0,0);
})

$("#invoice_item").delegate(".pid","change",function() {
    var pid=$(this).val();
    // alert(pid);
    var tr=$(this).parent().parent();//this means class pid and its parent is td and again its parent is tr

    $.ajax({
        url:"http://localhost/inventory_system/includes/process.php",
        method:"POST",
        dataType:"json",
        data:{getPriceAndQty:1,id:pid},
        success:function(data){
            console.log(data);
            console.log(data["product_stock"]);
            console.log(data["product_price"]);

            tr.find(".tqty").val(data["product_stock"]);
            tr.find(".pro_name").val(data["product_name"]);//it is hidden so we cant see it on page
            tr.find(".qty").val(1);
            tr.find(".price").val(data["product_price"]);
            tr.find(".amt").html( tr.find(".qty").val() * tr.find(".price").val());
            calculate(0,0);

        }
    })//end of ajax
})

//counting total amount of the product as per its quantity.

$("#invoice_item").delegate(".qty","keyup",function(){
    var qty=$(this);
    var tr=$(this).parent().parent();
    if(isNaN(qty.val())){
          alert("please enter a valid quantity");
          qty.val(1);
    }else{
     
        //always use -0 or *1 in jquery,bcoz sometimes it understands qty.val() as a string instead of numbers.
            if( (qty.val()-0) > (tr.find(".tqty").val()-0) ){
                alert("Sorry!... This much of quantity is not available.");
                qty.val(1);
            }else{
                var total_price=tr.find(".qty").val()*tr.find(".price").val();
               // alert(total_price);
                tr.find(".amt").html(total_price);
                calculate(0,0);
            }
    }
})

//calculate gst,sub total,net total etc,

function calculate(disc,paid_amt) {
  /*$("#discount");
    $("#paid");
   ;*/
    var subtotal=0;
    var  gst=0;
    var nettotal=0;
    var discount=disc;
    var paid=paid_amt;
    var due=0;
    $(".amt").each(function(){
        subtotal = subtotal + ($(this).html()*1);
    })
    $("#sub_total").val(subtotal);

    gst=0.18*subtotal;
    nettotal= gst + subtotal;
    nettotal= nettotal-discount;
    due=nettotal-paid;

    $("#gst").val(gst);
    $("#net_total").val(nettotal);
    $("#discount").val(discount);
    $("#due").val(due);

}//end of calculate() function

//calculate discount

$("#discount").keyup(function(){
 var discount=$(this).val();
 calculate(discount,0);
})

// CaLCULATE PAID
$("#paid").keyup(function(){
    var paid=$(this).val();
    var discount=$("#discount").val();
    calculate(discount,paid);
})

//order accepting
$("#order_form").click(function(){
var invoice=$("#get_order_data").serialize();
if($("#customer_name").val()==''){
    $("#error").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>Please enter Customer name<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
else if($(".pid").val()==''){
    // alert('fill details');
     $("#error").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>Please choose any product<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}else if($("#paid").val()==''){
    $("#error").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>Please enter paid amount<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}else if($("#payment_type").val()==''){
    $("#error").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>Please choose payment method<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
}
else{
    $.ajax({
        url:"http://localhost/inventory_system/includes/process.php",
        method:"POST",
        data:$("#get_order_data").serialize(),
        success:function(data){
            //in data it will get invoice_no from proceess.php,now we will check that this data(invoice_no) is negetive number or not
            if(data<0){
              alert(data);//returns error ,if there is any
            }else{
                if(confirm("Do you want to print invoice?")){
                    window.location.href="http://localhost/inventory_system/includes/invoice_bill.php?invoice_no="+data+"&"+invoice;
                }
                $("#get_order_data").trigger("reset");//it will reset our form after insertion of record
             //   alert(data);
            }
           
        }

    })//end of ajax
   }
})

})//end of document