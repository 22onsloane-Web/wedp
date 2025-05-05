<?php
$host = "dedi332.cpt3.host-h.net";
$username = "scbpoahnxj_1";
$password = "jHLwh4hxcUi8b3wqCSS8";
$database = "scbpoahnxj_db1";


$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT SUM(employees) AS totalEmployees, SUM(monthly_turnover) AS totalMonthlyTurnover, SUM(annual_turnover) AS totalAnnualTurnover, COUNT(*) AS totalApplications FROM attendees";
$result = $conn->query($query);
$data = $result->fetch_assoc();

$totalJobs = $data['totalEmployees'];
$totalMonthly = $data['totalMonthlyTurnover'];
$totalAnnual = $data['totalAnnualTurnover'];
$totalSMMEs = $data['totalApplications'];

$aveJobs = intdiv($totalJobs, $totalSMMEs);
$aveMonthly = intdiv($totalMonthly, $totalSMMEs);
$aveAnnual = intdiv($totalAnnual, $totalSMMEs);

$query2 = "SELECT DATE(created_at) AS day, COUNT(*) AS count FROM attendees GROUP BY day ORDER BY day";
$result2 = $conn->query($query2);
$applicationsPerDay = [];
$days = [];
while ($row = $result2->fetch_assoc()) {
    $days[] = $row['day'];
    $applicationsPerDay[] = $row['count'];
}

$query3 = "SELECT province, COUNT(*) AS count FROM attendees GROUP BY province";
$result3 = $conn->query($query3);
$applicationsPerProvince = [];
while ($row = $result3->fetch_assoc()) {
    $applicationsPerProvince[$row['province']] = $row['count'];
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Application Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        <h2 class="text-center mb-4">SMME Capacity Building Programme - Dashboard</h2>
        <div class="row pt-3 mb-3">
            <div class="col-12">
                <a href="https://scbp2025.22onsloane.co/export.php"  class="btn btn-custom">View scbp registration data</a>
                <a href="https://witep2025.22onsloane.co/export.php"  class="d-none mx-4 btn btn-custom">View witep registration data</a>
            </div>
        </div>
        
        <div class="row text-center">
            <div class="col-md-3">
                <div class="card p-3 shadow">
                    <h5>Total Employees / Jobs</h5>
                    <h3><?php echo $data['totalEmployees']; ?></h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3 shadow">
                    <h5>Total Monthly Turnover</h5>
                    <h3>R <?php echo number_format($data['totalMonthlyTurnover'], 2); ?></h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3 shadow">
                    <h5>Total Annual Turnover</h5>
                    <h3>R <?php echo number_format($data['totalAnnualTurnover'], 2); ?></h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3 shadow">
                    <h5>Total Applications</h5>
                    <h3><?php echo $data['totalApplications']; ?></h3>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-3">
                <div class="card p-3 shadow">
                    <h5>Ave Employees / Jobs</h5>
                    <h3><?php echo $aveJobs; ?></h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3 shadow">
                    <h5>Ave Monthly Turnover</h5>
                    <h3>R <?php echo number_format($aveMonthly, 2); ?></h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3 shadow">
                    <h5>Ave Annual Turnover</h5>
                    <h3>R <?php echo number_format($aveAnnual, 2); ?></h3>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-md-8">
                <canvas id="applicationsChart"></canvas>
            </div>
            <div class="col-md-4">
                <canvas id="provinceChart"></canvas>
            </div>
        </div>
    </div>
    
    <script>
        new Chart(document.getElementById('applicationsChart'), {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($days); ?>,
                datasets: [{
                    label: 'Applications per Day',
                    data: <?php echo json_encode($applicationsPerDay); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)'
                }]
            },
            options: { responsive: true }
        });
        
        new Chart(document.getElementById('provinceChart'), {
            type: 'pie',
            data: {
                labels: <?php echo json_encode(array_keys($applicationsPerProvince)); ?>,
                datasets: [{
                    label: 'Applications per Province',
                    data: <?php echo json_encode(array_values($applicationsPerProvince)); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)',
                        'rgba(199, 199, 199, 0.6)',
                        'rgba(83, 102, 255, 0.6)',
                        'rgba(60, 179, 113, 0.6)'
                    ]
                }]
            }
        });
    </script>
</body>
</html>
