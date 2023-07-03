
<?php
include '../config/connection.php';
include '../objects/clsusers.class.php';

$database = new clsMRFconnection();
$db = $database->connect();

$users = new Users($db);

$users->email = $_POST['email'];
$users->status = 0;

$view_by_email = $users->view_by_email();
while ($rows = $view_by_email->fetch(PDO::FETCH_ASSOC)) {
    $firstname = $rows['firstname'];
    $id = $rows['id'];
}

if ($view_by_email) {
    $users->email = $_POST['email'];
    $users->status = 0;
    $by_id = $users->email_by_id();

    echo 1;
    $from = "system.administrator<(it@innogroup.com.ph)>";
    $to = $_POST['email'];

    $subject = "Material Requisition Slip(MRS) User Message";
    $message = '<html>
                    <body style="margin: 0 auto; padding: 10px; border: 1px solid #e1e1e1; font-family:Calibri">
                        <div style="background-color: #00C957; padding: 5px; color: white">
                            <h3 style="padding: 0; margin: 0;">  Message: </h3>
                        </div>
                        <div style="border: 1px solid #e1e1e1; padding: 5px">    
                            Hi ' . $firstname . ', <br><br>
                            We received your request to change your password. As a response, you need to fill out this form through this link: <a href="http://www.innogroup.com.ph/mrs/change_password.php?id=' . $id . '">http://www.innogroup.com.ph/mrs/change_password.php</a><br><b>
                            Thank you. <br><br>
                            Thank You, <br>MRS Administrator
                        </div>
                        <br/>
                        <br/>
                        <div style="padding:10px 0px; text-align: center; font-size: 11px; border-top: 1px solid #e1e1e1">
                        ONLINE MATERIAL REQUISITION SLIP &middot; <a href="http://www.innogroup.com.ph/mrs">Innogroup</a>
                        </div>
                    </body>
                </html>';

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
    $headers .= "From: " . $from . "" . "\r\n";

    echo (mail($to, $subject, $message, $headers)) ? 1 : 0;
} else {
    echo 0;
}
