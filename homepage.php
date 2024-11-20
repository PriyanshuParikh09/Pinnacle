<?php
// index.php - Homepage for Quiz Portal
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Pinnacle</title>
    <!-- Link to External CSS -->
    <link rel="stylesheet" href="style.css">
    <script>
        // JavaScript to update the clock
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('clock').innerText = `${hours}:${minutes}:${seconds}`;
        }
        setInterval(updateClock, 1000); // Update clock every second
    </script>
</head>
<body onload="updateClock()">
    <div id="clock" class="clock"></div> <!-- Clock displayed here -->
    <div class="container">
        <h1 class="heading">Welcome to Pinnacle</h1>
        <div class="buttons">
            <a href="instructorlogin.php" class="btn btn-primary">Teacher Login</a>
            <a href="studentlogin.php" class="btn btn-secondary">Student Login</a>
        </div>
    </div>
</body>
</html>
