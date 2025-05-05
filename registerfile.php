<?php

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
// $host = "dedi332.cpt3.host-h.net"; // Change as needed
// $username = "tdmaputmxp_2"; // Change as needed
// $password = "D4znU3QrMnTnYsWcnRS8"; // Change as needed
// $database = "tdmaputmxp_db2";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


    // Get JSON data from the request body (form fields)
    

    // Handle file upload
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars($_POST['name']);
        $contactnumber = htmlspecialchars($_POST['contactnumber']);
        $idnumber = htmlspecialchars($_POST['idnumber']);
        $email = htmlspecialchars($_POST['email']);
        $gender = htmlspecialchars($_POST['gender']);
        $race = htmlspecialchars($_POST['race']);
        $disability = htmlspecialchars($_POST['disability']);
        $type_disability = htmlspecialchars($_POST['type_disability']);
        $province = htmlspecialchars($_POST['province']);
        $city = htmlspecialchars($_POST['city']);
        $qualifications_owner = htmlspecialchars($_POST['qualifications_owner']);
        $business_name = htmlspecialchars($_POST['business_name']);
        $registration_number = htmlspecialchars($_POST['registration_number']);
        $business_address = htmlspecialchars($_POST['business_address']);
        $business_stage = htmlspecialchars($_POST['business_stage']);
        $sector = htmlspecialchars($_POST['sector']);
        $industry = htmlspecialchars($_POST['industry']);
        $business_compliance = htmlspecialchars($_POST['business_compliance']);
        $business_offering = htmlspecialchars($_POST['business_offering']);
        $business_duration = htmlspecialchars($_POST['business_duration']);
        $annual_turnover = htmlspecialchars($_POST['annual_turnover']);
        $monthly_turnover = htmlspecialchars($_POST['monthly_turnover']);
        $employees = htmlspecialchars($_POST['employees']);
        $leadership_structure = htmlspecialchars($_POST['leadership_structure']);
        $tax_compliance = htmlspecialchars($_POST['tax_compliance']);
        $target_market = htmlspecialchars($_POST['target_market']);
        $market_documentation = htmlspecialchars($_POST['market_documentation']);
        $competitors = htmlspecialchars($_POST['competitors']);
        $competitor_analysis = htmlspecialchars($_POST['competitor_analysis']);
        $product_uniqueness = htmlspecialchars($_POST['product_uniqueness']);
        $business_strengths = htmlspecialchars($_POST['business_strengths']);
        $areas_for_improvement = htmlspecialchars($_POST['areas_for_improvement']);
        $marketing_strategy = htmlspecialchars($_POST['marketing_strategy']);
        $operation_location = htmlspecialchars($_POST['operation_location']);
        $efficiency_rating = htmlspecialchars($_POST['efficiency_rating']);
        $sop = htmlspecialchars($_POST['sop']);
        $operations_process = htmlspecialchars($_POST['operations_process']);
        // Check if a file was uploaded without errors

        $target_dir = "uploads_wedp/";
        $base_url = "https://tdmap2025.22onsloane.co/uploads_wedp/"; // Full base URL for downloads
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
        $tax_clearance_doc = uploadFile('tax_clearance_doc', $target_dir, $base_url, $allowed_types);
        $registration_doc = uploadFile('registration_doc', $target_dir, $base_url, $allowed_types);
        $bbbee_doc = uploadFile('bbbee_doc', $target_dir, $base_url, $allowed_types);
        $company_profile_doc = uploadFile('company_profile_doc', $target_dir, $base_url, $allowed_types);
     
        $id_docpath = $id_doc['full_url'];
        $tax_clearance_docpath = $tax_clearance_doc['full_url'];
        $registration_docpath = $registration_doc['full_url'];
        $bbbee_docpath = $bbbee_doc['full_url'];
        $company_profile_docppath = $company_profile_doc['full_url'];


       // Insert the file information into the database

      
            $sql = "INSERT INTO attendees (name, contactnumber, idnumber, email, gender, race, disability, type_disability, province, city, qualifications_owner, business_name, registration_number, business_address, business_stage, sector, industry, business_compliance, business_offering, business_duration, annual_turnover, monthly_turnover, employees, leadership_structure, tax_compliance, target_market, market_documentation, competitors, competitor_analysis, product_uniqueness, business_strengths, areas_for_improvement, marketing_strategy, operation_location, efficiency_rating, sop, operations_process,  id_doc_url, tax_clearance_url, registration_doc_url, bbbee_doc_url, company_profile_url) 
                    VALUES ('$name', '$contactnumber', '$idnumber', '$email', '$gender', '$race', '$disability', '$type_disability', '$province', '$city', '$qualifications_owner', '$business_name', '$registration_number', '$business_address', '$business_stage', '$sector', '$industry', '$business_compliance', '$business_offering', '$business_duration', '$annual_turnover', '$monthly_turnover', '$employees', '$leadership_structure', '$tax_compliance', '$target_market', '$market_documentation', '$competitors', '$competitor_analysis', '$product_uniqueness', '$business_strengths', '$areas_for_improvement', '$marketing_strategy', '$operation_location', '$efficiency_rating', '$sop', '$operations_process', '$id_docpath', '$tax_clearance_docpath', '$registration_docpath', '$bbbee_docpath', '$company_profile_docppath')";
        
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