<?php
include '../../config/connection.php';
include '../../objects/clsGenerateRequest.class.php';
session_start();
$database = new clsMRFconnection();
$db = $database->connect();

$mrf_print = new Generate($db);

if (!isset($_SESSION['firstname'])) {
    header("Location: ../../controls/logout.php");
}


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
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Owen Leibman');
$pdf->setTitle('MRF report');
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
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

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

// $pdf->Write(0, 'Example of HTML tables', '', 0, 'L', true, 0, false, false, 0);

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
    $user_id = $row2['user_id'];
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
    <td colspan="7" rowspan="1" style="text-align:center;" ><b>MATERIAL REQUISITION SLIP</b></td>
</tr>
<br>
<tr>
    <td colspan="3" style="">Date: <span>' . $date_added . '</span></td>
    <td colspan="4">Control No. : <span>' . $con_num . '</span></td>
</tr>
<tr>
    <td colspan="3">Project: <span>' . $p_project . '</span></td>
    <td colspan="4">Classification: <span>' . $p_class_name . '</span></td>
</tr>
<tr>
    <td colspan="3">Type of Project: <span>' . $p_pro_type . '</span></td>
    <td colspan="4">Sub-Classification: <span>' . $sub_class . '</span></td>
</tr>
<tr>
    <td colspan="6">CIP Account: <span>' . $p_cip_account . '</span></td>
</tr>
<tr>
    <td rowspan="2"></td>
</tr>
</table>
		';

$mrf_print->item_id = $id;
$mrf_print->user_id = $user_id;
$get_table = $mrf_print->get_item_table();
while ($row2 = $get_table->fetch(PDO::FETCH_ASSOC)) {
    $qty = $row2['qty'];
    $oum = $row2['oum'];
    $itemcode = $row2['itemcode'];
    $description = $row2['description'];
    $remarks = $row2['remarks'];

    $data_table .= '
    
    <tr>
    <td colspan="1" class="td" align="center">' . $qty . '</td>
    <td colspan="1" class="td" align="center">' . $oum . '</td>
    <td colspan="1" class="td" align="center">' . $itemcode . '</td>    
    <td colspan="3" class="td" align="center">' . $description . '</td>    
    <td colspan="2" class="td" align="center">' . $remarks . '</td>    
</tr>
    ';
}



$fullname = $_SESSION['firstname'] . " " . $_SESSION['lastname'];


$html = <<<EOD
<!DOCTYPE html>
<html>
<head>
<style>
span{
    text-decoration:underline;
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
    <br>
    <br>
    <hr>
</body>
</html>
EOD;

$html2 = <<<EOD
<!DOCTYPE html>
<html>
<head>
<style>
span{
    text-decoration:underline;
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
    <br>
</body>
</html>
EOD;

// Get the current Y position
$currentY = $pdf->GetY();

// Calculate the length of the row
$rowLength = 0;
$cells = count(explode('</td>', $html)) - 1;
for ($i = 0; $i < $cells; $i++) {
    $cellLength = $pdf->GetStringWidth("Column " . $i);
    $rowLength += $cellLength;
}

$html_length = $rowLength;

if ($html_length >= 1800) {
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
    $pdf->addPage();
    $pdf->writeHTMLCell(0, 0, '', '', $html2, 0, 1, 0, true, '', true);
} else {
    $html .= $html2;
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
}

// -----------------------------------------------------------------------------


//Close and output PDF document
$pdf->Output('MRF report.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
