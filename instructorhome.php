<?php
session_start();
if (!isset($_SESSION["instructorloggedin"]) || $_SESSION["instructorloggedin"] !== true) {
    header("location: instructorlogin.php");
    exit;
}

include "database.php"; // Include the database connection

// Fetch leaderboard data
$sql = "SELECT rollnumber, totalmarks, maxmarks, 
               (totalmarks / maxmarks * 100) AS percentage 
        FROM result 
        WHERE submit = 1 
        ORDER BY totalmarks DESC, percentage DESC 
        LIMIT 10"; // Top 10 students
$result = $conn->query($sql);

$leaderboard = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $leaderboard[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="./assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Pinnacle Portal - Instructor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="./assets/css/material-kit.css?v=2.0.4" rel="stylesheet" />
</head>

<body class="landing-page sidebar-collapse">
    <nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
        <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand" href="instructorhome.php">Pinnacle Portal</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <i class="material-icons">apps</i> Manage
                        </a>
                        <div class="dropdown-menu dropdown-with-icons">
                            <a href="quizconfig.php" class="dropdown-item">
                                <i class="material-icons">layers</i> Set Quiz
                            </a>
                            <a href="questionfeed.php" class="dropdown-item">
                                <i class="material-icons">input</i> Feed Questions
                            </a>
                            <a href="multiquestionfeed.php" class="dropdown-item">
                                <i class="material-icons">input</i> Multi Feed Questions
                            </a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="instructorlogout.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="page-header header-filter" data-parallax="true" style="background-image: url('./assets/img/profile_city.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto">
                    <h1 class="text-center">Welcome to Instructor's Portal</h1>
                    <p class="text-center">Manage all quiz content and view performance data.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="main main-raised">
        <div class="container">
            <!-- Leaderboard Section -->
            <div class="section text-center">
                <h2 class="title">Leaderboard</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Roll Number</th>
                                <th>Total Marks</th>
                                <th>Max Marks</th>
                                <th>Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($leaderboard)) : ?>
                                <?php foreach ($leaderboard as $index => $row) : ?>
                                    <tr>
                                        <td><?php echo $index + 1; ?></td>
                                        <td><?php echo $row['rollnumber']; ?></td>
                                        <td><?php echo $row['totalmarks']; ?></td>
                                        <td><?php echo $row['maxmarks']; ?></td>
                                        <td><?php echo number_format($row['percentage'], 2); ?>%</td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="5">No quiz results available.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Quiz Management Section -->
            <div class="section text-center">
                <h2 class="title">Manage Quiz Content</h2>
                <p>Use the navigation menu to configure quizzes and feed questions into the system.</p>
                <p><a href="quizconfig.php" class="btn btn-primary btn-round">Set Quiz</a></p>
                <p><a href="questionfeed.php" class="btn btn-primary btn-round">Feed Questions</a></p>
                <p><a href="multiquestionfeed.php" class="btn btn-primary btn-round">Multi Feed Questions</a></p>
            </div>
        </div>
    </div>

    <script src="./assets/js/core/jquery.min.js"></script>
    <script src="./assets/js/core/popper.min.js"></script>
    <script src="./assets/js/core/bootstrap-material-design.min.js"></script>
    <script src="./assets/js/material-kit.js?v=2.0.4"></script>
</body>

</html>
