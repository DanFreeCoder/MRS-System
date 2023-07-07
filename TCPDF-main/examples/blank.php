<?php
include '../../config/connection.php';
include '../../objects/clsGenerateRequest.class.php';
session_start();
$database = new clsMRFconnection();
$db = $database->connect();

$mrf_print = new Generate($db);




//============================================================+
// File name   : example_067.php
// Begin       : 2022-01-07
// Last Update : 2022-01-07
//
// Description : Example 067 for TCPDF class
//               HTML tables with !important in style
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: HTML tables and table headers
 * @author Nicola Asuni
 * @since 2009-03-20
 * @group html
 * @group table
 * @group pdf
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetDisplayMode(100, 'default');
$pdf->setCellPaddings(0, 0, 0, 0);
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Owen Leibman');
$pdf->setTitle('Blank printed');
$pdf->setSubject('TCPDF Tutorial');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');



// set default header data
// $pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 067', PDF_HEADER_STRING);

// set header and footer fonts
// $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
// $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(0);
$pdf->setFooterMargin(0);

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->setFont('helvetica', '', 11);

// add a page
$pdf->AddPage();


// $pdf->setFont('helvetica', '', 8);

// -----------------------------------------------------------------------------
//initialize data
$data_header = '';
$data_table = '';

//base data to compare to other table data by id
$get_data = $mrf_print->get_base_data();
while ($row2 = $get_data->fetch(PDO::FETCH_ASSOC)) {
    $id = $row2['id'];
    $date_added = $row2['date_added'];
    $project = $row2['project'];
    $typeof_project = $row2['typeof_project'];
    $classification = $row2['classification'];
    $sub_class = $row2['sub_class'];
    $con_num = $row2['con_num'];
    $cip_account = $row2['cip_account'];
    $approver = $row2['approver'];
    $requestor = $row2['requestor'];
}

//get project
$mrf_print->id = $project;
$get_project = $mrf_print->print_project();
while ($row = $get_project->fetch(PDO::FETCH_ASSOC)) {
    $p_project =  $row['Project'];
}
//get type of project
$mrf_print->id = $typeof_project;
$get_project = $mrf_print->print_type_of_project();
while ($row = $get_project->fetch(PDO::FETCH_ASSOC)) {
    $p_pro_type = $row['project_type'];
}
//get classification
$mrf_print->id = $classification;
$get_project = $mrf_print->print_classification();
while ($row = $get_project->fetch(PDO::FETCH_ASSOC)) {
    $p_class_name =  $row['class_name'];
}


//get CIP ACCOUNT
$mrf_print->id = $cip_account;
$get_project = $mrf_print->print_CIP_account();
while ($row = $get_project->fetch(PDO::FETCH_ASSOC)) {
    $p_cip_account = $row['cip_account'];
    $p_cip_id = $row['cip_id'];
}


$data_header .= '
   
            <table nobr="true">
            <tr>
                <td colspan="6" rowspan="1"><h3 align="center"><b>MATERIAL REQUISITION SLIP</b></h3></td>
            </tr>
            <br>
            <tr>
                <td colspan="3" style="">Date: <span>' . $date_added . '</span></td>
                <td colspan="3" style="">Control No. : <span style="font-weight:normal;">' . $con_num . '</span></td>
            </tr>
            <tr>
                <td colspan="3" style="">Project: <span style="font-weight:normal;">' . $p_project . '</span></td>
                <td colspan="3" style="">Classification: <span style="font-weight:normal;">' . $p_class_name . '</span></td>
            </tr>
            <tr>
                <td colspan="3" style="">Type of Project: <span style="font-weight:normal;">' . $p_pro_type . '</span></td>
                <td colspan="3" style="">Sub-Classification: <span style="font-weight:normal;">' . $sub_class . '</span></td>
            </tr>
            <tr>
                <td colspan="6" style="">CIP Account: <span style="font-weight:normal;">' . $p_cip_account . '</span></td>
            </tr>
            <tr>
                <td rowspan="2"></td>
            </tr>
            </table>
     
		';


for ($i = 1; $i < 10; $i++) {
    $data_table .= '
    <tr ' . $i . '>
        <td colspan="1" style="border:1px solid black; text-align:center;"></td>
        <td colspan="1" style="border:1px solid black; text-align:center;"></td>
        <td colspan="1" style="border:1px solid black; text-align:center;"></td>
        <td colspan="3" style="border:1px solid black; text-align:center;"></td>
        <td colspan="2" style="border:1px solid black; text-align:center;"></td>
    </tr>   
';
}



$fullname = '';
if ($requestor == '') {
    $fullname = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
} else {
    $fullname = $requestor;
}

$html = <<<EOD
<!DOCTYPE html>
<html>
<head>
<style>

.td{
    border: 1px solid black;
}
div span{
    vertical-align:middle;
}
</style>
</head>
<body>
<br>
<br>
                $data_header    
                
        <table id="item_table">
        <tr>
        <td colspan="8" style="border:1px solid black; text-align:center; width:695px;">To filled by requestor</td>
    </tr>
    <tr>
        <td colspan="1" style="border:1px solid black; text-align:center; width:50px;">QTY</td>
        <td colspan="1" style="border:1px solid black; text-align:center; width:60px;">UOM</td>
        <td colspan="1" style="border:1px solid black; text-align:center;">ITEM CODE</td>
        <td colspan="3" style="border:1px solid black; text-align:center; width:398px;">ITEM DESCRIPTIONS</td>
        <td colspan="2" style="border:1px solid black; text-align:center; width:100px;">REMARKS</td>
    </tr>
         $data_table
         </table>
         <br>
         <br>
         <table>
            <tr>   
              
                <td colspan="2">Requested By/Date:</td>
                <td colspan="1"></td>
                <td colspan="1"></td>
                <td colspan="1"></td>
                <td colspan="1"></td>
                <td colspan="2">Approved By/Date:</td>
                <td colspan="1"></td>
                <td colspan="1"></td>
            </tr>
            <tr>
            <td colspan="2"></td>
            <td colspan="1"></td>
            <td colspan="1"></td>
            <td colspan="1"></td>
            <td colspan="1"></td>
            <td colspan="2"></td>
            <td colspan="1"></td>
            <td colspan="1"></td>
        </tr>
    <tr>
         <td colspan="2" style="border-bottom:1px solid black; text-align:center;">$fullname</td>    
         <td colspan="1" style="border-bottom:1px solid black;">/</td>  
         <td colspan="1"></td>  
         <td colspan="1"></td>  
         <td colspan="1"></td>
         <td colspan="2" style="border-bottom:1px solid black; text-align:center;">$approver</td>
         <td colspan="1" style="border-bottom:1px solid black;">/</td>    
         <td colspan="1"></td>  
    
             
    </tr>
            <tr>    
                <td colspan="3" style=" font-size:8px; text-align:center;">Signature over Printed Name/Date:</td>
                <td colspan="1"></td>
                <td colspan="1"></td>
                <td colspan="1"></td>
                <td colspan="3" style=" font-size:8px; text-align:center;">Trade Engineer / Supervisor /Date:</td>
                <td colspan="1" style=""></td>
        </tr>
  </table>
  <br>
  <br>
    <hr>
</body>
</html>
EOD;

$html .= <<<EOD
<!DOCTYPE html>
<html>
<head>
<style>
td{
    font-weight:500;
}
.td{
    border: 1px solid black;
}
div span{
    vertical-align:middle;
</style>
</head>
<body>
<br>
                $data_header    
                
        <table>
        <tr>
                <td colspan="8" style="border:1px solid black; text-align:center; width:695px;">To filled by requestor</td>
            </tr>
            <tr>
                <td colspan="1" style="border:1px solid black; text-align:center; width:50px;">QTY</td>
                <td colspan="1" style="border:1px solid black; text-align:center; width:60px;">UOM</td>
                <td colspan="1" style="border:1px solid black; text-align:center;">ITEM CODE</td>
                <td colspan="3" style="border:1px solid black; text-align:center; width:398px;">ITEM DESCRIPTIONS</td>
                <td colspan="2" style="border:1px solid black; text-align:center; width:100px;">REMARKS</td>
            </tr>
         $data_table
         </table>
         <br>
         <br>
         <table>
            <tr>   
              
                <td colspan="2">Requested By/Date:</td>
                <td colspan="1"></td>
                <td colspan="1"></td>
                <td colspan="1"></td>
                <td colspan="1"></td>
                <td colspan="2">Approved By/Date:</td>
                <td colspan="1"></td>
                <td colspan="1"></td>
            </tr>
            <tr>
            <td colspan="2"></td>
            <td colspan="1"></td>
            <td colspan="1"></td>
            <td colspan="1"></td>
            <td colspan="1"></td>
            <td colspan="2"></td>
            <td colspan="1"></td>
            <td colspan="1"></td>
        </tr>
    <tr>
         <td colspan="2" style="border-bottom:1px solid black; text-align:center;">$fullname</td>    
         <td colspan="1" style="border-bottom:1px solid black;">/</td>  
         <td colspan="1"></td>  
         <td colspan="1"></td>  
         <td colspan="1"></td>
         <td colspan="2" style="border-bottom:1px solid black; text-align:center;">$approver</td>
         <td colspan="1" style="border-bottom:1px solid black;">/</td>    
         <td colspan="1"></td>  
    
             
    </tr>
            <tr>    
                <td colspan="3" style=" font-size:8px; text-align:center;">Signature over Printed Name/Date:</td>
                <td colspan="1"></td>
                <td colspan="1"></td>
                <td colspan="1"></td>
                <td colspan="3" style=" font-size:8px; text-align:center;">Trade Engineer / Supervisor /Date:</td>
                <td colspan="1" style=""></td>
        </tr>
  </table>
</body>
</html>
EOD;

$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);


// -----------------------------------------------------------------------------


//Close and output PDF document
$pdf->Output('blank.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
