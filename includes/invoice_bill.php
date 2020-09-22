<?php
session_start();
include_once("../fpdf/fpdf.php");

if($_GET['order_date'] && $_GET['invoice_no']){
    $pdf=new FPDF();
    $pdf->AddPage();
    
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(190,20,"Inventory Management System",0,1,"C");
    $pdf->SetFont('Arial',NULL,12);
    $pdf->Cell(40,10,"Order Date:",0,0);
    $pdf->Cell(40,10,$_GET['order_date'],0,1);
    $pdf->Cell(40,10,"Customer Name:",0,0);
    $pdf->Cell(40,10,$_GET['customer_name'],0,1);

    $pdf->Cell(40,10,"",0,1); //create a space

    //create table
    $pdf->Cell(10,10,"#",1,0,"C");
    $pdf->Cell(70,10,"Product Name",1,0,"C");
    $pdf->Cell(30,10,"Quantity",1,0,"C");
    $pdf->Cell(40,10,"Price",1,0,"C");
    $pdf->Cell(40,10,"Total (Rs)",1,1,"C");
    
    //values inside table
    for($i=0;$i<count($_GET['pid']);$i++){
        $pdf->Cell(10,10,($i+1),1,0,"C");
        $pdf->Cell(70,10,$_GET['pro_name'][$i],1,0,"C");
        $pdf->Cell(30,10,$_GET['qty'][$i],1,0,"C");
        $pdf->Cell(40,10,$_GET['price'][$i],1,0,"C");
        $pdf->Cell(40,10,($_GET['qty'][$i] * $_GET['price'][$i]),1,1,"C");
    }

    $pdf->Cell(40,10,"",0,1); //create a space

    $pdf->Cell(50,10,"Sub Total",0,0); 
    $pdf->Cell(50,10,": ".$_GET['sub_total'],0,1); 
    $pdf->Cell(50,10,"GST",0,0); 
    $pdf->Cell(50,10,": ".$_GET['gst'],0,1); 
    $pdf->Cell(50,10,"Discount",0,0); 
    $pdf->Cell(50,10,": ".$_GET['discount'],0,1); 
    $pdf->Cell(50,10,"Net total",0,0); 
    $pdf->Cell(50,10,": ".$_GET['net_total'],0,1); 
    $pdf->Cell(50,10,"Paid",0,0); 
    $pdf->Cell(50,10,": ".$_GET['paid'],0,1); 
    $pdf->Cell(50,10,"Due",0,0);
    $pdf->Cell(50,10,": ".$_GET['due'],0,1);
    $pdf->Cell(50,10,"Payment Type",0,0);
    $pdf->Cell(50,10,": ".$_GET['payment_type'],0,1);

  // http://localhost/inventory_system/includes/invoice_bill.php?order_date=2020-09-19&customer_name=kuku&pid%5B%5D=89&tqty%5B%5D=198&qty%5B%5D=1&price%5B%5D=2000&pro_name%5B%5D=women%20yellow%20kurta-Black%20payjama&
    //sub_total=2000&gst=360&discount=0&net_total=2360&paid=2360&due=0&payment_type=draft
    $pdf->Cell(40,10,"",0,1); //create a space
    $pdf->Cell(40,10,"",0,1); //create a space
    $pdf->Cell(40,10,"",0,1); //create a space
    $pdf->Cell(180,10,"Signature",0,0,"R");
    $pdf->Output("../PDF_INVOICES/PDF_INVOICE_".$_GET['invoice_no'].".pdf","F");
    $pdf->Output();
}
?>