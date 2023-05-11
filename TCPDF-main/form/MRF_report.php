<?php
include '../../config/connection.php';
include '../../objects/clsGenerateRequest.class.php';

$database = new clsMRconnection();
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
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Owen Leibman');
$pdf->setTitle('TCPDF Example 067');
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
   
            <span>Date: ' . $date_added . '</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span colspan = "2">Control No.: ' . $con_num . '</span><br>
            <span>Project: ' . $p_project . '</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span>Classification. : ' . $p_class_name . '</span><br>
            <span>Type of Project: ' . $p_pro_type . '</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span>Sub-Classification: ' . $sub_class . '</span><br>
            <span>CIP Account: ' . $p_cip_account . '</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   
     
		';

$mrf_print->item_id = $id;
$get_table = $mrf_print->get_item_table();
while ($row2 = $get_table->fetch(PDO::FETCH_ASSOC)) {
    $qty = $row2['qty'];
    $oum = $row2['oum'];
    $itemcode = $row2['itemcode'];
    $brand = $row2['brand'];
    $description = $row2['description'];
    $color = $row2['color'];
    $remarks = $row2['remarks'];

    $data_table .= '
    
        <tr>
        <td style="border:1px solid black;">' . $qty . '</td>
        <td style="border:1px solid black;">' . $oum . '</td>
        <td style="border:1px solid black;">' . $itemcode . '</td>
        <td style="border:1px solid black;">' . $brand . '</td>
        <td style="border:1px solid black;">' . $description . '</td>
        <td style="border:1px solid black;">' . $color . '</td>
        <td style="border:1px solid black;">' . $remarks . '</td>
        </tr>
    ';
}







$html = <<<EOD
<!DOCTYPE html>
<html>

<head>
</head>
<body>
    <div align="center">
                  <h2>MATERIAL REQUISITION FORM</h2>
    </div>
    <div>
            $data_header
    </div>       
            <div>
                <table style="border: 1px solid black;">
                <tr>
                <th style="border: 1px solid black; text-align:center; text-align:center;">Quantity</th>
                <th style="border: 1px solid black; text-align:center;">OUM</th>
                <th style="border: 1px solid black; text-align:center;">Item Code</th>
                <th style="border: 1px solid black; text-align:center;">Brand</th>
                <th style="border: 1px solid black; text-align:center;">Description</th>
                <th style="border: 1px solid black; text-align:center;">Other Specs</th>
                <th style="border: 1px solid black; text-align:center;">Remarks</th>
                </tr>
                $data_table
            </table> 
        </div>
    <span>Requested By/Date:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <span>Approved By/Date:</span><br><br>
    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________/______</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________/______</span><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <span style="font-size:8px; margin-top: 0;">Signature Over Printed Name/Date</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <span style="font-size:8px; margin-top: 0;">Signature Over Printed Name/Date</span>
    <br><br>
</body>
</html>
EOD;

$html .= <<<EOD
<!DOCTYPE html>
<html>

<head>
</head>
<body>
    <div align="center">
        <p style="border-style: dotted; width:100%;"></p>
                    <h2>MATERIAL REQUISITION FORM</h2>
    </div>
        <div>
                $data_header
        </div>       
            <div>
                <table style="border: 1px solid black;">
                <tr>
                <th style="border: 1px solid black; text-align:center;">Quantity</th>
                <th style="border: 1px solid black; text-align:center;">OUM</th>
                <th style="border: 1px solid black; text-align:center;">Item Code</th>
                <th style="border: 1px solid black; text-align:center;">Brand</th>
                <th style="border: 1px solid black; text-align:center;">Description</th>
                <th style="border: 1px solid black; text-align:center;">Other Specs</th>
                <th style="border: 1px solid black; text-align:center;">Remarks</th>
                </tr>
                $data_table
            </table> 
        </div>
        <span>Requested By/Date:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span>Approved By/Date:</span><br><br>
        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________/______</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________/______</span><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span style="font-size:8px; margin-top: 0;">Signature Over Printed Name/Date</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span style="font-size:8px; margin-top: 0;">Signature Over Printed Name/Date</span>
</body>
</html>
EOD;

$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);


// -----------------------------------------------------------------------------


//Close and output PDF document
$pdf->Output('MRF_report.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
