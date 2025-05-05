<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';

// $host = "dedi332.cpt3.host-h.net";
// $username = "suorgaacue_2";
// $password = "M4LzY2xH9RMXKVcgmX48";
// $database = "suorgaacue_db2";


$host = "localhost";
$username = "";
$password = "M4LzY2xH9RMXKVcgmX48";
$database = "suorgaacue_db2";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = htmlspecialchars($_POST['full_name']);
    $lastname = htmlspecialchars($_POST['last_name']);
    $organization = htmlspecialchars($_POST['organization_affiliation']);
    $designation = htmlspecialchars($_POST['designation_role']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $home_country = htmlspecialchars($_POST['home_country']);
    $province = htmlspecialchars($_POST['province']);
    $city = htmlspecialchars($_POST['city']);
    $background = htmlspecialchars($_POST['background']);
    $qualification = htmlspecialchars($_POST['qualification']);
    $study_field = htmlspecialchars($_POST['study_field']);
    $any_other_study_field = htmlspecialchars($_POST['any_other_study_field']);
    $institution = htmlspecialchars($_POST['institution']);
    $country = htmlspecialchars($_POST['country']);
    $graduation_year = htmlspecialchars($_POST['graduation_year']);
    $councils_experience = htmlspecialchars($_POST['councils_experience']);
    $councils_experience_description = htmlspecialchars($_POST['councils_experience_description']);
    $taskforce = htmlspecialchars($_POST['taskforce']);
    $project_description = htmlspecialchars($_POST['project_description']);
    $meeting_hours = htmlspecialchars($_POST['meeting_hours']);
    $overall_comments = htmlspecialchars($_POST['overall_comments']);

    $target_dir = "uploads/";
$base_url = "https://www.su20.org/uploads/"; // Full base URL for downloads
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

$file1 = uploadFile("cv_document", $target_dir, $base_url, $allowed_types);

if ($file1) {
    $filepath = $file1['full_url']; // full URL for download

    $sql = "INSERT INTO applicant (
        fullname, last_name, organization_affiliation, designation_role, email, phone, home_country, province, city, background, 
        qualification, study_field, any_other_study_field, institution, country, graduation_year, councils_experience, 
        councils_experience_description, taskforce, project_description, meeting_hours, overall_comments, 
        file_url1, filename1, filesize1, filetype1
    ) VALUES (
        '$firstname', '$lastname','$organization', '$designation', '$email', '$phone', '$home_country', '$province', '$city', '$background', 
        '$qualification', '$study_field', '$any_other_study_field', '$institution', '$country', '$graduation_year', '$councils_experience', 
        '$councils_experience_description', '$taskforce', '$project_description', '$meeting_hours', '$overall_comments', 
        '$filepath', '{$file1['original_filename']}', '{$file1['filesize']}', '{$file1['filetype']}'
    )";
        if ($conn->query($sql) === TRUE) {
            // Send confirmation email
            $mail = new PHPMailer(true);
            try {
                $mail->SMTPDebug  = SMTP::DEBUG_OFF;
                $mail->isSMTP();
                $mail->Host       = 'smtp.office365.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'info@su20.org';
                $mail->Password   = 'LMp&#0081!';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                $mail->setFrom(' info@su20.org', 'SU20 South Africa');
                $mail->addAddress($email, $firstname);
                $mail->addReplyTo('info@su20.org', 'SU20 South Africa');

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
               <!--[if gte mso 9]>
                <v:background xmlns:v='urn:schemas-microsoft-com:vml' fill='true'>
                  <v:fill type='frame' src='https://su20.org/white-bg.jpg' color='#ffffff'/>
                </v:background>
                <![endif]-->
                <div style='max-width:650px; margin:40px auto; background-image: url(\"https://su20.org/white-bg.jpg\"); background-repeat: no-repeat; background-position: center top; background-size: cover; position: relative;'>

                  <!-- Decorative Top Left Icon -->
                  <table width='100%' cellpadding='0 cellspacing='0 border='0'>
                <tr>
                  <td align='left' style='padding-top: 0px;'>
                    <img src='https://su20.org/email-icon-top.png' alt='Corner Icon' style='width: 100px; display: block;'/>
                  </td>
                </tr>
              </table>

                  <div style='padding:20px;font-weight: bold;'>
                    <!-- SU20 Logo and Header -->
                  <div style='text-align:center;'>
                    <img src='https://su20.org/SU20_LOGO_CONCEPTS_v4_Primary_logo.png' alt='SU20 Logo' style='width:200px; margin-bottom:30px;' />
                  </div>

                  <!-- Message Body -->
                  <p style='font-size:16px; color:#6980a3; font-weight:bold'>Dear $firstname,</p></br>

                  <p style='font-size:16px; color:#6980a3; line-height:1.6;'>
                    Thank you for submitting your application to join the Startup20 Task Force. We appreciate your interest in contributing to this global initiative and helping shape the future of entrepreneurship.
                  </p>

                  <p style='font-size:16px; color:#6980a3; line-height:1.6;'>
                  </br>Your application has been received, and is currently under review. You will receive feedback as soon as the evaluation process is complete.
                  </p>

                  <p style='font-size:16px; color:#6980a3; margin-top:30px;'>Kind regards,<br><strong>SU20 Secretariat</strong></p>

                  <!-- Partner Logos -->
                  <div style='margin-top:40px; display:flex; justify-content:start; align-items:center;'>
                    <img src='https://su20.org/email-partners.png' alt='Partner Logos' style='height:48px;' />
                  </div>
                  </div>

                <table width='100%' cellpadding='0 cellspacing='0 border='0'>
                <tr>
                  <td align='right' style='padding-top: 20px;'>
                    <img src='https://su20.org/email-icon-bottom.png' alt='Corner Icon' style='width: 100px; display: block;'/>
                  </td>
                </tr>
              </table>

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
                        window.location.href = 'https://su20.org';
                    }
                </script>
</head>
<body>
  <div id="thankYouModal">
    <div class="modalContent">
      <img src="SU20_LOGO_CONCEPTS_v4_Primary_logo.png" alt="SU20 Logo" />
      <h2>Thank You for your submission</h2>
      <p>Your application has been received. We appreciate your interest in joining the TaskForce. We will review your submission and contact you shortly.</p>
      <button onclick="document.getElementById('thankYouModal').style.display='none'; setTimeout(() => { window.location.href = 'https://su20.org'; }, 500);">Close</button>

    </div>
  </div>
</body>
</html>
HTML;

        } else {
            echo "Oops, error saving data: " . $conn->error;
        }
    }

    $conn->close();
}
?>
