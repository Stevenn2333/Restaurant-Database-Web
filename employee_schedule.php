<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Employee</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Select an Employee to View Schedule</h1>
        <nav>
            <ul>
                <li><a href="restaurant.html" class="home-button">Back to Home</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <form action="display_schedule.php" method="post">
                <?php
                    include 'connectdb.php';

                    $query = "SELECT EmployeeID, Fname, Lname FROM Employee";
                    $result = $connection->query($query);

                    if ($result) {
                        echo "Please choose an employee:<br>";
                        while ($row = $result->fetch()) {
                            echo '<label><input type="radio" name="employee" value="'.$row["EmployeeID"].'">'.$row["Fname"].' '.$row["Lname"].'</label><br>';
                        }
                    } else {
                        echo "Error: " . $connection->error;
                    }

                    $connection = NULL;
                ?>
                <input type="submit" value="View Schedule">
            </form>
        </section>
    </main>
</body>
</html>
