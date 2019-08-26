<?php
//call the FPDF library
require('fpdf181/fpdf.php');

include_once 'connect.php';
 session_start();

 if (isset($_SESSION['usr_id']) == "") {
     header("Location: login.php");
 }
 $id= $_GET['id'];
 $sql = mysqli_query($conn, "SELECT * FROM `inovice` WHERE inovice_id=".$id." ");


//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

//create pdf object
$pdf = new FPDF('P','mm','A4');
//add new page
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(79 ,5,' ',0,0);
$pdf->Cell(110 ,5,'INVOICE',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

 while ($row = mysqli_fetch_assoc($sql)){
 	$cust_id=$row['cust_id'];
 	$date=$row['date'];
 	$ino_product=$row['ino_product'];
 	$pro_quantity=$row['pro_quantity'];
 	$pro_discount=$row['pro_discount'];
 	$pro_price=$row['pro_price'];
 	$pro_total=$row['Pro_total'];
 }

$pdf->Cell(130 ,5,' ',0,0);
$pdf->Cell(25 ,5,'Date',0,0);
$pdf->Cell(34 ,5,$date,0,1);//end of line

$pdf->Cell(130 ,5,' ',0,0);
$pdf->Cell(25 ,5,'Invoice #',0,0);
$pdf->Cell(34 ,5,$id,0,1);//end of line

$pdf->Cell(130 ,5,' ',0,0);
$pdf->Cell(25 ,5,'Customer ID',0,0);
$pdf->Cell(34 ,5,$cust_id,0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

//billing address
$pdf->Cell(100 ,5,'Bill to',0,1);//end of line
$sql1 = mysqli_query($conn, "SELECT * FROM `customer` WHERE cust_id=".$cust_id." ");
while ($row = mysqli_fetch_assoc($sql1)){
 	$cust_name=$row['cust_name'];
 	$cust_email=$row['cust_email'];
 	$cust_address=$row['cust_address'];
 }

//add dummy cell at beginning of each line for indentation
$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,$cust_name,0,1);

$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,$cust_email,0,1);

$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,$cust_address,0,1);



//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

//invoice contents
$pdf->SetFont('Arial','B',12);

$pdf->Cell(80 ,5,'Description',1,0);
$pdf->Cell(25 ,5,'Quantity',1,0);
$pdf->Cell(25 ,5,'Unit Price',1,0);
$pdf->Cell(25 ,5,'Discount',1,0);
$pdf->Cell(34 ,5,'Amount',1,1);//end of line


$pdf->SetFont('Arial','',12);

//Numbers are right-aligned so we give 'R' after new line parameter



$pdf->Cell(80 ,5,$ino_product,1,0);
$pdf->Cell(25 ,5,$pro_quantity,1,0);
$pdf->Cell(25 ,5,$pro_price,1,0);
$pdf->Cell(25 ,5,$pro_discount,1,0);
$pdf->Cell(34 ,5,$pro_total,1,1);//end of line

//summary
$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,'Subtotal',0,0);
$pdf->Cell(4 ,5,' ',0,0);
$pdf->Cell(30 ,5,$pro_total,1,1,'R');//end of line


$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,'Total Due',0,0);
$pdf->Cell(4 ,5,' ',0,0);
$pdf->Cell(30 ,5,$pro_total,1,1,'R');//end of line
//output the result
$pdf->Output();
?>