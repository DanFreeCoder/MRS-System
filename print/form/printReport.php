<?php
ob_end_clean();
include '../../config/connection.php';
include '../../objects/clsGenerateRequest.class.php';

$database = new clsMRconnection();
$db = $database->connect();

$request_id = new Generate($db);
$request_data_head = new Generate($db);
$request_data_body = new Generate($db);


/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
ob_start();
require_once('tcpdf_include_report.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Material Requisition Form');
$pdf->SetSubject('TCPDF Tutorial');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH);
//$pdf->setFooterData(array(0,64,0), array(0,64,128));
//remove the header and footer data
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
	require_once(dirname(__FILE__) . '/lang/eng.php');
	$pdf->setLanguageArray($l);
}
// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 8, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();
// set text shadow effect
$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
//initialize data
$data_header = '';
$data_table = '';
$get_id = $request_id->get_latest_save_id();
while ($row = $get_id->fetch(PDO::FETCH_ASSOC)) {
	$id = $row['id'];
}



//GENERATE WITH DATE SPAN
// if($from != null && $to != null)
// {
// 	//GENERATE REPORT BY COMPANY
// 	if($comp_id != null)
// 	{
// 		$get_data = $report->generate_by_company_date($from, $to, $comp_id);
// 		while($row = $get_data->fetch(PDO::FETCH_ASSOC))
// 		{
// 			$po_num = $row['po_num'];
// 			$check_date = date('m/d/y', strtotime($row['check_date']));
// 			$cv_num = $row['cv_no'];
// 			$bank = $row['bank-name'];
// 			$check_num = $row['check_no'];
// 			$payee = $row['supplier_name'];
// 			$bill_date =  date('m/d/y', strtotime($row['bill_date']));
// 			$date_received =  date('m/d/y', strtotime($row['date_received_bo']));
// 			$due_date =  date('m/d/y', strtotime($row['due_date']));
// 			$amount = $row['amount'];
// 			$title_name = 'COMPANY NAME: '.$row['comp-name'];

// 			$report_data .= '
// 				<tr>
// 					<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$po_num.'</td>
// 					<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$check_date.'</td>
// 					<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$cv_num.'</td>
// 					<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$bank.'</td>
// 					<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$check_num.'</td>
// 					<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$payee.'</td>
// 					<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$bill_date.'</td>
// 					<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$date_received.'</td>
// 					<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$due_date.'</td>
// 					<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$amount.'</td>
// 				</tr>';
// 		}
// 	}
// 	//GENERATE REPORT BY SUPPLIER
// 	if($supplier_id != null)
// 	{
// 		$get_data = $report->generate_by_supplier_date($from, $to, $supplier_id);
// 		while($row = $get_data->fetch(PDO::FETCH_ASSOC))
// 		{
// 			$po_num = $row['po_num'];
// 			$check_date = date('m/d/y', strtotime($row['check_date']));
// 			$cv_num = $row['cv_no'];
// 			$bank = $row['bank-name'];
// 			$check_num = $row['check_no'];
// 			$payee = $row['supplier_name'];
// 			$bill_date =  date('m/d/y', strtotime($row['bill_date']));
// 			$date_received =  date('m/d/y', strtotime($row['date_received_bo']));
// 			$due_date =  date('m/d/y', strtotime($row['due_date']));
// 			$amount = $row['amount'];
// 			$title_name = 'SUPPLIER NAME: '.$row['supplier_name'];

// 			$report_data .= '
// 				<tr>
// 					<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$po_num.'</td>
// 					<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$check_date.'</td>
// 					<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$cv_num.'</td>
// 					<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$bank.'</td>
// 					<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$check_num.'</td>
// 					<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$payee.'</td>
// 					<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$bill_date.'</td>
// 					<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$date_received.'</td>
// 					<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$due_date.'</td>
// 					<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$amount.'</td>
// 				</tr>';
// 		}
// 	}
// 	//GENERATE REPORT BY STATUS
// 	if($status != null)
// 	{
// 		if($status == 3)
// 		{
// 			//generate on process only
// 			$get_data = $report->generate_on_process_date($from, $to, $status);
// 			while($row = $get_data->fetch(PDO::FETCH_ASSOC))
// 			{
// 				$po_num = $row['po_num'];
// 				$check_date = date('m/d/y', strtotime($row['check_date']));
// 				$cv_num = $row['cv_no'];
// 				$bank = $row['bank-name'];
// 				$check_num = $row['check_no'];
// 				$payee = $row['supplier_name'];
// 				$bill_date =  date('m/d/y', strtotime($row['bill_date']));
// 				$date_received =  date('m/d/y', strtotime($row['date_received_bo']));
// 				$due_date =  date('m/d/y', strtotime($row['due_date']));
// 				$amount = $row['amount'];
// 				$title_name = 'STATUS: ON PROCESS';

// 				$report_data .= '
// 					<tr>
// 						<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$po_num.'</td>
// 						<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$check_date.'</td>
// 						<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$cv_num.'</td>
// 						<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$bank.'</td>
// 						<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$check_num.'</td>
// 						<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$payee.'</td>
// 						<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$bill_date.'</td>
// 						<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$date_received.'</td>
// 						<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$due_date.'</td>
// 						<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$amount.'</td>
// 					</tr>';
// 			}
// 		}
// 		else
// 		{
// 			//generate by status
// 			$get_data = $report->generate_by_status_date($from, $to, $status);
// 			while($row = $get_data->fetch(PDO::FETCH_ASSOC))
// 			{
// 				$po_num = $row['po_num'];
// 				$check_date = date('m/d/y', strtotime($row['check_date']));
// 				$cv_num = $row['cv_no'];
// 				$bank = $row['bank-name'];
// 				$check_num = $row['check_no'];
// 				$payee = $row['supplier_name'];
// 				$bill_date =  date('m/d/y', strtotime($row['bill_date']));
// 				$date_received =  date('m/d/y', strtotime($row['date_received_bo']));
// 				$due_date =  date('m/d/y', strtotime($row['due_date']));
// 				$amount = $row['amount'];
// 				if($status == 1){
// 					$status_name = 'PENDING';
// 				}elseif($status == 2){
// 					$status_name = 'RETURNED';
// 				}elseif($status == 9){
// 					$status_name = 'ON HOLD';
// 				}elseif($status == 10){
// 					$status_name = 'FOR RELEASING';
// 				}else{
// 					$status_name = 'RELEASED';
// 				}
// 				$title_name = 'STATUS: '.$status_name;

// 				$report_data .= '
// 					<tr>
// 						<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$po_num.'</td>
// 						<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$check_date.'</td>
// 						<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$cv_num.'</td>
// 						<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$bank.'</td>
// 						<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$check_num.'</td>
// 						<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$payee.'</td>
// 						<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$bill_date.'</td>
// 						<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$date_received.'</td>
// 						<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$due_date.'</td>
// 						<td align="center" style="border-top-style:2px; border-left-style:2px; border-bottom-style:2px">'.$amount.'</td>
// 					</tr>';
// 			}
// 		}
// 	}
// }
// else
// {
$request_data_head->id = $id;
$get_data = $request_data_head->get_head_data();
while ($row = $get_data->fetch(PDO::FETCH_ASSOC)) {

	$date_added = $row['date_added'];
	$project_name = $row['project_name'];
	$pro_type_name = $row['pro_type_name'];
	$class_item_name = $row['class_item_name'];
	$sub_class = $row['sub_class'];
	$CIP_type = $row['CIP_type'];
	$con_num = $row['con_num'];

	$data_header .= '
			<center>
			<h2>Material Requisition Form</h2>
			<p>F-IVM-003 || Rev.2 || 01/17/2023</p>
			</center> </br>
			<span style="margin: 1;">Date:' . $date_added . '</span><br>
			<span style="margin: 1;">Project:' . $project_name . '</span><br>
			<span style="margin: 1;">Type of Project:' . $pro_type_name . '</span><br>
			<span style="margin: 1;">CIP Account:' . $CIP_type . '</span>
			<span style="margin: 1;">Control No. :' . $con_num . '</span>
			<span style="margin: 1;">Classification:' . $class_item_name . '</span>
			<span style="margin: 1;">Sub-Classification:' . $sub_class . '</span>
		';
}

$request_data_body->item_id = $id;
$get_body = $request_data_body->get_item_table();
while ($row2 = $get_body->fetch(PDO::FETCH_ASSOC)) {
	$qty = $row2['qty'];
	$oum = $row2['oum'];
	$itemcode = $row2['itemcode'];
	$brand = $row2['brand'];
	$description = $row2['description'];
	$color = $row2['qty'];
	$remarks = $row2['remarks'];

	$data_table .= '
	<tr>
    <td>' . $qty . '</td>
    <td>' . $oum . '</td>
    <td>' . $itemcode . '</td>
    <td>' . $brand . '</td>
    <td>' . $description . '</td>
    <td>' . $color . '</td>
    <td>' . $remarks . '</td>
    </tr>
	';
}

// Set some content to print
$html = <<<EOD
<html>

<head>
</head>

<body>
   
	$data_header
    <table width="100%" cellpadding="10" style="border-top-style:2px; border-left-style:2px; border-right-style:2px; border-bottom-style:2px; font-size: 10px">
        <thead>
            <th>
                <center>Quantity</center>
            </th>
            <th>
                <center>OUM</center>
            </th>
            <th>
                <center>Item Code</center>
            </th>
            <th>
                <center>Brand</center>
            </th>
            <th>
                <center>Description</center>
            </th>
            <th>
                <center>Color/Other Specs</center>
            </th>
            <th>
                <center>Remarks</center>
            </th>
        </thead>
        <tbody>
            $data_table
        </tbody>
    </table>
</body>

</html>
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------
ob_start();
// Close and output PDF document
// This method has several options, check the source code documentation for more information.

$pdf->Output('printReport.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
