
<?php


$username = strtolower($_POST['firstname'] . "." . $_POST['lastname']);
$from = "system.administrator<(it@innogroup.com.ph)>";
$to = $_POST['email'];

$subject = "Material Requisition Slip(MRS) User Message";
$message = '<html>
                    <body style="margin: 0 auto; padding: 10px; border: 1px solid #e1e1e1; font-family:Calibri">
                        <div style="background-color: #00C957; padding: 5px; color: white">
                            <h3 style="padding: 0; margin: 0;">  Message: </h3>
                        </div>
                        <div style="border: 1px solid #e1e1e1; padding: 5px">    
                        Hi ' . $_POST['firstname'] . ', <br><br>
                        Your user account has been successfully created. You can create your own MRS Account at <a link="www.innogroup.com.ph/mrs">www.innogroup.com.ph/mrs</a>. Sign in by using the username <b>' . str_replace(" ", "", $username) . '</b> and password of <b>123456</b> to access the system.<br>Please immediately change your password as directed.<br><br>
                        Thank you. <br><br>
                        Thank You, <br>MRS Administrator
                        </div>
                        <br/>
                        <br/>
                        <div style="padding:10px 0px; text-align: center; font-size: 11px; border-top: 1px solid #e1e1e1">
                         MATERIAL REQUISITION SLIP &middot; <a href="http://www.innogroup.com.ph/mrs">Innogroup</a>
                        </div>
                    </body>
                </html>';

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
$headers .= "From: " . $from . "" . "\r\n";

echo (mail($to, $subject, $message, $headers)) ? 1 : 0;
