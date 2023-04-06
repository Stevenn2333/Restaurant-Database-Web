<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Schedule</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Employee Schedule</h1>
        <nav>
            <ul>
                <li><a href="restaurant.html" class="home-button">Back to Home</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <?php
            include 'connectdb.php';

            $employeeID = $_POST["employee"];
            $query = "
            SELECT e.Fname, e.Lname, s.Day, s.Starttime, s.Sndtime AS Endtime, DAYNAME(s.Day) AS DayOfWeek
            FROM Employee e
            JOIN Shift s ON e.EmployeeID = s.EmployeeID
            WHERE e.EmployeeID = $employeeID
            AND DAYOFWEEK(s.Day) != 1 AND DAYOFWEEK(s.Day) != 7
            ORDER BY s.Day ASC;";

            $result = $connection->query($query);

            if ($result) {
                $employeeName = '';
                echo '<table border="1">';
                echo '<tr><th>Day</th><th>Start Time</th><th>End Time</th><th>Day ofWeek</th></tr>';
                while ($row = $result->fetch()) {
                    if (empty($employeeName)) {
                        $employeeName = $row['Fname'] . ' ' . $row['Lname'];
                    }
                    echo "<h2>Schedule for $employeeName</h2>";
                    echo '<tr>';
                    echo '<td>' . $row['Day'] . '</td>';
                    echo '<td>' . $row['Starttime'] . '</td>';
                    echo '<td>' . $row['Endtime'] . '</td>';
                    echo '<td>' . $row['DayOfWeek'] . '</td>';
                    echo '</tr>';
                }
                echo '</table>';       
            } else {
                echo "Error: " . $connection->error;
            }

            $connection = NULL;
            ?>
        </section>
    </main>
</body>
</html>

