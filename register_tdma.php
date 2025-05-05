<?php
// $host = "dedi332.cpt3.host-h.net";
// $username = "suorgaacue_2";
// $password = "M4LzY2xH9RMXKVcgmX48";
// $database = "suorgaacue_db2";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';


$host = "dedi332.cpt3.host-h.net";
$username = "tdmaputmxp_1";
$password = "f8jTTYJVAFi96AWaGvB8";
$database = "tdmaputmxp_db1";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Only process POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and assign values
    $full_name = htmlspecialchars($_POST['full_name']);
    $surname = htmlspecialchars($_POST['surname']);
    $id_number = htmlspecialchars($_POST['id_number']);
    $nationality = htmlspecialchars($_POST['nationality']);
    $race = htmlspecialchars($_POST['race']);
    $english_rate = htmlspecialchars($_POST['english_rate']);
    $education = htmlspecialchars($_POST['education']);
    $disability = htmlspecialchars($_POST['disability']);
    $disability_desc = isset($_POST['text']) ? htmlspecialchars($_POST['text']) : "";
    $telephone = isset($_POST['telephone']) ? htmlspecialchars($_POST['telephone']) : "";
    $mobile = htmlspecialchars($_POST['mobile']);
    $whatsapp = htmlspecialchars($_POST['whatsapp']);
    $email = htmlspecialchars($_POST['email']);
    $township = htmlspecialchars($_POST['township']);
    $other_township = isset($_POST['other_township']) ? htmlspecialchars($_POST['other_township']) : "";
    $internet_access = htmlspecialchars($_POST['internet_access']);
    $internet_description = isset($_POST['internet_description']) ? htmlspecialchars($_POST['internet_description']) : "";

    $business_name = htmlspecialchars($_POST['business_name']);
    $registration_number = htmlspecialchars($_POST['registration_number']);
    $industry = htmlspecialchars($_POST['industry']);
    $other_industry = htmlspecialchars($_POST['other_industry']);
    $home_address = htmlspecialchars($_POST['home_address']);
    $business_address = htmlspecialchars($_POST['business_address']);
    $tax_compliant = htmlspecialchars($_POST['tax_compliant']);
    $compliance_certification = htmlspecialchars($_POST['compliance_certification']);
    $years_operation = htmlspecialchars($_POST['years_operation']);
    $monthly_revenue = htmlspecialchars($_POST['monthly_revenue']);
    $other_ecommerce = htmlspecialchars($_POST['other_ecommerce']);
    $futur_ecommerce = htmlspecialchars($_POST['futur_ecommerce']);
    $other_delivery = htmlspecialchars($_POST['other_delivery']);

    // Handle checkbox arrays
    $ecommerce = isset($_POST['ecommerce']) ? $_POST['ecommerce'] : [];
    $delivery = isset($_POST['delivery']) ? $_POST['delivery'] : [];
    $devices = isset($_POST['devices']) ? $_POST['devices'] : [];

    $sanitized_devices = array_map('htmlspecialchars', $devices);
    $sanitized_ecommerce = array_map('htmlspecialchars', $ecommerce);
$sanitized_delivery = array_map('htmlspecialchars', $delivery);

$delivery_string = implode(', ', $sanitized_delivery);
$ecommerce_string = implode(', ', $sanitized_ecommerce);
$devices_string = implode(', ', $sanitized_devices);


    $target_dir = "uploads/";
    $base_url = "https://tdmap2025.22onsloane.co/uploads/"; // Full base URL for downloads
    $allowed_types = array("jpg", "jpeg", "png", "gif", "pdf", "doc", "docx", "xls", "xlsx", "csv", "mp4", "mp3", "zip", "ppt", "pptx");
    

    function uploadFile($file, $target_dir, $base_url, $allowed_types) {
        if (isset($_FILES[$file]) && $_FILES[$file]["error"] == 0) {
            $original_name = basename($_FILES[$file]["name"]);
            $file_type = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
    
            if (!in_array($file_type, $allowed_types)) {
                echo "Invalid file type for $file.";
                return null;
            }
    
            // Unique filename
            $unique_name = uniqid() . '_' . time() . '.' . $file_type;
            $target_file = $target_dir . $unique_name;
    
            if (move_uploaded_file($_FILES[$file]["tmp_name"], $target_file)) {
                return [
                    'original_filename' => $original_name,
                    'stored_filename' => $unique_name,
                    'full_url' => $base_url . $unique_name,
                    'filesize' => $_FILES[$file]["size"],
                    'filetype' => $_FILES[$file]["type"]
                ];
            } else {
                echo "Error uploading file: $file.";
                return null;
            }
        }
        return null;
    }
 

    $id_doc = uploadFile('id_doc', $target_dir, $base_url, $allowed_types);
    $industry_compliance_doc = uploadFile('industry_compliance_doc', $target_dir, $base_url, $allowed_types);
    $residence_address_doc = uploadFile('residence_address_doc', $target_dir, $base_url, $allowed_types);
    $tax_clearance_doc = uploadFile('tax_clearance_doc', $target_dir, $base_url, $allowed_types);
    $registration_doc = uploadFile('registration_doc', $target_dir, $base_url, $allowed_types);
    $bbbee_doc = uploadFile('bbbee_doc', $target_dir, $base_url, $allowed_types);
    $bank_statement_doc = uploadFile('bank_statement_doc', $target_dir, $base_url, $allowed_types);
    $company_profile_doc = uploadFile('company_profile_doc', $target_dir, $base_url, $allowed_types);
 
    $id_docpath = $id_doc['full_url'];
    $industry_compliance_docpath = $industry_compliance_doc['full_url'];
    $residence_address_docpath = $residence_address_doc['full_url'];
    $tax_clearance_docpath = $tax_clearance_doc['full_url'];
    $registration_docpath = $registration_doc['full_url'];
    $bbbee_docpath = $bbbee_doc['full_url'];
    $bank_statement_docpath = $bank_statement_doc['full_url'];
    $company_profile_docppath = $company_profile_doc['full_url'];
    $sql = "INSERT INTO applicant (
        full_name, surname, id_number, nationality, race, english_rate, education, disability,
        disability_desc, telephone, mobile, whatsapp, email, township, other_township, devices,
        internet_access, internet_description, business_name, registration_number, industry, other_industry,
        home_address, business_address, tax_compliant, compliance_certification, years_operation, 
        monthly_revenue, ecommerce_platfrom, other_ecommerce,futur_ecommerce, delivery_platform,other_delivery,id_doc_url, 
        industry_compliance_url, residence_address_url, tax_clearance_url, registration_doc_url,
        bbbee_doc_url, bank_statement_url, company_profile_url
    ) VALUES (
        '$full_name', '$surname', '$id_number', '$nationality', '$race', '$english_rate', '$education', '$disability',
        '$disability_desc', '$telephone', '$mobile', '$whatsapp', '$email', '$township', '$other_township', '$devices_string',
        '$internet_access', '$internet_description', '$business_name', '$registration_number', '$industry', '$other_industry',
        '$home_address', '$business_address', '$tax_compliant', '$compliance_certification', '$years_operation', 
        '$monthly_revenue', '$ecommerce_string', '$other_ecommerce', '$futur_ecommerce', '$delivery_string','$other_delivery',  '$id_docpath', '$industry_compliance_docpath', '$residence_address_docpath', '$tax_clearance_docpath', '$registration_docpath',
        '$bbbee_docpath', '$bank_statement_docpath', '$company_profile_docppath'
    )";
    
    // Execute the query directly
    if ($conn->query($sql) === TRUE) {
        // Send confirmation email
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug  = SMTP::DEBUG_OFF;
                $mail->isSMTP();
                $mail->Host       = 'za-smtp-outbound-1.mimecast.co.za';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'noreply@22onsloane.co';
                $mail->Password   = 'qGs7YK#w';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                $mail->setFrom('noreply@22onsloane.co', '22 On Sloane Team');
                $mail->addAddress($email, $fullname);
                $mail->addReplyTo('noreply@22onsloane.co', '22 On Sloane Team');


            $mail->isHTML(true);
            $mail->Subject = "Thank you for your application";
          $mail->Body = "
       <!DOCTYPE html>
        <html>
        <head>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
          <meta charset='UTF-8'>
        </head>
        <body style='margin:0; padding:0;  font-family:Arial, sans-serif;'>

          <div style='max-width:650px; margin:40px auto; background-repeat: no-repeat; background-position: center top; background-size: cover; position: relative;'>

          

            <div style='padding:20px;font-weight: bold;'>
            <div style='text-align:center;'>
              <img src='https://tdmap2025.22onsloane.co/web_banner002_1681x879.png' alt='TDMA logo' style='width:100%; margin-bottom:30px;' />
            </div>

            <!-- Message Body -->
            <p style='font-size:16px; color:#6980a3; font-weight:bold'>Dear $full_name,</p></br>
            <p style='font-size:16px; color:#6980a3; line-height:1.6;'>
              Thank you for submitting your application to join the Township Digital Market Access Programme. We appreciate your interest in contributing to this global initiative and helping shape the future of entrepreneurship.
            </p>

            <p style='font-size:16px; color:#6980a3; line-height:1.6;'>
            </br>Your application has been received, and is currently under review. You will receive feedback as soon as the evaluation process is complete.
            </p>
              </br>
            <p style='font-size:16px; color:#6980a3; line-height:1.6;'> If you do not hear from us within 2 months, please consider your application unsuccessful. </p>
            <p style='font-size:16px; color:#6980a3; margin-top:30px;'>Kind regards,<br><strong>22 On Sloane</strong></p>

            <!-- Partner Logos -->
            <div style='margin-top:40px; display:flex; justify-content:start; align-items:center;'>
              <img src='https://tdmap2025.22onsloane.co/uksatech.png' alt='Partner Logos' style='height:48px;' />
              <img src='https://tdmap2025.22onsloane.co/logo.png' alt='Partner Logos' style='height:48px;' />
            </div>
            </div>
        

          </div>
        </body>
        </html>

              
          ";

            $mail->send();
        } catch (Exception $e) {
            error_log("Email could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }

        // Show Thank You Modal
        echo <<<HTML
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Submission Successful</title>
<style>
#thankYouModal {
  display: flex;
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: rgba(0,0,0,0.6);
  justify-content: center;
  align-items: center;
  z-index: 9999;
  font-family: Arial, sans-serif;
}
.modalContent {
  background: #fff;
  border-radius: 12px;
  padding: 30px;
  max-width: 500px;
  width: 90%;
  text-align: center;
  box-shadow: 0 8px 20px rgba(0,0,0,0.3);
}
.modalContent img {
  width: 80px;
  margin-bottom: 15px;
}
.modalContent h2 {
  color: #2b2b2b;
  font-size: 22px;
}
.modalContent p {
  color: #555;
  font-size: 15px;
}
.modalContent button {
  margin-top: 20px;
  background: #007a3d;
  color: #fff;
  border: none;
  padding: 12px 25px;
  border-radius: 25px;
  cursor: pointer;
  font-size: 16px;
}
</style>
<script>
                function redirectToHome() {
                    window.location.href = 'https://www.22onsloane.co/h/';
                }
            </script>
</head>
<body>
<div id="thankYouModal">
<div class="modalContent">
  <img src="https://tdmap2025.22onsloane.co/logo.png" alt="SU20 Logo" />
  <h2>Thank You for your submission</h2>
  <p>Your application has been received. We appreciate your interest in joining the Township Digital Market Access Programme. We will review your submission and contact you shortly.</p>
  <button onclick="document.getElementById('thankYouModal').style.display='none'; setTimeout(() => { window.location.href = 'https://www.22onsloane.co/h/'; }, 500);">Close</button>

</div>
</div>
</body>
</html>
HTML;

    } else {
        echo "Oops, error saving data: " . $conn->error;
    }
$conn->close();
}
?>