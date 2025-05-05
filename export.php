<?php
// Database connection settings

$host = "dedi332.cpt3.host-h.net";
$username = "scbpoahnxj_1"; // Change as needed
$password = "jHLwh4hxcUi8b3wqCSS8"; // Change as needed
$database = "scbpoahnxj_db1";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all registration data
$sql = "SELECT * FROM attendees"; // Change `registrations` to your actual table name
$result = $conn->query($sql);

// Export to Excel functionality
if (isset($_POST['export'])) {
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=scbp2025registration_data.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    
    echo "<table border='1'>";
    echo "<tr>";
    while ($field = $result->fetch_field()) {
        echo "<th>" . $field->name . "</th>";
    }
    echo "</tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $data) {
            echo "<td>" . $data . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

        .bg-custom {
            background-color: #fe5c01;
            background-image: #fe5c01;
            background: #fe5c01;
            color: white;
        }

        .btn-custom {
            background-color: #fe5c01;
            color: white;
            border: none;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #f77f3b; /* Darker shade for hover effect */
            color: white;
            transform: translateY(-2px) scale(1.01);
            box-shadow: 0 20px 40px rgba(250, 181, 142, 0.55);
        }
         
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center">SMME Capacity Building Programme - Registration Data</h2>
        <form method="post" class="mb-3">
            <button class="btn btn-custom" type="submit" name="export">Export to Excel</button>
            <a href="https://scbp2025.22onsloane.co/impact.php"  class="px-4 btn btn-custom">View Dashboard</a>
        </form>
        <table class="table table-bordered table-striped">
            <thead class="table-secondary">
                <tr>
                    <?php while ($field = $result->fetch_field()) { ?>
                        <th><?php echo $field->name; ?></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <?php foreach ($row as $data) { ?>
                            <td><?php echo htmlspecialchars($data); ?></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
$conn->close();
?>
